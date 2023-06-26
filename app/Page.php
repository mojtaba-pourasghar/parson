<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Laracasts\Presenter\PresentableTrait;

class Page extends Model
{
    use PresentableTrait;
    use NodeTrait;
    use Traits\Model;
    protected $presenter = 'App\Presenters\PagePresenter';

    protected $fillable = ['title', 'name', 'uri', 'content', 'template','state','seo_title','seo_description','order'];


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value ?: null;
    }

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = $value ?: null;
    }


}
