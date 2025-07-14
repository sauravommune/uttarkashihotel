<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class ChangeHotelRepository extends BaseRepository
{
    public function __construct(private FrontRepository $frontRepository) {}

    public function availableRooms(array $searchParam,$all = false)  {
        $availableRooms =  Room::whereHas('ratePlan', function ($query) use ($searchParam) {
                $query->where('pricing_date', '>=',$searchParam['check_in'])->where('pricing_date','<',$searchParam['check_out'])
                 ->where('availability', '>=',$searchParam['roomCount']);

            })
            ->with(['ratePlan' => function ($query) use ($searchParam) {
                $query->where('pricing_date', '>=',$searchParam['check_in'])->where('pricing_date','<',$searchParam['check_out'])
                ->where('availability', '>=',$searchParam['roomCount']);
                
            }])
            
            ->where('stay_guest', '>=', $searchParam['total_guest'])
            ->where('status', 1)
            ->where('hotel_id', $searchParam['hotel_id']);
            if( $all){
                return $availableRooms->get();

            }else{
                return $availableRooms->first();
            }
            // ->get();
    }

    public function LeadHotelSearch($searchParam,$request)
    {

        $city = City::where('id', $searchParam['city'])->first();

        if (!$city) {
         
            return []; // Return empty if city doesn't exist
        }

        $totalGuests = $searchParam['adult'] +  $searchParam['child'];
        $searchParam['total_guest'] = $totalGuests;

    // apply filter

        $hotels = Hotel::where('city', $searchParam['city'])->where('status', 'active')->whereNotIn('id', [$searchParam['currentHotel']]);
        if(!empty($request->hotel_name)){
            $hotels =  $hotels->where('name', 'LIKE', '%' . $request->hotel_name . '%');
 
        }
        elseif(!empty($request->hotel_rating)){
            $hotels->whereIn('rating', $request->hotel_rating);
        } 
        elseif(!empty($request->google_rating)){
            $range = explode('-', $request->google_rating);
            $googleRating = [trim($range[0]), trim($range[1])];            
            $hotels->whereIn('google_rating',$googleRating ); 
        } 
        $hotels = $hotels->get();

        $filteredHotels = [];
        foreach ($hotels as $hotel) {
            $searchParam['hotel_id'] = $hotel?->id;
            $availableRooms = $this->availableRooms($searchParam);
            if ($availableRooms) {
                $nights = stayNights($searchParam['check_in'], $searchParam['check_out']);
                // Calculate total price
                $totalAmountEp = $availableRooms->ratePlan->sum('total_amount_ep');
                $averageRoomRate = $this->frontRepository->averageRoomRate($totalAmountEp, count($availableRooms->ratePlan));

                $totalPrice = $nights > 0 ? $averageRoomRate * $nights : $averageRoomRate;

                $filteredHotels[] = [
                    'hotel' => $hotel,
                    'available_rooms' => $availableRooms,
                    'total_price' => $totalPrice,
                    'per_night_price' => $averageRoomRate,
                    'city_name' => $city->name,
                    'availableRoom' =>  lowestAvailableRoom( $availableRooms->ratePlan)

                ];
            }
        }
        return $filteredHotels;
    }

    public function HotelRooms(Request $request)
    {

        // dd($request->all());
        // dd($$request->bookingId);

        $bookings = Booking::where('booking_id',$request->bookingId)->first();

        $bookedRooms = $bookings?->bookedRooms;
        $searchParams= [
            'city' => $bookings?->hotel?->city,
            'adult' => $bookings?->adult,
            'child' => $bookings?->child,
            'check_in' => $bookings?->check_in_date,
            'check_out' => $bookings?->check_out_date,
            'roomCount' => $bookings?->total_room,
            'currentHotel' => $bookings?->hotel_id,
            'total_guest' => $bookings?->adult + $bookings?->child,
            'hotel_id' => $request->selectedHotel
        ];

        $availableRooms = $this->availableRooms($searchParams,true);
          
        $selectedHotel = Hotel::find($request->selectedHotel,['id','name']);

        return [
            'bookedRooms' => $bookedRooms,
            'availableRooms' => $availableRooms,
            'bookings' => $bookings,
            'selectedHotel' => $selectedHotel
        ];
    }
}
