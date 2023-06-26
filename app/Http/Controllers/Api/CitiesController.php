<?php

namespace App\Http\Controllers\Api;


use App\Faq;
use App\Http\Controllers\Api\Controller;
use App\City;
use Illuminate\Http\Request;


class CitiesController extends Controller
{
    public function list($province_id)
    {
        $cities = City::
           // select('id', 'title', 'slug')
             where('province_id', $province_id)
            ->orderBy('name', 'asc')
            ->get();
        return response()->json(['cities' => $cities, 'success' => 1]);
    }

}
