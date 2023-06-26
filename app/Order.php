<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'state','bank_id','transaction_pay_id','sum_price','items_count','from_getway','user_detail_id','code'
    ];

    public function getData($id = 0)
    {
        if ($id == 0) {
            $value = $this->orderBy('id', 'asc')->get();
        } else {
            $value = $this->where('id', $id)->first();
        }
        return $value;
    }

    public static function getList()
    {
        $instance = new static;
        $value = $instance->pluck('title', 'id');
        return $value;
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function transaction_pay()
    {
        return $this->belongsTo(TransactionPay::class,'transaction_pay_id');
    }

    public function user_detail()
    {
        return $this->belongsTo(UserDetail::class,'user_detail_id');
    }
	
	public function getCreatedAtAttribute($value)
    {
        if ($value) {
            return \Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($value));
        }
        return __('');
    }
}
