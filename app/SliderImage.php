<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    protected $fillable = [
        'slider_id','image','title'
    ];

    /*public function getImageAttribute($value)
    {
        return getConstant('site_url').getSliderImagePath($value) ;
    }*/
}
