<?php

namespace App\Http\Controllers\Backend;

use App\Blog;
use App\BlogTag;
use App\Book;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Organization;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogsController extends Controller
{

    protected $blogs;
    protected $path;

    public function __construct(Blog $blogs)
    {
        $this->blogs = $blogs;
        $this->path = getConstant('options.upload_path') . '/blogs';
        parent::__construct();
    }

    public function index()
    {
        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');


        if (request()->isMethod('get')) {

            if (isset($_REQUEST['search'])) {

                $blogs = $this->blogs
                    ->where([['title', 'like', '%' . request()->input('search') . '%'],
                        ['state', '=', request()->input('state')]])
                    ->with('user')
                    ->orderBy('published_at', 'desc')
                    ->paginate($limit);

            } else {
                $blogs = $this->blogs
                    ->orderBy('id', 'desc')
                    ->with('user')
                    ->orderBy('published_at', 'desc')
                    ->paginate($limit);
            }

        }
        $path = $this->path;
        return view(currentBackView('blogs.index'), compact('blogs', 'path'));
    }

    public function create(Blog $blog)
    {
        $path = $this->path;
        $blogtags = BlogTag::getList();
        $selected_blogtags = [];

        return view(currentBackView('blogs.form'), compact('blog', 'path', 'blogtags', 'selected_blogtags'));
    }


    public function store(StoreBlogRequest $request)
    {


        if (!empty($_FILES['thumbnail_file']['name'])) {
            $thumbnail = $this->uploadImage($_FILES['thumbnail_file'], $this->path, true);

            if ($thumbnail['action']) {
                $request->merge(['thumbnail' => $thumbnail['filename']]);
            } else {
                return redirect() . back() . with('status', $thumbnail['message']);
            }
        }
        DB::beginTransaction();
        try {

            $published_at = $request->published_at;
            $dateTime = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d - H:i:s', $published_at);
            $request->merge(['published_at' => $dateTime]);

            $blog = $this->blogs->create(['user_id' => auth()->id()] + $request->only('title', 'seo_title', 'seo_description', 'slug', 'thumbnail', 'uri',
                    'body', 'excerpt', 'published_at', 'state','study_time'));

            $blog->blogtags()->attach($request->tag_ids);

            DB::commit();
            return redirect(route('backend.blogs.index'))->with('status', __('blog.blog_has_been_saved'));
        } catch (\QueryException $e) {
            DB::rollback();
            if (!empty($thumbnail['filename']))
                @unlink($this->path . '/' . $thumbnail['filename']);
            return redirect(route('backend.blogs.index'))->with('error', __('blog.blog_dont_saved'));
        }
    }

    public function edit($id)
    {
        $path = $this->path;
        $blog = $this->blogs->select('id', 'title', 'thumbnail', 'excerpt', 'published_at as PDate')->findOrFail($id);
        $blogtags = BlogTag::getList();

        $selected_blogtags = [];
        foreach ($blog->blogtags as $blogtag) {
            $selected_blogtags[] = $blogtag->id;
        }

        return view(currentBackView('blogs.form'), compact('blog', 'path', 'selected_blogtags', 'blogtags'));
    }

    public function update(UpdateBlogRequest $request, $id)
    {
        $blog = $this->blogs->findOrFail($id);


        if (!empty($_FILES['thumbnail_file']['name'])) {
            $thumbnail = $this->uploadImage($_FILES['thumbnail_file'], $this->path, true);

            if ($thumbnail['action']) {
                $request->merge(['thumbnail' => $thumbnail['filename']]);
            } else {
                return redirect() . back() . with('status', $thumbnail['message']);
            }
            @unlink($this->path . '/' . $blog->thumbnail);
            @unlink($this->path . '/' . getConstant('options.thumbnail') . '/' . $blog->thumbnail);
        }
        DB::beginTransaction();
        try {

            $published_at = $request->published_at;
            $dateTime = \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y/m/d - H:i:s', $published_at);
            $request->merge(['published_at' => $dateTime]);

            $blog->fill($request->only('title', 'seo_title', 'seo_description', 'slug', 'thumbnail', 'uri',
                'body', 'excerpt', 'published_at', 'state','study_time'))->save();

            $blog->blogtags()->sync($request->tag_ids);

            DB::commit();

            return redirect(route('backend.blogs.index'))->with('status', __('blog.blog_has_been_saved'));
        } catch (\QueryException $e) {
            DB::rollBack();
            if (!empty($thumbnail['filename']))
                @unlink($this->path . '/' . $thumbnail['filename']);
            return redirect(route('backend.blogs.index'))->with('error', __('blog.blog_dont_saved'));
        }
    }


    public function delete($id)
    {
        $blog = $this->blogs->findOrFail($id);
        $blog->delete();
        if ($blog->thumbnail != null){
            @unlink($this->path . '/' . $blog->thumbnail);
            @unlink($this->path . '/' . getConstant('options.thumbnail') . '/' . $blog->thumbnail);
        }
        return redirect(route('backend.blogs.index'))->with('status', __('blog.blog_has_been_deleted'));
    }
}
