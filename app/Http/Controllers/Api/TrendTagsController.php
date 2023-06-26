<?php

namespace App\Http\Controllers\Api;

use App\TrendTag;
use Illuminate\Http\Request;

class TrendTagsController extends Controller
{
    protected $trendtags;

    public function __construct(TrendTag $trendtags)
    {
        $this->trendtags = $trendtags;
        parent::__construct();
    }


    public function tags()
    {
        $trendtags = $this->trendtags
            ->select('id', 'title', 'slug')
            ->where('state', 1)
            ->orderBy('id', 'desc')
            ->get();
        return response()->json(['trendtags' => $trendtags, 'success' => 1]);
    }

    public function all($sex, $tag)
    {

        $trendtags = $this->trendtags
            ->with(['trends' => function ($query) use ($sex, $tag) {
                // $query->limit(12);
                $query->where([['state', 1], ['sex', $sex]]);
                return $query->select(['id', 'title', 'slug', 'thumbnail']);
            }])
            ->select('id', 'title');

        if (!empty($tag) && $tag != '0') {
            $trendtags = $trendtags->where('id', '=', $tag);
        }
        $trendtags = $trendtags->get();
        //->where('id', '=', $person_role_id)->take(12)->get();

        /*$trends = $this->trends
            ->select('id', 'title', 'slug','thumbnail')
            ->with('trend_tags:id,title')
            ->where([['state', 1], ['sex', $sex]]);
        if (!empty($tag) && $tag != '0') {
            $trends = $trends->whereHas('trend_tags', function ($query) use ($tag) {
                $query->where('trend_tag_id', '=', $tag);
            });
        }
        $trends = $trends
            ->orderBy('id', 'desc')
            ->get();
*/
        //foreach($trendtags as $key => $value)
        //{
       //     $trendtags[$key]['thumbnail'] =  getConstant('site_url').getTrendImagePath($value->thumbnail) ;
        //}

        return response()->json(['trends' => $trendtags, 'success' => 1]);
    }

}
