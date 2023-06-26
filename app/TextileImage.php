<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextileImage extends Model
{
    protected $fillable = [
        'textile_id','image'
    ];
    public static function getList()
    {
        $instance = new static;
        $value = $instance->pluck('title', 'id');
        return $value;
    }

    public function getImageAttribute($value)
    {
        return getConstant('site_url').getTextileImagePath($value) ;
    }
}
