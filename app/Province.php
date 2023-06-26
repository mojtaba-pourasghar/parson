<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public static function getList()
    {
        $instance = new static;
        $value = $instance->pluck('name', 'id');
        return $value;
    }
}
