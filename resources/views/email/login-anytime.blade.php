<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Anytime</title>
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.svg') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0; 
        }
strong{
color: #1A1F24;
}

        body {
            font-family: "Plus Jakarta Sans", sans-serif;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            /* animation: hardColorChange 1s infinite ease-in-out; */
        }

        .outer-body {
            background: #F9F9F9;
            border: 1px solid #E0E0EB;
            max-width: 600px;
            margin: 0 auto;
            border-radius: 8px;
            padding: 10px;
            /* animation: hardColorChange 1s infinite ease-in-out; */
        }

        .inner-body {
            border-radius: 8px;
            background: #FFFFFF;
            padding: 32px;
            display: flex;
            flex-direction: column;
            gap: 24px;
            box-shadow: rgba(14, 63, 126, 0.06) 0px 0px 0px 1px, rgba(42, 51, 70, 0.03) 0px 1px 1px -0.5px, rgba(42, 51, 70, 0.04) 0px 2px 2px -1px, rgba(42, 51, 70, 0.04) 0px 3px 3px -1.5px, rgba(42, 51, 70, 0.03) 0px 5px 5px -2.5px, rgba(42, 51, 70, 0.03) 0px 10px 10px -5px, rgba(42, 51, 70, 0.03) 0px 24px 24px -8px;
            /* animation: softColorChange 1s infinite ease-in-out; */

        }

        @keyframes hardColorChange {
            0% {
                background-color: #FF0000;
                /* Red */
            }

            20% {
                background-color: #00FF00;
                /* Green */
            }

            40% {
                background-color: #0000FF;
                /* Blue */
            }

            60% {
                background-color: #FFFF00;
                /* Yellow */
            }

            80% {
                background-color: #FF00FF;
                /* Magenta */
            }

            100% {
                background-color: #FF0000;
                /* Back to Red */
            }
        }

        @keyframes softColorChange {
            0% {
                background-color: #FFB3BA;
                /* Light Red */
            }

            20% {
                background-color: #B3FFB3;
                /* Light Green */
            }

            40% {
                background-color: #B3D9FF;
                /* Light Blue */
            }

            60% {
                background-color: #FFFFB3;
                /* Light Yellow */
            }

            80% {
                background-color: #FFCCF9;
                /* Light Pink */
            }

            100% {
                background-color: #FFB3BA;
                /* Back to Light Red */
            }
        }

        p {
            margin: 0;
            color: #45484E;
            font-weight: 500;
            font-size: 14px;
            line-height: 28px;
        }

        .fs-7 {
            font-size: 14px !important;
        }

        .fw-semibold {
            font-weight: 600;
        }

        .fw-bold {
            font-weight: 700;
        }

        .page-content {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .btn-primary {
            background: #FF541E;
            width: fit-content;
            padding: 8px 32px;
            border-radius: 30px;
            color: #fff;
            font-weight: 600;
            font-size: 14px;
            line-height: 24px;
            cursor: pointer;
        }

        a {
            color: #FF541E;
            text-decoration: none;
        }

        .disclaimer {
            border-top: 1px dashed #E0E0EB;
            padding-top: 18px;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .footer-content {
            display: flex;
            flex-direction: column;
            gap: 16px;
            padding: 32px;
            align-items: center;
        }

        .footer-content .top {
            /* margin: 0 auto; */
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 24px;
        }

        .footer-content .support {
            /* margin: 0 auto; */
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 24px;
        }

        .footer-content .top a {
            font-weight: 600;
            text-decoration: underline;
            color: #45484E;
            font-size: 14px;
        }

        .footer-content .support a {
            font-weight: 400;
            text-decoration: none;
            color: #45484E;
            font-size: 14px;
        }

        .fw-normal {
            font-weight: 400;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 24px;
            padding: 8px 0;
        }

        .social-icons img {
            width: 32px;
            height: 32px;
        }

        .heading p {
            font-size: 32px;
            line-height: 40px;
            font-weight: 700;
        }

        .heading .color {
            color: #FF541E;
        }

        .heading .secondary {
            font-size: 24px;
            line-height: 32px;
            font-weight: 400;
        }
    </style>
</head>

<body>
    <div class="outer-body">
        <div class="inner-body">
            <div class="page-header">
                <img src="{{ !empty($message) ? $message->embed(asset('assets/front/images/black-logo.png')) : asset('assets/front/images/black-logo.svg') }}" width="134.39" alt="">
                <p class="fs-7">Discover the best stays at best rates</p>
            </div>
            <div class="page-content">
                <p>Hi! Vaibhav,</p>

                <div class="heading">
                    <p>Welcome to <span class="color"> Hottel.in </span>—
                        <br>
                        <span class="secondary">
                            Your Journey Starts Here!
                        </span>
                    </p>
                </div>

                <p>Thank you for registering with Hottel.in! Your account is successfully created, and you're now part
                    of our family. Start exploring the best hotel deals and experience seamless bookings with us.</p>

                <a class="btn btn-primary">
                    Login Anytime!
                </a>

                <p>If you need any assistance, feel free to reach out to our support team. </p>
                <p><strong>Thank you for being a part of Hottel!</strong></p>
                <div class="disclaimer">
                    <p>Access your trips on any device, speed up bookings with saved details, and save properties you
                        love for later.</p>
                    <p>
                        <strong>Disclaimer:</strong> This is an automatically generated email. Please do not reply
                        directly to this
                        email. Need help? Contact us at <a href="mailto:support@hottel.in">support@hottel.in</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="footer-content">
            <div class="top">
                <a href="">Terms and Services</a>
                <a href="">Privacy Policy</a>
            </div>
            <div class="copyright">
                <p class="fw-normal">© Copyright {{date('Y')}} Hottel.in.
                    <span class="fs-7">
                        All rights reserved
                    </span>
                </p>
            </div>
            <div class="support">
                <a href="emailto:support@hottel.in">support@hottel.in</a>
                <a href="tel:8115192939">(+91) 8115-192939</a>
            </div>
            <div class="social-icons">
                <img src="{{ asset('assets/media/logos/linkedin.svg') }}" alt="">
                <img src="{{ asset('assets/media/logos/YouTube.svg') }}" alt="">
                <img src="{{ asset('assets/media/logos/instagram.svg') }}" alt="">
                <img src="{{ asset('assets/media/logos/facebook.svg') }}" alt="">

            </div>
        </div>
    </div>
</body>

</html>
