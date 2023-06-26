<?php


namespace App\Presenters;

use Laracasts\Presenter\Presenter;
use League\CommonMark\CommonMarkConverter;

class PagePresenter extends Presenter
{
    protected $markDown;

    public function __construct($entity)
    {
        $this->markDown = new CommonMarkConverter();
        parent::__construct($entity);
    }
    public function contentHtml()
    {
        return $this->markDown->convertToHtml($this->content) ;
    }

    public function uriWildcard()
    {
        return $this->uri . '*';
    }

    public function prettyUri()
    {
        return '/' . ltrim($this->uri, '/');
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
