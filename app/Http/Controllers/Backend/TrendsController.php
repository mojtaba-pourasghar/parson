<?php

namespace App\Http\Controllers\Backend;

use App\Trend;
use App\TrendCategory;
use App\TrendColor;
use App\TrendTag;
use App\Book;
use App\Http\Requests\StoreTrendRequest;
use App\Http\Requests\UpdateTrendRequest;
use App\Textile;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function index()
    {
        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');


        if (request()->isMethod('get')) {

            if (isset($_REQUEST['search'])) {

                $trends = $this->trends
                    ->where([['title', 'like', '%' . request()->input('search') . '%'],
                        ['state', '=', request()->input('state')]])
                    ->with('user')
                    ->orderBy('published_at', 'desc')
                    ->paginate($limit);

            } else {
                $trends = $this->trends
                    ->orderBy('id', 'desc')
                    ->with('user')
                    ->orderBy('published_at', 'desc')
                    ->paginate($limit);
            }

        }
        $path = $this->path;
        return view(currentBackView('trends.index'), compact('trends', 'path'));
    }

    public function create(Trend $trend)
    {
        $path = $this->path;
        $trend_tags = TrendTag::getList();
        $selected_trend_tags = [];

        $trend_categories = TrendCategory::getList();
        $selected_trend_categories = [];

        $selected_persons = [];

        $textiles = Textile::getList();
        $selected_textiles = [];

        return view(currentBackView('trends.form'), compact('trend', 'path', 'trend_tags','trend_categories', 'selected_trend_tags','selected_trend_categories', 'selected_textiles', 'textiles'));
    }


    public function store(StoreTrendRequest $request)
    {


        if (!empty($_FILES['thumbnail_file']['name'])) {
            $thumbnail = $this->uploadImage($_FILES['thumbnail_file'], $this->path, true);

            if ($thumbnail['action']) {
                $request->merge(['thumbnail' => $thumbnail['filename']]);
            } else {
                return redirect() . back() . with('status', $thumbnail['message']);
            }
        }
        DB::beginTransaction();
        try {

            $published_at = $request->published_at;
            $dateTime = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d - H:i:s', $published_at);
            $request->merge(['published_at' => $dateTime]);

            $trend = $this->trends->create(['user_id' => auth()->id()] + $request->only('title', 'seo_title', 'seo_description', 'slug', 'thumbnail', 'uri',
                    'body', 'excerpt', 'published_at', 'state','study_time','sex'));

            $trend->trend_tags()->attach($request->tag_ids);
            $trend->trend_categories()->attach($request->category_ids);
            $trend->textiles()->attach($request->textile_ids);

            if (!empty($request->color_codes)) {
                foreach ($request->color_codes as $key => $color_code) {
                    $TrendColor = new TrendColor();
                    $TrendColor->trend_id = $trend->id;
                    $TrendColor->color_code = $color_code;
                    $trend->colors()->save($TrendColor);
                }
            }

            DB::commit();
            return redirect(route('backend.trends.index'))->with('status', __('trend.trend_has_been_saved'));
        } catch (\QueryException $e) {
            DB::rollback();
            if (!empty($thumbnail['filename']))
                @unlink($this->path . '/' . $thumbnail['filename']);
            return redirect(route('backend.trends.index'))->with('error', __('trend.trend_dont_saved'));
        }
    }

    public function edit($id)
    {
        $path = $this->path;
        $trend = $this->trends->findOrFail($id);
        $trend_tags = TrendTag::getList();

        $selected_trend_tags = [];
        foreach ($trend->trend_tags as $trend_tag) {
            $selected_trend_tags[] = $trend_tag->id;
        }
        $trend_categories = TrendCategory::getList();
        $selected_trend_categories = [];
        foreach ($trend->trend_categories as $trend_category) {
            $selected_trend_categories[] = $trend_category->id;
        }

        $textiles = Textile::getList();
        $selected_textiles = [];
        foreach ($trend->textiles as $textile) {
            $selected_textiles[] = $textile->id;
        }

        return view(currentBackView('trends.form'), compact('trend', 'path','selected_trend_categories','trend_categories','selected_trend_tags', 'trend_tags', 'selected_textiles', 'textiles'));
    }

    public function update(UpdateTrendRequest $request, $id)
    {
        $trend = $this->trends->findOrFail($id);


        if (!empty($_FILES['thumbnail_file']['name'])) {
            $thumbnail = $this->uploadImage($_FILES['thumbnail_file'], $this->path, true);

            if ($thumbnail['action']) {
                $request->merge(['thumbnail' => $thumbnail['filename']]);
            } else {
                return redirect() . back() . with('status', $thumbnail['message']);
            }
            @unlink($this->path . '/' . $trend->thumbnail);
            @unlink($this->path . '/' . getConstant('options.thumbnail') . '/' . $trend->thumbnail);
        }
        DB::beginTransaction();
        try {

            $published_at = $request->published_at;
            $dateTime = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d - H:i:s', $published_at);
            $request->merge(['published_at' => $dateTime]);

            $trend->fill($request->only('title', 'seo_title', 'seo_description', 'slug', 'thumbnail', 'uri',
                'body', 'excerpt', 'published_at', 'state','study_time','sex'))->save();

            $trend->trend_tags()->sync($request->tag_ids);
            $trend->trend_categories()->sync($request->category_ids);
            $trend->textiles()->sync($request->textile_ids);

            $trend->colors()->delete();
            if (!empty($request->color_codes)) {
                foreach ($request->color_codes as $key => $color_code) {
                    $TrendColor = new TrendColor();
                    $TrendColor->trend_id = $trend->id;
                    $TrendColor->color_code = $color_code;
                    $trend->colors()->save($TrendColor);
                }
            }

            DB::commit();

            return redirect(route('backend.trends.index'))->with('status', __('trend.trend_has_been_saved'));
        } catch (\QueryException $e) {
            DB::rollBack();
            if (!empty($thumbnail['filename']))
                @unlink($this->path . '/' . $thumbnail['filename']);
            return redirect(route('backend.trends.index'))->with('error', __('trend.trend_dont_saved'));
        }
    }


    public function delete($id)
    {
        $trend = $this->trends->findOrFail($id);
        $trend->delete();
        if ($trend->thumbnail != null){
            @unlink($this->path . '/' . $trend->thumbnail);
            @unlink($this->path . '/' . getConstant('options.thumbnail') . '/' . $trend->thumbnail);
        }
        return redirect(route('backend.trends.index'))->with('status', __('trend.trend_has_been_deleted'));
    }
}
