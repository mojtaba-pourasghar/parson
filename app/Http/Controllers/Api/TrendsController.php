<?php

namespace App\Http\Controllers\Api;


use App\CategoryTrend;
use App\Trend;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\StoreTrendRequest;
use App\Http\Requests\UpdateTrendRequest;
use App\TrendCategory;
use DB;
use Illuminate\Http\Request;


class TrendsController extends Controller
{
    protected $trends;
    protected $path;

    public function __construct(Trend $trends)
    {
        $this->trends = $trends;
        $this->path = getConstant('options.upload_path') . '/trends';
        parent::__construct();
    }

    public function view($id)
    {
        $trend = $this->trends
            ->select('id', 'title', 'slug', 'thumbnail', 'body')
            ->with(['colors' => function ($query) use ($id) {
                return $query->where('trend_id', $id);
                //return $query->select(['id', 'color_code']);
            }])
            ->with(['textiles' => function ($query) use ($id) {

                $query->select('id', 'title', 'slug', 'available_amount', 'unit_measurement',
                    'price',DB::raw('(select sum(d.percent) as sum_percent from discounttype_textile as t inner join discount_types d on d.id =
                     t.discount_type_id where t.textile_id = textiles.id ) as sum_off'));
                $query->with([
                    'images' => function ($query) {
                        // $query->where('id', '=', 1);
                        // return $query->select('id', 'image');
                    }]);
                return $query->where('trend_id', $id);
                //return $query->select(['id', 'title', 'price', 'available_amount']);
            }])
            ->where([['state', 1], ['id', $id]])
            ->first();
        foreach ($trend->textiles as $textile_discount) {
            $textile_discount->sum_price_with_off = $textile_discount->price - ($textile_discount->price * ($textile_discount->sum_off / 100));
        }

        return response()->json(['trend' => $trend, 'success' => 1]);
    }

    public function all($sex, $tag)
    {
        $category_trends = TrendCategory::
        with(['trends' => function ($query) use ($sex, $tag) {
            $query->where([['state', 1], ['sex', $sex]]);
            if (!empty($tag) && $tag != '0') {
                $query->whereHas('trend_tags', function ($query) use ($tag) {
                    $query->where('trend_tag_id', $tag);
                });
            }
            return $query->select(['id', 'title', 'slug', 'thumbnail']);
        }])
            ->select('id', 'title');
        $category_trends = $category_trends->get();
        return response()->json(['trends' => $category_trends, 'success' => 1]);
    }


}
