<?php

namespace App\Http\Controllers\Backend;


use App\Order;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\OrderItem;
use App\Textile;
use App\Transaction;
use App\TransactionDetail;
use App\TransactionPay;
use DB;
use Illuminate\Http\Request;


class OrderItemsController extends Controller
{
    protected $orderItems;
    protected $path;

    public function __construct(OrderItem $orderItems)
    {
        $this->orderItems = $orderItems;
        parent::__construct();
    }


    public function list($order_id)
    {
        $order = Order::
            with([
                'user_detail' => function ($query) {
                    return $query->select('id','recipient_name','address','telephon');
                }])
            ->where([['id', '=', $order_id]])
            ->first();

        $orderItems = $this->orderItems
            ->with('textile')
            ->with('textile.images')
            ->where([['order_id', '=', $order_id]])
            ->get();

        return view(currentBackView('orderitems.list'), compact('orderItems','order'));
    }

    public function print($order_id)
    {

        $order = Order::
        with([
            'user_detail' => function ($query) {
                return $query->select('id','recipient_name','address','telephon');
            }])
            ->where([['id', '=', $order_id]])
            ->first();

        $orderItems = $this->orderItems
            ->with('textile')
            ->with('textile.images')
            ->where([['order_id', '=', $order_id]])
            ->get();


        return view(currentBackView('orderitems.print'), compact('orderItems','order'));
    }
}
