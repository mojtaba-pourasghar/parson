<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogComment;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogCommentsController extends Controller
{
    protected $blogcomments;

    public function __construct(BlogComment $blogcomments)
    {
        $this->blogcomments = $blogcomments;
    }

    public function get($blog_id)
    {
        //\DB::enableQueryLog();
        $limit = getConstant('frontend.limit');
        $blogcomments = $this->blogcomments
            ->with([
                'user' => function ($query) {
                    $query->where('state', '=', 1);
                    return $query->select('id', 'name', 'image');
                },
                'replies' => function ($query) {
                    $query->with([
                        'user' => function ($query) {
                            $query->where('state', '=', 1);
                            return $query->select('id', 'name', 'image');
                        }
                    ]);
                    $query->where('state', '=', 1);
                    // return $query->select('id', 'comment', 'created_at');
                }
            ])
            ->where([['blog_id', $blog_id]/*, ['reply_to', 0]*/])
            ->orderBy('id', 'desc')
            ->paginate($limit);
        // return \DB::getQueryLog();
        //return $blogcomments;
        $blog = null;
        if (!empty($blogcomments)) {
            $blog = Blog::where('id', $blogcomments[0]->blog_id)->select('id', 'title', 'slug')->first();
        }
        $returnHTML = view(currentFrontView('partials.blogcomments.get'))->with(['blogcomments' => $blogcomments, 'blog' => $blog])->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

    protected function commentValidator(array $data)
    {
        $attributes = [
            'comment' => __('blogcomment.comment'),
        ];

        $messages = [];
        $rules = [
            'comment' => ['required'],
        ];
        return Validator::make($data, $rules, $messages, $attributes);
    }


    public function add(Request $request, $blog_id)
    {
        $validator = $this->commentValidator($request->all());

        $message = '';
        $success = true;
        if ($validator->passes()) {
            try {


                $blogcomment = $this->blogcomments->create([
                        'user_id' => auth()->id(),
                        'blog_id' => $blog_id,
                        'comment_date' => \Morilog\Jalali\CalendarUtils::strftime('Ymd', strtotime(now()))
                    ] + $request->only('comment', 'reply_to'));

                Blog::where('id', $blog_id)->update(['comment_count' => DB::raw('comment_count + 1')]);
                $message = __('blogcomment.blogcomment_has_been_saved');

            } catch (\QueryException $e) {
                $success = false;
                if ($request->is_question == 0)
                    $message = __('blogcomment.blogcomment_dont_saved'); else
                    $message = __('blogcomment.question_dont_saved');
            }
        } else {
            foreach ($validator->errors()->all() as $error) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => $error
                    ]
                );
            }
        }
        return response()->json(
            [
                'success' => $success,
                'message' => $message
            ]
        );

    }

    public function showModal($id)
    {
        $blogcomment = $this->blogcomments
            ->where([['id', $id]])
            ->first();

        $returnHTML = view(currentFrontView('partials.blogcomments.modal'))->with(['blogcomment' => $blogcomment])->render();
        return response()->json($returnHTML);
    }

    public function update(Request $request, $id)
    {
        $validator = $this->commentValidator($request->all());
        $message = '';
        $success = true;
        $comment = '';
        if ($validator->passes()) {
            try {
                $blogcomment = $this->blogcomments->find($id);
                $blogcomment->comment = $request->comment;
                $comment = $request->comment;
                $blogcomment->save();
                $message = __('blogcomment.blogcomment_has_been_saved');
            } catch (\QueryException $e) {
                $success = false;
                $message = __('blogcomment.blogcomment_dont_saved');
            }
        } else {
            foreach ($validator->errors()->all() as $error) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => $error
                    ]
                );
            }
        }

        return response()->json(
            [
                'success' => $success,
                'message' => $message,
                'comment' => $comment,
            ]
        );
    }


    public function getUserComments(Request $request, $user_id)
    {
        $limit = getConstant('frontend.limit');
        $blogcomments = $this->blogcomments
            ->with([
                'blog' => function ($query) {
                    $query->where('state', 1);
                    return $query->select(['id', 'title', 'slug', 'thumbnail', 'rate']);
                }
            ])
            ->where([['state', 1], ['user_id', $user_id]])
            ->orderBy('id', 'desc')
            ->paginate($limit);
        return view(currentFrontView('blogcomments.comments'), compact('blogcomments'));
    }
}
