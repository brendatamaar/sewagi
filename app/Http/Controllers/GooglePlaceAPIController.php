<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GooglePlaces;

class GooglePlaceAPIController extends Controller
{
    function getPlaceAutoComplete(Request $request) {
        $params = [];
        if ($request->restrict_place) {
            $params = [
                'location' => '-6.21462, 106.84513',
                'radius' => 20000,
                'strictbounds' => true
            ];
        }
        
        $response = GooglePlaces::placeAutocomplete($request->place_name, $params);
        return $response;
    }
    function getPlaceDetails(Request $request) {
        $response = GooglePlaces::placeDetails($request->place_id);
        return $response;
    }
}
