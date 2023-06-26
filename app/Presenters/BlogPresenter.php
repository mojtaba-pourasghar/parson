<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;
use League\CommonMark\CommonMarkConverter;

class BlogPresenter extends Presenter
{
    protected $markDown;

    public function __construct($entity)
    {
        $this->markDown = new CommonMarkConverter();
        parent::__construct($entity);
    }

    public function excerptHtml()
    {
        return $this->excerpt ? $this->markDown->convertToHtml($this->excerpt) : null;
    }

    public function bodyHtml()
    {
        return $this->body ? $this->markDown->convertToHtml($this->body) : null;
    }

    public function publishedDate()
    {
        if ($this->published_at) {
            return \Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($this->published_at));
           // return $this->published_at->toFormattedDateString();
        }
        return __('blog.not_published');
    }


}
