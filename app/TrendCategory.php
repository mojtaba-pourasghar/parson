<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrendCategory extends Model
{
    use Traits\Model;
    protected $fillable = [
        'title', 'state', 'slug'
    ];

    /*public function setTitleAttribute($value)
    {
        $this->attributes['title'] = str_replace(' ','-',$value) ?: null;
    }*/

    public static function getList()
    {
        $instance = new static;
        $value = $instance->where('state', 1)->pluck('title', 'id');
        return $value;
    }

    public function trends()
    {
        return $this->belongsToMany(Trend::class, 'category_trend');
    }
}
