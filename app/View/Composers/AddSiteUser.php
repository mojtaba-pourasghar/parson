<?php

namespace Cms\View\Composers;

use Illuminate\View\View;

class AddSiteUser
{
    public function compose(View $view)
    {
        $view->with('loginUser', auth()->user());
    }
}
