<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Blog extends Model
{
    use PresentableTrait;
    use Traits\Model;
    protected $presenter = 'App\Presenters\BlogPresenter';

    protected $fillable = ['user_id','title', 'seo_title', 'seo_description', 'slug', 'thumbnail', 'uri',
        'body', 'excerpt', 'published_at', 'state','comment_count','view_count','study_time'];

    protected $dates = ['published_at'];

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = $value ?: null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blogtags()
    {
        return $this->belongsToMany(BlogTag::class,'blog_tag');
    }

    public function persons()
    {
        return $this->belongsToMany(Person::class,'blog_person');
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class,'blog_organization');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class,'blog_book');
    }

    public function getPublishedAtAttribute($value)
    {
        if ($value) {
            return \Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($value));
        }
        return __('blog.not_published');
    }

    public function getThumbnailAttribute($value)
    {
        return getConstant('site_url').getBlogImagePath($value) ;
    }


}
