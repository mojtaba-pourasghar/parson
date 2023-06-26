<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\PricePatternItem;
use App\Textile;
use App\TextileType;
use DB;
use Illuminate\Http\Request;

class TextilesController extends Controller
{
    protected $textiles;
    protected $path;

    public function __construct(Textile $textiles)
    {
        $this->textiles = $textiles;
        $this->path = getConstant('options.upload_path') . '/textiles';
    }

    public function filter()
    {
        $maxPrice = $this->textiles->max('price');
        $maxWeight = $this->textiles->max('weight');
        return response()->json(['maxPrice' => $maxPrice, 'maxWeight' => $maxWeight, 'success' => 1]);
    }

    public function search_filter()
    {
        $max_price= Textile::max('price');
        return view(currentFrontView('textiles.search_filter'), compact('max_price'));
    }

    public function search(Request $request)
    {


        $max_price= Textile::max('price');
        $search_title = $request->title;
        $limit = getConstant('frontend.limit');
        $category_id = $request->category_id;
        $category_id1 = $request->category_id1;
        $category_id2 = $request->category_id2;
        $category_id3 = $request->category_id3;
        $category_id4 = $request->category_id4;
        $color = $request->color;

        $discount_type_id = $request->discount_type_id;
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;
        $minWeight = $request->minWeight;
        $maxWeight = $request->maxWeight;

        $last_discounts = $request->last_discounts;

        $newers = $request->newers;
        //$rateCount = BookRate::where('book_id', $id)->get()->count();
        \DB::enableQueryLog();

        $textiles = $this->textiles
            ->select('id', 'title', 'slug', 'available_amount', 'unit_measurement', 'price',
                DB::raw('COALESCE((select sum(d.percent) as sum_percent from discounttype_textile as t inner join discount_types d on d.id = t.discount_type_id where t.textile_id = textiles.id ),0) as sum_off')
                ,DB::raw('(select price  - (price * (sum_off / 100)) ) as sum_discount_price'))
            ->with('images')
            ->with([
                'discount_types' => function ($query) {
                    return $query->select('percent');
                }]);
        // ->where([['state', 1], ['sex', $sex]]);

        $category_ids = [];
        $category_id = substr($category_id,0,strlen($category_id)-1);

        if (!empty($category_id) && $category_id > 0) $category_ids  = explode(',',$category_id);
        if (!empty($category_id1) && $category_id1 > 0) $category_ids [] = $category_id1;
        if (!empty($category_id2) && $category_id2 > 0) $category_ids [] = $category_id2;
        if (!empty($category_id3) && $category_id3 > 0) $category_ids [] = $category_id3;
        if (!empty($category_id4) && $category_id4 > 0) $category_ids [] = $category_id4;



        $search_category = null;
        if (!empty($category_ids)) {
            $search_category = Category::where('id',$category_ids[0])->first();

            $textiles = $textiles->whereHas('categories', function ($query) use ($category_ids) {
                $query->whereIn('category_id', $category_ids);
            });
        }

        if (!empty($discount_type_id) && $discount_type_id > 0) {
            $textiles = $textiles->whereHas('discount_types', function ($query) use ($discount_type_id) {
                $query->where('discount_type_id', '=', $discount_type_id);
            });
        }

        if (isset($last_discounts)){
            $textiles = $textiles->whereHas('discount_types', function ($query) {
                $query->where('discount_type_id', '<>', 0);
            });
        }

        if (isset($newers)){
            $textiles = $textiles->orderBy('id', 'desc');
        }

        if (!empty($color)) {
            $textiles = $textiles->whereHas('colors', function ($query) use ($color) {
                $query->where('color_code', '=', '#'.$color);
            });
        }

        if (!empty($maxPrice) && $maxPrice > 0) {
            $textiles = $textiles->whereBetween('price', [$minPrice, $maxPrice]);
        }

        if (!empty($maxWeight && $maxWeight > 0)) {
            $textiles = $textiles->whereBetween('weight', [$minWeight, $maxWeight]);
        }

        $textiles = $textiles->where([['state', '=', 1], ['title', 'like', '%' . $request->title . '%']]);

        if ($request->sortby == 1/* || empty($request->sortby)*/) {
            $textiles = $textiles->whereHas('order_items', function ($query)  {
                return $query
                    ->groupBy('textile_id')
                    ->orderBy(DB::raw('count(textile_id)', 'DESC'))
                    ->select('textile_id');
            });
        }
        if ($request->sortby == 2 || empty($request->sortby)) {
            $textiles = $textiles->orderBy('id', 'desc');
            $_REQUEST['sortby']=2;
        }
        if ($request->sortby == 3) {
            $textiles = $textiles->orderBy('sum_off', 'desc');
        }
        if ($request->sortby == 4) {
            $textiles = $textiles->orderBy('sum_discount_price', 'desc');
        }
        if ($request->sortby == 5) {
            $textiles = $textiles->orderBy('sum_discount_price', 'asc');
        }
        $textiles =
            $textiles
            ->paginate($limit);
        //return \DB::getQueryLog();
        foreach ($textiles as $textile) {
            $textile->sum_price_with_off = $textile->price - ($textile->price * ($textile->sum_off / 100));
        }


        $textileCount = $textiles->count();
        return view(currentFrontView('textiles.search'), compact('search_title','textiles','textileCount','search_category','max_price'));
    }

    public function lastDiscounts(Request $request, $start, $limit)
    {
        $textiles = $this->textiles
            ->select('id', 'title', 'slug', 'available_amount', 'unit_measurement', 'price',
                DB::raw('(select sum(d.percent) as sum_percent from discounttype_textile as t inner join discount_types d on d.id = t.discount_type_id where t.textile_id = textiles.id ) as sum_off'))
            ->with('images')
            ->with([
                'discount_types' => function ($query) {
                    return $query->select('percent');
                }]);
        $textiles = $textiles->whereHas('discount_types', function ($query) {
            $query->where('discount_type_id', '<>', 0);
        });

        $textiles = $textiles
            ->skip($start * 5)
            ->take($limit)->where([['state', '=', 1],[DB::raw('(select sum(d.percent) as sum_percent from discounttype_textile as t inner join discount_types d on d.id = t.discount_type_id where t.textile_id = textiles.id )'),'>',0]]);
        $textiles = $textiles->orderBy('id', 'desc')->get();

        foreach ($textiles as $textile) {
            $textile->sum_price_with_off = $textile->price - ($textile->price * ($textile->sum_off / 100));
        }

        // return \DB::getQueryLog();
        $textileCount = $textiles->count();
        return response()->json(['textiles' => $textiles, 'textileCount' => $textileCount, 'success' => 1]);

    }

    public function newers(Request $request, $start, $limit)
    {
        $textiles = $this->textiles
            ->select('id', 'title', 'slug', 'available_amount', 'unit_measurement', 'price',
                DB::raw('(select sum(d.percent) as sum_percent from discounttype_textile as t inner join discount_types d on d.id = t.discount_type_id where t.textile_id = textiles.id ) as sum_off'))
            ->with('images')
            ->with([
                'discount_types' => function ($query) {
                    return $query->select('percent');
                }]);

        $textiles = $textiles
            ->skip($start * 5)
            ->take($limit)
            ->where([['state', '=', 1]]);
        $textiles = $textiles->orderBy('id', 'desc')->get();

        foreach ($textiles as $textile) {
            $textile->sum_price_with_off = $textile->price - ($textile->price * ($textile->sum_off / 100));
        }

        // return \DB::getQueryLog();
        $textileCount = $textiles->count();
        return response()->json(['textiles' => $textiles, 'textileCount' => $textileCount, 'success' => 1]);

    }

    public function view($id)
    {
        $textile = $this->textiles
            ->select('id','hashtag_id', 'title', 'slug', 'price_pattern_id', 'barcode', 'description', 'available_amount', 'unit_measurement', 'price', 'weight', 'wide', 'construction', 'shrinking_volume', 'textile_type_id',
                DB::raw('(select sum(d.percent) as sum_percent from discounttype_textile as t inner join discount_types d on d.id = t.discount_type_id where t.textile_id = textiles.id ) as sum_off')
                ,DB::raw('(select price  - (price * (sum_off / 100)) ) as sum_discount_price'))
            ->with('images')
            ->with('colors')
            ->with('categories:id')
            ->where([['state', 1], ['id', $id]])
            ->first();

        if (empty($textile)) {
            return;
        }

        $textile_type = TextileType::where('id', $textile->textile_type_id)->select('id', 'title')->first();

        $category_ids = [];
        foreach ($textile->categories as $category) {
            $category_ids[] = $category->id;
        }

        $sametextiles = $this->textiles
            ->select('id', 'title', 'slug', 'available_amount', 'unit_measurement', 'price', 'weight',
                DB::raw('(select sum(d.percent) as sum_percent from discounttype_textile as t inner join discount_types d on d.id = t.discount_type_id where t.textile_id = textiles.id ) as sum_off')
                ,DB::raw('(select price  - (price * (sum_off / 100)) ) as sum_discount_price'))
            ->with('images')
            ->whereHas('categories', function ($query) use ($category_ids, $id) {
                $query->where('textile_id', '<>', $id);
                return $query->whereIn('category_id', [$category_ids]);
            })
            ->get();
        $hashtagtextiles = [];
        if ($textile->hashtag_id != null){
            $hashtagtextiles = $this->textiles
                ->select('id', 'title', 'slug', 'available_amount', 'unit_measurement', 'price', 'weight',
                    DB::raw('(select sum(d.percent) as sum_percent from discounttype_textile as t inner join discount_types d on d.id = t.discount_type_id where t.textile_id = textiles.id ) as sum_off')
                    ,DB::raw('(select price  - (price * (sum_off / 100)) ) as sum_discount_price'))
                ->with('images')
                ->where([['hashtag_id',$textile->hashtag_id],['id','<>',$textile->id]])
                ->get();
        }


        $price_pattern_items = [];
        if (!empty($textile)) {
            $items = PricePatternItem::
            where('price_pattern_id', $textile->price_pattern_id)
                ->with([
                    'values' => function ($query) use ($id) {
                        return $query->where('textile_id', $id);
                    }])
                ->get();

            foreach ($items as $item) {
                $price_pattern_items[] = [
                    "min" => $item->min,
                    'max' => $item->max,
                    "off" => $item->off / 100,
                    'price_pattern_id' => $item->price_pattern_id,
                   // "price_pattern_item_id" => (!empty($item->values)) ? $item->values[0]->pivot->price_pattern_item_id :0,
                    //"price" => (!empty($item->values)) ? $item->values[0]->pivot->price : 0
                ];
            }
        }

        $sum_off = 0;
        $sum_price_with_off = 0;
        foreach ($textile->discount_types as $discount_type) {
            $sum_off += $discount_type->percent;
            // $sum_price_with_off += $discount_type->amount;
        }
        $sum_price_with_off = $textile->price - ($textile->price * ($sum_off / 100));
      //  return response()->json(['sum_off' => $sum_off, 'sum_price_with_off' => $sum_price_with_off, 'textile' => $textile, 'price_pattern_items' => $price_pattern_items, 'textile_type' => $textile_type, 'sametextiles' => $sametextiles, 'success' => 1]);
        return view(currentFrontView('textiles.view'), compact('textile','sametextiles','price_pattern_items','hashtagtextiles'));
    }
}
