<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Textile extends Model
{
    use PresentableTrait;
    protected $fillable = [
        'user_id', 'textile_type_id', 'title', 'state', 'slug', 'description', 'seo_title', 'seo_description', 'barcode', 'available_amount', 'unit_measurement',
        'price', 'weight', 'wide', 'construction', 'shrinking_volume', 'view_count', 'price_pattern_id','static','thickness','ware','design','hashtag_id'
    ];
    protected $presenter = 'App\Presenters\TextilePresenter';

    public static function getList()
    {
        $instance = new static;
        $value = $instance->where('state', 1)->pluck('title', 'id');
        return $value;
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function getPrice($id)
    {
        $instance = new static;
        $textile = $instance->select('id', 'price','available_amount')->where('id', $id)->first();
        $sum_off = 0;
        $sum_price_with_off = 0;
        foreach ($textile->discount_types as $discount_type)
            $sum_off += $discount_type->percent;
        $textile->sum_price_with_off = $textile->price - ($textile->price * ($sum_off / 100));
        return $textile;
    }

    public function colors()
    {
        return $this->hasMany(TextileColor::class);
    }

    public function images()
    {
        return $this->hasMany(TextileImage::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_textile');
    }

    public function textile_type()
    {
        return $this->belongsTo(TextileType::class);
    }

    public function discount_types()
    {
        return $this->belongsToMany(DiscountType::class, 'discounttype_textile');
    }

    public function getThumbnailAttribute($value)
    {
        return getConstant('site_url') . getTextileImagePath($value);
    }

    public function price_pattern_items()
    {
        return $this->belongsToMany(PricePatternItem::class, 'price_pattern_textile')
            ->withPivot('price');
    }
}
