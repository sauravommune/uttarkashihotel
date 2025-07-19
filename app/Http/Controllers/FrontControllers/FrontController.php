<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\FrontRepository;
use App\Repositories\SearchRepository;
use App\Models\City;
use App\Models\MetaSettings;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\SavedHotel;
use App\Models\SearchLog;

use App\Repositories\SavedHotelRepository;

class FrontController extends Controller
{

    public function index(FrontRepository $frontRepository)
    {

        $searchData = Session::get('searchData') ?? [];

        addVendors(['tinyMCE', 'jquery-validate']);

        $city = $frontRepository->getCityWithHotel();
        $popularHotel = $frontRepository->popularHotel();


        // dd($searchData);


        return view('front.index', compact('city', 'searchData', 'popularHotel'));
    }

    public function makePayment()
    {
        return view('front.make-payment');
    }   

    public function sortResult($request, $searchResult)
    {
        if (!empty($request->sort_by) && ($request->sort_by == 'low_to_high_price')) {
            // $searchResult  = $searchResult->sortBy('per_night_price');
            $searchResult = $searchResult->sort(function ($a, $b) {
                // First level: sold_out (0 comes before 1)
                if ($a['hotel']->sold_out !== $b['hotel']->sold_out) {
                    return $a['hotel']->sold_out <=> $b['hotel']->sold_out;
                }
            
                // Second level: max_availability (higher availability comes first)
                if ($a['hotel']->max_availability !== $b['hotel']->max_availability) {
                    return $b['hotel']->max_availability <=> $a['hotel']->max_availability;
                }

                // Third level: per_night_price (lower price comes first)
                return $a['per_night_price'] <=> $b['per_night_price']; 
            });
        }
        if (!empty($request->sort_by) && ($request->sort_by == 'high_to_low_price')) {
            // $searchResult  = $searchResult->sortByDesc('per_night_price');
            $searchResult = $searchResult->sort(function ($a, $b) {
                // First level: sold_out (0 comes before 1)
                if ($a['hotel']->sold_out !== $b['hotel']->sold_out) {
                    return $a['hotel']->sold_out <=> $b['hotel']->sold_out;
                }
            
                // Second level: max_availability (higher availability comes first)
                if ($a['hotel']->max_availability !== $b['hotel']->max_availability) {
                    return $b['hotel']->max_availability <=> $a['hotel']->max_availability;
                }
            
                // Third level: per_night_price (higher price comes first)
                return $b['per_night_price'] <=> $a['per_night_price'];
            });
            
        }

        if (!empty($request->sort_by) && ($request->sort_by == 'low_to_high_rating')) {
            // $searchResult  = $searchResult->sortBy('per_night_price');
            $searchResult = $searchResult->sort(function ($a, $b) {
                // First level: sold_out (0 comes before 1)
                if ($a['hotel']->sold_out !== $b['hotel']->sold_out) {
                    return $a['hotel']->sold_out <=> $b['hotel']->sold_out;
                }
            
                // Second level: max_availability (higher availability comes first)
                if ($a['hotel']->max_availability !== $b['hotel']->max_availability) {
                    return $b['hotel']->max_availability <=> $a['hotel']->max_availability;
                }
            
                // Third level: google_rating (lower rating comes first)
                return $a['hotel']->google_rating <=> $b['hotel']->google_rating;
            });
        }
        if (!empty($request->sort_by) && ($request->sort_by == 'high_to_low_rating')) {
            // $searchResult  = $searchResult->sortByDesc('per_night_price');
            $searchResult = $searchResult->sort(function ($a, $b) {
                // First level: sold_out (0 comes before 1)
                if ($a['hotel']->sold_out !== $b['hotel']->sold_out) {
                    return $a['hotel']->sold_out <=> $b['hotel']->sold_out;
                }
            
                // Second level: max_availability (higher availability comes first)
                if ($a['hotel']->max_availability !== $b['hotel']->max_availability) {
                    return $b['hotel']->max_availability <=> $a['hotel']->max_availability;
                }
            
                // Third level: google_rating (higher rating comes first)
                return $b['hotel']->google_rating <=> $a['hotel']->google_rating;
            });
            
        }

        return $searchResult;
    }

    public function searchResult(Request $request, SearchRepository $searchRepository, FrontRepository $frontRepository)
    {

        $agent = new Agent();
        try {
            $city = City::with(['state:id,name'])->where('name', $request->city)->first();
            if (!$city) {
                throw new \Exception('City not found');
            }
            $meta = [
                'title' => $city?->meta_title,
                'description' => $city?->meta_description
            ];
            $searchResult = $searchRepository->searchResult($request, $city);

            if (isset($searchResult['status']) && $searchResult['status'] == false) {
                throw new \Exception($searchResult['message']);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            // return redirect()->route('home')->with('error', $e->getMessage());
        }

        $searchData = $searchResult['searchData'];
        $searchResult = $searchResult['filteredHotels'];

        // prioritize recommended hotels
        list($recommendedHotels, $nonRecommendedHotels) = collect($searchResult)->partition(function ($hotel) {
            return $hotel['hotel']->recommended == 1;
        });
        $searchResult = $recommendedHotels->merge($nonRecommendedHotels);

        // set selected hotel at top if searched
        if ($request->has('hotel_id')) {
            $hotelId = $request->input('hotel_id');

            // Find the hotel by ID
            $searchResult = $searchResult->sortByDesc(function ($hotel) use ($hotelId) {
                return $hotel['hotel']->id == $hotelId ? 1 : 0; // Move the matching hotel to the top
            });
        }

        $citiesWithHotelCount = $frontRepository->getCityWithHotel();

        if ($request->ajax()) {

            $searchResult = $this->sortResult($request, $searchResult);

            if (isset($request->range_price) && count($request->range_price) > 0) {
                $ranges = $request->range_price;

                $searchResult = $searchResult->filter(function ($hotel) use ($ranges) {
                    $perNightPrice = $hotel['per_night_price'];
                    foreach ($ranges as $range) {
                        list($min, $max) = explode('-', $range);
                        if ($perNightPrice >= (float) $min && $perNightPrice <= (float) $max) {
                            return true;
                        }
                    }
                    return false;
                });
            }
            if (!empty($request->hotel_name)) {
                return response()->json(['status' => 200, 'data' => $searchResult, 'list' => true], 200);
            } elseif (!empty($request->hotel_id)) {
                $hotel_id = $request->hotel_id;
                $html = view('components.hotel-list', ['hotelList' => $searchResult, 'searchTerms' => $searchData, 'agent' => $agent, 'hotelId' => $hotel_id])->render();
                return response()->json(['status' => 200, 'data' => $html, 'list' => false], 200);
            } else {
                $html = view('components.hotel-list', ['hotelList' => $searchResult, 'searchTerms' => $searchData, 'agent' => $agent])->render();
                return response()->json(['status' => 200, 'data' => $html, 'list' => false], 200);
            }
        } else {
            $amenityBedTyeData = $frontRepository->getAllAmenityBedType($searchResult);
            $viewPage = $agent->isDesktop() ? 'front.search-result' : 'front.search-result-md';

            return view($viewPage, compact('searchResult', 'citiesWithHotelCount', 'amenityBedTyeData', 'meta', 'searchData'));
        }
    }

    public function hotelDetails(FrontRepository $frontRepository, $slug = null, $searchId = null)
    {

        $searchId = $searchId ?? session('search_id');
        $roomCount = session('roomCount',1);

        $agent = new Agent();
        $searchId = decode($searchId);
        $hotelDetails = $frontRepository->hotelDetails($slug, $searchId);


        $searchData = $hotelDetails['searchData'];
        if ($hotelDetails['status'] == false) {
            session()->flash('error', 'Currently selected hotel is not available');
            return redirect(url('hotels-in-' . $searchData->city?->name));
        }
        $allAvailableRoom = $frontRepository->getAllAvailableRoomsWithHotels($slug, $searchData?->id);

        $citiesWithHotelCount = $frontRepository->getCityWithHotel();
        $meta = [
            'title' => $hotelDetails['details']?->hotelMeta?->meta_title ?? 'Book ' . $hotelDetails['details']?->name . ' Hotel in ' . $hotelDetails['details']?->cityDetails->name . ' - Get Best Deals on Hottel.in',
            'description' => $hotelDetails['details']?->hotelMeta?->meta_description ?? 'Book your stay at ' . $hotelDetails['details']?->name . ' Hotel in ' . $hotelDetails['details']?->cityDetails->name . ' on Hottel.in. Enjoy comfortable rooms, top-notch service, and the best deals for your stay.'
        ];

        return view('front.hotel-detail-modify', compact('agent', 'hotelDetails', 'searchData', 'allAvailableRoom', 'citiesWithHotelCount', 'meta'));
    }

    public function addDetails($hotelId = null, $roomId = null, $roomTypeId = null, $searchId = null, FrontRepository $frontRepository)
    {
        addVendors(['jquery-validate']);
        $details = $frontRepository->addDetails($hotelId, $roomId, $roomTypeId, $searchId);

        return view('front.add-detail-second', compact('details',));
    }

    public function searchRoom(Request $request, FrontRepository $frontRepository)
    {


        $allAvailableRoom = $frontRepository->searchRoom($request);
        $roomId = $request->room_id;
        $searchId = !empty($allAvailableRoom['0']['search_id'])?encode($allAvailableRoom['0']['search_id']):'';
                
        // $html = view('front.search-room', compact('allAvailableRoom', 'roomId',))->render();
        $html = view('front.search-room-modify', compact('allAvailableRoom', 'roomId',))->render();

        return response()->json(['status' => 200, 'data' => $html,'searchId'=>$searchId], 200);
    }


    public function addBookingMultiple(Request $request, FrontRepository $frontRepository)
    {
        $details = $frontRepository->addDetailsMultiple($request);
        if ($details == 'data not found') {
            return redirect()->route('home')->with('error', 'Some thing went wrong please try again!');
        }
        return view('front.add-detail-second', compact('details'));
    }

    public function consultNow(FrontRepository $frontRepository)
    {
        $city = $frontRepository->getCityWithHotel();
        $metaSettings = MetaSettings::where('route_name', 'consult-now')->first();
        $meta = [
            'title' => $metaSettings?->meta_title ?? "",
            'description' => $metaSettings?->meta_description ?? ""
        ];
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return view('front.consult-now')->with(['city' => $city, 'meta' => $meta]);
    }


    public function hotelListForConsultNow(Request $request, FrontRepository $frontRepository)
    {
        $hotelList = $frontRepository->hotelListForConsultNow($request);
        return response()->json(['status' => 200, 'message' => 'hotel List', 'data' => $hotelList]);
    }

    public function termsAndCondition()
    {
        $metaSettings = MetaSettings::where('route_name', 'terms-and-conditions')->first();
        $meta = [
            'title' => $metaSettings?->meta_title ?? '',
            'description' => $metaSettings?->meta_description ?? ''
        ];
        return view('front.term_and_condition', compact('meta'));
    }

    public function cancellingAndRefund()
    {
        $metaSettings = MetaSettings::where('route_name', 'cancelling_and_refund')->first();
        $meta = [
            'title' => $metaSettings?->meta_title ?? '',
            'description' => $metaSettings?->meta_description ?? ''
        ];
        return view('front.cancellation-policy', compact('meta'));
    }

    public function contactUs()
    {
        $metaSettings = MetaSettings::where('route_name', 'cancelling_and_refund')->first();
        $meta = [
            'title' => $metaSettings?->meta_title ?? '',
            'description' => $metaSettings?->meta_description ?? ''
        ];
        return view('front.contact-us', compact('meta'));
    }

    public function privacyPolicy()
    {
        $metaSettings = MetaSettings::where('route_name', 'privacy-policy')->first();
        $meta = [
            'title' => $metaSettings?->meta_title ?? '',
            'description' => $metaSettings?->meta_description ?? ''
        ];
        return view('front.privacy-policy', compact('meta'));
    }

    public function faq()
    {
        $metaSettings = MetaSettings::where('route_name', 'faq')->first();
        $meta = [
            'title' => $metaSettings?->meta_title ?? '',
            'description' => $metaSettings?->meta_description ?? ''
        ];
        return view('front.faq', compact('meta'));
    }

    public function savedHotel(Request $request, SavedHotelRepository $savedHotelRepository)
    {
        $savedHotelRepository->savedHotel($request);
        if ($request->expectsJson()) {
            $msg = $request->status == 1 ? 'hotel saved successfully' : 'hotel unsaved successfully';
            return response()->json(['status' => 200, 'message' => $msg], 200);
        }
    }

    public function getSavedHotel(Request $request, SavedHotelRepository $savedHotelRepository)
    {
        $saveHotelList = $savedHotelRepository->getSavedHotel();
        $saveHotelList = new SavedHotel($saveHotelList);

        if ($request->expectsJson()) {
            return response()->json(['status'  => 200, 'message' => 'Saved hotel list retrieved successfully.', 'data' => $saveHotelList], 200);
        }
    }
}
