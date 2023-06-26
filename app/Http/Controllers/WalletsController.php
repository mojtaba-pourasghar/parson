<?php

namespace App\Http\Controllers;

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

    public function add(Request $request)
    {
        $amount = $this->wallet::getAccountBalance(auth()->id());


        if ($request->isMethod('post')) {

            $amount = str_replace(',', '', $request->amount);

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

                $session = [
                    'title' => __('wallet.charge_wallet'),
                    'sum_price' => $amount,
                    'other_price' => 0,
                    'sum_item' => 1,
                    'orderid' => $long,
                    'model' => 'Wallet',
                    'token' => $random,
                    'row_id' => $transaction->id,
                    'call_back_url' => route('wallet.verify')
                ];

                Session::put('PayInfo', $session);

                DB::commit();
                flash()->success(__('wallet.wallet_has_been_saved'));
                return redirect(route('wallet.gateway'));
            } catch (\QueryException $e) {
                DB::rollBack();
                flash()->error(__('wallet.wallet_dont_saved'));
            }

        }
        $transactions = TransactionPay::where('user_id',auth()->id())->orderBy('id', 'desc')->get();

        return view(currentFrontView('wallets.add'), compact('amount','transactions'));
    }

    public function gateway(Request $request)
    {
        $PayInfo = Session::get('PayInfo');
        $transaction = Transaction::where('id', $PayInfo['row_id'])->first();
        $create_at = $transaction->created_at;

        if ($request->isMethod('post')) {
            # create new invoice
            $invoice = (new Invoice)->amount(intval($PayInfo['sum_price']));
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

        return view(currentFrontView('wallets.gateway'), compact('PayInfo', 'create_at'));
    }

    public function verify()
    {
        $message = '';
        $ReferenceId = 0;
        try {
            $PayInfo = Session::get('PayInfo');
            $transaction = Transaction::where('id', $PayInfo['row_id'])->first();
            $create_at = $transaction->created_at;
            $receipt = Payment::amount(intval($PayInfo['sum_price']))->transactionId($transaction->gateway_transaction_id)->verify();

            // you can show payment's referenceId to user
            //echo $receipt->getReferenceId();
            $ReferenceId = $receipt->getReferenceId();
            if (!empty($ReferenceId)) {
                $transPay = TransactionPay::where('transaction_id', $transaction->id)->first();
                $transPay->refid = $ReferenceId;
                $transPay->status = 1;
                $transPay->save();

                $wallet = Wallet::where('user_id', auth()->id())->first();
                if (empty($wallet))
                {
                    $wallet = Wallet::Insert(auth()->id(),$PayInfo['sum_price']);
                }else{
                    $wallet->amount =  $wallet->amount + $PayInfo['sum_price'];
                    $wallet->save();
                }

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
        session()->forget('PayInfo');
        return view(currentFrontView('wallets.verify'), compact('PayInfo', 'create_at', 'ReferenceId', 'message'));
    }

    public function refresh()
    {
        $Basket_Info = Session::get('Basket_Info');

        $count = 0;
        if (!empty($Basket_Info))
            $count = count($Basket_Info);
        return response()->json(['basket_count' => $count]);
    }

    public function list()
    {
        //session()->forget('Basket_Info');
        $Basket_Info = session('Basket_Info');
        $userDetail = UserDetail::where([['user_id', auth()->id()], ['selected', 1]])->first();
        //return $Basket_Info;
        return view(currentFrontView('basket.list'), compact('Basket_Info', 'userDetail'));
    }

    public function delete($id)
    {
        $session_arr = Session::get('Basket_Info');

        if (!empty($session_arr)) {
            foreach ($session_arr as $key => $basket_textile) {
                if ($basket_textile['textile_id'] == $id) {
                    unset($session_arr[$key]);
                    break;
                }
            }
        }
        Session::put('Basket_Info', $session_arr);
        $Basket_Info = $session_arr;
        return view(currentFrontView('basket.list'), compact('Basket_Info'));
    }
}
