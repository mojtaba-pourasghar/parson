<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Slider extends Model
{
    protected $fillable = [
        'title', 'order', 'state', 'url'
    ];

    public function images()
    {
        return $this->hasMany(SliderImage::class);
    }
}
