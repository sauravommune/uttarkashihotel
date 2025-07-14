<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UttarkashiHotel - Your Booking is Cancelled!</title>
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
                <img style="font-family: Helvetica, Arial, sans-serif; max-width: 200px;" src="{{ !empty($message) ? $message->embed(asset('assets/front/images/black-logo.png')) : asset('assets/front/images/black-logo.png') }}" alt="UttarkashiHotel Logo">
            </div>
            <div class="content">
                <p style="color:#05264E;font-family: Helvetica, Arial, sans-serif; font-size:14px; font-weight:500; margin-top:20px;">Discover the best stays at best rates</p>
                <p style="font-family: Helvetica, Arial, sans-serif; color:#3B4C65; font-size:14px; font-weight:600;">Hi {{ $booking?->bookingContact?->name }},</p>

                <p style="font-size:24px; color:#05264E; line-height:1.4;">
                    <b style="font-weight:700;">Your Booking is <span style="color: #FF541E;">Cancelled By Vendor Due to Unavailability</span> —</b>
                </p>
                <p style="font-size:14px; line-height: 1.5; color:#3B4C65; font-weight:400; margin-top:10px; font-family: Helvetica, Arial, sans-serif; line-height:1.4;" align="justify">We're sorry to see you go! Your booking at <b>{{ $booking?->hotel?->name }} (Booking ID:  {{ $booking->booking_id }})</b>, for the dates <b>{{ formatDateMdY($booking?->check_in_date) }} {{ $booking->hotel?->check_in_time }}</b> to <b>{{ formatDateMdY($booking?->check_out_date) }} {{ $booking->hotel?->check_out_time }}</b> has been cancelled By Vendor Due to Unavailability.</p>
                <p style="font-size:14px; line-height: 1.5; color:#3B4C65; font-weight:400; margin-top:10px; font-family: Helvetica, Arial, sans-serif; line-height:1.4;" align="justify">If you have any questions regarding this cancellation or the refund process, please don’t hesitate to reach out to us at <a href="mailto:{{ config('contact-info.email') }}" style="color:#FF541E;">{{ config('contact-info.email') }}</a>.</p>

                <div style="border-top:1px solid #EEEEEE;">
                    <div style="margin-top:20px; margin-bottom:15px;">
                        <p style="font-family: Helvetica, Arial, sans-serif; color:#78828D; font-size:14px; font-weight:400; padding:0px 0px 0px 0px; margin:0px 0px 5px 0px; line-height:1.5em;">Warm Regards,</p>
                        <p style="font-family: Helvetica, Arial, sans-serif; color:#78828D; font-size:14px; font-weight:400; padding:0px 0px 0px 0px; margin:0px 0px 5px 0px; line-height:1.5em;">UttarkashiHotel Team</p>
                    </div>
                    <div style="border-top:1px solid #EEEEEE;">
                        <p style="font-family: Helvetica, Arial, sans-serif; margin:15px 0px 0px 0px; color:#78828D; font-size:14px;" align="justify">This is an automatically generated email; For assistance, contact our support team using the details above.</p>
                    </div>
                </div>
            </div>

            <div style="font-family: Helvetica, Arial, sans-serif; text-align:center; color:#666; font-size: 12px; margin-top: 10px; padding-top:10px; padding-bottom:20px;">
                <div>
                    <a href="https://uttarkashihotel.in/terms-and-conditions" style="font-family: Helvetica, Arial, sans-serif; color:#3B4C65; margin: 0 5px;  display: inline-block;font-size:14px; font-weight:600; text-decoration:underline;">Terms and Conditions</a>&nbsp; &nbsp;<a href="https://uttarkashihotel.in/privacy-policy" style="font-family: Helvetica, Arial, sans-serif; color:#3B4C65; font-size:14px; font-weight:600; text-decoration:underline;">Privacy Policy</a>
                    <div class="contact-info" style="font-family: Helvetica, Arial, sans-serif; margin-top: 10px; font-size: 12px;">
                        <p style="font-family: Helvetica, Arial, sans-serif; color:#3B4C65; font-size:14px; text-align-center;">
                            Copyright © {{date('Y')}} | UttarkashiHotel | All Rights Reserved
                        </p>
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
