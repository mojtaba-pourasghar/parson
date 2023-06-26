<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    protected $blogs;

    public function __construct(Blog $blogs)
    {
        $this->blogs = $blogs;
    }

    public function view(Request $request, $id, $slug)
    {

        $blog = $this->blogs
            ->with([
                'user' => function ($query) {
                    return $query->select(['id', 'name', 'image']);
                },
                'persons' => function ($query) {
                    $query->where('state', '=', 1);
                    return $query->select('id', 'title', 'slug','thumbnail');
                },
                'books' => function ($query) {
                    $query->where('state', '=', 1);
                    return $query->select('id', 'title', 'slug','thumbnail');
                },
                'organizations' => function ($query) {
                    $query->where('state', '=', 1);
                    return $query->select('id', 'title', 'slug','thumbnail');
                },
                'blogtags' => function ($query) {
                    $query->where('state', '=', 1);
                    return $query->select('id', 'title', 'slug');
                }
            ])
            ->where([['state', 1], ['id', $id]])
            ->first();
         //return $blog;
        /* $book_count = Bookblog::where('blog_id', '=', $id)->count();
         // \DB::enableQueryLog();
         $folow = Follower::where([['blog_id', '=', $id], ['folower_id', auth()->id()]])->first();

         $blogs = Blog::whereHas('blogs', function ($query) use ($blog) {
             return $query->where('blog_id', $blog->id);
         })
             ->where('state', 1)
             ->orderBy('id', 'desc')
             ->take(3)
             ->select(['id', 'title', 'slug', 'thumbnail', 'excerpt'])->get();*/
        // return $blogs;
        // return \DB::getQueryLog();
        return view(currentFrontView('blogs.view'), compact('blog'));
    }

    public function news(Request $request)
    {
        $limit = getConstant('frontend.limit');
        $blogs = $this->blogs
            ->where([['state', 1]])
            ->orderBy('id', 'desc')
            ->paginate($limit);
        return view(currentFrontView('blogs.news'), compact('blogs'));
    }
}
