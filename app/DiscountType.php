<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountType extends Model
{
    protected $fillable = [
        'title', 'state','amount','percent', 'thumbnail', 'is_single'
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

    public function getThumbnailAttribute($value)
    {
        return getConstant('site_url').getDiscountTypeImagePath($value) ;
    }

}
