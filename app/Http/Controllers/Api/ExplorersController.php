<?php

namespace App\Http\Controllers\Api;


use App\DiscountType;
use App\Faq;
use App\Http\Controllers\Api\Controller;
use App\Textile;
use DB;
use Illuminate\Http\Request;
use PhpParser\Builder;


class ExplorersController extends Controller
{
    public function list()
    {
        $textiles = Textile::
        select('id', 'title', 'slug', 'available_amount', 'unit_measurement', 'price',
                DB::raw('(select sum(d.percent) as sum_percent from discounttype_textile as t inner join discount_types d on d.id = t.discount_type_id where t.textile_id = textiles.id ) as sum_off'))
            ->with('images')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        foreach ($textiles as $textile) {
            $textile->sum_price_with_off = $textile->price - ($textile->price * ($textile->sum_off / 100));
        }

        $textile_discounts = Textile::
        select('id', 'title', 'slug', 'available_amount', 'unit_measurement', 'price',DB::raw('(select sum(d.percent) as sum_percent from discounttype_textile as t inner join discount_types d on d.id = t.discount_type_id where t.textile_id = textiles.id ) as sum_off'))
            ->with('images')
            ->orderBy('id', 'desc')
            ->whereHas('discount_types')
            ->where(DB::raw('(select sum(d.percent) as sum_percent from discounttype_textile as t inner join discount_types d on d.id = t.discount_type_id where t.textile_id = textiles.id )'),'>',0)
            ->limit(10)
            ->get();
        foreach ($textile_discounts as $textile_discount) {
            $textile_discount->sum_price_with_off = $textile_discount->price - ($textile_discount->price * ($textile_discount->sum_off / 100));
        }

        $discount_banners = DiscountType::
        orderBy('id', 'desc')
            ->whereNotNull('thumbnail')
            ->limit(10)
            ->get();

        $discount_issingle_banners = DiscountType::
        orderBy('id', 'desc')
            ->whereNotNull('thumbnail')
            ->where('is_single',1)
            ->limit(3)
            ->get();

        return response()->json(['textiles' => $textiles, 'textile_discounts' => $textile_discounts, 'discount_banners' => $discount_banners,'discount_issingle_banners'=>$discount_issingle_banners, 'success' => 1]);
    }

}
