<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCommentReport extends Model
{
    protected $fillable = ['user_id','report', 'report_type', 'blog_comment_id'];
}
