<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UttarkashiHotel - Your Booking Status is Pending!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    <div class="email-container" style="font-family: Helvetica, Arial, sans-serif; width: 100%; max-width:600px; margin: 0px auto; padding: 0px 0px; border: 1px solid #EEEEEE; background:#fff;">

        <div class="box" style="font-family: Helvetica, Arial, sans-serif; border: 1px solid #EEEEEE; margin:5px; padding:20px 20px; border-radius:5px; box-shadow: rgba(99, 99, 99, 0.1) 0px 2px 4px 0px; border: 1px solid #EEEEEE; background:#fff!important;">
            
            <div class="header">
                <a href="{{ url('/') }}">
                    <img style="font-family: Helvetica, Arial, sans-serif; max-width: 200px;" src="{{ !empty($message) ? $message->embed(asset('assets/front/images/black-logo.png')) : asset('assets/front/images/black-logo.svg') }}" alt="Hottel Logo">
                </a>
            </div>

            <div class="content">

                <p style="font-family: Helvetica, Arial, sans-serif; color:#3B4C65; font-size:14px; font-weight:600;">Hi {{ $admin?->name }},</p>

                <p style="color:#05264E;font-family: Helvetica, Arial, sans-serif; font-size:14px; font-weight:500; margin-top:20px;">
                    New Booking Alert! Please find the details below:
                </p>

                <p style="color:#05264E;font-family: Helvetica, Arial, sans-serif; font-size:14px; font-weight:500; margin-top:20px;">
                    <b style="padding-right:5px;">Booking Summary (Booking ID:  {{ $booking->booking_id }}):</b>
                </p>
                
                <table style="border-collapse: collapse; width: 100%; margin: 0 auto;">
                    <tr style="border-bottom: 1px dashed #E0E0EB;">
                        <th style="text-align: left; padding: 8px 12px 12px 0px; font-weight: 600; color:#8597A7; font-size:12px; text-transform: uppercase;">
                            Hotal Name
                        </th>
                        <td style="text-align: right; padding: 8px 12px; font-size: 14px; font-weight: 600; color: #1A1F24;">
                            <a href="{{  route('hotel.details', $booking?->hotel?->slug??'') }}">{{ $booking?->hotel?->name }}</a>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px dashed #E0E0EB;">
                        <th style="text-align: left; padding: 8px 12px 12px 0px; font-weight: 600; color:#8597A7; font-size:12px; text-transform: uppercase;">
                            Contact Name
                        </th>
                        <td style="text-align: right; padding: 8px 12px; font-size: 14px; font-weight: 600; color: #1A1F24;">
                            {{ $booking?->bookingContact?->name }}
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px dashed #E0E0EB;">
                        <th style="text-align: left; padding: 8px 12px 12px 0px; font-weight: 600; color:#8597A7; font-size:12px; text-transform: uppercase;">
                            Booking Date
                        </th>
                        <td style="text-align: right; padding: 8px 12px; font-size: 14px; font-weight: 600; color: #1A1F24;">
                            {{ formatDateMdYHiA($booking?->created_at) }}
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px dashed #E0E0EB;">
                        <th style="text-align: left; padding: 8px 12px 12px 0px; font-weight: 600; color:#8597A7; font-size:12px; text-transform: uppercase;">Check In</th>
                        <td style="text-align: right; padding: 8px 12px; font-size: 14px; font-weight: 600; color: #1A1F24;">
                            {{ formatDateMdY($booking?->check_in_date) }} {{ $booking->hotel?->check_in_time }}
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px dashed #E0E0EB;">
                        <th style="text-align: left; padding: 8px 12px 12px 0px; font-weight: 600; color:#8597A7; font-size:12px; text-transform: uppercase;">Check out</th>
                        <td style="text-align: right; padding: 8px 12px; font-size: 14px; font-weight: 600; color: #1A1F24;">
                            {{ formatDateMdY($booking?->check_out_date) }} {{ $booking->hotel?->check_out_time }}
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px dashed #E0E0EB;">
                        <th style="text-align: left; padding: 8px 12px 12px 0px; font-weight: 600; color:#8597A7; font-size:12px; text-transform: uppercase;">Length of Stay</th>
                        <td style="text-align: right; padding: 8px 12px; font-size: 14px; font-weight: 600; color: #1A1F24;">{{ stayNights($booking?->check_in_date, $booking?->check_out_date) }} Nights</td>
                    </tr>
                    <tr style="border-bottom: 1px dashed #E0E0EB;">
                        <th style="text-align: left; padding: 8px 12px 12px 0px; font-weight: 600; color:#8597A7; font-size:12px; text-transform: uppercase;">Guests</th>
                        <td style="text-align: right; padding: 8px 12px; font-size: 14px; font-weight: 600; color: #1A1F24;">{{ $booking?->total_guest }} Guests</td>
                    </tr>
                    <tr style="border-bottom: 1px dashed #E0E0EB;">
                        <th style="text-align: left; padding: 8px 12px 12px 0px; font-weight: 600; color:#8597A7; font-size:12px; text-transform: uppercase;">
                            Rooms <br/>
                            @if( $booking?->bookedRooms->count() > 0 )
                                @foreach($booking?->bookedRooms as $room)
                                    <small style="font-size:8px; font-weight: 500;">{{ $room?->quantity }} X {{ $room?->roomCategory->name }} ({{ $room?->plan_name }}) </small> <br/>
                                @endforeach
                            @endif
                        </th>
                        <td style="text-align: right; padding: 8px 12px; font-size: 14px; font-weight: 600; color: #1A1F24;">{{ $booking?->total_room }} Rooms</td>
                    </tr>
                </table>

                <p style="color:#05264E;font-family: Helvetica, Arial, sans-serif; font-size:14px; font-weight:500; margin-top:20px;" align="justify">
                    <b style="padding-right:5px;">Thank you for your contribution!</b>
                </p>
                
                <p style="color:#05264E;font-family: Helvetica, Arial, sans-serif; font-size:14px; font-weight:500; margin-top:20px;">
                    <b style="padding-right:5px;">Disclaimer:</b>
                </p>

                <ul style="font-family: Helvetica, Arial, sans-serif; margin:0px; padding:0px 0px 10px 20px;">
                    <li style="font-family: Helvetica, Arial, sans-serif; margin:0px; padding:0px 0px 8px 0px;color:#78828D; font-size:14px; font-weight:400; line-height: 1.5; list-style:disc;" align="justify">
                        This is an automatically generated email. Please do not reply directly to this email. Need help? Contact us at <a style="color: #FF541E;" href="mailto:{{ config('contact-info.email') }}" title="{{ config('contact-info.email') }}">{{ config('contact-info.email') }}</a>
                    </li>
                </ul>
                
                <div style="margin-top:20px; margin-bottom:15px;">                
                    <p style="font-family: Helvetica, Arial, sans-serif; color:#78828D; font-size:14px; font-weight:400; padding:0px 0px 0px 0px; margin:0px 0px 5px 0px; line-height:1.5em;">Warm Regards,</p>
                    <p style="font-family: Helvetica, Arial, sans-serif; color:#78828D; font-size:14px; font-weight:400; padding:0px 0px 0px 0px; margin:0px 0px 5px 0px; line-height:1.5em;">UttarkashiHotel Team</p>
                </div>
            </div>
        
            <div style="font-family: Helvetica, Arial, sans-serif; text-align:center; color:#666; font-size: 12px; margin-top: 10px; padding-top:10px; padding-bottom:20px;">
                <div>
                    <a href="https://uttarkashihotel.in/terms-and-conditions" style="font-family: Helvetica, Arial, sans-serif; color:#3B4C65; margin: 0 5px; display: inline-block;font-size:14px; font-weight:600; text-decoration:underline;">Terms and Conditions</a>&nbsp; &nbsp;<a href="https://uttarkashihotel.in/privacy-policy" style="font-family: Helvetica, Arial, sans-serif; color:#3B4C65; font-size:14px; font-weight:600; text-decoration:underline;">Privacy Policy</a>
                    <div class="contact-info" style="font-family: Helvetica, Arial, sans-serif;  margin-top: 10px; font-size: 12px;">
                        <p style="font-family: Helvetica, Arial, sans-serif; color:#3B4C65; font-size:14px; text-align-center;">Copyright © {{date('Y')}} | UttarkashiHotel | All Rights Reserved</p>
                    </div>
                    
                </div>
            </div>
        </div>

        @if( !empty($preview) && $preview == 'true' )
            <button type="button" style="background-color: #FF541E; color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;margin: 10px 0px;float: right;" id="sendButton">Send Mail</button>

            <div id="successAlert" class="alert alert-success" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; padding: 15px; background-color: #5cb85c; color: white; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">

            </div>
            <div id="errorAlert" class="alert alert-danger" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; padding: 15px; background-color: rgb(190 37 37); color: white; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('sendButton').addEventListener('click', function() {
                        var button = document.getElementById('sendButton');
                        button.innerText = 'Sending...';
                        button.disabled = true;

                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '{{ route("email.send") }}', true);
                        xhr.setRequestHeader('Content-Type', 'application/json');

                        var params = JSON.stringify({ booking_id: '{{$booking->booking_id}}', email_type: '{{$emailType}}', '_token': '{{ csrf_token() }}' });
                        xhr.onload = function() {
                            if (xhr.status >= 200 && xhr.status < 300) {
                                var response = JSON.parse(xhr.responseText);
                                if (response.status === 200) {
                                    console.log(response.message);
                                    document.getElementById('successAlert').innerText = response.message;
                                    document.getElementById('successAlert').style.display = 'block';
                                    button.innerText = 'Send';
                                } else {
                                    button.disabled = false;
                                    button.innerText = 'Send Again';
                                    console.error('Error: ' + response.message);
                                    document.getElementById('errorAlert').innerText = response.message;
                                    document.getElementById('errorAlert').style.display = 'block';
                                }
                            } else {
                                button.disabled = false;
                                button.innerText = 'Send Again';
                                alert('Failed to send. Please try again.');
                                console.error('Request failed with status ' + xhr.status);
                            }
                        };
                        xhr.send(params); 
                    });
                });
            </script>
        @endif
    </div>
</body>
</html>
