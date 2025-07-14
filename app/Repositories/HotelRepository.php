<?php
namespace App\Repositories;

use App\Http\Requests\HotelRequest;
use App\Models\AddAmenity;
use App\Models\Amenity;
use App\Models\City;
use App\Models\Hotel;
use App\Models\HotelBankDetails;
use App\Models\HotelBraekfast;
use App\Models\HotelSEO;
use App\Models\NearByPlaceDistance;
use App\Models\User;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Images;


class HotelRepository extends BaseRepository{

  public $hotel_id =null;
    public function __construct(private ? Hotel $hotel)
    {
        $this->hotel_id = request('id') ? request('id') : session('hotel_id');
        $this->hotel = $this->hotel_id ? Hotel::find($this->hotel_id) : new Hotel();
    }

    public function saveHotel(HotelRequest $request)
    {
        if ($request->step == 1) {
            $this->handleStepOne($request);
        } elseif ($request->step == 2) {
            $this->handleStepTwo($request);
        } elseif ($request->step == 3) {
            $this->handleStepThree($request);
        } elseif ($request->step == 4) {
            $this->handleStepFour($request);
        } elseif ($request->step == 5) {
            $this->handleStepFive($request);
        } elseif ($request->step == 6) {
            $this->handleStepSix($request);
        } elseif ($request->step == 7) {
            $this->handleStepSeven($request);
        } elseif ($request->step == 8) {
            $this->handleStepEight($request);
        }
        $this->hotel->save();
    }

    // Step Handlers
    protected function handleStepOne($request)
    {
        $google_rating = $google_rating_total = null;
        if (!empty($request->google_place_id)) {
            $url = 'https://maps.googleapis.com/maps/api/place/details/json';
            $response = Http::get($url, [
                'place_id' => $request->google_place_id,
                'fields' => 'rating,user_ratings_total',
                'key' => env('GOOGLE_PLACES_API_KEY'),
            ]);
            if ($response->successful()) {
                $google_rating = $response->json('result.rating');
                $google_rating_total = $response->json('result.user_ratings_total');               
            } else {
                $google_rating = null;
                Log::error('Error fetching place details', ['response' => $response->body()]);
            }
        }

        $prefix = "https://www.youtube.com/embed/";

        session()->forget(['hotel_id']);
        $this->hotel->fill([
            'name'              => $request->name,
            'slug'              => Str::slug($request->name),
            'city'              => $request->city,
            'google_place_id'   => $request->google_place_id,
            'google_place_text' => $request->google_place_text,
            'google_rating'     => $google_rating, 
            'google_rating_total'   => $google_rating_total,
            'rating'            => $request->rating2,
            'phone'             => $request->phone,
            'email'             => $request->email,
            'address'           => $request->address,
            'country'           => $request->country ?? 'India',
            'zip_code'          => $request->zip_code,
            'description'       => $request->description,
            'status'            => $this->hotel->status ?? 'draft',
            'map_url'           => $request->map_url,
            'embed_map_url'     => $request->embed_map_url,
            'video_title'       => $request->video_permission == '1' ? $request->video_title : $this->hotel->video_title,
            'video_url'         => $request->video_permission == '1' ? $prefix.$request->video_id : $this->hotel->video_url,
        ]);

        $this->hotel->save();
     
        if ($request->distance) {
            foreach ($request->distance as $key => $distance) {
                if ($distance > 0) {
                    NearByPlaceDistance::updateOrCreate(
                        ['near_by_place' => $request->place[$key], 'hotel_id' => $this->hotel->id],
                        ['distance' => $distance]
                    );
                }else{
                    NearByPlaceDistance::where('near_by_place', $request->place[$key])->where('hotel_id', $this->hotel->id)->delete();
                }
            }
        }

        HotelSEO::updateOrCreate(
            ['hotel_id' => $this->hotel->id],
            [
                'meta_title'       => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords'    => $request->meta_keywords,
            ]
        );

        session(['hotel_id' => $this->hotel->id]);
    }

    protected function handleStepTwo($request)
    {
        if ($request->facility) {
            AddAmenity::where('hotel_id', $this->hotel->id)->delete();
            $facilityArr = array_map(fn($facility) => [
                'amenity_id' => $facility,
                'room_id'    => null,
                'hotel_id'   => $this->hotel->id,
            ], $request->facility);

            AddAmenity::insert($facilityArr);
        }
    }

    protected function handleStepThree($request)
    {
        $this->hotel->fill([
            'parking_available'     => $request->parking_available,
            'reservation_required'  => $request->reservation_required,
            'parking_location'      => $request->parking_location,
            'parking_type'          => $request->parking_type,
        ]);
    }

    protected function handleStepFour($request)
    {
        if ($request->breakfasts) {
            $hotelBreakfast = array_map(fn($breakfast) => [
                'breakfast_id' => $breakfast,
                'hotel_id'     => $this->hotel->id ?? session('hotel_id'),
            ], $request->breakfasts);

            HotelBraekfast::insert($hotelBreakfast);
        }

        $this->hotel->fill([
            'enter_amount'    => $request->enter_amount ?? 0,
            'breakfast_served'=> $request->breakfast_served,
        ]);
    }

    protected function handleStepFive($request)
    {
        $this->hotel->fill([
            'check_in_time'    => $request->check_in_time ?? 0,
            'check_out_time'   => $request->check_out_time ?? 0,
            'pets_allowed'     => $request->pets_allowed,
            'general_rules'    => $request->property_rules_general,
            'optinal_rules'    => $request->property_rules_optional,
        ]);
    }

    protected function handleStepSix($request)
    {
        $this->hotel->fill([
            'pan_no' => $request->pan_no ?? 0,
            'gst_no' => $request->gst_no ?? 0,
        ]);

        HotelBankDetails::updateOrCreate(
            ['hotel_id' => $this->hotel->id],
            [
                'bank_name'             => $request->bank_name,
                'ifsc'                  => $request->ifsc,
                'branch'                => $request->branch_name,
                'account_holder_name'   => $request->account_holder_name,
                'account_number'        => $request->account_number,
                'upi_id'                => $request->upi_id,
                'name_on_invoice'       => $request->name_on_invoice,
            ]
        );
    }

    protected function handleStepSeven($request)
    {


        // dd($request->search_page_img);
        // $images = FileUpload::fileUpload('hotel_images', 'uploads/hotelImages');

        if($request->imageId){
         $this->moveImage($this->hotel,$request);

       }

        if ($request->hotel_images) {

            $imageName = $request->imageName;
            $altTag = $request->altTag;
            $images = uploadMultipleImages($this->hotel,$request->hotel_images,'uploads/hotelImages/',$imageName);
            $this->saveHotelImages($this->hotel, $images,$altTag,$imageName);

        }


        if($request->search_page_img){

            $imageName = $request->searchImageName;
            $altTag = $request->searchAltTag;

           $hotelImages =  uploadImage($this->hotel,$request->search_page_img,'uploads/hotelImages/',$imageName);
           $this->SingleImg($this->hotel,$hotelImages,$altTag,$imageName);
      
        //    $hotelImages = FileUpload::fileUpload('search_page_img', 'uploads/hotelImages');
        //    $this->SingleImg($this->hotel,$hotelImages);

        }else{

            $hotel = hotel::find($this->hotel_id);
        
            if ($hotel) {
                $oldPath = 'public/' . $hotel->hotel_imgs;
                $extension = pathinfo($hotel->hotel_imgs, PATHINFO_EXTENSION);
                $slugBase = Str::slug($hotel->name . ' ' . $hotel->cityName->name . '' . $request->searchImageName ? $request->searchImageName : '');
                $finalImageName = $slugBase . '.' . $extension;
                $newPath = 'public/uploads/hotelImages/' . $finalImageName;

                if (Storage::exists($oldPath)) {
                    Storage::copy($oldPath, $newPath);
                    $hotel->hotel_imgs = 'uploads/hotelImages/' . $finalImageName;
                }
                $hotel->alt_tag = $request->searchImageName;
                $hotel->image_name = $request->searchAltTag;
                $hotel->save();
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
                $newPath = 'public/uploads/hotelImages/' . $finalImageName;
                // Rename in storage
                if (Storage::exists($oldPath)) {
                    Storage::copy($oldPath, $newPath);
                    $image->image = 'uploads/hotelImages/' . $finalImageName;
                }
                $image->alt_tag = $request->existingAltTag[$key];
                $image->image_name = $request->existingImageName[$key];
                $image->save();
            }
            }
        }

     public function SingleImg($hotel,$hotelImages,$altTag,$imageName){

        $hotel->hotel_img = $hotelImages;
        $hotel->alt_tag= $altTag??"";
        $hotel->image_name = $imageName??"";
        $hotel->save();

     }

    protected function handleStepEight($request)
    {
        $this->hotel->fill([
            'owner_name'       => $request->owner_name,
            'middle_name'      => $request->middle_name,
            'last_name'        => $request->last_name,
            'owner_contact_no' => $request->owner_contact_no,
            'owner_email'      => $request->owner_email,
            'term_first'      =>  $request->terms1,
            'term_second'      => $request->terms2,
            'status'           => $this->hotel->status=='active'?$this->hotel->status:'inactive'

        ]);
        $request->session()->forget(['hotel_id']);
    }


    public function getDetails($id){
        $details['amenities'] = Amenity::get();
        $details['hotel'] = $this->hotel->with(['rooms'])->find($id);
        return $details;

    }

    public function removeHotel()
    {
        foreach ($this->hotel->rooms ?? [] as $room) {
            $room->addAmenity?->each->delete();
            $room->images?->each->delete();
            $room->roomPrice?->each->delete();
            $room->getBed?->each->delete();
            $room->roomAvailability?->delete();
            $room->ratePlan?->each->delete();
            $room->delete();
        }

        $this->hotel->images?->each->delete();
        $this->hotel->amenities?->each->delete();
        $this->hotel->breakfast?->each->delete();
        $this->hotel->bankDetail?->delete();
        $this->hotel->nearByPlace?->each->delete();
        $this->hotel->hotelMeta?->delete();
        $this->hotel->hotelReview?->each->delete();
        $this->hotel->delete();
    }

    public function changePapular(){
        try{
            $this->hotel->papular = $this->hotel->papular == 0 ? 1 : 0;
            return $this->hotel->save();
        }catch(Exception $e){
            throw new Exception();
        }
    }

    public function changeSoldOut(){
        try{
            $this->hotel->sold_out = $this->hotel->sold_out == 0 ? 1 : 0;
            return $this->hotel->save();
        }catch(Exception $e){
            throw new Exception();
        }
    }

    public function changeRecommended(){
        try{
            $this->hotel->recommended = $this->hotel->recommended == 0 ? 1 : 0;
            return $this->hotel->save();
        }catch(Exception $e){
            throw new Exception();
        }
    }  public function changeStatus(){
        try{
            $this->hotel->status = $this->hotel->status == 'inactive' ? 'active' : 'inactive';
            return $this->hotel->save();
        }catch(Exception $e){
            throw new Exception();
        }
    }

    private function createHotelAdmin(HotelRequest $request){
        // dd(request('id'));
        $hotelAdmin = User::updateOrCreate([
            'hotel_id' => (int)(request('id') ?? session('hotel_id')),
        ],[
        'name' => $request->owner_name.' '.$request->middle_name.' '.$request->last_name,
        'phone' => $request->owner_contact_no ?? null,
        'email' => $request->owner_email ?? null,
        'password' => 'Hottel@123'
        ]);
        $hotelAdmin->assignRole('Hotel Admin');
    }

    public function hotelRooms(){
        return $this->hotel->rooms;
    }

    public function nearByPlace($city) {
       $city =  City::findOrNew($city);
       $nearByPlace = $city->nearPlaces;
       return $nearByPlace;
    }

    public function getAllCities(){
       return City::whereHas('getHotel')->OrderBy('name','asc')->get();
    }
}