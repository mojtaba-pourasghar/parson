<?php


namespace App\Templates;


use App\Blog;
use Carbon\Carbon;
use Illuminate\View\View;

class BlogTemplate extends AbstractTemplate
{
    protected $view = 'blog.post';
    protected $blogs;

    public function __construct(Blog $blogs)
    {
        $this->blogs = $blogs;
    }

    public function prepare(View $view, array $parameters)
    {
       $blog =$this->blogs->where('id',$parameters['id'])->where('slug',$parameters['slug'])->first();
       $view->with('blog',$blog);
    }
}
