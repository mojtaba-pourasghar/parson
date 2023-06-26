<?php

namespace App\Http\Controllers\Api;


use App\Order;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\OrderItem;
use App\User;
use App\Textile;
use App\Transaction;
use App\TransactionDetail;
use App\TransactionPay;
use DB;
use Illuminate\Http\Request;
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
        $message = '';
        $success = 0;
        /* $validator = Validator::make($request->all(), [
             'name' => 'required'
         ]);

         if ($validator->fails()) {
             return response()->json($validator->errors(), 422);
         }*/
        $data = $request->json()->all();

        if (empty($data['order']) || empty($data['order_items'])) {
            $success = 0;
            $message = __('order.this_order_is_empty');
        }

        foreach ($data['order_items'] as $order_item) {
            $textile = Textile::getPrice($order_item['textile_id']);
            if (empty($textile)) {
                return response()->json(['success' => 0, 'message' => __('order.items_in_order_not_correct'), 'orderCode' => -1]);
            }
            /* if (($textile->sum_price_with_off * $order_item['item_count']) != $order_item['sum_price']) {
                 return response()->json(['success' => 0, 'message' => __('order.items_in_order_not_correct'),'orderCode'=>-2]);
             }*/
        }

        DB::beginTransaction();
        try {

            $order = $this->orders->create([
                'user_id' => auth()->id(),
                'bank_id' => 0,
                'transaction_pay_id' => 0,
                'from_getway' => 1,
                'sum_price' => $data['order']['sum_price'],
                'items_count' => $data['order']['items_count'],
                'user_detail_id' => $data['order']['user_detail_id'],
            ]);

            foreach ($data['order_items'] as $order_item) {
                $OrderItem = new OrderItem();
                $OrderItem->order_id = $order->id;
                $OrderItem->textile_id = $order_item['textile_id'];
                $OrderItem->item_count = $order_item['item_count'];
                $OrderItem->sum_price = $order_item['sum_price'];
                $OrderItem->color = $order_item['color'];
                $order->order_items()->save($OrderItem);
            }

            $transaction = Transaction::Insert([
                'action_id' => 2,
                'user_id' => auth()->id(),
                'amount' => $data['order']['sum_price'],
                'description' => __('order.save_order_with_number') . ' : ' . $order->id]);

            $transactionDetail = TransactionDetail::Insert([
                'actiondetail_id' => 3,
                'user_id' => auth()->id(),
                'transaction_id' => $transaction->id,
                'accounthead_id' => 2,
                'amount' => $data['order']['sum_price'],
                'description' => __('order.save_order_with_number') . ' : ' . $order->id]);

            $transactionPay = TransactionPay::Insert([
                'user_id' => auth()->id(),
                'transaction_id' => $transaction->id,
                'bank_id' => 1]);

            $order->transaction_pay_id = $transactionPay->id;
            $orderCode = 'PRS-' . $order->id;
            $order->code = $orderCode;
            $order->save();

            DB::commit();
            $user = User::where('id', auth()->id())->first();
            // send sms
            /*speedSend($user->mobile, 49268, array(
                ["Parameter" => "OrderCode", "ParameterValue" => $orderCode]
            ));*/

            $invoice = (new Invoice)->amount(intval($data['order']['sum_price']));

            $response = Payment::callbackUrl(route('order.api.verify', [$transaction->id, $data['order']['sum_price'], $orderCode, $order->id]))->purchase($invoice, function ($driver, $transactionId) use ($transaction) {
                // store transactionId in database, we need it to verify payment in future.
                $transaction->gateway_transaction_id = $transactionId;
                $transaction->save();

            })->pay();

            $response = json_encode($response);
            $response = json_decode($response, true);

            $url = $response['action'];

            $success = 1;
            $message = __('order.the_order_have_been_saved');
        } catch (\QueryException $e) {
            DB::rollBack();
            $success = 0;
            $message = __('order.order_not_saved');
        }
        return response()->json(['success' => $success, 'message' => $message, 'orderCode' => $orderCode, 'url' => $url]);
    }

    public function verify(Request $request, $transaction_id, $sum_price, $ordercode, $order_id)
    {
        $success = 0;
        $message = '';
        $ReferenceId = 0;

        try {
            $transaction = Transaction::where('id', $transaction_id)->first();

            $create_at = $transaction->created_at;
            $receipt = Payment::amount(intval($sum_price))->transactionId($transaction->gateway_transaction_id)->verify();

            // you can show payment's referenceId to user

            if (!empty($ReferenceId)) {
                $transPay = TransactionPay::where('transaction_id', $transaction->id)->first();
                $transPay->refid = $ReferenceId;
                $transPay->status = 1;
                $transPay->save();

                // send sms
                $user = User::where('id', auth()->id())->first();
                speedSend($user->mobile, 49268, array(
                    ["Parameter" => "OrderCode", "ParameterValue" => $ordercode]
                ));
                $success = 1;
            } else {
                $transaction->delete();
                $order = $this->orders->where('id', $order_id)->first();
                $order->delete();
                $success = 0;
                $ordercode = 0;
            }

        } catch (InvalidPaymentException $exception) {

            $message = $exception->getMessage();
            $transPay = TransactionPay::where('transaction_id', $transaction->id)->first();
            $transPay->message = $message;
            $transPay->save();

            $transaction->delete();
            $order = $this->orders->where('id', $order_id)->first();
            $order->delete();
            $success = 0;
            $ordercode = 0;
        }


        return view(currentFrontView('orders.appverify'), compact('create_at', 'ReferenceId', 'message', 'ordercode', 'success', 'order_id'));
    }

    public function list()
    {
        $success = 1;
        $message = '';
        $orders = $this->orders
            //->with('user_detail')
            //->select('id','sum_price','items_count')
            ->with([
                'user_detail' => function ($query) {
                    return $query->select('id', 'recipient_name', 'address');
                }])
            ->where([['user_id', '=', auth()->id()]])
            ->get();

        return response()->json(['success' => $success, 'message' => $message, 'orders' => $orders]);
    }
}
