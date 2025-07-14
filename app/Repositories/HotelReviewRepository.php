<?php

namespace App\Repositories;
use App\Models\HotelReview;
use App\Traits\FileUpload;

class HotelReviewRepository extends BaseRepository
{

    public function save($request)
    {
        $imagePath = null;
        if($request->hasFile('author_image')){
            $imagePath = FileUpload::fileUpload('author_image', 'uploads/reviewImages');    
        }
        $hotelReview = !empty($request->hotelReviewId)?HotelReview::find($request->hotelReviewId):new HotelReview();
        $hotelReview->hotel_id = $request['id'];
        $hotelReview->author_name = $request['author_name'];
        $hotelReview->text = $request['review'];
        $hotelReview->rating = $request['rating'];
        $hotelReview->date = $request['review_date'];
        $hotelReview->is_show = 1;
        $hotelReview->review_profile_photo = $imagePath==null?$hotelReview->review_profile_photo:$imagePath; 
        return $hotelReview->save();
    }
    
}
