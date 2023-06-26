<?php

namespace App\Http\Controllers\Api;

use App\Textile;
use App\Transaction;
use App\TransactionDetail;
use App\TransactionPay;
use App\UserDetail;
use App\Wallet;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class WalletsController
{

    protected $wallet;

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function get()
    {
        $transactions = TransactionPay::
        with('transaction')
            ->where('user_id', auth()->id())->orderBy('id', 'desc')->get();

        $amount = $this->wallet->getAccountBalance(auth()->id());
        return response()->json(['transactions' => $transactions, 'amount' => $amount, 'success' => 1]);
    }

    public function add(Request $request)
    {
        $success = false;
        $message = '';
        $data = $request->json()->all();
        $amount = str_replace(',', '', $data['amount']);

        DB::beginTransaction();
        try {

            $transaction = Transaction::Insert([
                'action_id' => 1,
                'user_id' => auth()->id(),
                'amount' => $amount,
                'description' => __('wallet.charge_wallet')]);

            $transactionDetail = TransactionDetail::Insert([
                'actiondetail_id' => 1,
                'user_id' => auth()->id(),
                'transaction_id' => $transaction->id,
                'accounthead_id' => 2,
                'amount' => $amount,
                'description' => __('wallet.charge_wallet')]);

            $transactionPay = TransactionPay::Insert([
                'user_id' => auth()->id(),
                'transaction_id' => $transaction->id,
                'bank_id' => 1]);

            $long = strtotime(date('Y-m-d H:i:s'));
            $random = rand(1000, 1000000);
            $call_back_url = getConstant('site_url').'/api/wallets/verify/'.$transaction->id.'/'.$amount;

            DB::commit();
            $message = __('wallet.wallet_has_been_saved');


            $invoice = (new Invoice)->amount(intval($amount));

            $response = Payment::callbackUrl(route('wallet.api.verify',[$transaction->id,$amount]))->purchase($invoice, function ($driver, $transactionId) use ($transaction) {
                // store transactionId in database, we need it to verify payment in future.
                $transaction->gateway_transaction_id = $transactionId;
                $transaction->save();

            })->pay();

            $response = json_encode($response);
            $response = json_decode($response, true);

            $url = $response['action'];

            $success = 1;
        } catch (\QueryException $e) {
            DB::rollBack();
            $message = __('wallet.wallet_dont_saved');
            $success = 1;
        }
        return response()->json(['message' => $message, 'success' => $success,
            'call_back_url' => $call_back_url,
            'sum_price' => $amount,
            'order_id' => $long,
            'transaction_id' => $transaction->id,
            'title' => __('wallet.charge_wallet'),
            'url' => $url
        ]);
    }

    public function gateway(Request $request)
    {
        $data = $request->json()->all();
        $transaction = Transaction::where('id', $data['transaction_id'])->first();
        $create_at = $transaction->created_at;

        if ($request->isMethod('post')) {
            # create new invoice
            $invoice = (new Invoice)->amount(intval($data['sum_price']));
            # purchase and pay the given invoice
            // you should use return statement to redirect user to the bank's page.
            $response = Payment::purchase($invoice, function ($driver, $transactionId) use ($transaction) {
                // store transactionId in database, we need it to verify payment in future.
                $transaction->gateway_transaction_id = $transactionId;
                $transaction->save();

            })->pay();
            $response = json_encode($response);
            $response = json_decode($response, true);

            return redirect($response['action']);

        }

        return view(currentFrontView('wallets.gateway'));
    }

    public function verify(Request $request, $transaction_id, $sum_price)
    {

        $message = '';
        $ReferenceId = 0;
        try {
            $data = $request->json()->all();
            $transaction = Transaction::where('id', $transaction_id)->first();
            $create_at = $transaction->created_at;
            $receipt = Payment::amount(intval($sum_price))->transactionId($transaction->gateway_transaction_id)->verify();

            // you can show payment's referenceId to user
            //echo $receipt->getReferenceId();
            $ReferenceId = $receipt->getReferenceId();
            if (!empty($ReferenceId)) {
                $transPay = TransactionPay::where('transaction_id', $transaction->id)->first();
                $transPay->refid = $ReferenceId;
                $transPay->status = 1;
                $transPay->save();

                $wallet = Wallet::where('user_id', auth()->id())->first();
                $wallet->amount = $sum_price;
                $wallet->save();
            }

        } catch (InvalidPaymentException $exception) {
            /**
             * when payment is not verified , it throw an exception.
             * we can catch the excetion to handle invalid payments.
             * getMessage method, returns a suitable message that can be used in user interface.
             **/
            $message = $exception->getMessage();
            $transPay = TransactionPay::where('transaction_id', $transaction->id)->first();
            $transPay->message = $message;
            $transPay->save();
        }

        return view(currentFrontView('wallets.appverify'), compact('create_at', 'ReferenceId', 'message'));
    }


}
