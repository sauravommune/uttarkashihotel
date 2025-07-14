<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class ProfileRepository extends BaseRepository
{

    public function manageBooking()
    {
        $booking_data = Booking::with([
            'hotel.amenities.amenityName',
            'hotel.city',
            'hotel.hotelImages' => function($query) {
                $query->orderBy('id', 'desc')->limit(1);
            }
        ])->where('user_id', Auth::user()?->id??'')->orderBy('id', 'desc')->get();
        $manage_booking = [];
        foreach($booking_data as $booking){
            $nights = (strtotime($booking->check_out_date) - strtotime($booking->check_in_date)) / (60 * 60 * 24);
            $manage_booking[] =[
                'nights'=> $nights==0?1:$nights ,
                'details'=> $booking,
                'totalRoom' => $booking->bookedRooms->pluck('quantity')->sum(),
            ]; 
        }
        return $manage_booking;
    }
    
}