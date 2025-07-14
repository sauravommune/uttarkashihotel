<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to UttarkashiHotel.in – Your Journey Starts Here!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
    
        <div class="box" style="font-family: Helvetica, Arial, sans-serif;  border: 1px solid #EEEEEE; background:#fff; margin:5px; padding:20px 20px; border-radius:5px; box-shadow: rgba(99, 99, 99, 0.1) 0px 2px 4px 0px; border: 1px solid #EEEEEE; background:#fff!important;">
            
            <div class="header">
                <img style="font-family: Helvetica, Arial, sans-serif;  max-width: 200px;" src="{{ !empty($message) ? $message->embed(asset('assets/front/images/black-logo.png')) : asset('assets/front/images/black-logo.png') }}" alt="UttarkashiHotel Logo">
            </div>
            <div class="content">
                <p style="color:#05264E;font-family: Helvetica, Arial, sans-serif; font-size:14px; font-weight:500; margin-top:20px;">Discover the best stays at best rates</p>
                <p style="font-family: Helvetica, Arial, sans-serif;  color:#3B4C65; font-size:14px; font-weight:600;">Hi {{$user?->name??''}},</p>
                <p style="font-size:24px; color:#05264E; line-height:1.4;">Welcome to <b style="font-weight:700; color:#FF541E;">UttarkashiHotel.in</b></p>
                <p  style="font-size:14px; color:#05264E; font-weight:600; font-family: Helvetica, Arial, sans-serif;">Your Journey Starts Here!</p>
                <p  style="font-size:14px; line-height:1.4; color:#3B4C65; font-weight:400; margin-top:10px; font-family: Helvetica, Arial, sans-serif;">An account has been created for you using the email address provided:</p>
                <p  style="font-size:14px; line-height:1.4; color:#3B4C65; font-weight:400; margin-top:10px; font-family: Helvetica, Arial, sans-serif;">
                    Username: <b style="color:#FF541E!important; font-size:14px; font-weight:500;">{{$user?->email??""}}</b>
                </p>
                <p  style="font-size:14px; line-height:1.4; color:#3B4C65; font-weight:400; margin-top:10px; font-family: Helvetica, Arial, sans-serif;">
                    Password: <b style="color:#FF541E!important; font-size:14px; font-weight:500;">{{$password??""}}</b>
                </p>

                <div style="font-family: Helvetica, Arial, sans-serif; margin:20px 0px; 0px 0px; padding-bottom:25px; display:block; border-bottom:1px solid #EEEEEE;">
                    <div style="font-family: Helvetica, Arial, sans-serif; margin-top:20px;">
                        <a href="https://Uttarkashihotel.in/" target="_blank" style="font-size:14px; font-family: Helvetica, Arial, sans-serif; display:inline-block; text-decoration:none; color:#fff; padding:10px 20px; background:#FF541E; border-radius:5px;" title="Login  to continue">Login  to continue</a>
                    </div>
                </div>

                <ul style="font-family: Helvetica, Arial, sans-serif;  margin:0px; padding:0px 0px 10px 0px;">
                    <li style="font-family: Helvetica, Arial, sans-serif;  margin:0px; padding:0px 0px 15px 0px;color:#78828D; font-size:14px; font-weight:400; list-style:none; margin-top:25px;">You can login to your account anytime to view your booking, manage your trip, and explore more travel options.</li>
                    <li style="font-family: Helvetica, Arial, sans-serif;  margin:0px; padding:0px 0px 15px 0px;color:#78828D; font-size:14px; font-weight:400; list-style:none;">Thank you for being a part of <a style="color:#78828D; text-decoration:none" href="https://barkothotels.com/">UttarkashiHotel</a></li>
                </ul>

                
                <div style="margin-top:20px; margin-bottom:15px;">                
                    <p style="font-family: Helvetica, Arial, sans-serif;  color:#78828D; font-size:14px; font-weight:400; padding:0px 0px 0px 0px; margin:0px 0px 5px 0px; line-height:1.5em;">Warm Regards,</p>
                    <p style="font-family: Helvetica, Arial, sans-serif;  color:#78828D; font-size:14px; font-weight:400; padding:0px 0px 0px 0px; margin:0px 0px 5px 0px; line-height:1.5em;">UttarkashiHotel Team</p>
                </div>
                <div style="border-top:1px solid #EEEEEE;">
                    <p  style="font-family: Helvetica, Arial, sans-serif;  margin:15px 0px 0px 0px; color:#78828D; font-size:14px;">This is an automatically generated email; For assistance, contact our support team using the details above.</p>
                </div>
            </div>
        </div>
        <div>
            <div style="font-family: Helvetica, Arial, sans-serif;  text-align:center; color:#666; font-size: 12px; margin-top: 10px; padding-top:10px; padding-bottom:20px;">
                <div>
                    <a href="https://uttarkashihotel.in/terms-and-conditions" style="font-family: Helvetica, Arial, sans-serif;  color:#3B4C65; margin: 0 5px;  display: inline-block;font-size:14px; font-weight:600; text-decoration:underline;">Terms and Conditions</a>&nbsp; &nbsp;<a href="https://uttarkashihotel.in/privacy-policy" style="font-family: Helvetica, Arial, sans-serif;  color:#3B4C65; font-size:14px; font-weight:600; text-decoration:underline;">Privacy Policy</a>
                    <div class="contact-info" style="font-family: Helvetica, Arial, sans-serif;  margin-top: 10px; font-size: 12px;">
                        <p style="font-family: Helvetica, Arial, sans-serif;  color:#3B4C65; font-size:14px; text-align-center;">Copyright © {{date('Y')}} | UttarkashiHotel | All Rights Reserved</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
