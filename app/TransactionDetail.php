<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\CalendarUtils;

class TransactionDetail extends Model
{
    protected $fillable = [
        'actiondetail_id', 'user_id','transaction_id','accounthead_id','amount','description'
    ];

    public static function Insert($items)
    {
        $instance = new static;
        $transaction_dtl = $instance->create([
            'actiondetail_id' => $items['actiondetail_id'],
            'user_id' => $items['user_id'],
            'transaction_id' => $items['transaction_id'],
            'accounthead_id' => $items['accounthead_id'],
            'amount'=> $items['amount'],
            'description'=> $items['description'],
        ] );
        return $transaction_dtl;
    }
}
