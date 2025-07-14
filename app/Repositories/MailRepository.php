<?php

namespace App\Repositories;

use App\Jobs\UserRegistered;
Use App\Models\RecommendHotel;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecommendHotelMail;
use App\Models\ContactInformation;

class MailRepository extends BaseRepository
{

    public function sendMailRecommendHotel($user_id,$bookingId){ 

        $hotelData = RecommendHotel::with([
            'recommendHotel.hotelImg' => function ($query) {
                $query->where('imageable_type', 'App\Models\Hotel');
            },
            'recommendHotel.amenities' => function ($query) {
                $query->limit(2); // Limit amenities to 3
            },
            'user'
        ])->where('user_id', $user_id)->where('status',1)->where('is_mail',0)->get();

        $contact_info = ContactInformation::where('booking_id',$bookingId)->first();

        if(count($hotelData)>0)  {
            $hotelData = [
                'hotel_data' =>$hotelData,
                'user_name'  =>$hotelData['0']->user->name,
                'user_email' => $contact_info->email,

            ];
            Mail::to($hotelData['user_email'])->send(new RecommendHotelMail($hotelData));
            RecommendHotel::where('user_id',$user_id)->where('status',1)->update([
            'is_mail'=> 1,

           ]);
         }else{
                RecommendHotel::where('user_id',$user_id)->where('status',0)->update([
                'is_mail'=> 0,
               ]);   
               
               return "no_mail";
             }
       }

        public function userCreateSendMail($user, $password){
            UserRegistered::dispatch($user, $password);
        }
}