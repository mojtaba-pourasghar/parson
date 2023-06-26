<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogCommentReport;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogCommentReportsController extends Controller
{
    protected $blogcommentreports;

    public function __construct(BlogCommentReport $blogcommentreports)
    {
        $this->blogcommentreports = $blogcommentreports;
    }


    protected function commentReportValidator(array $data)
    {
        $attributes = [
            'report' => __('blogcomment.report'),
        ];

        $messages = [];
        $rules = [
            //report' => ['required'],
        ];
        return Validator::make($data, $rules, $messages, $attributes);
    }


    public function add(Request $request)
    {
        $validator = $this->commentReportValidator($request->all());

        $message = '';
        $success = true;
        if ($validator->passes()) {
            try {
                //return $request->all();
                $blogcommentreport = $this->blogcommentreports->create([
                        'user_id' => auth()->id()
                    ] + $request->only('report', 'report_type', 'blog_comment_id'));

                $message = __('blogcomment.blogcommentreport_has_been_saved');

            } catch (\QueryException $e) {
                $success = false;
                $message = __('blogcommentreport.blogcommentreport_dont_saved');
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

    public function showModal($blog_comment_id)
    {
        $blogcommentreport = $this->blogcommentreports
            ->where([['blog_comment_id', $blog_comment_id],['user_id' , auth()->id()]])
            ->first();

        $abusive = '';
        $transpire_story = '';

        if (!empty($blogcommentreport)) {
            switch ($blogcommentreport->report_type) {
                case '1':
                    $abusive = 'active';
                    $transpire_story = '';
                    break;
                case '2':
                    $abusive = '';
                    $transpire_story = 'active';
                    break;
                case '1,2':
                    $abusive = 'active';
                    $transpire_story = 'active';
                    break;
            }

        }


        $returnHTML = view(currentFrontView('partials.blogcommentreports.modal'))->with(['blogcommentreport' => $blogcommentreport, 'blog_comment_id' => $blog_comment_id, 'abusive' => $abusive, 'transpire_story' => $transpire_story])->render();
        return response()->json($returnHTML);
    }

}
