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
            $roomText = 'room';
        } elseif ($room > 1) {
            $roomText = 'rooms';
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
            $nightText = 'night';
        } elseif ($night > 1) {
            $nightText = 'nights';
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
            'ep_extra_person_price' => $totalPrice,
            'ep_extra_person_markup' => $totalMarkup,
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
            'cp_extra_person_price' => $totalPrice,
            'cp_extra_person_markup' => $totalMarkup,
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
            'map_extra_person_price' => $totalPrice,
            'map_extra_person_markup' => $totalMarkup,
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
            'ap_extra_person_price' => $totalPrice,
            'ap_extra_person_markup' => $totalMarkup,
            'ap_total_extra_person_price' => $totalExtraPrice,
            'ap_average_extra_person_price' => $count > 0 ? round($totalExtraPrice / $count, 2) : 0,
        ];
    }
}
