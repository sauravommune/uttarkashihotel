<?php

namespace App\Repositories;

use App\Models\City;
use App\Models\Hotel;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\SearchLog;
use MakiDizajnerica\GeoLocation\Facades\GeoLocation;
use Jenssegers\Agent\Agent;

class FrontRepository extends BaseRepository
{

    public function getCityWithHotel()
    {
        return City::with('state')
            ->whereHas('getHotel', fn($query) => $query->where('status', 'active')->whereHas('rooms', fn($query) => $query->where('status', 1)))
            ->withCount(['getHotel' => function ($query) {
                $query->whereHas('rooms', fn($query) => $query->where('status', 1));
                $query->where('status', 'active');
            }])
            ->get();
    }

    public function SearchCity($request)
    {

        $searchCity = City::where('name', 'LIKE', "%$request->name%")->with('state')->whereHas('getHotel')->withCount(['getHotel' => function ($query) {
            $query->whereHas('rooms', fn($query) => $query->where('status', 1));
        }])->get();
        return $searchCity;
    }

    public function popularHotelApi()
    {
        $date = Carbon::now()->addDay(2)->format('Y-m-d');  // This is correct

        $popularHotel = Hotel::whereHas('room', function ($query) use ($date) {
            $query->where('status', 1);
        })->whereHas('room.plan', function ($query) use ($date) {
            $query->whereDate('pricing_date', '=', $date)
                ->where('b2b_rate_ep', '>', 0)
                ->where('availability', '>', 0);
        })
            ->with([
                'room',
                'room.plan' => function ($query) use ($date) {
                    $query->whereDate('pricing_date', '=', $date)
                        ->where('availability', '>', 0)
                        ->where('b2b_rate_ep', '>', 0);
                },
            ])
            ->where('status', 'active')
            ->where('papular', 1)
            ->paginate(10);

        return $popularHotel;
    }

    public function popularHotel()
    {
        $date = Carbon::now()->addDay(2)->format('Y-m-d');  // This is correct

        $popularHotel = Hotel::whereHas('room', function ($query) use ($date) {
            $query->where('status', 1);
        })->whereHas('room.plan', function ($query) use ($date) {
            $query->whereDate('pricing_date', '=', $date)
                ->where('b2b_rate_ep', '>', 0)
                ->where('availability', '>', 0);
        })
            ->with([
                'room',
                'room.plan' => function ($query) use ($date) {
                    $query->whereDate('pricing_date', '=', $date)
                        ->where('availability', '>', 0)
                        ->where('b2b_rate_ep', '>', 0);
                },
                'hotelImg' => function ($query) {
                    $query->where('imageable_type', 'App\Models\Hotel');
                }
            ])
            ->where('status', 'active')
            ->where('papular', 1)
            ->get();

        $otherHotel = [];
        if ($popularHotel->count() < 6) {
            $otherHotel = Hotel::whereHas('room', function ($query) use ($date) {
                $query->where('status', 1);
            })
                ->whereHas('room.plan', function ($filter) use ($date) {
                    $filter->whereDate('pricing_date', '=', $date)
                        ->where('b2b_rate_ep', '>', 0)
                        ->where('availability', '>', 0);
                })
                ->with([
                    'room',
                    'room.plan' => function ($query) use ($date) {
                        $query->whereDate('pricing_date', '=', $date)
                            ->where('availability', '>', 0)
                            ->where('b2b_rate_ep', '>', 0);
                    },
                    'hotelImg' => function ($query) {
                        $query->where('imageable_type', 'App\Models\Hotel');
                    }
                ])
                ->where('status', 'active')
                ->where('papular', 0)
                ->get();
        }
        $popularHotel = $popularHotel->merge($otherHotel);

        // dd($popularHotel);
        return $popularHotel;
    }


    public function averageRoomRate($totalAmountEp, $totalRatePlanCount)
    {
        $averageRatePrice = $totalAmountEp / $totalRatePlanCount;
        return  round($averageRatePrice, 2);
    }

    private function generateSearchData($hotel)
    {
        $master = new SearchLog();
        $collection = GeoLocation::lookup(request()->ip());
        $agent = new Agent();
        $master->request_ip = request()->ip();
        $master->user_id = auth()->user()->id ?? null;
        $master->city_id = $hotel->city;
        $master->checkin_date = Carbon::now()->addDay()->format('Y-m-d');
        $master->checkout_date = Carbon::now()->addDays(2)->format('Y-m-d');
        $master->roomCount = 1;
        $master->adultCount = 1;
        $master->childCount = 0;
        $master->status = 'Hotel';
        $master->device_type = $agent->deviceType();
        $master->country = $collection->get('country');
        $master->child_ages = [];

        // Save the record to the database
        $master->save();
        return $master->load(['city']);
    }

    public function hotelDetails($slug, $searchId = null)
    {
        $hotel = Hotel::where('slug', $slug)->firstOrFail();
        if (empty($searchId)) {
            $searchData = $this->generateSearchData($hotel);
        } else {
            $searchData = SearchLog::findOrFail($searchId);
        }
        $checkIn        = $searchData->checkin_date;
        $checkOut       = $searchData->checkout_date;
        $adultCount     = $searchData->adultCount;
        $childCount     = $searchData->childCount;
        $roomCount      = $searchData->roomCount;
        $cityId         = $searchData->city_id;
        $totalGuests    = $adultCount + $childCount;

        $nights = (int)max((strtotime($checkOut) - strtotime($checkIn)) / (60 * 60 * 24), 1);

        // Fetch hotel details with necessary relationships and conditions
        $hotelDetails = Hotel::whereHas('room', function ($query) use ($checkIn, $checkOut, $roomCount, $totalGuests) {
            // Ensure the room has valid rate plans
            $query->where('stay_guest', '>=', $totalGuests)->whereHas('ratePlan', function ($subQuery) use ($checkIn, $checkOut, $roomCount) {
                $subQuery->where('pricing_date', '>=', $checkIn)
                    ->where('pricing_date', '<', $checkOut);
                // ->where('availability', '>=', $roomCount);
            });
        })->with([
            'hotelReview' => function ($review) {
                $review->orderBy('id', 'desc')->limit(5);
            },
            'room' => function ($query)  use ($totalGuests) {

                $query->has('ratePlan')->where('stay_guest', '>=', $totalGuests);;
            },
            'room' => function ($query) use ($checkIn, $checkOut, $roomCount, $totalGuests) {
                $query->where('stay_guest', '>=', $totalGuests)->whereHas('ratePlan', function ($subQuery) use ($checkIn, $checkOut, $roomCount) {
                    $subQuery->where('pricing_date', '>=', $checkIn)
                        ->where('pricing_date', '<', $checkOut);
                    // ->where('availability', '>=', $roomCount);
                });
            },
            'room.ratePlan' => function ($query) use ($checkIn, $checkOut, $roomCount) {
                $query->where('pricing_date', '>=', $checkIn)
                    ->where('pricing_date', '<', $checkOut);
                // ->where('availability', '>=', $roomCount);
            },
            'hotelImages',
            'amenities.amenityName',
            'cityName',
            'room.roomType',
        ])->where('slug', $slug)->first();

        if (empty($hotelDetails)) {
            return [
                'status'        => false,
                'searchData'    => $searchData
            ];
        }

        $similarHotelDetails = $this->similarHotel($slug, $cityId, $searchData);

        $nights = (strtotime($checkOut) - strtotime($checkIn)) / (60 * 60 * 24);
        $totalRatePlanCount = count($hotelDetails->room->ratePlan);
        $totalAmountEp = 0;

        if ($totalRatePlanCount > 0) {
            foreach ($hotelDetails->room->ratePlan as $planAmount) {
                $epAmount  = $planAmount->total_amount_ep;
                $totalAmountEp = $totalAmountEp + $epAmount;
            }
        }
        $averageRoomRate = $this->averageRoomRate($totalAmountEp, $totalRatePlanCount);
        // Calculate the total and average room rates
        $totalAmountEp = $hotelDetails->room->ratePlan->sum('total_amount_ep');
        $totalRatePlans = $hotelDetails->room->ratePlan->count();
        $averageRoomRate = $totalRatePlans > 0 ? $totalAmountEp / $totalRatePlans : 0;

        //start add this extraBedPrice add new code
        if($hotelDetails->room->ratePlan->count() > 0){
            $personExtraBedPriceEp = personExtraBedPriceEp($hotelDetails->room->ratePlan);
            $averageRoomRate = $averageRoomRate+$personExtraBedPriceEp['ep_average_extra_person_price'];
        }
       //end add this extraBedPrice add new code

        $totalPrice = $averageRoomRate * $roomCount;

        return [
            'status'                => true,
            'similarHotelDetails'   => $similarHotelDetails,
            'details'               => $hotelDetails,
            'total_price'           => $totalPrice,
            'per_night_price'       => $averageRoomRate,
            'totalRoom'             => $roomCount,
            'totalGuests'           => $totalGuests,
            'nights'                => $nights,
            'searchData'            => $searchData,
            'availability'         => lowestAvailableRoom($hotelDetails->room->ratePlan)

        ];
    }

    public function similarHotel($slug, $cityId, $searchData)
    {
        $checkIn = $searchData->checkin_date ?? Carbon::now()->addDay()->format('Y-m-d');
        $checkOut = $searchData->checkout_date ?? Carbon::now()->addDays(2)->format('Y-m-d');
        $roomCount = $searchData->roomCount ?? 1;
        $totalGuests = ($searchData->adultCount ?? 1) + ($searchData->childCount ?? 0);

        $similarHotel = Hotel::whereHas('room', function ($query) use ($totalGuests) {
            $query->where('status', 1)->where('stay_guest', '>=', $totalGuests);
        })->whereHas('room.plan', function ($filter) use ($checkIn, $checkOut, $roomCount) {
            $filter->where('pricing_date', '>=', $checkIn)
                ->where('pricing_date', '<', $checkOut)
                ->where('availability', '>=', $roomCount)
                ->where('b2b_rate_ep', '>', 0);
        })->with([
            'room.plan' => function ($filter) use ($checkIn, $checkOut, $roomCount) {

                $filter->where('pricing_date', '>=', $checkIn)->where('pricing_date', '<', $checkOut)->where('availability', '>=', $roomCount)->where('b2b_rate_ep', '>', 0);
            },
            'cityName',
            'hotelImg' => function ($query) {
                $query->where('imageable_type', 'App\Models\Hotel');
            }
        ])->where('status', 'active')->where('slug', '!=', $slug)
            ->where('city', $cityId)->limit(10)->get();

        return $similarHotel;
    }


    public function getAllAvailableRoomsWithHotels($slug, $searchId = null)
    {
        $searchData = SearchLog::find($searchId);
        $adultCount =  $searchData?->adultCount;
        $childCount =  $searchData?->childCount;
        $roomCount  =  $searchData?->roomCount;
        $checkIn    = $searchData?->checkin_date;
        $checkOut   = $searchData?->checkout_date;

        $totalGest =   $adultCount + $childCount;

        $nights = (strtotime($checkOut) - strtotime($checkIn)) / (60 * 60 * 24);
        $hotels = Hotel::with(['getRoom.roomImages' => function ($img) {
            $img->where('imageable_type', 'App\Models\Room');
        }, 'getRoom' => function ($query) use ($totalGest, $roomCount, $checkIn, $checkOut) {

            $query->whereHas('ratePlan', function ($query) use ($checkIn, $checkOut, $roomCount) {
                $query->where('pricing_date', '>=', $checkIn)->where('pricing_date', '<', $checkOut);
                // ->where('availability', '>=', $roomCount);
            });
            $query->with(['ratePlan' => function ($query) use ($checkIn, $checkOut, $roomCount) {
                $query->where('pricing_date', '>=', $checkIn)->where('pricing_date', '<', $checkOut);
                // ->where('availability', '>=', $roomCount);

            }])->where('status', 1)->where('stay_guest', '>=', $totalGest);
        }, 'getRoom.ratePlan', 'getRoom.roomType', 'getRoom.roomImages', 'getRoom.addAmenity.amenityName'])->where('slug', $slug)->first();
        $availableRooms = [];

        foreach ($hotels->getRoom as $rooms) {

            $totalRatePlanCount = count($rooms->ratePlan);

            if ($totalRatePlanCount > 0) {
                $totalAmountEp = 0;
                $totalAmountCp  = 0;
                $totalAmountMap = 0;

                foreach ($rooms->ratePlan as $planAmount) {

                    if (isset($planAmount->total_amount_ep)) {
                        $epAmount = $planAmount->total_amount_ep ?? 0;
                        $totalAmountEp += $epAmount;
                    }

                    if (isset($planAmount->total_amount_cp)) {
                        $cpAmount = $planAmount->total_amount_cp ?? 0;
                        $totalAmountCp += $cpAmount;
                    }

                    if (isset($planAmount->total_amount_map)) {
                        $mapAmount = $planAmount->total_amount_map ?? 0;
                        $totalAmountMap += $mapAmount;
                    }
                }

                $totalPriceEp = $this->averageRoomRate($totalAmountEp, $totalRatePlanCount);
                $totalPriceCp = $this->averageRoomRate($totalAmountCp, $totalRatePlanCount);
                $totalPriceMap = $this->averageRoomRate($totalAmountMap, $totalRatePlanCount);

                // //start code  Extra person bedPrice 
                
                if ($rooms->ratePlan && $rooms->ratePlan->count() > 0) {
                    $ratePlan = $rooms->ratePlan;

                    // EP: Room Only
                    $personExtraBedPriceEp = personExtraBedPriceEp($ratePlan);
                    $totalPriceEp  = $totalPriceEp  + $personExtraBedPriceEp['ep_average_extra_person_price'] ?? 0;

                    // CP: With Breakfast
                    $personExtraBedPriceCp = personExtraBedPriceCp($ratePlan);
                    $totalPriceCp  = $totalPriceCp  + $personExtraBedPriceCp['cp_average_extra_person_price'] ?? 0;

                    // MAP: With Breakfast + Dinner
                    $personExtraBedPriceMap = personExtraBedPriceMap($ratePlan);
                    $totalPriceMap  = $totalPriceMap  + $personExtraBedPriceMap['map_average_extra_person_price'] ?? 0;
                }
                //end code  Extra person bedPrice 
            }

            $availableRooms[] = [
                'total_price' => $totalPriceEp,
                'per_night_price' => $totalPriceEp,
                'rooms' => $rooms,
                'nights'        => (int)($nights == 0 ? 1 : $nights),
                'total_price_with_break_fast' => $totalPriceCp,
                'total_price_with_break_fast_and_dinner' => $totalPriceMap,
                'roomId' => $hotels->getRoom['0']?->room_type,
                'availableRoom' =>  lowestAvailableRoom($rooms->ratePlan)
            ];
        }
        return $availableRooms;
    }

    function getNextThousand($number)
    {
        return ceil($number / 1000) * 1000;
    }

    public function getAllAmenityBedType($searchResult)
    {
        $bed = $searchResult->pluck('hotel.room.getBed')->flatten(1);

        $bedType = $bed->groupBy('bed_type_id')->map(function ($group) {
            $firstBed = $group->first();
            return [
                'bed_type_id' => $firstBed->bed_type_id ?? 1,
                'total_bed_type' => $group->count() ?? 1,
                'bedTypeName' => [
                    'bed_type' => $firstBed->bedTypeName->bed_type ?? '',
                ]
            ];
        })->values();

        $amenities = $searchResult->pluck('hotel.amenities')->flatten(1);

        $hotelAmenity = $amenities->groupBy('amenity_id')->map(function ($group) {
            $firstAmenity = $group->first();
            return [
                'amenity_id' => $firstAmenity->amenity_id ?? 1,
                'total_amenity' => $group->count() ?? 1,
                'amenityName' => [
                    'name' => $firstAmenity->amenityName->name ?? '',
                ],
            ];
        })->values();

        $hotelRating = $searchResult->filter(function ($item) {
            $rating = $item['hotel']['rating'] ?? '0';
            return $rating !== '0' && $rating !== '0.0' && $rating !== null;
        })
            ->groupBy(function ($item) {
                return $item['hotel']['rating'];
            })
            ->map(function ($group, $rating) {
                return [
                    'rating' => $rating,
                    'total' => $group->count()
                ];
            })
            ->values()
            ->keyBy('rating')
            ->toArray();
        $defaultRatings = ['3.0', '4.0', '5.0'];
        // foreach ($defaultRatings as $defaultRating) {
        //     if (!isset($hotelRating[$defaultRating])) {
        //         $hotelRating[$defaultRating] = [
        //             'rating' => $defaultRating,
        //             'total' => 0
        //         ];
        //     }
        // }
        $hotelRating = array_values($hotelRating);

        $maxPrice = collect($searchResult)->pluck('per_night_price')->max() ?? 0;
        $maximum_value = $this->getNextThousand($maxPrice);

        // $ranges = [];
        // $step = ceil($maximum_value / 5);  // Divide into 5 equal steps

        // for ($i = 0; $i < $maximum_value; $i += $step) {
        //     $start = $i;
        //     $end = $i + $step;
        //     if ($end > $maximum_value) {
        //         $end = $maximum_value;
        //     }
        //     $ranges[] = [
        //         'start' => $start,
        //         'end' => $end,
        //     ];
        // }
        $ranges = [
            ['start' => 0, 'end' => 5000],
            ['start' => 5001, 'end' => 10000],
            ['start' => 10001, 'end' => 20000],
            ['start' => 20000, 'end' => 100000000000],
        ];
        $priceRangeCount = [];
        foreach ($ranges as $key => $value) {
            $count = 0;
            foreach ($searchResult as $price) {
                if ($value['start'] <= $price['per_night_price'] && $value['end'] >= $price['per_night_price']) {
                    $count++;
                }
            }
            $priceRangeCount[] = [
                'start' => $value['start'],
                'end' => $value['end'],
                'count' => $count
            ];
        }

        return [
            'hotelAmenity' => $hotelAmenity,
            'bedType' => $bedType,
            'hotelRating' => $hotelRating,
            'priceRangeCount' => $priceRangeCount,
        ];
    }

    public function addDetails($hotelId, $roomId, $roomTypeId, $searchId)
    {
        $hotel = Room::select('id', 'hotel_id')
            ->with(['hotel:id,city'])
            ->where('id', decode($roomId))
            ->first();

        if (empty($searchId)) {
            $searchData = $this->generateSearchData($hotel);
        } else {
            $searchData = SearchLog::find(decode($searchId));
        }

        $traveler = [
            'adult'         => $searchData->adultCount ?? 0,
            'child'         => $searchData->childCount ?? 0,
            'checkIn'       => $searchData->checkin_date ?? now(),
            'checkOut'      => $searchData->checkout_date ?? now()->addDay(),
            'totalRooms'    => $searchData->roomCount ?? 1,
        ];

        $room_data = Room::with(['hotel.hotelReview' => function ($review) {
            $review->orderBy('id', 'desc')->limit(5);
        }, 'ratePlan' => function ($query) use ($traveler) {
            $query->where('pricing_date', '>=', $traveler['checkIn'])->where('pricing_date', '<', $traveler['checkOut']);
        }, 'roomType', 'hotel', 'addAmenity.amenityName'])->where('id', decode($roomId))->first();

        $nights = (strtotime($traveler['checkOut']) - strtotime($traveler['checkIn'])) / (60 * 60 * 24);
        $totalRatePlanCount = count($room_data->ratePlan);
        if ($totalRatePlanCount > 0) {
            $totalAmountEp = 0;

            foreach ($room_data->ratePlan as $planAmount) {
                $epAmount  = $planAmount->total_amount_ep;
                $totalAmountEp = $totalAmountEp + $epAmount;
            }
            $epAmount = $this->averageRoomRate($totalAmountEp, $totalRatePlanCount);
        }

        $total_record[] = [
            'roomId'     =>  $room_data->id,
            'quantity'   => $traveler['totalRooms'],
            'roomType'   => 'Single Room',
            'roomTypeId' => decode($roomTypeId),
            'category'   => 'Room Only',
        ];

        $traveler_details = [];
        $details = [];

        $traveler_details = [
            'traveler'     => $traveler,
            'nights'       => ($nights == 0 ? 1 : $nights),
            'total_record' => $total_record,
            'total_room'   => $traveler['totalRooms'],
            'hotelId'      => decode($hotelId)
        ];
        $details[] = [
            'room_data'   => $room_data,
            'category'    => 'Room Only',
            'quantity'    => $traveler['totalRooms'],
        ];

        $details = [
            'room_details' => $details,
            'traveler_details'  => $traveler_details,
            'searchData'        => $searchData,
            'hotelReview'       => $room_data->hotel
        ];
        return $details;
    }

    public function addDetailsApi($request)
    {
        $hotel = Room::select('id', 'hotel_id')
            ->with(['hotel:id,city'])
            ->where('id', $request->roomId)
            ->first();

        if (empty($searchId)) {
            $searchData = $this->generateSearchData($hotel);
        } else {
            $searchData = SearchLog::find($searchId);
        }

        $traveler = [
            'adult'         => $searchData->adultCount ?? 0,
            'child'         => $searchData->childCount ?? 0,
            'checkIn'       => $searchData->checkin_date ?? now(),
            'checkOut'      => $searchData->checkout_date ?? now()->addDay(),
            'totalRooms'    => $searchData->roomCount ?? 1,
        ];

        $room_data = Room::with(['ratePlan' => function ($query) use ($traveler) {
            $query->where('pricing_date', '>=', $traveler['checkIn'])->where('pricing_date', '<', $traveler['checkOut']);
        }, 'roomType', 'hotel', 'addAmenity.amenityName'])->where('id', $request->roomId)->first();

        $nights = (strtotime($traveler['checkOut']) - strtotime($traveler['checkIn'])) / (60 * 60 * 24);
        $totalRatePlanCount = count($room_data->ratePlan);
        if ($totalRatePlanCount > 0) {
            $totalAmountEp = 0;
            foreach ($room_data->ratePlan as $planAmount) {
                $epAmount  = $planAmount->total_amount_ep;
                $totalAmountEp = $totalAmountEp + $epAmount;
            }
            $epAmount = $this->averageRoomRate($totalAmountEp, $totalRatePlanCount);
        }

        $total_record[] = [
            'roomId'     => $room_data->id,
            'quantity'   => $traveler['totalRooms'],
            'roomType'   => 'Single Room',
            'roomTypeId' => $request->roomTypeId,
            'category'   => 'Room Only',
        ];

        $traveler_details = [];
        $details = [];

        $traveler_details = [
            'traveler' => $traveler,
            'nights'    => ($nights == 0 ? 1 : $nights),
            'total_record' => $total_record,
            'total_room'  => $traveler['totalRooms'],
            'hotelId' => $request->hotelId
        ];
        $details[] = [
            'room_data'  => $room_data,
            'category'      => 'Room Only',
            'quantity'      => $traveler['totalRooms'],
        ];

        $details = [
            'room_details' => $details,
            'traveler_details' => $traveler_details,
            'searchData'        => $searchData
        ];

        return $details;
    }


    public function addDetailsMultiple($request)
    {

        if (empty($request->all()) || collect($request->quantity)->sum() <= 0) {
            return 'data not found';
        }
        // Prepare total records array
        $totalRecords = collect($request->roomId)->map(function ($roomId, $key) use ($request) {
            return [
                'quantity'    => $request->quantity[$key],
                'roomId'      => $roomId,
                'roomType'    => $request->roomType[$key],
                'roomTypeId'  => $request->roomTypeId[$key],
                'category'    => $request->category[$key],
            ];
        });

        $hotel = Room::select('id', 'hotel_id')
            ->with(['hotel:id,city'])
            ->whereIn('id', $request->roomId)
            ->first();

        $searchId   = decode($request->search_id);
        if (empty($searchId)) {
            $searchData = $this->generateSearchData($hotel);
        } else {
            $searchData = SearchLog::find($searchId);
        }

        $traveler = [
            'adult'         => $searchData->adultCount ?? 0,
            'child'         => $searchData->childCount ?? 0,
            'checkIn'       => $searchData->checkin_date ?? now(),
            'checkOut'      => $searchData->checkout_date ?? now()->addDay(),
            'totalRooms'    => $searchData->roomCount ?? 1,
        ];

        // Calculate nights
        $nights = max((strtotime($traveler['checkOut']) - strtotime($traveler['checkIn'])) / (60 * 60 * 24), 1);

        $roomDetails = [];
        // Fetch room details with one query
        foreach ($totalRecords as $record) {
            $details = Room::with([
                'hotel',
                'hotel.hotelReview' => function ($review) {
                    $review->orderBy('id', 'desc')->limit(5);
                },
                'ratePlan' => function ($query) use ($traveler) {
                    $query->where('pricing_date', '>=', $traveler['checkIn'])->where('pricing_date', '<', $traveler['checkOut']);
                },
                'roomType',
                'addAmenity.amenityName',
            ])
                ->where('id', $record['roomId'])->first();

            if ($details) {
                $details = [
                    'room_data' => $details,
                    'category'  => $record ? $record['category'] : null,
                    'quantity'  => $record ? $record['quantity'] : 0, // Default to 0 if not found
                ];
                $roomDetails[] = $details;
            }
        }

        // Prepare traveler details
        $travelerDetails = [
            'traveler'      => $traveler,
            'nights'        => $nights,
            'total_record'  => $totalRecords,
            'total_room'    => $totalRecords->sum('quantity'),
            'hotelId'       => $request->hotelId,
        ];
        return [
            'room_details'      => $roomDetails,
            'traveler_details'  => $travelerDetails,
            'searchData'        => $searchData,
            'hotelReview'       => empty($roomDetails['0']['room_data']->hotel) ? [] : $roomDetails['0']['room_data']->hotel
        ];
    }


    public function searchRoom($request)
    {

        $searchId = decode($request->search_id);
        // $searchData = SearchLog::findOrFail($searchId);
        $data = SearchLog::findOrFail($searchId);

        $searchData = new SearchLog();
        $searchData->adultCount     = $request?->adultCount ?? 1;
        $searchData->childCount     = $request?->childCount ?? 0;
        $searchData->roomCount      = $request?->roomCount ?? 1;
        $searchData->checkin_date   = $request?->checkin_date;
        $searchData->checkout_date  = $request?->checkout_date;
        $searchData->child_ages     = $request?->childAge ?? [];
        $searchData->request_ip = $request->ip();
        $searchData->request_ip = $data->request_ip;
        $searchData->user_id =   $data->user_id;
        $searchData->city_id = $data->city_id;
        $searchData->save();

        $nights = (strtotime($searchData->checkout_date) - strtotime($searchData->checkin_date)) / (60 * 60 * 24);

        $hotels = Hotel::with(['getRoom.roomImages' => function ($img) {
            $img->where('imageable_type', 'App\Models\Room');
        }, 'getRoom' => function ($query) use ($searchData) {

            $query->whereHas('ratePlan', function ($query) use ($searchData) {
                $query->where('pricing_date', '>=', $searchData->checkin_date)->where('pricing_date', '<', $searchData->checkout_date)->where('availability', '>=', $searchData->roomCount);
            });
            $query->with(['ratePlan' => function ($query) use ($searchData) {
                $query->where('pricing_date', '>=', $searchData->checkin_date)->where('pricing_date', '<', $searchData->checkout_date)->where('availability', '>=', $searchData->roomCount);
            }])->where('status', 1)->where('stay_guest', '>=', ($searchData->adultCount + $searchData->childCount));
        }, 'getRoom.ratePlan', 'getRoom.roomType', 'getRoom.roomImages', 'getRoom.addAmenity.amenityName'])->where('id', $request->hotel_id)->first();
        $availableRooms = [];
        foreach ($hotels->getRoom as $rooms) {
            $totalRatePlanCount = count($rooms->ratePlan);
            if ($totalRatePlanCount > 0) {
                $totalAmountEp = 0;
                $totalAmountCp  = 0;
                $totalAmountMap = 0;
                foreach ($rooms->ratePlan as $planAmount) {
                    if (isset($planAmount->total_amount_ep)) {
                        $epAmount = $planAmount->total_amount_ep ?? 0;
                        $totalAmountEp += $epAmount;
                    }
                    if (isset($planAmount->total_amount_cp)) {
                        $cpAmount = $planAmount->total_amount_cp ?? 0;
                        $totalAmountCp += $cpAmount;
                    }
                    if (isset($planAmount->total_amount_map)) {
                        $mapAmount = $planAmount->total_amount_map ?? 0;
                        $totalAmountMap += $mapAmount;
                    }
                }
                $totalPriceEp = $this->averageRoomRate($totalAmountEp, $totalRatePlanCount);
                $totalPriceCp = $this->averageRoomRate($totalAmountCp, $totalRatePlanCount);
                $totalPriceMap = $this->averageRoomRate($totalAmountMap, $totalRatePlanCount);

                 //start code  Extra person bedPrice 
                if ($rooms->ratePlan && $rooms->ratePlan->count() > 0) {
                    $ratePlan = $rooms->ratePlan;

                    // EP: Room Only
                    $personExtraBedPriceEp = personExtraBedPriceEp($ratePlan);
                    $totalPriceEp  = $totalPriceEp  + $personExtraBedPriceEp['ep_average_extra_person_price'] ?? 0;

                    // CP: With Breakfast
                    $personExtraBedPriceCp = personExtraBedPriceCp($ratePlan);
                    $totalPriceCp  = $totalPriceCp  + $personExtraBedPriceCp['cp_average_extra_person_price'] ?? 0;

                    // MAP: With Breakfast + Dinner
                    $personExtraBedPriceMap = personExtraBedPriceMap($ratePlan);
                    $totalPriceMap  = $totalPriceMap  + $personExtraBedPriceMap['map_average_extra_person_price'] ?? 0;
                }
                //end code  Extra person bedPrice 
            }

            $availableRooms[] = [
                'per_night_price' => $totalPriceEp,
                'total_price' => $totalPriceEp,
                'total_price_with_break_fast' => $totalPriceCp,
                'nights'        => ($nights == 0 ? 1 : $nights),
                'total_price_with_break_fast_and_dinner' => $totalPriceMap,
                'rooms' => $rooms,
                'roomId' => $hotels->getRoom['0']?->room_type,
                // 'availableRoom'=>$rooms->ratePlan['0']->availability??1,
                'availableRoom' =>  lowestAvailableRoom($rooms->ratePlan),
                'search_id'      => $searchData->id,

            ];
        }
        return $availableRooms;
    }

    public function hotelListForConsultNow($request)
    {
        $hotel = Hotel::where('city', $request->city)->where('rating', $request->rating)->get();
        return $hotel;
    }
}
