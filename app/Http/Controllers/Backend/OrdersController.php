<?php

namespace App\Http\Controllers\Backend;

use App\Order;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    protected $orders;

    public function __construct(Order $orders)
    {
        $this->orders = $orders;
        parent::__construct();
    }

    public function index(Request $request)
    {
        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');

        if (request()->isMethod('post')) {

            if (!empty($request->orders)) {
                foreach ($request->orders as $id) {
                    $order = $this->orders->findOrFail($id);
                    $order->status = $request->status;
                    $order->save();
                }
            }
        }

        if (!empty(request()->all()) && !empty(request()->input('search'))) {

            $orders = $this->orders
                ->with('transaction_pay')
                ->with('user_detail')
                ->where([['id', '=', request()->input('search')]])
                ->paginate($limit);

        } else {
            $orders = $this->orders
                ->with('transaction_pay')
                ->with('user_detail')
                ->paginate($limit);
        }


        return view(currentBackView('orders.index'), compact('orders'));
    }

    public function create(Order $order)
    {
        return view(currentBackView('orders.form'), compact('order'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orders->create($request->only('title', 'state', 'amount', 'percent'));
        return redirect(route('backend.orders.index'))->with('status', __('order.order_has_been_saved'));
    }


    public function edit($id)
    {
        $order = $this->orders->findOrFail($id);
        return view(currentBackView('orders.form'), compact('order'));
    }

    public function update(StoreOrderRequest $request, $id)
    {
        $order = $this->orders->findOrFail($id);
        $order->fill($request->only('title', 'state', 'amount', 'percent'))->save();
        return redirect(route('backend.orders.index'))->with('status', __('order.order_has_been_saved'));
    }

    public function delete(Request $request, $id)
    {
        $order = $this->orders->findOrFail($id);
        $order->delete();
        return redirect(route('backend.orders.index'))->with('status', __('order.order_has_been_deleted'));
    }

}
