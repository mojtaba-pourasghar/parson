<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrendColor extends Model
{
    protected $fillable = [
        'trend_id','color_code'
    ];

    public static function getList()
    {
        $instance = new static;
        $value = $instance->pluck('title', 'id');
        return $value;
    }
}
