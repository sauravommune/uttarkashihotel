<?php

namespace App\Repositories;

use App\Http\Requests\RoomAvailablityRequest;
use App\Models\RoomAvailability;

class RoomAvailabilityRepository extends BaseRepository
{
    public function __construct(private RoomAvailability $roomAvailability)
    {

        // $this->roomAvailability =  request('type') == 'add' ? $roomAvailability : $roomAvailability->find(decode(request('id')));
    }
    public function save(RoomAvailablityRequest $request)
    {
        $roomAvailability = $this->roomAvailability::where('room_id', decode($request->room))
            ->where(function ($query) use ($request) {
                $query->where('available_from', $request->available_from)
                    ->orWhere('available_to', $request->available_to);
            })->first();
        $roomAvailability = $roomAvailability ? $roomAvailability : new $this->roomAvailability();

        $roomAvailability->hotel_id = decode($request->hotel);
        $roomAvailability->room_id = decode($request->room);
        $roomAvailability->available_from = $request->available_from;
        $roomAvailability->available_to = $request->available_to;
        $roomAvailability->available_rooms = $request->available_room;
        $roomAvailability->save();
    }
}
