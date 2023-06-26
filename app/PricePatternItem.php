<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PricePatternItem extends Model
{
    protected $fillable = [
        'price_pattern_id', 'min','max','off'
    ];

    public function values()
    {
        return $this->belongsToMany(PricePatternItem::class, 'price_pattern_textile')
            ->withPivot('price');
    }
}
