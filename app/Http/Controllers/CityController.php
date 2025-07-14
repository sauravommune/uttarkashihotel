<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CityDataTable;
use Exception;
use App\Models\City;
use App\Models\NearByPlace;
use App\Models\State;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{

    public function city(CityDataTable $dataTable)
    {

        $data['title'] = "Cities";
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return $dataTable->render('cities.index', $data);
    }

    public function save($id = null)
    {

        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        if ($id) {
            $city = City::find(decode($id));
            $title = "Edit Cities";
        } else {
            $city = new City();
            $title = "Add Cities";
        }
        $states = State::all();
        return view('cities.add', compact('states', 'city', 'title'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'city_name' => [
                'required',
                'string',
                'unique:cities,name,' . $request->id,
            ],
            'state_id' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $city = City::findOrNew($request->id);
            $city->name = $request->city_name;
            $city->state_id = $request->state_id;
            $city->meta_title = $request->meta_title;
            $city->meta_description = $request->meta_description;
            $city->save();

            $places = [];

            foreach ($request->near_by_places as $key => $item) {
                if (empty($item)) {
                    continue;
                }

                if (!empty($request->near_by_places_id[$key])) {
                  
                    $place = NearByPlace::find($request->near_by_places_id[$key]);

                    if ($place) {
                        $place->places = $item;
                        $place->save();
                        $places[] = $place->id;
                    }
                } else {
                  
                    $place = NearByPlace::create([
                        'places' => $item,
                        'city_id' => $city->id,
                    ]);
                    $places[] = $place->id;
                }
            }
            NearByPlace::where('city_id', $city->id)->whereNotIn('id', $places)->delete();
            DB::commit();
            return response()->json(['status' => 200, 'message' => 'City Saved Successfully'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteCity($id = null)
    {
        $checkCity = City::find(decode($id));
        try {
            $checkCity->delete();
            return response()->json(['status' => 200, 'message' => 'City delete successfully', 'redirect' => 'city'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }
}
