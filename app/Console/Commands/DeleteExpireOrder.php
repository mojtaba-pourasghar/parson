<?php

namespace App\Console\Commands;

use App\Order;
use App\OrderItem;
use App\Textile;
use DB;
use Illuminate\Console\Command;

class DeleteExpireOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Expire order after 15 minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = DB::select("select o.id from orders as o 
                                inner join transaction_pays as TPay
                                        on o.transaction_pay_id = TPay.id
                          where TPay.refid is null and MINUTE(TIMEDIFF(CURRENT_TIMESTAMP, o.created_at)) > 15
        ");

        foreach ($orders as $order){
            $orderItems = OrderItem::where('order_id',$order->id)->get();
            foreach ($orderItems as $orderItem){
                $textile = Textile::where('id',$orderItem->textile->id)->first();
                $textile->available_amount += $orderItem->item_count;
                $textile->save();
            }
            $order = Order::where('id',$order->id)->first();
            $order->delete();
        }
    }
}
