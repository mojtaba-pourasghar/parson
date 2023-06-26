<?php

namespace App\Http\Controllers\Backend;

use App\BlogTag;
use App\Http\Requests\StoreBlogTagRequest;
use Illuminate\Http\Request;

class BlogTagsController extends Controller
{
    protected $blogtags;

    public function __construct(BlogTag $blogtags)
    {
        $this->blogtags = $blogtags;
        parent::__construct();
    }

    public function index()
    {
        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');

        if (!empty(request()->all())) {
            $blogtags = $this->blogtags
                ->where([['title', 'like', '%' . request()->input('search') . '%']])
                ->paginate($limit);
        } else {
            $blogtags = $this->blogtags->paginate($limit);
        }

        return view(currentBackView('blogtags.index'), compact('blogtags'));
    }

    public function create(BlogTag $blogtag)
    {
        return view(currentBackView('blogtags.form'), compact('blogtag'));
    }

    public function store(StoreBlogTagRequest $request)
    {
        $blogtag = $this->blogtags->create(['slug' =>  $request->title] + $request->only('title', 'state'));
        return redirect(route('backend.blogtags.index'))->with('status', __('blogtag.blogtag_has_been_saved'));
    }


    public function edit($id)
    {
        $blogtag = $this->blogtags->findOrFail($id);
        return view(currentBackView('blogtags.form'), compact('blogtag'));
    }

    public function update(StoreBlogTagRequest $request, $id)
    {
        $blogtag = $this->blogtags->findOrFail($id);
        $blogtag->fill(['slug' =>  $request->title] + $request->only('title', 'state'))->save();
        return redirect(route('backend.blogtags.index'))->with('status', __('blogtag.blogtag_has_been_saved'));
    }

    public function delete(Request $request, $id)
    {
        $blogtag = $this->blogtags->findOrFail($id);
        $blogtag->delete();
        return redirect(route('backend.blogtags.index'))->with('status', __('blogtag.blogtag_has_been_deleted'));
    }
}
