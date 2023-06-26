<?php


namespace App\Http\Controllers\Backend;

use Illuminate\Routing\Controller as BaseController;
use App\Traits;

class Controller extends BaseController
{

    use Traits\UploadFiles;

    public function __construct()
    {
        $this->middleware(['auth','role']);
    }


}
