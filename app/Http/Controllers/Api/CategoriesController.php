<?php

namespace App\Http\Controllers\Api;


use App\Category;
use App\Http\Controllers\Api\Controller;
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

    public function parents()
    {
        $categories = $this->categories
            ->select('id', 'title', 'slug', 'parent_id','order')
            ->where([['state', 1], ['parent_id', null]])
            ->orderBy('order','asc')
            ->get();
        return response()->json(['categories'=>$categories,'success'=>1]);
    }

    public function childs($category_id)
    {
        $categories = $this->categories
            ->select('id', 'title', 'slug', 'parent_id','thumbnail','order')
            ->where([['state', 1], ['parent_id', $category_id]])
            ->orderBy('order','asc')
            ->get();

        foreach($categories as $key => $value)
        {
            $categories[$key]['thumbnail'] =  getConstant('site_url').getCategoryImagePath($value->thumbnail) ;
        }

        return response()->json(['categories'=>$categories,'success'=>1]);
    }
}
