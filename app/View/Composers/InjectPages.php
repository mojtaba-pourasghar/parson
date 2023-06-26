<?php


namespace Cms\View\Composers;
use App\Page;
use Illuminate\View\View;

class InjectPages
{
    protected $pages;

    public function __construct(Page $pages)
    {
        $this->pages = $pages;
    }

    public function compose(View $view)
    {
        $pages = $this->pages->all()->toTree();
        $view->with('pages',$pages);
    }
}


