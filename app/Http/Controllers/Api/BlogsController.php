<?php

namespace App\Http\Controllers\Api;


use App\Blog;
use App\DiscountType;
use App\Faq;
use App\Http\Controllers\Api\Controller;
use App\Textile;
use Illuminate\Http\Request;
use PhpParser\Builder;


class BlogsController extends Controller
{
    protected $blogs;

    public function __construct(Blog $blogs)
    {
        $this->blogs = $blogs;
        parent::__construct();
    }

    public function list()
    {
        $blogs = $this->blogs
            ->select('id', 'title', 'thumbnail', 'excerpt', 'published_at')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
        $blog_views = $this->blogs
            ->select('id', 'title', 'thumbnail', 'excerpt', 'published_at','view_count')
            ->orderBy('view_count', 'desc')
            ->limit(10)
            ->get();

        return response()->json(['blogs' => $blogs,'blog_views'=>$blog_views, 'success' => 1]);
    }

    public function view($id)
    {
        $blog = $this->blogs->where('id',$id)->first();
        $blog_views = $this->blogs
            ->select('id', 'title', 'thumbnail', 'excerpt', 'published_at','view_count')
            ->orderBy('view_count', 'desc')
            ->limit(10)
            ->get();
        return response()->json(['blog' => $blog,'blog_views'=>$blog_views, 'success' => 1]);
    }

}
