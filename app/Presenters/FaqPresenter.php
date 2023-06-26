<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;
use League\CommonMark\CommonMarkConverter;

class FaqPresenter extends Presenter
{
    protected $markDown;

    public function __construct($entity)
    {
        $this->markDown = new CommonMarkConverter();
        parent::__construct($entity);
    }

    public function answerHtml()
    {
        return $this->answer ? $this->markDown->convertToHtml($this->answer) : null;
    }


}
