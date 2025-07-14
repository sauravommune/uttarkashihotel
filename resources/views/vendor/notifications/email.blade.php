<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'Welcome to Hottel' }}</title>
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
    <div class="email-container" style="width: 100%; max-width:600px; margin: 0 auto; border: 1px solid #EEEEEE; background:#fff;">
        <div class="box" style="margin: 5px; padding: 20px; border-radius: 5px; box-shadow: rgba(99, 99, 99, 0.1) 0px 2px 4px 0px;">
            <div class="header">
                <img style="max-width: 200px;" src="https://hottel.in/assets/front/images/black-logo.svg" alt="Hottel Logo">

            </div>
            <div class="content">
                <p style="color:#05264E; font-size:14px; font-weight:500; margin-top:20px;">
                    {{ $introText ?? 'Discover the best stays at the best rates' }}
                </p>
                @foreach ($introLines as $line)
                <p style="font-size:14px; line-height:1.5; color:#3B4C65; font-weight:400;">
                    {{ $line }}
                </p>
                @endforeach

                @isset($actionUrl)
                <div style="margin: 20px 0;">
                    <a href="{{ $actionUrl }}" target="_blank" style="font-size:14px; display:inline-block; text-decoration:none; color:#fff; padding:10px 20px; background:#FF541E; border-radius:30px;">
                        {{ $actionText ?? 'Click Here' }}
                    </a>
                </div>
                @endisset

                @foreach ($outroLines as $line)
                <p style="font-size:14px; line-height:1.5; color:#3B4C65; font-weight:400;">
                    {{ $line }}
                </p>
                @endforeach

                <div style="margin-top:20px; margin-bottom:15px;">
                    <p style="color:#78828D; font-size:14px; font-weight:400;">{{ $salutation ?? 'Warm Regards,' }}</p>
                    <p style="color:#78828D; font-size:14px; font-weight:400;">Hottel Team</p>
                </div>
                <div style="border-top:1px solid #EEEEEE;">
                    <p style="margin:15px 0; color:#78828D; font-size:14px;">This is an automatically generated email; please do not reply directly.</p>
                </div>
            </div>
            <div style="text-align:center; color:#666; font-size:12px; margin-top:10px;">
                <a href="{{ route('terms-and-conditions') }}" style="color:#3B4C65; margin: 0 5px; font-size:14px; font-weight:600; text-decoration:underline;">Terms and Conditions</a>&nbsp;&nbsp;
                <a href="{{ route('privacy-policy') }}" style="color:#3B4C65; font-size:14px; font-weight:600; text-decoration:underline;">Privacy Policy</a>
                <div class="contact-info" style="margin-top:10px; font-size:12px;">
                    <p style="color:#3B4C65; font-size:14px; text-align:center;">Copyright © {{ now()->year }} | Hottel | All Rights Reserved</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
