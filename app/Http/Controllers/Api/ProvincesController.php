<?php

namespace App\Http\Controllers\Api;


use App\Faq;
use App\Http\Controllers\Api\Controller;
use App\Province;
use Illuminate\Http\Request;


class ProvincesController extends Controller
{
    public function list()
    {
        $provinces = Province::orderBy('name', 'asc')->where('state',1)->get();
        return response()->json(['provinces' => $provinces, 'success' => 1]);
    }

}
