<?php

namespace App\Http\Controllers\Backend;

use App\Blog;
use App\BlogComment;
use Illuminate\Http\Request;

class BlogCommentsController extends Controller
{

    protected $blogcomments;

    public function __construct(BlogComment $blogcomments)
    {
        $this->blogcomments = $blogcomments;
        parent::__construct();
    }

    public function index($blog_id)
    {
        $blog = Blog::findOrFail($blog_id);

        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');


        if (request()->isMethod('get')) {

            if (isset($_REQUEST['search'])) {

                $blogcomments = $this->blogcomments
                    ->where([['name', 'like', '%' . request()->input('search') . '%'],
                        ['state', '=', request()->input('state')]])
                    ->orWhereHas('user', function ($query) {
                        $query->where('name', 'like', '%' . request()->input('search') . '%');
                    })
                    ->orderBy('id', 'desc')
                    ->paginate($limit);

            } else {
                $blogcomments = $this->blogcomments
                    ->with('user')
                    ->orderBy('id', 'desc')
                    ->paginate($limit);
            }

        }
       // return $blogcomments;
        return view(currentBackView('blogcomments.index'), compact('blogcomments','blog_id','blog'));
    }

    public function delete($blog_id,$id)
    {
        $blogcomment = $this->blogcomments->findOrFail($id);
        $blogcomment->delete();
        $blog = Blog::findOrFail($blog_id);
        $blog->update(['comment_count' => $blog->comment_count - 1]);

        return redirect(route('backend.blogcomments.index',$blog_id))->with('status', __('blog.blog_has_been_deleted'));
    }


    public function edit($blog_id,$id)
    {
        $blog = Blog::findOrFail($blog_id);
        $blogcomment = $this->blogcomments->with('user')->findOrFail($id);
        return view(currentBackView('blogcomments.form'), compact('blogcomment','blog','blog_id'));
    }

    public function update(Request $request, $blog_id,$id)
    {
        $blogcomment = $this->blogcomments->findOrFail($id);

        try {
            $blogcomment->fill($request->only('comment', 'state'))->save();

            return redirect(route('backend.blogcomments.index',$blog_id))->with('status', __('blogcomment.blogcomment_has_been_saved'));
        } catch (\QueryException $e) {
            return redirect(route('backend.blogcomments.index',$blog_id))->with('error', __('blogcomment.blogcomment_dont_saved'));
        }
    }

}
