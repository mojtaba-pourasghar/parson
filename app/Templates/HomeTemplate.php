<?php


namespace App\Templates;


use App\Blog;
use Carbon\Carbon;
use Illuminate\View\View;

class HomeTemplate extends AbstractTemplate
{
    protected $view = 'home';
    protected $blogs;

    public function __construct(Blog $blogs)
    {
        $this->blogs = $blogs;
    }

    public function prepare(View $view, array $parameters)
    {
       $blogs =$this->blogs->with('author')
           ->where('published_at','<',Carbon::now())
           ->orderBy('published_at','desc')
           ->take(3)
           ->get();
       $view->with('blogs',$blogs);
    }
}
