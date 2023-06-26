<?php

namespace App\Http\Controllers\Backend;

use App\TrendCategory;
use App\Http\Requests\StoreTrendCategoryRequest;
use Illuminate\Http\Request;

class TrendCategoriesController extends Controller
{
    protected $trendcategories;

    public function __construct(TrendCategory $trendcategories)
    {
        $this->trendcategories = $trendcategories;
        parent::__construct();
    }

    public function index()
    {
        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');

        if (!empty(request()->all())) {
            $trendcategories = $this->trendcategories
                ->where([['title', 'like', '%' . request()->input('search') . '%']])
                ->paginate($limit);
        } else {
            $trendcategories = $this->trendcategories->paginate($limit);
        }

        return view(currentBackView('trend_categories.index'), compact('trendcategories'));
    }

    public function create(TrendCategory $trendcategory)
    {
        return view(currentBackView('trend_categories.form'), compact('trendcategory'));
    }

    public function store(StoreTrendCategoryRequest $request)
    {
        $trendcategory = $this->trendcategories->create(['slug' =>  $request->title] + $request->only('title', 'state'));
        return redirect(route('backend.trendcategories.index'))->with('status', __('trend_category.trend_category_has_been_saved'));
    }


    public function edit($id)
    {
        $trendcategory = $this->trendcategories->findOrFail($id);
        return view(currentBackView('trend_categories.form'), compact('trendcategory'));
    }

    public function update(StoreTrendCategoryRequest $request, $id)
    {
        $trendcategory = $this->trendcategories->findOrFail($id);
        $trendcategory->fill(['slug' =>  $request->title] + $request->only('title', 'state'))->save();
        return redirect(route('backend.trendcategories.index'))->with('status', __('trend_category.trend_category_has_been_saved'));
    }

    public function delete(Request $request, $id)
    {
        $trendcategory = $this->trendcategories->findOrFail($id);
        $trendcategory->delete();
        return redirect(route('backend.trendcategories.index'))->with('status', __('trend_category.trend_category_has_been_deleted'));
    }
}
