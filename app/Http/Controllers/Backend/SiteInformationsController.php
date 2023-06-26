<?php

namespace App\Http\Controllers\Backend;

use App\SiteInformation;
use App\Http\Requests\StoreSiteInformationRequest;
use Illuminate\Http\Request;

class SiteInformationsController extends Controller
{
    protected $siteinformations;

    public function __construct(SiteInformation $siteinformations)
    {
        $this->siteinformations = $siteinformations;
        parent::__construct();
    }



    public function edit()
    {
        $siteinformation = $this->siteinformations->first();
        return view(currentBackView('siteinformation.form'), compact('siteinformation'));
    }

    public function update(Request $request)
    {
        $siteinformation = $this->siteinformations->first();
        $siteinformation->fill($request->only('title', 'description', 'keywords', 'instagram', 'facebook', 'twitter', 'telegram', 'worldwide'))->save();
        return redirect(route('backend.siteinformations.edit'))->with('status', __('siteinformation.siteinformation_has_been_saved'));
    }


}
