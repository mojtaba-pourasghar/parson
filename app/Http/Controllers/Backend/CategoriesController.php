<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $categories;
    protected $path;

    public function __construct(Category $categories)
    {
        $this->categories = $categories;
        $this->path = getConstant('options.upload_path') . '/categories';
        parent::__construct();
    }

    public function index()
    {
        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');

        if (isset($_REQUEST['search'])) {
            $categories = $this->categories->with('ancestors')
                ->where([['title', 'like', '%' . request()->input('search') . '%']]);


            if (request()->input('organization') != 0) {
                $categories = $categories->whereHas('organizations', function ($query) {
                    $query->where('organization_id', '=', request()->input('organization'));
                });
            }
            if (request()->input('picture_status') == 1)
                $categories = $categories->whereNotNull('thumbnail');
            else if (request()->input('picture_status') == 0)
                $categories = $categories->whereNull('thumbnail');

            if (request()->input('status') != -1)
                $categories = $categories->where([['status', '=', request()->input('status')]]);

            if (request()->input('state') != -1)
                $categories = $categories->where([['state', '=', request()->input('state')]]);

            $categories = $categories->orderBy('order', 'desc')
                ->paginate($limit);
        } else {
            $categories = $this->categories->with('ancestors')
                ->orderBy('order', 'desc')
                ->paginate($limit);
        }
        $path = $this->path;

        return view(currentBackView('categories.index'), compact('categories', 'path'));
    }

    public function create(Category $category)
    {
        $orderCategories = $this->categories->all();
        $orderList = $this->paddedTitle($orderCategories);
        $path = $this->path;
        return view(currentBackView('categories.form'), compact('category', 'path', 'orderList'));
    }


    public function store(StoreCategoryRequest $request)
    {
        if (!empty($_FILES['thumbnail_file']['name'])) {
            $thumbnail = $this->uploadImage($_FILES['thumbnail_file'], $this->path);

            if ($thumbnail['action']) {
                $request->merge(['thumbnail' => $thumbnail['filename']]);
            } else {
                return redirect() . back() . with('status', $thumbnail['message']);
            }
        }

        $requestِData = $request;
        $request->merge(['deo_title' => $requestِData['title']]);
        $parent = null;
        if ($requestِData['parent_id'] > 0)
            $parent = $this->categories->findOrFail($requestِData['parent_id']);
        // dd($request->all());
        try {
            $category = $this->categories->create($request->only('title', 'slug', 'seo_title', 'seo_description', 'description', 'thumbnail', 'state', 'parent_id', 'order'), $parent);
            if ($requestِData['parent_id'] == 0)
                $category->saveAsRoot();
            else $category->appendToNode($parent)->save();
            return redirect(route('backend.categories.index'))->with('status', __('category.category_has_been_saved'));
        } catch (\QueryException $e) {
            if (!empty($thumbnail['filename']))
                @unlink($this->path . '/' . $thumbnail['filename']);
            return redirect(route('backend.categories.index'))->with('error', __('category.category_dont_saved'));
        }

    }

    protected function paddedTitle($orderCategories)
    {
        $orderList = [];
        foreach ($orderCategories as $key => $category) {
            $orderList[$category->id] = $category->ancestors->count() ? implode(' > ', $category->ancestors->pluck('title')->toArray()) . '>' . $category->title : $category->title;
        }
        return $orderList;
    }

    protected function refreshNodes($categories)
    {
        foreach ($categories as $orderCategory){
            $category = $this->categories->findOrFail($orderCategory->id);

            if ($orderCategory->parent_id == 0){
                $category->saveAsRoot();
                $category::fixTree();
            }
            else {
                $parent = null;
                $parent = $this->categories->findOrFail($orderCategory->parent_id);
                //return $category;
                $category::fixTree();
                $category->appendToNode($parent)->save();
            }
        }
    }

    public function edit($id)
    {
        $category = $this->categories->findOrFail($id);
        $orderCategories = $this->categories->all();
        //return $this->refreshNodes($orderCategories);
        //return $orderCategories;
        $orderList = $this->paddedTitle($orderCategories);
        //return $orderCategories;
        $path = $this->path;
        return view(currentBackView('categories.form'), compact('category', 'path', 'orderList'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = $this->categories->findOrFail($id);

        if (!empty($_FILES['thumbnail_file']['name'])) {
            $thumbnail = $this->uploadImage($_FILES['thumbnail_file'], $this->path);

            if ($thumbnail['action']) {
                $request->merge(['thumbnail' => $thumbnail['filename']]);
            } else {
                return redirect() . back() . with('status', $thumbnail['message']);
            }
            @unlink($this->path . '/' . $category->thumbnail);
        }
        $requestِData = $request;
        $request->merge(['deo_title' => $requestِData['title']]);
        $parent = null;
        if ($requestِData['parent_id'] > 0)
            $parent = $this->categories->findOrFail($requestِData['parent_id']);

        try {
            $category->fill($request->only('title', 'slug', 'seo_title', 'seo_description', 'description', 'thumbnail', 'deo_code', 'deo_title', 'state', 'parent_id', 'order'), $parent)->save();
            if ($requestِData['parent_id'] == 0)
                $category->saveAsRoot();
            else $category->appendToNode($parent)->save();
            return redirect(route('backend.categories.index'))->with('status', __('category.category_has_been_saved'));
        } catch (\QueryException $e) {
            if (!empty($thumbnail['filename']))
                @unlink($this->path . '/' . $thumbnail['filename']);
            return redirect(route('backend.categories.index'))->with('error', __('category.category_dont_saved'));
        }
    }

    public function delete(Request $request, $id)
    {
        $category = $this->categories->findOrFail($id);
        $category->delete();
        if ($category->thumbnail != null)
            @unlink($this->path . '/' . $category->thumbnail);
        return redirect(route('backend.categories.index'))->with('status', __('category.category_has_been_deleted'));
    }

    public function getdeotitle($deo_code)
    {
        $category = $this->categories->where([['deo_code', '=', $deo_code]])->first();
        $data = $category->title;
        return response()->json(array('success' => true, 'data' => $data));
    }
}
