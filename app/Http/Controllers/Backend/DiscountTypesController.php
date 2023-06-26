<?php

namespace App\Http\Controllers\Backend;

use App\DiscountType;
use App\Http\Requests\StoreDiscountTypeRequest;
use Illuminate\Http\Request;

class DiscountTypesController extends Controller
{
    protected $discounttypes;
    protected $path;

    public function __construct(DiscountType $discounttypes)
    {
        $this->discounttypes = $discounttypes;
        $this->path = getConstant('options.upload_path') . '/discounttypes';
        parent::__construct();
    }

    public function index()
    {
        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');

        if (!empty(request()->all())) {
            $discounttypes = $this->discounttypes
                ->where([['title', 'like', '%' . request()->input('search') . '%']])
                ->paginate($limit);
        } else {
            $discounttypes = $this->discounttypes->paginate($limit);
        }

        return view(currentBackView('discounttypes.index'), compact('discounttypes'));
    }

    public function create(DiscountType $discounttype)
    {
        $path = $this->path;
        return view(currentBackView('discounttypes.form'), compact('discounttype', 'path'));
    }

    public function store(StoreDiscountTypeRequest $request)
    {
        if (!empty($_FILES['thumbnail_file']['name'])) {
            $thumbnail = $this->uploadImage($_FILES['thumbnail_file'], $this->path, true);

            if ($thumbnail['action']) {
                $request->merge(['thumbnail' => $thumbnail['filename']]);
            } else {
                return redirect() . back() . with('status', $thumbnail['message']);
            }
        }
        if (isset($request->is_single)) {
            $request->merge(['is_single' => 1]);
        } else {
            $request->merge(['is_single' => 0]);
        }
        $discounttype = $this->discounttypes->create($request->only('title', 'state','amount','percent', 'thumbnail', 'is_single'));
        return redirect(route('backend.discounttypes.index'))->with('status', __('discount_type.discount_type_has_been_saved'));
    }


    public function edit($id)
    {
        $discounttype = $this->discounttypes->findOrFail($id);
        $path = $this->path;
        return view(currentBackView('discounttypes.form'), compact('discounttype', 'path'));
    }

    public function update(StoreDiscountTypeRequest $request, $id)
    {
        $discounttype = $this->discounttypes->findOrFail($id);

        if (isset($request->is_single)) {
            $request->merge(['is_single' => 1]);
        } else {
            $request->merge(['is_single' => 0]);
        }

        if (!empty($_FILES['thumbnail_file']['name'])) {
            $thumbnail = $this->uploadImage($_FILES['thumbnail_file'], $this->path);

            if ($thumbnail['action']) {
                $request->merge(['thumbnail' => $thumbnail['filename']]);
            } else {
                return redirect() . back() . with('status', $thumbnail['message']);
            }
            @unlink($this->path . '/' . $discounttype->thumbnail);
        }
        $discounttype->fill($request->only('title', 'state','amount','percent', 'thumbnail', 'is_single'))->save();
        return redirect(route('backend.discounttypes.index'))->with('status', __('discount_type.discount_type_has_been_saved'));
    }

    public function delete(Request $request, $id)
    {
        $discounttype = $this->discounttypes->findOrFail($id);
        $discounttype->delete();
        return redirect(route('backend.discounttypes.index'))->with('status', __('discount_type.discount_type_has_been_deleted'));
    }
}
