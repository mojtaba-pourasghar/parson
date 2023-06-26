<?php
namespace Cms\View\Composers;

use Illuminate\View\View;

class AddWarningMessage
{
    public function compose(View $view)
    {
        $view->with('warning',session('warning'));
    }
}
