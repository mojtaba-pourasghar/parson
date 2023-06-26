<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'textile_id','item_count','sum_price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function textile()
    {
        return $this->belongsTo(Textile::class);
    }
}
