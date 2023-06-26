<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Trend extends Model
{
    use PresentableTrait;
    use Traits\Model;
    protected $presenter = 'App\Presenters\TrendPresenter';

    protected $fillable = ['user_id','title', 'seo_title', 'seo_description', 'slug', 'thumbnail', 'uri','sex',
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

    public function colors()
    {
        return $this->hasMany(TrendColor::class);
    }

    public function trend_tags()
    {
        return $this->belongsToMany(TrendTag::class,'trend_tag');
    }

    public function trend_categories()
    {
        return $this->belongsToMany(TrendCategory::class,'category_trend');
    }

    public function textiles()
    {
        return $this->belongsToMany(Textile::class,'trend_textile');
    }

    public function getThumbnailAttribute($value)
    {
        return getConstant('site_url').getTrendImagePath($value) ;
    }

    public function getCreatedAtAttribute($value)
    {
        if ($value) {
            return \Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($value));
        }
        return __('');
    }

}
