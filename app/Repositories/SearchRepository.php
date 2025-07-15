<?php

namespace App\Repositories;

use App\Models\Hotel;
use App\Models\SearchLog;
use Carbon\Carbon;
use MakiDizajnerica\GeoLocation\Facades\GeoLocation;
use Jenssegers\Agent\Agent;

class SearchRepository
{

    private function save_preference($request, $city)
        {
            // $master = SearchLog::findOrNew(id: decode($request?->search_id));
            $master = new SearchLog();
            $collection = GeoLocation::lookup($request->ip());
            $agent = new Agent();
            $master->request_ip = $request->ip();
            $master->user_id = auth()->user()->id ?? null;
            $master->city_id = $city->id;
            $master->checkin_date = $request->input('checkin_date', Carbon::now()->addDay());
            $master->checkout_date = $request->input('checkout_date', Carbon::now()->addDays(2));
            $master->roomCount = $request->input('roomCount', 1);
            $master->adultCount = $request->input('adultCount', 1);
            $master->childCount = $request->input('childCount', 0);
            $master->status = $request->status ?? 0;
            $master->device_type = $agent->deviceType();
            $master->country = $collection->get('country');
            $master->child_ages = $request->childAge ?? [];
            $master->save();

            session()->forget('search_id');
            session(['search_id' => encode($master->id)]);
            return $master->load(['city']);
        }


        public function searchResult($request, $city)
        {

            try {
                $searchData = $this->save_preference($request, $city);

                // Validate and sanitize input parameters with default values
                $checkIn = $searchData->checkin_date;
                $checkOut = $searchData->checkout_date;
                $adult_count = $searchData->adultCount;
                $child_count = $searchData->childCount;
                // $room_count = $searchData->roomCount;
                $totalGuests = $adult_count + $child_count;

                $nights = (int)max(1, Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut)));

                // Build complete query with all conditions
                $hotelsQuery = Hotel::with([
                    'hotelImg' => fn($img) => $img->where('imageable_type','App\Models\Hotel')->latest('id'),
                    'amenities.amenityName',
                ])
                    ->where('city', $city->id)
                    ->where('status', 'active')
                    ->select('hotels.*')
                    ->selectRaw('(
                            SELECT CASE 
                                WHEN MAX(rp.availability) > 0 THEN 1 
                                ELSE 0 
                            END
                            FROM rate_plans rp
                            JOIN rooms r ON r.id = rp.room_type
                            WHERE r.hotel_id = hotels.id
                            AND rp.pricing_date >= ?
                            AND rp.pricing_date < ?
                    ) as max_availability', [$checkIn, $checkOut])
                    // Join with rooms and add room conditions
                    ->whereHas('rooms', function ($query) use ($checkIn, $checkOut, $totalGuests, $request) {
                        $query->where('status', 1)
                            // ->where('stay_guest', '>=', $totalGuests)
                            ->when($request->bed_type, function ($q) use ($request) {
                                $q->whereHas(
                                    'getBed',
                                    fn($bedQ) =>
                                    $bedQ->whereIn('bed_type_id', $request->bed_type)
                                ); 
                            })
                            ->whereHas('ratePlan', function ($q) use ($checkIn, $checkOut) {
                                    $q->where('pricing_date', '>=', $checkIn)
                                    ->where('pricing_date', '<', $checkOut);
                            });
                    })
                    ->with(['rooms' => function ($query) use ($checkIn, $checkOut, $totalGuests, $request) {
                        $query->where('status', 1)
                            // ->where('stay_guest', '>=', $totalGuests)
                            ->when($request->bed_type, function ($q) use ($request) {
                                $q->whereHas(
                                    'getBed',
                                    fn($bedQ) =>
                                    $bedQ->whereIn('bed_type_id', $request->bed_type)
                                );
                            })
                            ->whereHas('ratePlan', function ($q) use ($checkIn, $checkOut) {
                                $q->where('pricing_date', '>=', $checkIn)
                                    ->where('pricing_date', '<', $checkOut);
                            })
                            ->with([
                                'getBed',
                                'ratePlan' => fn($q) => $q
                                    ->where('pricing_date', '>=', $checkIn)
                                    ->where('pricing_date', '<', $checkOut)
                            ]);
                    }]);

                // Apply additional hotel filters
                $this->applyHotelFilters($hotelsQuery, $request);

                $hotelsQuery->orderByRaw('CASE 
                    WHEN sold_out = 0 AND (
                        SELECT MAX(rp.availability) 
                        FROM rate_plans rp 
                        JOIN rooms r ON r.id = rp.room_type 
                        WHERE r.hotel_id = hotels.id 
                        AND rp.pricing_date >= ? 
                        AND rp.pricing_date < ?
                    ) > 0 THEN 1
                    WHEN sold_out = 1 THEN 3
                    ELSE 2 
                END ASC, 
                CASE 
                    WHEN sold_out = 0 THEN (
                        SELECT MAX(rp.availability) 
                        FROM rate_plans rp 
                        JOIN rooms r ON r.id = rp.room_type 
                        WHERE r.hotel_id = hotels.id 
                        AND rp.pricing_date >= ? 
                        AND rp.pricing_date < ?
                    )
                    ELSE 0 
                END DESC', [$checkIn, $checkOut, $checkIn, $checkOut]);

                // Execute query and transform results
                $filteredHotels = $hotelsQuery->get()->map(function ($hotel) use ($nights, $city, $request) {

                    $availableRoom = $hotel->rooms->first();
                  
                    return $this->buildHotelResult($hotel, $availableRoom, $nights, $city, $request);
                });

                return ['filteredHotels' => $filteredHotels, 'searchData' => $searchData];
            } catch (\Exception $e) {
                return ['status' => false, 'message' => $e->getMessage()];
            }
        }

        private function applyHotelFilters($query, $request)
        {
            if ($request->rating > 0) {
                $query->where('rating', $request->rating);
            }

            if ($request->hotel_name) {
                $query->where('name', 'LIKE', '%' . $request->hotel_name . '%');
            }

            if (!empty($request->select_star)) {
                $query->whereIn('rating', $request->select_star);
            }

            if (!empty($request->hotel_amenity)) {
                $query->whereHas('amenities', fn($q) => $q->whereIn('amenity_id', $request->hotel_amenity));
            }

        }

        private function averageRoomRate($totalAmountEp, $totalRatePlanCount)
        {
            $averageRatePrice = $totalAmountEp / $totalRatePlanCount;
            return round($averageRatePrice, 2);
        }

        private function buildHotelResult($hotel, $availableRoom, $nights, $city, $request)
        {

            $totalRatePlanCount = count($availableRoom->ratePlan);
            $totalAmountEp = $availableRoom->ratePlan->sum('total_amount_ep');

            $averageRoomRate = $this->averageRoomRate($totalAmountEp, $totalRatePlanCount);

              //start add this extraBedPrice add new code
            //   if($availableRoom->ratePlan->count()>0){
            //       $personExtraBedPriceEp = personExtraBedPriceEp($availableRoom->ratePlan);
            //       $averageRoomRate = $averageRoomRate+$personExtraBedPriceEp['ep_average_extra_person_price'];
            //   }
            //end add this extraBedPrice add new code

            $room_count = $request->roomCount ?? 1;
            $totalPrice = $averageRoomRate * $room_count;

            return[
                'hotel' => $hotel,
                'hotelImg' => $hotel->hotelImg,
                'available_rooms' => $availableRoom,
                'total_price' => $totalPrice,
                'amenities' => $hotel->amenities->pluck('amenityName'),
                'per_night_price' => $averageRoomRate,
                'city_name' => $city->name,
                'availableRoom' => lowestAvailableRoom($availableRoom->ratePlan)
            ];  
        }
        
}
