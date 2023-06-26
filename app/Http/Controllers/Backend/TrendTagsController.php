<?php

namespace App\Http\Controllers\Backend;

use App\TrendTag;
use App\Http\Requests\StoreTrendTagRequest;
use Illuminate\Http\Request;

class TrendTagsController extends Controller
{
    protected $trendtags;

    public function __construct(TrendTag $trendtags)
    {
        $this->trendtags = $trendtags;
        parent::__construct();
    }

    public function index()
    {
        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');

        if (!empty(request()->all())) {
            $trendtags = $this->trendtags
                ->where([['title', 'like', '%' . request()->input('search') . '%']])
                ->paginate($limit);
        } else {
            $trendtags = $this->trendtags->paginate($limit);
        }

        return view(currentBackView('trend_tags.index'), compact('trendtags'));
    }

    public function create(TrendTag $trendtag)
    {
        return view(currentBackView('trend_tags.form'), compact('trendtag'));
    }

    public function store(StoreTrendTagRequest $request)
    {
        $trendtag = $this->trendtags->create(['slug' =>  $request->title] + $request->only('title', 'state'));
        return redirect(route('backend.trendtags.index'))->with('status', __('trend_tag.trend_tag_has_been_saved'));
    }


    public function edit($id)
    {
        $trendtag = $this->trendtags->findOrFail($id);
        return view(currentBackView('trend_tags.form'), compact('trendtag'));
    }

    public function update(StoreTrendTagRequest $request, $id)
    {
        $trendtag = $this->trendtags->findOrFail($id);
        $trendtag->fill(['slug' =>  $request->title] + $request->only('title', 'state'))->save();
        return redirect(route('backend.trendtags.index'))->with('status', __('trend_tag.trend_tag_has_been_saved'));
    }

    public function delete(Request $request, $id)
    {
        $trendtag = $this->trendtags->findOrFail($id);
        $trendtag->delete();
        return redirect(route('backend.trendtags.index'))->with('status', __('trend_tag.trend_tag_has_been_deleted'));
    }
}
