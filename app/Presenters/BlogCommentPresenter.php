<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;
use League\CommonMark\CommonMarkConverter;

class BlogCommentPresenter extends Presenter
{

    public function __construct($entity)
    {
        parent::__construct($entity);
    }

    public function CreateDate()
    {
        if ($this->created_at) {
            return \Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($this->created_at));
        }
        return __('');
    }
    public function CreateTime()
    {
        if ($this->created_at) {
            return date('H:i', strtotime($this->created_at));
        }
        return __('');
    }
}
