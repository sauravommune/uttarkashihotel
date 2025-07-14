<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Repositories\RoomRepository;
use App\Models\Hotel;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct(private RoomRepository $roomRepository) {}

    public function index($hotelId)
    {
        $hotelId = decode($hotelId);
        $hotel = Hotel::find($hotelId);
        $title = $hotel?->name . ' Room Lists';
        $rooms = Room::with([
            'roomType',
            'ratePlan' => function ($query) {
                $query->where('pricing_date', date('Y-m-d'));
            },
            'roomAvailability' => function ($query) {
                $query->whereDate('available_from', '<=', date('Y-m-d'))
                    ->whereDate('available_to', '>=', date('Y-m-d'));
            }
        ])
            ->where('hotel_id', $hotelId)->get();
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return view('rooms.index', compact('title', 'hotel', 'rooms'));
    }

    public function create($hotelId, $roomId = null)
    {

        session()->forget(['room_id']);

        if ($roomId) {
            $room_id = decode($roomId);
            $roomDetails = Room::with(['hotel', 'addAmenity', 'images', 'getBed'])->find($room_id);
            $data['title'] = 'Edit Room';
        } else {
            $roomDetails = new Room();
            $data['title'] = 'Add Room';
        }
        addVendors(['datatable', 'tinyMCE', 'jquery-validate', 'dropify', 'room_validate']);
        $amenity = $this->roomRepository->getAllAmenity();
        $hotelId = decode($hotelId);
        $hotel = Hotel::find($hotelId);
        $room_category = $this->roomRepository->getRoomType();
        $bed_type = $this->roomRepository->getBedType();

        return view('rooms.add', [
            'data'          => $data,
            'amenity'       => $amenity,
            'roomDetails'   => $roomDetails,
            'hotel'         => $hotel,
            'room_category' => $room_category,
            'bed_type'      => $bed_type,
            'title'         => $data['title'],
        ]);
    }

    public function save(RoomRequest $request)
    {
        try {
            $this->roomRepository->saveRoom($request);
            return response()->json(['status' => 200, 'message' => 'Details Saved Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }



    public function deleteRoom($id)
    {
        try {
            Room::find(decode($id))->delete();
            return response()->json(['status' => 200, 'message' => 'Room delete successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateStatus()
    {
        try {
            $response = $this->roomRepository->changeStatus();
            return response()->json(['status' => 200, 'message' => $response], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }


    public function updatesoldout()
    {
        try {
            $response = $this->roomRepository->changeSoldout();
            return response()->json(['status' => 200, 'message' => $response], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteImage($imageId = null)
    {
        try {
            $this->roomRepository->deleteImage($imageId);
            return response()->json(['status' => 200, 'message' => 'Image Remove Successfully',], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteBed(Request $request)
    {
        $bed_id = $request->bedId;
        try {
            $this->roomRepository->deleteBed($bed_id);
            return response()->json(['status' => 200, 'message' => 'Bed Remove Successfully',], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function uniqueRoomType(Request $request)
    {

        $exists = Room::where('room_type', $request->room_type)->where('hotel_id', $request->hotel_id)->where('id', '<>', $request->id)->exists();
        if (!$exists)
            return "true";
        else
            return "false";
    }
}
