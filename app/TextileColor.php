<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextileColor extends Model
{
    protected $fillable = [
        'textile_id','color_code'
    ];

    public static function getList()
    {
        $instance = new static;
        $value = $instance->pluck('title', 'id');
        return $value;
    }
}
