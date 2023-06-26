<?php

namespace App\Presenters;

class UserPresenter extends BasePresenter
{
    public function __construct($entity)
    {
        parent::__construct($entity);
    }

    public function registrationDate()
    {
        if ($this->created_at) {
            return \Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($this->created_at));
        }
        return __('');
    }
}
