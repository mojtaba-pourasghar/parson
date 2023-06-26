<?php

namespace App\Http\Controllers\Backend;

use App\HashTag;
use App\Http\Requests\StoreHashTagRequest;
use Illuminate\Http\Request;

class HashTagsController extends Controller
{
    protected $hashtags;

    public function __construct(HashTag $hashtags)
    {
        $this->hashtags = $hashtags;
        parent::__construct();
    }

    public function index()
    {
        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');

        if (!empty(request()->all())) {
            $hashtags = $this->hashtags
                ->where([['title', 'like', '%' . request()->input('search') . '%']])
                ->paginate($limit);
        } else {
            $hashtags = $this->hashtags->paginate($limit);
        }

        return view(currentBackView('hashtags.index'), compact('hashtags'));
    }

    public function create(HashTag $hashtag)
    {
        return view(currentBackView('hashtags.form'), compact('hashtag'));
    }

    public function store(StoreHashTagRequest $request)
    {
        $hashtag = $this->hashtags->create($request->only('title', 'state'));
        return redirect(route('backend.hashtags.index'))->with('status', __('textile_type.textile_type_has_been_saved'));
    }


    public function edit($id)
    {
        $hashtag = $this->hashtags->findOrFail($id);
        return view(currentBackView('hashtags.form'), compact('hashtag'));
    }

    public function update(StoreHashTagRequest $request, $id)
    {
        $hashtag = $this->hashtags->findOrFail($id);
        $hashtag->fill($request->only('title', 'state'))->save();
        return redirect(route('backend.hashtags.index'))->with('status', __('textile_type.textile_type_has_been_saved'));
    }

    public function delete(Request $request, $id)
    {
        $hashtag = $this->hashtags->findOrFail($id);
        $hashtag->delete();
        return redirect(route('backend.hashtags.index'))->with('status', __('textile_type.textile_type_has_been_deleted'));
    }
}
