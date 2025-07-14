<?php

namespace App\Repositories;

use App\Models\SavedHotel;
use Illuminate\Support\Facades\Auth;

class SavedHotelRepository extends BaseRepository
{

    public function savedHotel($request)
    {
        if (Auth::id()) {
            $this->savedHotelInTable($request);
        }
    }

    public function savedHotelInTable($request)
    {
        SavedHotel::updateOrCreate([
            'hotel_id' => (int)$request->hotelId,
            'user_id' => Auth::id(),
        ], [
            'status' => (int) $request->status,
        ]);
    }

    public function getSavedHotel()
    {
        $savedHotel = SavedHotel::with(['hotel.cityName.state', 'hotel.amenities.amenityName' => function ($amenity) {
            $amenity->limit(4);
        }, 'hotel.hotelImages' => function ($img) {
            $img->where('imageable_type', 'App\Models\Hotel')->limit(10);
        }])->where('user_id', Auth::id())->where('status', 1)
            ->orderBy('id', 'desc')
            ->get();
        return $savedHotel;
    }
}
