<?php

namespace App\Http\Controllers\Backend;

use App\TextileType;
use App\Http\Requests\StoreTextileTypeRequest;
use Illuminate\Http\Request;

class TextileTypesController extends Controller
{
    protected $textiletypes;

    public function __construct(TextileType $textiletypes)
    {
        $this->textiletypes = $textiletypes;
        parent::__construct();
    }

    public function index()
    {
        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');

        if (!empty(request()->all())) {
            $textiletypes = $this->textiletypes
                ->where([['title', 'like', '%' . request()->input('search') . '%']])
                ->paginate($limit);
        } else {
            $textiletypes = $this->textiletypes->paginate($limit);
        }

        return view(currentBackView('textiletypes.index'), compact('textiletypes'));
    }

    public function create(TextileType $textiletype)
    {
        return view(currentBackView('textiletypes.form'), compact('textiletype'));
    }

    public function store(StoreTextileTypeRequest $request)
    {
        $textiletype = $this->textiletypes->create($request->only('title', 'state'));
        return redirect(route('backend.textiletypes.index'))->with('status', __('textile_type.textile_type_has_been_saved'));
    }


    public function edit($id)
    {
        $textiletype = $this->textiletypes->findOrFail($id);
        return view(currentBackView('textiletypes.form'), compact('textiletype'));
    }

    public function update(StoreTextileTypeRequest $request, $id)
    {
        $textiletype = $this->textiletypes->findOrFail($id);
        $textiletype->fill($request->only('title', 'state'))->save();
        return redirect(route('backend.textiletypes.index'))->with('status', __('textile_type.textile_type_has_been_saved'));
    }

    public function delete(Request $request, $id)
    {
        $textiletype = $this->textiletypes->findOrFail($id);
        $textiletype->delete();
        return redirect(route('backend.textiletypes.index'))->with('status', __('textile_type.textile_type_has_been_deleted'));
    }
}
