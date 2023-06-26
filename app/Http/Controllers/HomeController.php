<?php

namespace App\Http\Controllers;

use App\DiscountType;
use App\Slider;
use App\SliderImage;
use App\Textile;
use App\Blog;
use App\Book;
use App\BookView;
use App\Category;
use App\Organization;
use App\Person;
use App\PersonRole;
use App\Quotation;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $categories;

    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    public function index()
    {
        $last_discounts = $this->lastDiscounts(0, 12);

        $newers = $this->newers(0, 12);

        $discount_banners = DiscountType::
        orderBy('id', 'desc')
            ->whereNotNull('thumbnail')
            ->limit(10)
            ->get();

        $discount_issingle_banners = DiscountType::
        orderBy('id', 'desc')
            ->whereNotNull('thumbnail')
            ->where('is_single', 1)
            ->limit(3)
            ->get();


        $sliders = Slider::with('images')->where('state',1)->get();


        return view(currentFrontView('home.home'), compact('last_discounts', 'newers', 'discount_banners', 'discount_issingle_banners','sliders'));
        //return view(currentFrontView('home.home'));

    }

    private function lastDiscounts($start, $limit)
    {
        $textiles = Textile::
        select('id', 'title', 'slug', 'available_amount', 'unit_measurement', 'price',
            DB::raw('(select sum(d.percent) as sum_percent from discounttype_textile as t inner join discount_types d on d.id = t.discount_type_id where t.textile_id = textiles.id ) as sum_off'))
            ->with('images')
            ->with('colors')
            ->with([
                'discount_types' => function ($query) {
                    return $query->select('percent');
                }]);
        $textiles = $textiles->whereHas('discount_types', function ($query) {
            $query->where('discount_type_id', '<>', 0);
        });

        $textiles = $textiles->where([['state', '=', 1]]);
        $textiles = $textiles->orderBy('id', 'desc')->get($limit);

        foreach ($textiles as $textile) {
            $textile->sum_price_with_off = $textile->price - ($textile->price * ($textile->sum_off / 100));
        }

        // return \DB::getQueryLog();
        $textileCount = $textiles->count();
        return $textiles;
        // return response()->json(['textiles' => $textiles, 'textileCount' => $textileCount, 'success' => 1]);

    }

    private function newers($start, $limit)
    {
        $textiles = Textile::
        select('id', 'title', 'slug', 'available_amount', 'unit_measurement', 'price',
            DB::raw('(select sum(d.percent) as sum_percent from discounttype_textile as t inner join discount_types d on d.id = t.discount_type_id where t.textile_id = textiles.id ) as sum_off'))
            ->with('images')
            ->with([
                'discount_types' => function ($query) {
                    return $query->select('percent');
                }]);

        $textiles = $textiles->where([['state', '=', 1]]);
        $textiles = $textiles->orderBy('id', 'desc')->get($limit);

        foreach ($textiles as $textile) {
            $textile->sum_price_with_off = $textile->price - ($textile->price * ($textile->sum_off / 100));
        }

        // return \DB::getQueryLog();
        $textileCount = $textiles->count();
        return $textiles;
        //return response()->json(['textiles' => $textiles, 'textileCount' => $textileCount, 'success' => 1]);

    }
}
