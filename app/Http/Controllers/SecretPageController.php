<?php

namespace App\Http\Controllers;

use App\DataTables\ExternalHotelDataTable;
use App\Models\ExternalHotelRoomType;
use App\Models\HotelData;
use App\Models\HotelImage;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SecretPageController extends Controller
{
    //
    use FileUpload;
    public function index(Request $request)
    {
        // session()->forget('page_unlocked');
        if (! session()->has('page_unlocked')) {
            return redirect()->route('secret.page.unlock')->withErrors(['error' => 'Please unlock the page first.']);
        }
        $amenities = amenitiesData();
        $defaultSelected = ['24_hour_front_desk','towels','clothes_rack','wake_up_service'];
        $roomTypes =extRoomTypes();
       
            $id = decodeSecureHash(request('id'));
            $hotel = request('id') ? HotelData::find($id) : null;
            $hotelAmenities = $$hotel->amenities ?? [];
            array_push($hotelAmenities, ...$defaultSelected);
            $externalHotelRoomTypes = $hotel->roomTypes ?? [];
            if (session()->has('page_unlocked')) {
                return view('data-file', compact('amenities','hotel','roomTypes','hotelAmenities','externalHotelRoomTypes'));
            }


    }



    public function store(Request $request)
    {
        $data = $request->except('_token', 'image');

        DB::beginTransaction();

        $request->validate([
            'hotel' => 'required',
            'city' => 'required',
            'rating' => 'required',
            // 'description' => 'required',
            'amenities' => 'required|array',
            'amenities.*' => 'string',
            'rooms' => 'required|array',
            'rooms.*.room_type' => 'required|string',
            'rooms.*.retail_price' => 'required|numeric',
            'rooms.*.b2b_price' => 'required|numeric',
            'rooms.*.room_size' => 'nullable|integer',
        ],[
            'rooms.*.room_type.required' => 'Room type is required.',
            'rooms.*.retail_price.required' => 'Retail price is required.',
            'rooms.*.b2b_price.required' => 'B2B price is required.',
            'rooms.*.room_size.required' => 'Room size is required.',
        ]);
        try {
            // dd($request->all());
            
            $hotel = HotelData::updateOrCreate(['id' => $request->id], $data);
            $rooms =$request->rooms;
            foreach ($rooms as &$room) {
                $room['hotel_id'] = $hotel->id;
            }
            
            if ($request->id) {
                $hotel->roomTypes()->delete();
            }
            ExternalHotelRoomType::insert($rooms);


            if (!$hotel?->id) {
                DB::rollBack();
                return back()->withErrors(['error' => 'Unable to save hotel data.']);
            }


            $filePaths = FileUpload::fileUpload('image');

            if (!empty($filePaths)) {
                $images = [];

                foreach ($filePaths as $file) {
                    $images[] = [
                        'hotel_data_id' => $hotel->id,
                        'image' => $file,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                if ($request->id)
                    $hotel->images()->delete();

                HotelImage::insert($images);
            }

            DB::commit();
            return back()->with(['message' => 'Hotel saved successfully.']);
        } catch (Exception $e) {
          
            DB::rollBack();
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function hotels(ExternalHotelDataTable $dataTable)
    {
        if (! session()->has('page_unlocked')) {
            return redirect()->route('secret.page.unlock')->withErrors(['error' => 'Please unlock the page first.']);
        }
        
        $title = 'External Hotels';
        return $dataTable->render('secret-data-list', compact('title'));
    }
    public function delete($id)
    {
        if (! session()->has('page_unlocked')) {
            return redirect()->route('secret.page.unlock')->withErrors(['error' => 'Please unlock the page first.']);
        }
        $id = decodeSecureHash($id);
        DB::beginTransaction();

        try {
            $hotel = HotelData::with('images')->findOrFail($id);

          
            foreach ($hotel->images as $image) {
                if (Storage::disk('public')->exists($image->image)) {
                    Storage::disk('public')->delete($image->image);
                }
            }

            
            $hotel->images()->delete();
            $hotel->delete();
            DB::commit();
            return response()->json(['status' =>200, 'message' => 'Hotel Deleted Successfully'],200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' =>500, 'message' => 'Hotel Deleted Successfully'],500);
        }
    }
    public function unlock() {
        return view('unlock');
    }
    public function unlockPage(Request $request) {
        $request->validate([
            'password' => 'required',
        ]);
    
        $correctPassword = 'Haint@2025'; 
    
        if ($request->password === $correctPassword) {
            session(['page_unlocked' => true]);
            return redirect()->route('secret.page');
        }
    
        return back()->withErrors(['password' => 'Incorrect password.']);
    }


    // public function dataList(Request $request){
    //     return view('secret-data-list');
        
    // }
}
