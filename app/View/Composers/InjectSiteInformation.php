<?php


namespace Cms\View\Composers;
use App\SiteInformation;
use Illuminate\View\View;

class InjectSiteInformation
{
    protected $siteinformations;

    public function __construct(SiteInformation $siteinformations)
    {
        $this->siteinformations = $siteinformations;
    }

    public function compose(View $view)
    {
        $siteinformation = $this->siteinformations->first();
        $view->with('siteinformation',$siteinformation);
    }
}


