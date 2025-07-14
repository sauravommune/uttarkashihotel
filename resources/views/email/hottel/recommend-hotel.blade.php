<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to UttarkashiHotel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Account Confirmation</title>
    <style>
        body {
           font-family: Helvetica, Arial, sans-serif !important;
        }
        .email-container {
           font-family: Helvetica, Arial, sans-serif !important;
        }
    </style>
    
</head>
<body style="font-family: Helvetica, Arial, sans-serif; margin: 20px 0px; padding: 10px 10px; border: 0; background-color:#F3F2F1;">
    
    <div class="email-container" style="font-family: Helvetica, Arial, sans-serif;  width: 100%; max-width:600px; margin: 0px auto; padding: 0px 0px; border: 1px solid #EEEEEE; background:#fff;">
    
        <div class="box" style="font-family: Helvetica, Arial, sans-serif;  border: 1px solid #EEEEEE; background:#fff; margin:5px; padding:20px 20px; border-radius:5px; box-shadow: rgba(99, 99, 99, 0.1) 0px 2px 4px 0px; border: 1px solid #EEEEEE; backgroud:#fff!important;">
            
            <div class="header">
                <img style="font-family: Helvetica, Arial, sans-serif;  max-width: 200px;" src="{{ !empty($message) ? $message->embed(asset('assets/front/images/black-logo.png')) : asset('assets/front/images/black-logo.png') }}" alt="UttarkashiHotel Logo">
            </div>
            <div class="content">
                <p style="color:#05264E;font-family: Helvetica, Arial, sans-serif; font-size:14px; font-weight:500; margin-top:20px;">Discover the best stays at best rates</p>
                <p style="font-family: Helvetica, Arial, sans-serif;  color:#3B4C65; font-size:14px; font-weight:600;">Hi {{$hotelData['user_name']??''}},</p>
                <p style="font-size:24px; color:#05264E; line-height:1.4;"><b style="font-weight:700; color:#FF541E; padding-right:10px;">Hotel Recommendation</b><b style="font-weight:700;">for Your Booking</b></p>
                <p  style="font-size:14px; line-height:1.4; color:#3B4C65; font-weight:400; margin-top: :10px; font-family: Helvetica, Arial, sans-serif;">Thank you for choosing UttarkashiHotel.in for your stay! We have curated alternate hotel options that we believe better suits your preferences.</p>
                <p style="color:#05264E; font-size:16px; font-weight:600; border-top:1px solid #EEEEEE; padding-top:20px; font-family: Helvetica, Arial, sans-serif;">Recommended Hotel: </p>
               
                @if(count($hotelData['hotel_data'])>0)
                @foreach ($hotelData['hotel_data'] as $item)
                    
                <div style="max-width: 600px; border:1px solid #E0E0EB; margin: 0 auto; margin-bottom:10px; font-family: Arial, sans-serif;  border-radius: 15px; padding: 10px;">
                    <!-- Container -->
                    <div style="width: 100%;">
                        <!-- Left Box -->
                        <div style="display: inline-block; width: 100%;">

                            @if (!empty($item->recommendHotel?->hotelImg?->image))
                                <img src="{{ asset('storage/' . $item->recommendHotel?->hotelImg?->image) }}"  style="width: 100%; min-height: 240px; max-height: 240px; max-width: 100%; border-radius: 8px; display: block" alt="Placeholder">
                            @else
                                {{-- <img src="{{ asset('assets/media/no-hotel-img.svg') }}" alt=""  style="width: 100%; min-height: 240px; max-height: 240px; max-width: 220px; border-radius: 8px; display: block;" alt="Placeholder"> --}}
                                <img src="https://hottel.in/storage/uploads/hotelImages/VjEcVgeJMh9nemS.jpg" style="width: 100%; min-height: 240px; max-height: 240px; max-width: 100%; border-radius: 8px; display: block;" alt="Placeholder"/>
                            @endif
                        </div>
                        <!-- Right Box -->
                        <div style="display: inline-block; ; width: 100%; vertical-align: top; text-align: left; box-sizing: border-box; padding: 25px 0px;">
                            <div style="font-size: 14px; font-family: Arial, sans-serif;  display: inline-flex; line-height: 20px; color: #333;">
                                <div style="border-radius: 5px;font-family: Arial, sans-serif;  background:#249760; font-weight:500; padding:5px 10px; font-size:14px; color:#fff; margin-right:8px;">P</div>
                                <div style="border-radius: 5px;font-family: Arial, sans-serif;  background:#FF1E1E; font-weight:600; padding:5px 10px; font-size:14px; color:#fff; margin-right:8px;">20% OFF</div>
                                <div>
                                    <ul style="padding:0px; margin: 0px; margin-top:5px;display:flex; gap:4px;list-style: none">
                                        <li style="list-style: none; display: inline;margin:0; padding-left:2px;">
                                            <img src="https://hottel.in/assets/front/images/yellow-star.png" style="height:20px; width:20px;">
                                        </li>
                                        <li style="list-style: none; display: inline;margin:0; padding-left:2px;">
                                            <img src="https://hottel.in/assets/front/images/yellow-star.png" style="height:20px; width:20px;">
                                        </li>
                                        <li style="list-style: none; display: inline;margin:0; padding-left:2px;">
                                            <img src="https://hottel.in/assets/front/images/yellow-star.png" style="height:20px; width:20px;">
                                        </li>
                                        <li style="list-style: none; display: inline;margin:0; padding-left:2px;">
                                            <img src="https://hottel.in/assets/front/images/yellow-star.png" style="height:20px; width:20px;">
                                        </li>
                                        <li style="list-style: none; display: inline;margin:0; padding-left:2px;">
                                            <img src="https://hottel.in/assets/front/images/yellow-star.png" style="height:20px; width:20px;">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div style="margin-top:15px;">
                                <h2 style="font-size:16px; font-weight:600; color:#1A1F24;">{{ucwords($item?->recommendHotel?->name ??"")}}</h2>
                                <p style="color:#3E4C56; font-size:14px;font-family: Arial, sans-serif; padding-bottom:0px; margin-bottom:0px;">{{ucwords($item->recommendHotel?->cityDetails?->state->name??"")}}, 
                                    {{ucwords($item->recommendHotel?->cityDetails?->name??"")}}
                                </p>
                            </div>
                            <div style="font-size: 14px; font-family: Arial, sans-serif;  display: inline-flex; line-height: 20px; color: #333; margin-top: 20px;">
                                <ul style="padding:0px; margin: 0px; margin-top:5px;display:flex; gap:4px;list-style: none">
                                @if($item?->recommendHotel?->amenities->count() > 0)
                                    @foreach($item->recommendHotel->amenities as $amenity)
                                        <li style="margin-left:0px;">
                                            <div style="display: flex; align-items: center; padding-left:15px;">
                                                <div>
                                                    <img src="https://hottel.in/assets/front/images/circle.png" style="height:5px; width:5px; padding-right:5px; margin-top:-5px;">
                                                </div>
                                                <div>
                                                    {{ $amenity->amenityName?->name??"" }}
                                                </div>
                                            </div>
                                            {{-- <img src="https://Uttarkashihotels.in/assets/front/images/yellow-star.png" style="height:20px; width:20px; padding-right:5px"> <span style="color: #3E4C56; font-size:14px; font-weight:400;">{{ $amenity->amenityName?->name??"" }}</span> --}}
                                        </li>
                                    @endforeach
                                @endif
                                </ul>
                            
                            </div>
                            

                            @if($item->recommendHotel?->cityDetails?->google_rating>0)

                             <div style="font-size: 14px; font-family: Arial, sans-serif;  display: inline-flex; line-height: 20px; color: #333; margin-top: 5px;">
                                <div style="padding-right:10px; padding-top: 5px;">
                                    <img src="https://hottel.in/assets/front/images/google-image.png" />
                                </div>
                                <div style="padding-right:10px;">
                                    <div style="color: #1A1F24; font-weight:600; padding-top:5px">Google Reviews</div>
                                    <div style="display: flex; align-items: center; color: #3E4C56; font-weight: 700; font-size: 14px;">
                                        <div style="margin-right: 8px;">{{$item->recommendHotel?->cityDetails?->google_rating}}</div>
                                        <ul style="display: flex; padding: 0; margin: 0; margin-top:0px; list-style: none;">
                                            <li style="margin-left: 0px; padding-left:0; margin-left:0px;">
                                                <img src="https://hottel.in/assets/front/images/yellow-star.png" style="height:20px; width:20px;">
                                            </li>
                                            <li style="margin-left: 0px; padding-left:0; margin-left:0px;">
                                                <img src="https://hottel.in/assets/front/images/yellow-star.png" style="height:20px; width:20px;">
                                            </li>
                                            <li style="margin-left: 0px; padding-left:0; margin-left:0px;">
                                                <img src="https://hottel.in/assets/front/images/yellow-star.png" style="height:20px; width:20px;">
                                            </li>
                                            <li style="margin-left: 0px; padding-left:0; margin-left:0px;">
                                                <img src="https://hottel.in/assets/front/images/yellow-star.png" style="height:20px; width:20px;">
                                            </li>
                                            <li style="margin-left: 0px; padding-left:0; margin-left:0px;">
                                                <img src="https://hottel.in/assets/front/images/yellow-star.png" style="height:20px; width:20px;">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                <ul style="font-family: Helvetica, Arial, sans-serif;  margin:0px; padding:0px 0px 10px 0px;">
                    <li style="font-family: Helvetica, Arial, sans-serif;  margin:0px; line-height: 1.5em; padding:0px 0px 15px 0px;color:#78828D; font-size:14px; font-weight:400; list-style:none; margin-top:25px;">If you’re happy with this recommendation and confirm with our agent. We’ll update your booking seamlessly, and you’ll receive a confirmation email shortly.</li>
                    <li style="font-family: Helvetica, Arial, sans-serif;  margin:0px; padding:0px 0px 15px 0px; font-weight:600; color:#78828D; font-size:14px; font-weight:400; list-style:none; margin-top:15px;">Looking forward to making your stay comfortable and memorable!</li>
                    <li style="font-family: Helvetica, Arial, sans-serif;  margin:0px; padding:0px 0px 15px 0px; color:#1A1F24; font-size:14px; font-weight:700; list-style:none;">Thank you for choosing <a href="https://barkothotels.com/" target="_blank" style="color: #FF541E; text-decoration:none;">UttarkashiHotel.in</a> for your stay!</li>
                </ul>

                <div style="margin-top:20px; margin-bottom:15px;">                
                    <p style="font-family: Helvetica, Arial, sans-serif;  color:#78828D; font-size:14px; font-weight:400; padding:0px 0px 0px 0px; margin:0px 0px 5px 0px; line-height:1.5em;">Warm Regards,</p>
                    <p style="font-family: Helvetica, Arial, sans-serif;  color:#78828D; font-size:14px; font-weight:400; padding:0px 0px 0px 0px; margin:0px 0px 5px 0px; line-height:1.5em;">UttarkashiHotel Team</p>
                </div>
                <div style="border-top:1px solid #EEEEEE;">
                    <p  style="font-family: Helvetica, Arial, sans-serif;  margin:15px 0px 0px 0px; color:#78828D; font-size:14px; line-height:1.7em;">This is an automatically generated email; please do not reply directly. For assistance, contact our support team using the details above.</p>
                </div>
            </div>
        </div>
        <div>
            <div style="font-family: Helvetica, Arial, sans-serif;  text-align:center; color:#666; font-size: 12px; margin-top: 10px; padding-top:10px; padding-bottom:20px;">
                <div>
                     <a href="{{ route('terms-and-conditions') }}" style="font-family: Helvetica, Arial, sans-serif;  color:#3B4C65; margin: 0 5px;  display: inline-block;font-size:14px; font-weight:600; text-decoration:underline;">Terms and Conditions</a>&nbsp; &nbsp;
                     <a href="{{ route('terms-and-conditions') }}" style="font-family: Helvetica, Arial, sans-serif;  color:#3B4C65; font-size:14px; font-weight:600; text-decoration:underline;">Privacy Policy</a>
                    <div class="contact-info" style="font-family: Helvetica, Arial, sans-serif;  margin-top: 10px; font-size: 12px;">
                        <p style="font-family: Helvetica, Arial, sans-serif;  color:#3B4C65; font-size:14px; text-align-center;">Copyright © {{date('Y')}} | UttarkashiHotel | All Rights Reserved</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
