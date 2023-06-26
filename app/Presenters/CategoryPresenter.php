<?php


namespace App\Presenters;

use Laracasts\Presenter\Presenter;
use League\CommonMark\CommonMarkConverter;

class CategoryPresenter extends BasePresenter
{
    protected $markDown;

    public function __construct($entity)
    {
        $this->markDown = new CommonMarkConverter();
        parent::__construct($entity);
    }

    public function linkToPaddedTitle($link)
    {
        $padding = str_repeat('&nbsp;', $this->depth * 4);
        return $padding . link_to($link, $this->title);
    }

    public function paddedTitle()
    {
        return str_repeat('&nbsp;', $this->depth * 4) . $this->title;
    }
}
