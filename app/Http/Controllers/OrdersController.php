<?php

namespace App\Http\Controllers;


use App\Order;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\OrderItem;
use App\Textile;
use App\User;
use App\Transaction;
use App\TransactionDetail;
use App\TransactionPay;
use App\UserDetail;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;


class OrdersController extends Controller
{
    protected $orders;
    protected $path;

    public function __construct(Order $orders)
    {
        $this->orders = $orders;
        parent::__construct();
    }

    public function save(Request $request)
    {
        $Basket_Info = Session::get('Basket_Info');

        if (empty($Basket_Info)) {
            flash()->error(__('order.this_order_is_empty'));
            return redirect(route('order.step2'));
        }
        $sum_price = 0;
        $items_count = 0;
        foreach ($Basket_Info as $order_item) {
            $textile = Textile::getPrice($order_item['textile_id']);
            if ($textile->available_amount - $order_item['requested_size'] < 1){
                flash()->error('موجودی کافی بابت پارچه '.$textile->title.' موجود نمی باشد');
                return redirect(route('order.step2'));
            }
            $sum_price += $order_item['sum_price'];
            $items_count += $order_item['requested_size'];
            if (empty($textile)) {
                flash()->error(__('order.items_in_order_not_correct'));
                return redirect(route('order.step2'));
            }
        }
        $userDetail = UserDetail::where([['user_id', auth()->id()], ['selected', 1]])->first();
        DB::beginTransaction();
        try {

            $order = $this->orders->create([
                'user_id' => auth()->id(),
                'bank_id' => 0,
                'transaction_pay_id' => 0,
                'from_getway' => 2,
                'sum_price' => $sum_price,
                'items_count' => $items_count,
                'user_detail_id' => $userDetail->id,
            ]);

            foreach ($Basket_Info as $order_item) {
                $OrderItem = new OrderItem();
                $OrderItem->order_id = $order->id;
                $OrderItem->textile_id = $order_item['textile_id'];
                $OrderItem->item_count = $order_item['requested_size'];
                $OrderItem->sum_price = $order_item['sum_price'];
                $OrderItem->color = $order_item['color'];
                $order->order_items()->save($OrderItem);
                $textile = Textile::find($order_item['textile_id']);
                $textile->available_amount -= $order_item['requested_size'];
                $textile->save();
            }

            $transaction = Transaction::Insert([
                'action_id' => 2,
                'user_id' => auth()->id(),
                'amount' => $sum_price,
                'description' => __('order.save_order_with_number') . ' : ' . $order->id]);

            $transactionDetail = TransactionDetail::Insert([
                'actiondetail_id' => 3,
                'user_id' => auth()->id(),
                'transaction_id' => $transaction->id,
                'accounthead_id' => 2,
                'amount' => $order_item['sum_price'],
                'description' => __('order.save_order_with_number') . ' : ' . $order->id]);

            $transactionPay = TransactionPay::Insert([
                'user_id' => auth()->id(),
                'transaction_id' => $transaction->id,
                'bank_id' => 1]);

            $order->transaction_pay_id = $transactionPay->id;
            $orderCode = 'PRS-' . $order->id;
            $order->code = $orderCode;
            $order->save();

            $random = rand(1000, 1000000);
            $session = [
                'title' => __('wallet.charge_wallet'),
                'sum_price' => $sum_price,
                'other_price' => 0,
                'sum_item' => $items_count,
                'ordercode' => $orderCode,
                'orderid' => $order->id,
                'model' => 'Order',
                'token' => $random,
                'row_id' => $transaction->id,
                'call_back_url' => route('order.step3')
            ];

            Session::put('PayInfo', $session);


            DB::commit();
            flash()->success(__('order.the_order_have_been_saved'));



            $invoice = (new Invoice)->amount(intval($sum_price));
            Payment::purchase($invoice, function ($driver, $transactionId) use ($transaction) {
                $transaction->gateway_transaction_id = $transactionId;
                $transaction->save();
            });

            Payment::callbackUrl(route('order.step3'))->purchase(
                $invoice,
                function ($driver, $transactionId) use ($transaction){
                    $transaction->gateway_transaction_id = $transactionId;
                    $transaction->save();
                }
            );
            $response = Payment::pay();

            $response = json_encode($response);
            $response = json_decode($response, true);

            return redirect($response['action']);

        } catch (\QueryException $e) {
            DB::rollBack();
            flash()->error(__('order.order_not_saved'));
        }
        return redirect(route('orders.step2'));
    }

    public function list()
    {
        $success = 1;
        $message = '';

        $orders = $this->orders
            ->with('transaction_pay')
            //->select('id','sum_price','items_count')
            ->with([
                'user_detail' => function ($query) {
                    return $query->select('id', 'recipient_name', 'address');
                }])
            ->orderBy('id','desc')
            ->where([['user_id', '=', auth()->id()]])
            ->get();

        return view(currentFrontView('orders.list'), compact('orders'));
    }

    public function step1()
    {
        $userDetail = UserDetail::where([['user_id', auth()->id()], ['selected', 1]])->first();
        return view(currentFrontView('orders.step1'), compact('userDetail'));
    }

    public function step2()
    {
        $Basket_Info = Session::get('Basket_Info');

        $userDetail = UserDetail::where([['user_id', auth()->id()], ['selected', 1]])->first();
        $sum_price_discount = 0;
        $sum_price = 0;
        if (!empty($Basket_Info)) {
            foreach ($Basket_Info as $item) {
                $sum_price_discount += $item['sum_price_discount'];
                $sum_price += $item['sum_price'];
            }
        }

        return view(currentFrontView('orders.step2'), compact('userDetail', 'sum_price_discount', 'sum_price', 'Basket_Info'));
    }

    public function step3()
    {
        $ReferenceId = 0;
        try {
            $PayInfo = Session::get('PayInfo');
            $ordercode = $PayInfo['ordercode'];
            $transaction = Transaction::where('id', $PayInfo['row_id'])->first();

            $create_at = $transaction->created_at;

            $receipt = Payment::amount(intval($PayInfo['sum_price']))->transactionId($transaction->gateway_transaction_id)->verify();

            // you can show payment's referenceId to user
            $ReferenceId = $receipt->getReferenceId();
            if (!empty($ReferenceId)) {
                $transPay = TransactionPay::where('transaction_id', $transaction->id)->first();
                $transPay->refid = $ReferenceId;
                $transPay->status = 1;
                $transPay->save();

                session()->forget('PayInfo');
                session()->forget('Basket_Info');

                // send sms
                $user = User::where('id', auth()->id())->first();
                speedSend($user->mobile, 49268, array(
                    ["Parameter" => "OrderCode", "ParameterValue" => $PayInfo['ordercode']]
                ));
            }
            else {
                $transaction->delete();
                $order = $this->orders->where('id', $PayInfo['orderid'])->first();
                $order->delete();
                $ordercode = 0;
            }

        } catch (InvalidPaymentException $exception) {

            $message = $exception->getMessage();

            $transPay = TransactionPay::where('transaction_id', $transaction->id)->first();
            $transPay->message = $message;
            $transPay->save();

            $transaction->delete();
            $order = $this->orders->where('id', $PayInfo['orderid'])->first();
            $order->delete();
            $ordercode = 0;
        }

        return view(currentFrontView('orders.step3'), compact('PayInfo', 'create_at', 'ReferenceId', 'message', 'ordercode'));
    }

}
