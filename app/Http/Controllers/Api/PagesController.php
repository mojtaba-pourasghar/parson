<?php

namespace App\Http\Controllers\Api;

use App\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function show(Page $page, array $parameters)
    {
        return response()->json(['success' => 1,'page'=>$page]);
    }

}
