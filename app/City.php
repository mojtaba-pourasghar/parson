<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public static function getList($province_id)
    {
        $instance = new static;
        $value = $instance->pluck('title', 'id')->where('province_id',$province_id);
        return $value;
    }
}
