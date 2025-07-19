<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\Storage;

if (!function_exists('formatDateMdY')) {

    function formatDateMdY($date)
    {
        return Carbon::parse($date)->format('M d, Y');
    }
}

if (!function_exists('stayNights')) {
    function stayNights($fromDate, $toDate)
    {
        $fromDate = Carbon::parse($fromDate);
        $toDate = Carbon::parse($toDate);
        $nights = $fromDate->diffInDays($toDate);
        return $nights;
    }
}

if (!function_exists('formatDateMdYHiA')) {
    function formatDateMdYHiA($date)
    {
        return Carbon::parse($date)->format('M d, Y H:i A');
    }
}

if (!function_exists('averageRoomRate')) {
    function averageRoomRate($totalAmount, $totalRatePlanCount)
    {
        if ($totalRatePlanCount == 0) {
            return 0;
        }
        $averageRatePrice = $totalAmount / $totalRatePlanCount;

        return $averageRatePrice;
    }
}

if (!function_exists('cancellationPolicy')) {
    function cancellationPolicy($arrival_date, $check_in_time, $check_in_date, $cancel_booking)
    {

        $cancellation_type = $arrival_date;
        $checking_time = $check_in_time ?? "11:00";
        $cancellation_date_time = $cancel_booking;
        $checkin_date = $check_in_date;


        if ($cancellation_type == 'days before arrival') {
            $currentDate = now();

            $day = (int)$cancellation_date_time;
            $cancellation_date = Carbon::parse($currentDate)->addDay($day);

            if (Carbon::parse($checkin_date) >= ($cancellation_date)) {
                $formate = \Carbon\Carbon::parse($cancellation_date)->format('M d, Y');
                $text     =  "Free Cancellation till" . ' ' . $formate . ' ' . "At" . ' ' . $checking_time . ' ' . 'AM';
                $noCancellation = 2;
            } else {
                $text     = "";
                $noCancellation = 1;
            }
        } elseif ($cancellation_type == 'hours before arrival') {
            $noCancellation = 3;
            $checking_date = \Carbon\Carbon::parse($checkin_date)->format('M d, Y');
            $time = Carbon::createFromTimeString($checking_time);
            $subtractHours = (int)$cancellation_date_time;
            $newTime = $time->subHours($subtractHours);
            $subtractedTime = $newTime->format('H:i');
            $text =  "Free Cancellation till" . ' ' . $checking_date . ' ' . "At" . ' ' . $subtractedTime . ' ' . 'AM';
        }

        $data = [
            'noCancellation' => $noCancellation,
            'text'           => $text
        ];

        return $data;
    }
}



if (!function_exists('generateReferralCode')) {
    function generateReferralCode()
    {
        $code = Str::random(7);
        $table = config('referral.referral_table', 'users');
        $exists = DB::table($table)->where('affiliate_code', $code)->exists();
        if ($exists) {
            $code = generateReferralCode();
        }
        return $code;
    }
}


if (!function_exists('lowestAvailableRoom')) {
    function lowestAvailableRoom($ratePlans)
    {
        $minimumAvailability = $ratePlans->min('availability');
        return $minimumAvailability;
    }
}

if (!function_exists('roomText')) {
    function roomText($room)
    {
        if ($room == 1) {
            $roomText = 'Room';
        } elseif ($room > 1) {
            $roomText = 'Rooms';
        } else {
            $roomText = '';
        }
        return $roomText;
    }
}


if (!function_exists('guestText')) {
    function guestText($guest)
    {
        if ($guest == 1) {
            $guestText = 'Guest';
        } elseif ($guest > 1) {
            $guestText = 'Guests';
        } else {
            $guestText = '';
        }
        return $guestText;
    }
}

if (!function_exists('adultText')) {
    function adultText($adult)
    {
        if ($adult == 1) {
            $adultText = 'adult';
        } elseif ($adult > 1) {
            $adultText = 'adults';
        } else {
            $adultText = '';
        }
        return $adultText;
    }
}

if (!function_exists('nightText')) {
    function nightText($night)
    {
        if ($night == 1) {
            $nightText = 'Night';
        } elseif ($night > 1) {
            $nightText = 'Nights';
        } else {
            $nightText = '';
        }
        return $nightText;
    }
}

//external hotels

if (!function_exists('amenitiesData')) {
    function amenitiesData()
    {
        return [
            'restaurant' => 'Restaurant',
            '24_hour_front_desk' => '24-hour Front Desk',
            'shuttle service' => 'Shuttle Service',
            'air_conditioning' => 'Air Conditioning',
            'airport_shuttle' => 'Airport Shuttle',
            'baggage_storage' => 'Baggage storage',
            'fitness_centre' => 'Fitness Centre',
            'clothes_rack' => 'Clothes rack',
            'flat_screen_tv' => 'Flat-screen TV',
            'air_conditioning' => 'Air conditioning',
            'linen' => 'Linen',
            'desk' => 'Desk',
            'wake_up_service' => 'Wake-up service',
            'towels' => 'Towels',
            'wardrobe_or_closet' => 'Wardrobe or closet',
            'heating' => 'Heating',
            'balcony' => 'Balcony',
            'terrace' => 'Terrace',
            'swinging_pool' => 'Swimming Pool',
        ];
    }
}
if (!function_exists('extRoomTypes')) {
    function extRoomTypes()
    {
        return [
            'single'             => 'Single Room',
            'double'             => 'Double Room',
            'twin'               => 'Twin Room',
            'triple'             => 'Triple Room',
            'quad'               => 'Quad Room',
            'queen'              => 'Queen Room',
            'king'               => 'King Room',
            'studio'             => 'Studio Room',
            'suite'              => 'Suite',
            'presidential_suite' => 'Presidential Suite',
            'connecting'         => 'Connecting Rooms',
            'villa'              => 'Villa',
            'apartment'          => 'Serviced Apartment',
            'dormitory'          => 'Dormitory',
        ];
    }
}

if (!function_exists('uploadImage')) {
    function uploadImage($hotel, $image, $path, $imageName)
    {
        if ($image && $image->isValid()) {
            $image  = ImageManagerStatic::make($image)->encode('webp');
            $imageFormate = '.webp';
            $finalImageName = str::slug($hotel->name . ' ' . $hotel->cityName->name . ' ' . (!empty($imageName) ? $imageName : ''));
            $relativePath = $path . $finalImageName . $imageFormate;

            Storage::disk('public')->put($relativePath, $image);
            $hotelImages = $relativePath;
            return  $hotelImages;
        }
        return null;
    }
}

if (!function_exists('uploadMultipleImages')) {
    function uploadMultipleImages($hotel, $images, $path, $imageName)
    {

        $uploadedFiles = [];
        if (!empty($images) && is_array($images)) {
            foreach ($images as $key => $image) {
                if ($image && $image->isValid()) {
                    $image  = ImageManagerStatic::make($image)->encode('webp');
                    $imageFormate = '.webp';
                    $finalImageName = str::slug($hotel->name . ' ' . $hotel->cityName->name . ' ' . (!empty($imageName[$key]) ? $imageName[$key] : ''));
                    $relativePath = $path . $finalImageName . $imageFormate;
                    Storage::disk('public')->put($relativePath, $image);
                    $hotelImages = $relativePath;
                    $uploadedFiles[] = $hotelImages;
                }
            }
        }

        return $uploadedFiles;
    }
}

// Alt Name: Hotel Rio Benaras, Varanasi [Suite Room, Bathroom]

if (!function_exists('ImageAltTag')) {

    function ImageAltTag($hotel, $altTag)
    {

        if (!empty($altTag)) {
            return ucwords($hotel->name ?? "Hotel") . ' ' . ucwords($hotel->cityName->name ?? 'City') . ' [' . ucwords($altTag ?? 'Alt Tag') . ']';
        } else {
            return '';
        }
    }
}

if (!function_exists('checkImageExists')) {

    function checkImageExists($images)
    {

        if ($images instanceof \Illuminate\Support\Collection) {
            $files = $images->pluck('image')->toArray();
        } elseif (is_array($images)) {
            $files = $images;
        } else {
            return file_exists(storage_path('app/public/' . $images));
        }
        $status = array_map(function ($val) {
            return file_exists(storage_path('app/public/' . $val));
        }, $files);
        return !in_array(false, $status);
    }
}

if (!function_exists('personExtraBedPriceEp')) {

    function personExtraBedPriceEp($ratePlans)
    {
        $totalPrice = 0;
        $totalMarkup = 0;
        $totalExtraPrice = 0;
        $count = 0;
        foreach ($ratePlans as $ratePlan) {
            $extraPerson = $ratePlan->RatePlanConfig->where('plan_type', 'ep')->first();

            if ($extraPerson && $extraPerson->extra_person_price > 0) {
                $count++;
                $extraPersonPrice = $extraPerson->extra_person_price ?? 0;
                $extraPersonMarkup = $extraPerson->extra_person_markup ?? 0;
                $totalPrice += $extraPersonPrice;
                $totalMarkup += $extraPersonMarkup;
                $totalExtraPrice += ($extraPersonPrice + $extraPersonMarkup);
            }
        }
        return [
            'ep_extra_person_price' => $count > 0 ? round($totalPrice / $count, 2) : 0,
            'ep_extra_person_markup' => $count>0?round($totalMarkup/ $count, 2) : 0,
            'ep_total_extra_person_price' => $totalExtraPrice,
            'ep_average_extra_person_price' => $count > 0 ? round($totalExtraPrice / $count, 2) : 0,
        ];
    }
}
if (!function_exists('personExtraBedPriceCp')) {
    function personExtraBedPriceCp($ratePlans)
    {
        $totalPrice = 0;
        $totalMarkup = 0;
        $totalExtraPrice = 0;
        $count = 0;

        foreach ($ratePlans as $ratePlan) {
            $extraPerson = $ratePlan->RatePlanConfig->where('plan_type', 'cp')->first();

            if ($extraPerson && $extraPerson->extra_person_price > 0) {
                $count++;
                $extraPersonPrice = $extraPerson->extra_person_price ?? 0;
                $extraPersonMarkup = $extraPerson->extra_person_markup ?? 0;
                $totalPrice += $extraPersonPrice;
                $totalMarkup += $extraPersonMarkup;
                $totalExtraPrice += ($extraPersonPrice + $extraPersonMarkup);
            }
        }

        return [
            'cp_extra_person_price' => $count > 0 ? round($totalPrice / $count, 2) : 0,
            'cp_extra_person_markup' => $count>0?round($totalMarkup/ $count, 2) : 0,
            'cp_total_extra_person_price' => $totalExtraPrice,
            'cp_average_extra_person_price' => $count > 0 ? round($totalExtraPrice / $count, 2) : 0,
        ];
    }
}

if (!function_exists('personExtraBedPriceMap')) {
    function personExtraBedPriceMap($ratePlans)
    {
        $totalPrice = 0;
        $totalMarkup = 0;
        $totalExtraPrice = 0;
        $count = 0;

        foreach ($ratePlans as $ratePlan) {
            $extraPerson = $ratePlan->RatePlanConfig->where('plan_type', 'map')->first();

            if ($extraPerson && $extraPerson->extra_person_price > 0) {
                $count++;
                $extraPersonPrice = $extraPerson->extra_person_price ?? 0;
                $extraPersonMarkup = $extraPerson->extra_person_markup ?? 0;
                $totalPrice += $extraPersonPrice;
                $totalMarkup += $extraPersonMarkup;
                $totalExtraPrice += ($extraPersonPrice + $extraPersonMarkup);
            }
        }

        return [
            'map_extra_person_price' => $count > 0 ? round($totalPrice / $count, 2) : 0,
            'map_extra_person_markup' => $count > 0 ? round($totalMarkup / $count, 2) : 0,
            'map_total_extra_person_price' => $totalExtraPrice,
            'map_average_extra_person_price' => $count > 0 ? round($totalExtraPrice / $count, 2) : 0,
        ];
    }
}

if (!function_exists('personExtraBedPriceAp')) {
    function personExtraBedPriceAp($ratePlans)
    {
        $totalPrice = 0;
        $totalMarkup = 0;
        $totalExtraPrice = 0;
        $count = 0;

        foreach ($ratePlans as $ratePlan) {
            $extraPerson = $ratePlan->RatePlanConfig->where('plan_type', 'ap')->first();

            if ($extraPerson && $extraPerson->extra_person_price > 0) {
                $count++;
                $extraPersonPrice = $extraPerson->extra_person_price ?? 0;
                $extraPersonMarkup = $extraPerson->extra_person_markup ?? 0;
                $totalPrice += $extraPersonPrice;
                $totalMarkup += $extraPersonMarkup;
                $totalExtraPrice += ($extraPersonPrice + $extraPersonMarkup);
            }
        }

        return [
            'ap_extra_person_price' => $count > 0 ? round($totalPrice / $count, 2) : 0,
            'ap_extra_person_markup' => $count > 0 ? round($totalMarkup / $count, 2) : 0,
            'ap_total_extra_person_price' => $totalExtraPrice,
            'ap_average_extra_person_price' => $count > 0 ? round($totalExtraPrice / $count, 2) : 0,
        ];
    }
}



if (!function_exists('calculateExtraPersonPrice')) {

    function calculateExtraPersonPrice($ratePlans, $totalGuests, $stayGuest, $totalRoom, $planType)
    {

        $guestsPerRoom = (int)ceil($totalGuests / $totalRoom);

        if ($planType == 'ep') {

            if ($guestsPerRoom <= $stayGuest || $ratePlans->isEmpty()) {

                return [
                    'ep_extra_person_price' => 0,
                    'ep_extra_person_markup' => 0,
                    'ep_total_extra_person_price' => 0,
                    'ep_average_extra_person_price' => 0,
                ];
            }
            $extraBedPrices = personExtraBedPriceEp($ratePlans);
            return $extraBedPrices;
        }
        if ($planType == 'cp') {


            if ($guestsPerRoom <= $stayGuest || $ratePlans->isEmpty()) {

                return [
                    'cp_extra_person_price' => 0,
                    'cp_extra_person_markup' => 0,
                    'cp_total_extra_person_price' => 0,
                    'cp_average_extra_person_price' => 0,
                ];
            }

            $extraBedPrices = personExtraBedPriceCp($ratePlans);
            return $extraBedPrices;
        }
        if ($planType == 'map') {


            if ($guestsPerRoom <= $stayGuest || $ratePlans->isEmpty()) {

                return [
                    'map_extra_person_price' => 0,
                    'map_extra_person_markup' => 0,
                    'map_total_extra_person_price' => 0,
                    'map_average_extra_person_price' => 0,
                ];
            }
            $extraBedPrices = personExtraBedPriceMap($ratePlans);
            return $extraBedPrices;
        }
        if ($planType == 'ap') {


            if ($guestsPerRoom <= $stayGuest || $ratePlans->isEmpty()) {

                return [
                    'ap_extra_person_price' => 0,
                    'ap_extra_person_markup' => 0,
                    'ap_total_extra_person_price' => 0,
                    'ap_average_extra_person_price' => 0,
                ];
            }

            $extraBedPrices = personExtraBedPriceAp($ratePlans);
            return $extraBedPrices;
        }
    }
}

if (!function_exists('phoneCode')) {

    function phoneCode()
    {
        $phoneCode = [
            ["name" => "Afghanistan", "code" => "AF", "dial_code" => "+93"],
            ["name" => "Albania", "code" => "AL", "dial_code" => "+355"],
            ["name" => "Algeria", "code" => "DZ", "dial_code" => "+213"],
            ["name" => "Andorra", "code" => "AD", "dial_code" => "+376"],
            ["name" => "Angola", "code" => "AO", "dial_code" => "+244"],
            ["name" => "Argentina", "code" => "AR", "dial_code" => "+54"],
            ["name" => "Armenia", "code" => "AM", "dial_code" => "+374"],
            ["name" => "Australia", "code" => "AU", "dial_code" => "+61"],
            ["name" => "Austria", "code" => "AT", "dial_code" => "+43"],
            ["name" => "Azerbaijan", "code" => "AZ", "dial_code" => "+994"],
            ["name" => "Bahrain", "code" => "BH", "dial_code" => "+973"],
            ["name" => "Bangladesh", "code" => "BD", "dial_code" => "+880"],
            ["name" => "Belarus", "code" => "BY", "dial_code" => "+375"],
            ["name" => "Belgium", "code" => "BE", "dial_code" => "+32"],
            ["name" => "Brazil", "code" => "BR", "dial_code" => "+55"],
            ["name" => "Canada", "code" => "CA", "dial_code" => "+1"],
            ["name" => "China", "code" => "CN", "dial_code" => "+86"],
            ["name" => "Denmark", "code" => "DK", "dial_code" => "+45"],
            ["name" => "Egypt", "code" => "EG", "dial_code" => "+20"],
            ["name" => "France", "code" => "FR", "dial_code" => "+33"],
            ["name" => "Germany", "code" => "DE", "dial_code" => "+49"],
            ["name" => "India", "code" => "IN", "dial_code" => "+91"],
            ["name" => "Indonesia", "code" => "ID", "dial_code" => "+62"],
            ["name" => "Iran", "code" => "IR", "dial_code" => "+98"],
            ["name" => "Iraq", "code" => "IQ", "dial_code" => "+964"],
            ["name" => "Ireland", "code" => "IE", "dial_code" => "+353"],
            ["name" => "Israel", "code" => "IL", "dial_code" => "+972"],
            ["name" => "Italy", "code" => "IT", "dial_code" => "+39"],
            ["name" => "Japan", "code" => "JP", "dial_code" => "+81"],
            ["name" => "Kenya", "code" => "KE", "dial_code" => "+254"],
            ["name" => "Malaysia", "code" => "MY", "dial_code" => "+60"],
            ["name" => "Mexico", "code" => "MX", "dial_code" => "+52"],
            ["name" => "Netherlands", "code" => "NL", "dial_code" => "+31"],
            ["name" => "New Zealand", "code" => "NZ", "dial_code" => "+64"],
            ["name" => "Nigeria", "code" => "NG", "dial_code" => "+234"],
            ["name" => "Norway", "code" => "NO", "dial_code" => "+47"],
            ["name" => "Pakistan", "code" => "PK", "dial_code" => "+92"],
            ["name" => "Philippines", "code" => "PH", "dial_code" => "+63"],
            ["name" => "Poland", "code" => "PL", "dial_code" => "+48"],
            ["name" => "Portugal", "code" => "PT", "dial_code" => "+351"],
            ["name" => "Qatar", "code" => "QA", "dial_code" => "+974"],
            ["name" => "Russia", "code" => "RU", "dial_code" => "+7"],
            ["name" => "Saudi Arabia", "code" => "SA", "dial_code" => "+966"],
            ["name" => "Singapore", "code" => "SG", "dial_code" => "+65"],
            ["name" => "South Africa", "code" => "ZA", "dial_code" => "+27"],
            ["name" => "Spain", "code" => "ES", "dial_code" => "+34"],
            ["name" => "Sweden", "code" => "SE", "dial_code" => "+46"],
            ["name" => "Switzerland", "code" => "CH", "dial_code" => "+41"],
            ["name" => "Thailand", "code" => "TH", "dial_code" => "+66"],
            ["name" => "Turkey", "code" => "TR", "dial_code" => "+90"],
            ["name" => "United Arab Emirates", "code" => "AE", "dial_code" => "+971"],
            ["name" => "United Kingdom", "code" => "GB", "dial_code" => "+44"],
            ["name" => "United States", "code" => "US", "dial_code" => "+1"],
            ["name" => "Vietnam", "code" => "VN", "dial_code" => "+84"],
            ["name" => "Yemen", "code" => "YE", "dial_code" => "+967"],
            ["name" => "Zimbabwe", "code" => "ZW", "dial_code" => "+263"],
            ["name" => "Nepal", "code" => "NP", "dial_code" => "+977"],

        ];

        return $phoneCode;
    }
}
