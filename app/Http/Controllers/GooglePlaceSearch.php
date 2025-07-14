<?php

namespace App\Http\Controllers;

use Avcodewizard\GooglePlaceApi\GooglePlacesApi;
use Illuminate\Http\Request;

class GooglePlaceSearch extends Controller
{
    //
    public function searchAjax(Request $request, GooglePlacesApi $googlePlaces)
    {
        $query = $request->input('q');
        if (empty($query)) return response()->json(['items' => [], 'success' => false]);
        $places = $googlePlaces->searchPlace($query);
        $response = array_map(function ($place) {
            return [
                'id' => $place['place_id'],
                'text' => $place['description']
            ];
        }, $places['predictions']);
        return response()->json(['items' => $response, 'success' => true]);
    }
}
