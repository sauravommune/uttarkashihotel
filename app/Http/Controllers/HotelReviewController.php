<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\HotelReviewRepository;
use Exception;
use App\Models\HotelReview;
use App\Models\Hotel;

class HotelReviewController extends Controller
{

    public function index($hotelId)
    {
        $hotelId = decode($hotelId);
        $hotel = Hotel::find($hotelId);
        $title = $hotel?->name . ' Google Review Lists';
        $hotelReview = HotelReview::where('hotel_id', $hotelId)
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return view('hotelmaster.hotelReview.index', compact('title', 'hotel', 'hotelReview'));
    }

    public function create($hotelId = null, $hotelReviewId = null)
    {
        $hotelId = decode($hotelId);
        $data = '';
        if ($hotelReviewId) {
            $data = HotelReview::find(decode($hotelReviewId));
        }
        $html =  view('hotelmaster.hotelReview.add', compact('hotelId', 'data'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function store(Request $request, HotelReviewRepository $hotelReviewRepository)
    {

        $request->validate([
            'author_name' => 'required|string',
            'review' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5',
            'review_date' => 'required|date',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024', // Max 1MB
        ]);

        try {
            $save = $hotelReviewRepository->save($request);
            if ($save) {
                return response()->json(['status' => 200, 'message' => 'Review Saved Successfully', 'redirect' => url()->previous()], 200);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteHotelReview($id)
    {
        try {
            $hotelReview  = HotelReview::find(decode($id));
            if ($hotelReview) {
                $hotelReview->delete();
                return response()->json(['status' => 200, 'message' => 'Data delete Successfully'], 200);
            } else {
                return response()->json(['status' => 200, 'message' => 'Data not found'], 200);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }
}
