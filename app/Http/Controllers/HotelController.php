<?php

namespace App\Http\Controllers;

use App\DataTables\HotelDataTable;
use App\Http\Requests\HotelRequest;
use App\Jobs\GenerateSitemapJob;
use App\Models\{Amenity, Breakfast, City, Hotel, Bank, Room, User};
use App\Repositories\HotelRepository;
use Exception;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @param \App\DataTables\HotelDataTable $datatable The datatable object.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View The rendered view.
     */

    public function __construct(private HotelRepository $hotelRepository) {}

    public function index(HotelDataTable $datatable)
    {
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        $hotelSearch = session()->get('hotelSearch');
        $title = 'Hotel Management';
        $cities = $this->hotelRepository->getAllCities();
        return $datatable->render('hotelmaster.index', compact('title', 'cities', 'hotelSearch'));
    }


    public function create($id = null)
    {
        session()->forget(['hotel_id']);

        addVendors(['tinyMCE', 'jquery-validate', 'dropify', 'hotel_validate']);
        $amenities = Amenity::where('type', 'hotel')->get();
        $breakFasts = Breakfast::all();
        $data['amenities']      = $amenities;
        $data['breakfasts']      = $breakFasts;
        if ($id) {
            $hotel = Hotel::with('hotelMeta')->where('id', $id)->first();
            $data['title']      = 'Edit Hotel';
            $data['places']      = $this->hotelRepository->nearByPlace($hotel?->city);
        } else {
            $hotel = new Hotel();
            $data['title']      = 'Add Hotel';
            $data['places']      = [];
        }
        $data['hotel']        = $hotel;
        $data['city'] =         City::all();
        $data['banks'] =         Bank::all();
        return view('hotelmaster.create', $data);
    }

    /**
     * Save the hotel details.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the status and message.
     */
    public function save(HotelRequest $request)
    {
        try {
            $this->hotelRepository->saveHotel($request);
           
            return response()->json(['status' => 200, 'message' => 'Details Saved Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function viewDetails($id)
    {
        addVendors(['jquery-validate']);
        $details = $this->hotelRepository->getDetails($id);
        $room_type = new Room();
        return view('hotelmaster.details', compact('details', 'room_type'));
    }

    public function changeStatus(Request $request)
    {
        try {
            $this->hotelRepository->changeStatus();
            return response()->json(['status' => 200, 'message' => 'Updated Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function changePapular(Request $request)
    {
        try {
            $this->hotelRepository->changePapular();
            return response()->json(['status' => 200, 'message' => 'Updated Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateSoldOut(Request $request)
    {
        try {
            $this->hotelRepository->changeSoldOut();
            return response()->json(['status' => 200, 'message' => 'Updated Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function changeRecommended(Request $request)
    {
        try {
            $this->hotelRepository->changeRecommended();
            return response()->json(['status' => 200, 'message' => 'Updated Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function nearByPlaces(Request $request)
    {
        try {
            $places = $this->hotelRepository->nearByPlace($request->city);
            $html = view('hotelmaster.hotelForm.near_by_place', compact('places'))->render();
            return response()->json(['success' => 200, 'html' => $html], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function addImageForm()
    {
        $html = view('hotelmaster.add_image_form')->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function removeHotel()
    {
        try {
            $this->hotelRepository->removeHotel();
            return response()->json(['status' => 200, 'message' => 'Hotel Removed Successfully', 'redirect' => 'hotels'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }
    public function uniqueHotel(Request $request)
    {
        $exists = Hotel::where('name', $request->name)->where('id', '<>', $request->id)->exists();
        if (!$exists)
            return "true";
        else
            return "false";
    }

    public function uniqueEmail(Request $request)
    {
        $exists = User::where('email', $request->email)->where('email', '<>', $request->email)->exists();
        if (!$exists)
            return "true";
        else
            return "false";
    }

    public function sitemap()
    {

        $sitemapPath = public_path('sitemap.xml');
        if (file_exists($sitemapPath)) {
            $existsSitemap = 'yes';

            $sitemapUrl = asset('sitemap.xml');
        } else {
            $existsSitemap = 'no';

            $sitemapUrl = 'Site map file nothing please generate';
        }
        return view('sitemap.index', compact('existsSitemap', 'sitemapUrl'));
    }

    public function generateSitemap()
    {

        try {
            GenerateSitemapJob::dispatch();
            return redirect()->route('site.map')->with('success', 'Sitemap generated successfully!');
        } catch (\Exception $e) {

            return redirect()->route('site.map')->with('error', 'Failed to generate sitemap.');
        }
    }
}
