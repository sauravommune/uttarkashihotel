<?php

namespace App\Http\Controllers\ApiControllers;

use App\Models\{City, Hotel, SearchLog, Amenity, RequestModificationBooking, Booking, User};
use App\Repositories\{FrontRepository, SearchRepository, ProfileRepository, BookingRepository};
use App\Http\Resources\{SearchData, MyBooking, ManageBooking, UserResource, HotelResource, PopularHotel, HotelDetail, AllRoom};
use Illuminate\Support\Facades\{Log, Auth, Hash, View};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use Barryvdh\Snappy\Facades\SnappyPdf;
use App\Jobs\UserRegistered;
use Exception;

class SearchController extends Controller
{
    public function allCity(FrontRepository $frontRepository)
    {
        try {
            $city = $frontRepository->getCityWithHotel();
            if ($city) {
                return response()->json(['status' => 200, 'data' => $city, 'messages' => 'list city'], 200);
            } else {
                return response()->json(['status' => 404, 'data' => [], 'messages' => 'city not found'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'messages' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function searchCity(Request $request, FrontRepository $frontRepository)
    {
        try {
            $searchCity = $frontRepository->SearchCity($request);

            if ($searchCity) {
                return response()->json(['status' => 200, 'data' => $searchCity, 'messages' => 'list city'], 200);
            } else {
                return response()->json(['status' => 404, 'data' => [], 'messages' => 'city not found'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'messages' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function searchHotel(Request $request, FrontRepository $frontRepository, SearchRepository $searchRepository)
    {

        try {
            $city = City::with(['state:id,name'])->where('name', $request->city)->first();
            if (!$city) {
                throw new Exception('City not found');
            }
            $searchResult = $searchRepository->searchResult($request, $city);
            $searchData = $searchResult['searchData'];;
            $searchResult = $searchResult['filteredHotels'];

            $filter_price_range = $frontRepository->getAllAmenityBedType($searchResult);

            $totalResult = count($searchResult);


            list($recommendedHotels, $nonRecommendedHotels) = collect($searchResult)->partition(function ($hotel) {
                return $hotel['hotel']->recommended == 1;
            });

            $searchResult = $recommendedHotels->merge($nonRecommendedHotels);


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
                $data = [
                    // 'searchResult' =>$searchResult,
                    'searchResult' => new HotelResource(resource: $searchResult),

                    'totalResultCount' => $totalResult,
                    'searchId' => encode($searchData->id),
                    'searchData' => new SearchData($searchData)

                ];
            }

            if ($request->type == 1) {
                $data = [
                    'searchResult' => new HotelResource(resource: $searchResult),
                    'totalResultCount' => $totalResult,
                    'searchId' => encode($searchData->id),
                    'searchData' => new SearchData($searchData)
                ];
            }

            if ($request->type == 2) {
                $data = [
                    // 'searchResult' =>$searchResult,
                    'searchResult' => new HotelResource(resource: $searchResult),
                    'totalResultCount' => $totalResult,
                    'hotel_id'        => $request->hotel_id,
                    'searchId' => encode($searchData->id),
                    'searchData' => new SearchData($searchData)

                ];
            } else {
                $data = [
                    // 'searchResult' =>$searchResult,
                    'searchResult' => new HotelResource(resource: $searchResult),
                    'filterPrice' => $filter_price_range,
                    'totalResultCount' => $totalResult,
                    'searchId' => encode($searchData->id),
                    'searchData' => new SearchData($searchData)

                ];
            }

            if (count($data['searchResult']) > 0) {
                // dd($data);
                // $data = new HotelResource(resource: $data);
                return response()->json(['status' => 200, 'data' => $data, 'messages' => 'list hotel'], 200);
            } else {
                return response()->json(['status' => 404, 'data' => [], 'messages' => 'hotel not found'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'messages' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


    public function popularHotel(FrontRepository $frontRepository)
    {

        try {
            $popularHotel = $frontRepository->popularHotelApi();

            $popularHotel = new PopularHotel($popularHotel);
            return response()->json(['status' => 200, 'messages' => 'List Popular Hotel', 'popularData' => $popularHotel], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'messages' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function hotelDetails(Request $request, FrontRepository $frontRepository)
    {
        try {
            $hotel = Hotel::where('id', $request->hotel_id)->first();
            $searchId = decode($request->searchId);
            $hotelDetails = $frontRepository->hotelDetails($hotel->slug, $searchId);
            if( empty($hotelDetails['details']) )
                throw new Exception('Hotel not found');
            $allAvailableRoom = $frontRepository->getAllAvailableRoomsWithHotels($hotel->slug, $searchId);
            $nearByPlace = $hotelDetails['details']->nearByPlace ?? collect([]);

            $nearByPlace = $nearByPlace->map(function ($place) {
                return [
                    'name' => $place->placeName->places,
                    'distance' => $place->distance

                ];
            });

            $citiesWithHotelCount = $frontRepository->getCityWithHotel();

            $searchData = $hotelDetails['searchData'];

            $data = [
                'hotel_details' => new HotelDetail($hotelDetails['details']),
                // 'hotel_details' =>$hotelDetails['details'],
                // 'searchData' => $searchData,
                'searchData' => new SearchData($searchData),
                'city' => $citiesWithHotelCount,
                'nearByPlace' => $nearByPlace,
                'totalPrice'  => $hotelDetails['total_price'],
                'availability' => empty($allAvailableRoom) ? 0 : 1
            ];


            return response()->json(['status' => 200, 'data' => $data, 'messages' => 'hotel details'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'messages' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function allRoom(Request $request, FrontRepository $frontRepository)
    {


        try {
            $hotel = Hotel::where('id', $request->hotel_id)->first();
            $searchId = decode($request->searchId);

            $allAvailableRoom = $frontRepository->getAllAvailableRoomsWithHotels($hotel->slug, $searchId);
            $searchData = SearchLog::find($searchId);

            $data = [
                // 'allAvailableRoom' =>$allAvailableRoom,
                'allAvailableRoom' => new AllRoom($allAvailableRoom),
                'searchData'  => new SearchData($searchData),
                'searchId'  => encode($searchData->id),
            ];

            // $citiesWithHotelCount = $frontRepository->getCityWithHotel();

            return response()->json(['status' => 200, 'data' => $data, 'messages' => 'list room details'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'messages' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function addBookingMultiple(Request $request, FrontRepository $frontRepository)
    {


        try {
            $details = $frontRepository->addDetailsMultiple($request);
            return response()->json(['status' => 200, 'data' => $details], 200);
        } catch (Exception $e) {

            Log::error('addBookingMultipleDetails error: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while processing your request. Please try again later.',
            ], 500);
        }
    }

    public function addDetails(Request $request, FrontRepository $frontRepository)
    {

        try {
            $details = $frontRepository->addDetailsApi($request);
            return response()->json(['status' => 200, 'data' => $details], 200);
        } catch (Exception $e) {
            Log::error('addBookingMultipleDetails error: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while processing your request. Please try again later.',
            ], 500);
        }
    }

    public function addMultipleBooking(BookingRequest $request, BookingRepository $bookingRepository)
    {
        try {
            if (!$request->hotelId || !$request->search_id) {
                return response()->json(['status' => 404, 'message' => 'Search For Best Hotels & book now!'], 404);
            }
            $token = '';
            if (!Auth::check()) {

                $user = User::where('email', $request->contact_email)->first();
                if (!empty($user->id)) {
                    if (empty($checkUser?->phone)) {
                        $user->phone = $request->contact_no;
                        $user->save();
                    }
                } else {
                    $password = randomPassword();
                    $user = User::create([
                        'name' => $request->contact_name,
                        'email' => $request->contact_email,
                        'phone' => $request->contact_no,
                        'password' => Hash::make($password),
                    ]);
                    $user->assignRole('User');
                    UserRegistered::dispatch($user, $password);
                }
                Auth::login($user);
                $token = $user->createToken("HottelApi")->accessToken;
            } else {
                $user = Auth::user();
            }

            $addBooking = $bookingRepository->addMultipleBooking($request);
            if (!$addBooking) {
                return response()->json(['status' => 400, 'message' => 'Something went wrong'], 400);
            }

            $bookingRepository->addTravellerDetails($request, $addBooking);
            return response()->json([
                'status' => 200,
                'message' => 'Booking saved successfully',
                'bookingId' => $addBooking,
                'token' => $token,
                'user'  => new UserResource($user)
            ], 200);
        } catch (Exception $e) {
            Log::error('addBookingMultipleDetails error: ' . $e->getMessage());
            return response()->json(['status' => 500, 'message' => 'Internal server error', 'data' => $e->getMessage()], 500);
        }
    }

    public function myBooking(Request $request, ProfileRepository $profileRepository, BookingRepository $bookingRepository)
    {

        $bookingId = $request->bookingId;
        if (!empty($bookingId)) {
            $manageBooking =  $bookingRepository->manageBooking();
            $manageBooking = new ManageBooking($manageBooking);
            return response()->json(['status' => 200, 'data' => $manageBooking, 'message' => 'booking list']);
        } else {
            $allBooking =  $profileRepository->manageBooking();
            $allBooking = new MyBooking($allBooking);
            return response()->json(['status' => 200, 'data' => $allBooking, 'message' => 'booking list']);
        }
    }
    public function resetPassword(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'oldPassword' => ['required', 'min:8'],
            'newPassword' => ['required', 'min:8'],
            'passwordConfirmation' => 'required|same:newPassword'

        ]);
        $user = auth()->user();

        if (!Hash::check($request->oldPassword, $user->password)) {
            return response()->json([
                'message' => 'The old password does not match our records.',
            ], 400);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();
        return response()->json([
            'message' => 'Password has been successfully updated.',
        ], 200);
    }


    public function amenityList()
    {

        $amenityList = Amenity::where('type', 'hotel')->get(['id', 'name']);
        return response()->json(['data' => $amenityList, 'message' => 'Hotel Amenity List'], 200);
    }
    public function sendRequestModifyBooking(Request $request)
    {
        $request->validate([
            'bookingId' => 'required',
            'modifyType' => 'required|in:cancel,date,traveler',
        ]);

        try {
            RequestModificationBooking::updateOrCreate(
                [
                    'booking_id' => $request->bookingId,
                    'modify_type' => $request->modifyType,
                ],
                [
                    'status' => $request->modifyType,
                    'date' => now(),
                ]
            );

            return response()->json(['status' => 'success', 'message' => 'Request send successfully'], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process the request. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function downloadInvoice(Request $request)
    {

        $booking = Booking::with('bookedRooms', 'transactions', 'invoice')->findOrFail($request->bookingId);

        $invoiceData = [
            'invoice_number' => !empty($booking->invoice?->invoice_number) ? $booking->invoice?->invoice_number : "",
            'invoice_date'   => now()->toDateString(),
        ];

        $booking->invoice()->updateOrCreate(
            ['booking_id' => $booking->id],
            $invoiceData
        );

        $html = View::make('front.pdf.payment-receipt', compact('booking'))->render();

        $pdf = SnappyPdf::loadHTML($html);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream("invoice-" . $booking->id . ".pdf");
    }
}
