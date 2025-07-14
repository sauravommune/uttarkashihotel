<?php

namespace App\Repositories;

use App\Models\{Amenity, Images, Room, RoomPrice, AddAmenity, Hotel, RoomCategory, BedType, AddBed};
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class RoomRepository extends BaseRepository
{
    use FileUpload;
    public $room_id = null;

    public function __construct(public ?Room $addRoom, private RoomPrice $roomPrice, private Images $images, private AddAmenity $addAmenity)
    {

        $this->room_id = request('id') ? request('id') : Session::get('room_id');
        $this->addRoom = $this->room_id ? Room::find($this->room_id) : new Room();
    }

    public function saveRoom(Request $request)
    {

        if ($request->step == 1) {

            $this->addRoom->hotel_id = $request->hotel;
            $this->addRoom->room_type = $request->room_type;
            $this->addRoom->total_room = $request->total_rooms;
            $this->addRoom->description = $request->room_desc;
            $this->addRoom->stay_guest = $request->gest_stay;
            $this->addRoom->room_size = $request->room_size;
            $this->addRoom->measure = $request->measure;
            $this->addRoom->smoking_allow = $request->smoking_option;
            // $this->addRoom->status  = 0;

            // if ($request->extra_bed_option == "no") {
            //     $extra_bed_adult_price = 0.00;
            //     $extra_bed_child_price = 0.00;
            // } else {
            //     $extra_bed_adult_price =  $request->adult_bed_price ?? 0.00;
            //     $extra_bed_child_price = $request->children_bed_price ?? 0.00;
            // }

            // $this->addRoom->extra_bed_adult_price = $extra_bed_adult_price;
            // $this->addRoom->extra_bed_child_price = $extra_bed_child_price;
            // $this->addRoom->extra_bed_option = $request->extra_bed_option ?? 'no';
            $this->addRoom->save();
            Session::put('room_id', $this->addRoom->id);
            if ($this->addRoom) {

                $bed = [];
                $bedType = [];
                foreach ($request->bed as $val) {
                    $bed[] = $val;
                }
                foreach ($request->bed_type as $val1) {
                    $bedType[] = $val1;
                }
                $combineBed = array_combine($bedType, $bed);

                AddBed::where('room_id',Session::get('room_id'))->delete();

                foreach ($combineBed as $type => $bed) {
                    $addBed =  new AddBed();
                    $addBed->room_id = Session::get('room_id')?? $request->room_id;
                    $addBed->bed_type_id = $type;
                    $addBed->total_bed = $bed;
                    $addBed->save();
                }
            }
        } 
        elseif ($request->step == 2) {
           
            AddAmenity::where('room_id', $this->room_id)->whereNull('hotel_id')->delete();
            if (!empty($request->general_amenities)) {
                foreach ($request->general_amenities as $value) {
                    $addAmenity = new AddAmenity();
                    $addAmenity->room_id =  Session::get('room_id') ?? $request->id;
                    $addAmenity->amenity_id = $value;
                    $addAmenity->save();
                }
            }
            if (!empty($request->outdoor_views)) {
                foreach ($request->outdoor_views as $value1) {
                    $addAmenity = new AddAmenity();
                    $addAmenity->room_id =   $this->room_id?? $request->id;
                    $addAmenity->amenity_id = $value1;
                    $addAmenity->save();
                }
            }
            if (!empty($request->food_and_drinks)) {
                foreach ($request->food_and_drinks as $value2) {
                    $addAmenity = new AddAmenity();
                    $addAmenity->room_id =  $this->room_id ?? $request->id;
                    $addAmenity->amenity_id = $value2;
                    $addAmenity->save();
                }
            }
            if (!empty($request->bathroom_facilities)) {
                foreach ($request->bathroom_facilities as $value3) {
                    $addAmenity = new AddAmenity();
                    $addAmenity->room_id =  $this->room_id ?? $request->id;
                    $addAmenity->amenity_id = $value3;
                    $addAmenity->save();
                }
            }
        } elseif ($request->step == 3) {

            $this->addRoom->cancel_booking = $request->guest_cancel;
            $this->addRoom->arrival_date = $request->measure_day;
            $this->addRoom->cancellation_period = $request->cancellation_period;
            $this->addRoom->save();
        } elseif ($request->step == 4) {


            if($request->imageId){
                $this->moveImage($this->addRoom->hotel,$request);
       
              }
            if (!empty($request->images)){

                // $images = FileUpload::fileUpload('images', 'uploads/roomImages');
                // $this->saveImages($this->addRoom, $images);
                $imageName = $request->imageName ?? [];
                $altTag = $request->altTag ?? [];
    
                $images = uploadMultipleImages($this->addRoom->hotel, $request->images, 'uploads/roomImages/', $imageName);
                $this->saveHotelImages($this->addRoom, $images, $altTag, $imageName);
    
                Room::where('id', Session::get('room_id'))->update(['step' => 'complete']);
                Session::forget('room_id');

            }
        }
    }


    public function moveImage($hotel,$request){

        foreach ($request->imageId as $key => $id) {
            $image = Images::find($id);
        
            if ($image) {
                $oldPath = 'public/' . $image->image;
                $extension = pathinfo($image->image, PATHINFO_EXTENSION);
                $slugBase = Str::slug($hotel->name . ' ' . $hotel->cityName->name . '' . (!empty($request->existingImageName[$key]) ? $request->existingImageName[$key] : ''));
                $finalImageName = $slugBase . '.' . $extension;
                $newPath = 'public/uploads/roomImages/' . $finalImageName;
                if (Storage::exists($oldPath)) {
                    Storage::copy($oldPath, $newPath);
                    $image->image = 'uploads/roomImages/' . $finalImageName;
                }
                $image->alt_tag = $request->existingAltTag[$key];
                $image->image_name = $request->existingImageName[$key];
                $image->save();
            }
            }
        }


    public function getAllAmenity()
    {
        return Amenity::all();
    }

    public function getHotel()
    {
        return Hotel::orderByDesc('id')->get();
    }

    public function getRooms()
    {
        return Hotel::orderByDesc('id')->get();
    }

    public function deleteImage($imageId)
    {
        $image = Images::find($imageId);
        if ($image) {
            $imgPath  = $image->image;
            $fullPath = storage_path("app/public/{$imgPath}");
            File::exists($fullPath) ? File::delete($fullPath) : false;
            $deleteImg = Images::where('id', $image->id)->delete();
            return $deleteImg;
        }
    }

    public function changeStatus()
    {
        try {
            $this->addRoom->status = !$this->addRoom->status;
            $this->addRoom->save();
            return 'Room Status Updated Successfully';
        } catch (Exception $e) {
            return $e->getMessage();
            throw new Exception();
        }
    }

    public function changeSoldout()
    {
        try {
            $this->addRoom->sold_out = !$this->addRoom->sold_out;
            $this->addRoom->save();
            return 'Room Sold Out Updated Successfully';
        } catch (Exception $e) {
            return $e->getMessage();
            throw new Exception();
        }
    }

    public function deleteBed($bed_id)
    {
        $bed = AddBed::find($bed_id);
        if ($bed) {
            $deleteBed = AddBed::where('id', $bed_id)->delete();
            return $deleteBed;
        }
    }

    public function getRoomType()
    {
        return RoomCategory::orderByDesc('id')->get();
    }

    public function getBedType()
    {
        return BedType::orderByDesc('id')->get();
    }
}
