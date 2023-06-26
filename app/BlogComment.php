<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class BlogComment extends Model
{
    use PresentableTrait;
    protected $presenter = 'App\Presenters\BlogcommentPresenter';
    protected $fillable = ['user_id','blog_id', 'name', 'email', 'comment', 'state','reply_to','comment_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies() {
        return $this->hasMany(BlogComment::class, 'reply_to','id');
    }

    public function blog()
    {
        return $this->belongsTo(Book::class,'blog_id');
    }

}
