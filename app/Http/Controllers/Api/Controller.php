<?php


namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use App\Traits;

class Controller extends BaseController
{

    use Traits\UploadFiles;

    public function __construct() {
      //  $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
}
