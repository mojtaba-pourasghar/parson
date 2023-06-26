<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Laracasts\Presenter\PresentableTrait;

class Category extends Model
{
    use NodeTrait;
    use PresentableTrait;
    use Traits\Model;
    protected $presenter = 'App\Presenters\CategoryPresenter';

    protected $fillable = [
        'title', 'slug','seo_title','seo_description','description','thumbnail','state','parent_id','order'
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class,'book_category');
    }

    public static function getList()
    {
        $instance = new static;
        $orderCategories = $instance->all();
        $orderList = [];
        foreach ($orderCategories as $key => $category) {
            $orderList[$category->id] = $category->ancestors->count() ? implode(' > ', $category->ancestors->pluck('title')->toArray()).'>'.$category->title  : $category->title ;
        }
        return $orderList;
    }
}
