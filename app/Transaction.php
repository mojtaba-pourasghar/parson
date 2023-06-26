<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\CalendarUtils;

class Transaction extends Model
{
    protected $fillable = [
        'action_id', 'user_id','exctime','exctdate','amount','description'
    ];

    public static function Insert($items)
    {
        $instance = new static;
        $transaction = $instance->create([
            'action_id' => $items['action_id'],
            'user_id' => $items['user_id'],
            'exctime' => CalendarUtils::strftime('Hi', Carbon::now()) ,
            'exctdate'=> CalendarUtils::strftime('Ymd', Carbon::now()) ,
            'amount'=> $items['amount'],
            'description'=> $items['description'],
        ] );
        return $transaction;
    }

    public function getCreatedAtAttribute($value)
    {
        if ($value) {
            return \Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($value));
        }
        return __('');
    }
}
