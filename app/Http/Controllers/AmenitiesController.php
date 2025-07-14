<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Amenity;
use App\DataTables\AmenityDataTable;
use Exception;
use App\Repositories\AmenityRepository;

class AmenitiesController extends Controller
{

    public function listAmenities(AmenityDataTable $dataTable)
    {
        $data['title'] = "Amenities";
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return $dataTable->render('amenities.index', $data);
    }

    public function save($id = null)
    {
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        if ($id) {
            $amenity = Amenity::find(decode($id));
        } else {
            $amenity = new Amenity();
        }
        $data['title'] = "Amenities";
        return view('amenities.add', ['data' => $data, 'amenity' => $amenity]);
    }

    public function create(Request $request,  AmenityRepository $amenityRepository)
    {
        try {
            $amenityRepository->saveAmenity($request);
            return response()->json(['status' => 200, 'message' => 'Amenity Saved Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteAmenity($id)
    {

        $checkAmenity = Amenity::find($id);
        try {
            $checkAmenity->delete();
            return response()->json(['status' => 200, 'message' => 'Amenity delete successfully', 'redirect' => 'amenities'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }
}
