<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function show(Page $page, array $parameters)
    {
        $this->perpareTemplate($page, $parameters);
        return view(currentFrontView('page'), compact('page'));
    }

    public function perpareTemplate(Page $page, array $parameters)
    {
        $templates = config('cms.templates');
        if (!$page->template || !isset($templates[$page->template])) {
            return;
        }
        $template = app($templates[$page->template]);
        $view = sprintf('templates.%s', $template->getView());
        if (! view()->exists($view)) {
            return;
        }
        $template->prepare($view = view($view), $parameters);
        $page->view = $view;
    }

}
