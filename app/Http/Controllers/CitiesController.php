<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    protected $cities;

    public function __construct(City $cities)
    {
        $this->cities = $cities;
    }

    public function get($province_id, $city_id)
    {
        $cities = $this->cities->where('province_id', $province_id)->orderBy('name', 'asc')->get();
        $returnHTML = view(currentFrontView('partials.cities.get'))->with(['cities' => $cities, 'city_id' => $city_id])->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }
}
