@php
use Carbon\Carbon;
@endphp

@extends('front.layouts.app')
@section('content')
<style>
.select2-container {
    border: 1px solid #ccc;
    border-radius: 5px;
}

span.select2-dropdown.custom-dropdown-class.select2-dropdown--below {
    top: -2px !important;
}

.select2-container--bootstrap-5 .select2-dropdown .select2-search .select2-search__field {
    display: none;
}

.select2-container--bootstrap-5 .select2-dropdown .select2-search {
    padding: 0rem .75rem;
}

.select2-container--bootstrap-5 .select2-dropdown.select2-dropdown--below {
    border-top-right-radius: 0px;
    border-top-left-radius: 0px;
    left: -1px;
}

@media (max-width: 1200px) {
    .flatpickr-calendar.open {
        z-index: 99999999 !important;
    }
}
</style>

<section class="top-bg lazy bg-image-style " data-bg="{{ asset('assets/front/images/search-result.png') }}"
    id="top-bg-class"></section>
<section class="top-bg top-bg-II lazy bg-image-style bg-image-style-II d-block d-xl-none"
    data-bg="{{ asset('assets/front/images/m-bg.png') }}"></section>

<section class="search-section other-page search-section-II m-device" id="search-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if ($agent->isDesktop())
                <div class="d-none d-sm-none d-md-none d-lg-none d-xl-block">
                    @include('front.includes.searchForm')

                </div>
                @endif

                @if (!$agent->isDesktop())
                <div class="serach-warpper d-block d-sm-block d-md-block d-lg-block  d-xl-none">
                    <div>
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div class="warpper-city">
                                <div class="city">
                                    {{ ucwords($searchData->city?->name ?? '') }}
                                </div>
                                <div class="info">
                                    {{ Carbon::parse($searchData->checkin_date)->format('M d') ?? date('M d') }} -
                                    {{ Carbon::parse($searchData->checkout_date)->format('M d') ?? date('M d') }},
                                    {{ $searchData->roomCount ?? 1 }} Rooms,
                                    {{ $searchData->adultCount + $searchData->childCount ?? 1 }} Guest
                                </div>
                            </div>
                            <div>
                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                    data-bs-target="#search-modal-section">
                                    <div class="icon">
                                        <span class="icon-search-1"></span>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</section>

<section class="section-9 pt-xl-2 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-section">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item">
                                <a
                                    href="{{ Route('searchResultCity', ['city' => $searchData->city?->name ?? '']) }}">{{ $searchData->city?->name ?? '' }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ ucwords($hotelDetails['details']['name']) ?? '' }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-10 pb-xl-0 pt-xl-2 pt-0">
    <div class="container pb-xl-4 pt-xl-2 pt-0 main-section-10">
        <div class="row">
            <div class="col-12">
                <div class="row">

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="title  mt-0">
                                    
                                    <h1>{{ ucwords($hotelDetails['details']['name']) ?? '' }}</h1>
                                </div>
                                <div class="view-map">
                                    <div class="d-flex">
                                        <div class="text pe-2">
                                            <span
                                                class="icon-location-1 pe-1"></span>{{ ucwords($hotelDetails['details']['cityName']['name']) ?? '' }},
                                            {{ $searchData->city?->state?->name ?? '' }}
                                        </div>

                                        @if (!empty($hotelDetails['details']?->map_url))
                                        <div class="text">
                                            <a target="_blank" href="{{ $hotelDetails['details']?->map_url ?? '' }}">View
                                                on
                                                map</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-xl-flex justify-content-xl-end">
                                @if ($hotelDetails['details']['google_rating'] > 0)
                                    <div class="rating-verify">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="{{ asset('assets/front/images/google-image.png') }}"
                                                    alt="">
                                            </div>
                                            <div class="ms-2 ">
                                                <div class="g-rating">
                                                    Google Reviews
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="rating">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <p class="mb-0">
                                                                    {{ $hotelDetails['details']['google_rating'] ?? 0}}/5 
                                                                </p>
                                                            </div>
                                                            <div>
                                                                @php
                                                                    $rating = $hotelDetails['details']['google_rating'];
                                                                    $full_star = floor($rating);
                                                                    $half_star =
                                                                        $rating - $full_star >= 0.1 ? 1 : 0;
                                                                    $empty_star = 5 - ($full_star + $half_star);
                                                                @endphp
                                                                <div class="rating-star ps-1">
                                                                    @for ($i = 0; $i < $full_star; $i++)
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                    @endfor
                                                                    {{-- Half Star --}}
                                                                    @if ($half_star)
                                                                        <i
                                                                            class="bi bi-star-half text-warning"></i>
                                                                    @endif
                                                                    {{-- Empty Stars --}}
                                                                    @for ($i = 0; $i < $empty_star; $i++)
                                                                        <i class="bi bi-star text-secondary"></i>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            @if($hotelDetails['details']['google_rating_total']>0)
                                                            <div class="reviews ps-1">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="reviews-text">based on {{$hotelDetails['details']['google_rating_total']??0}} reviews</div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        
                        </div>
                        
                        @if (count($hotelDetails['details']['hotelImages']) > 0)
                        {{-- <div id="fancybox-gallery" class="d-none d-sm-none d-md-none d-lg-none d-xl-block"> --}}
                        {{-- <div id="lightgallery" class="d-none d-sm-none d-md-none d-lg-none d-xl-block">
                                    <div class="hotel-gallery-section">
                                        <div class="row my-4">
                                            <div class="col-xl-6 left-grid">
                                                <div class="left-image">
                                                    <a href="{{ asset('storage/' . $hotelDetails['details']['hotelImages']['0']['image']) }}">
                        <div class="image bg-image-style lazy"
                            data-bg="{{ asset('storage/' . $hotelDetails['details']['hotelImages']['0']['image'])}}">

                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-6">

                    <div id="hotel-images-container" class="row">
                        @foreach ($hotelDetails['details']['hotelImages'] as $key => $hotelImg)
                        <div class="col-xl-6 right-grid image-item" data-key="{{ $key }}"
                            data-src="{{ asset('storage/' . $hotelImg['image'] ?? '') }}">
                            <a href="{{ asset('storage/' . $hotelImg['image'] ?? '') }}">
                                <div class="right-image postion-relative">
                                    <div class="image last-img bg-image-style lazy"
                                        style="background-image: url({{ asset('storage/'.$hotelImg['image'] ?? '')}})">
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="d-none d-sm-none d-md-none d-lg-none d-xl-block">
        <div class="hotel-gallery-section">
            <div class="row my-3">
                <div class="col-xl-6 left-grid">
                    <div class="left-image">
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#gallery-modal">
                            <div class="image bg-image-style lazy"
                                data-bg="{{ asset('storage/' . $hotelDetails['details']['hotelImages']['0']['image']) }}">

                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div id="hotel-images-container" class="row">
                        @foreach (collect($hotelDetails['details']['hotelImages'])->take(4) as $key => $hotelImg)
                        <div class="col-xl-6 right-grid image-item">
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#gallery-modal">
                                <div class="right-image position-relative">
                                    <div class="image last-img bg-image-style lazy"
                                        style="background-image: url({{ asset('storage/' . $hotelImg['image'] ?? '') }})">
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- This slide is only used for mobile --}}
    @if (count($hotelDetails['details']['hotelImages']) > 0)
    <section class="hotel-slider my-4 d-block d-xl-none" id="hotel-slider-II">
        @foreach ($hotelDetails['details']['hotelImages'] as $key => $hotelImg)
        <div class="image-wrapper">
            <div class="mx-2">
                <a data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" data-bs-dismiss="modal"
                    href="javascript:void(0);" data-title="Hotel Image {{ $key + 1 }}">
                    <img src="{{ asset('storage/' . $hotelImg['image'] ?? '') }}" alt="{{ImageAltTag($hotelDetails['details'],$hotelImg->alt_tag)}}"
                        height="200" width="300">
                </a>
            </div>
        </div>
        @endforeach
    </section>
    @endif
    {{-- End --}}

    @if (count($hotelDetails['details']['amenities']) > 0)
    <div class="amenities-section">
        <div class="title">
            <h2 class="mt-xl-0 mt-2">Amenities</h2>
        </div>
        <div class="ul-section mt-xl-2 mt-2">
            <ul>
                @foreach ($hotelDetails['details']->amenities as $key => $amenity)
                @if ($key == 4)
                @break
                @endif
                <li class="">
                    <div class="d-flex align-items-center">
                        <div>
                            <span
                                class="material-symbols-outlined fs-5 me-1 pt-xl-1 pt-0">{{$amenity->amenityName?->icode ??'spa'}}</span>
                        </div>
                        <div class="ps-1">
                            {{ $amenity->amenityName?->name ?? '' }}
                        </div>
                    </div>
                </li>
                @endforeach
                @if ($hotelDetails['details']->amenities->count() > 5)
                <li>
                    <div class="d-flex align-items-center">
                        <div class="view-all">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#amenities">View All
                                <span class="icon-angle-right"></span>
                            </a>
                        </div>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </div>
    @endif
    <div class="description-section mt-2">
        <div class="title">
            <h2>Description</h2>
            <p class="pt-xl-3 pt-1">
                {{ $hotelDetails['details']['description'] ?? '' }}
            </p>
        </div>
    </div>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 left-item mt-xl-0 mt-4">
        <div class="left-card">
            <div class="title">
                <div class="row px-2">
                    <div class="col-7 p-0">
                         <h3>{{ ucwords($hotelDetails['details']['room']['roomType']['name']) ?? '' }}</h3>
                         <ul>
                            <li>
                                <span class="icon-king-bed pe-1"></span>{{ $searchData->roomCount ?? 0 }}
                                {{ucfirst(roomText($searchData->roomCount))}}
                            </li>
                            <li class="px-1">|</li>
                            <li>
                                <span class="icon-user pe-1"></span>{{ $searchData->adultCount + $searchData->childCount ?? 0 }}
                                {{guestText($searchData->adultCount + $searchData->childCount)}}
                            </li>
                        </ul>
                    </div>
                    <div class="col-5 p-0">
                        <div class="d-flex justify-content-end justify-content-md-between w-100 flex-wrap gap-2">
                            <div class="d-flex align-items-center">
                                <div class="p-btn">
                                    @php
                                    $parkingClass = '';
                                    $available = '';
                                    if ($hotelDetails['details']['parking_available'] === 'yes_free') {
                                    $parkingClass = 'bg-success';
                                    $available = 'Free Parking Available';
                                    } elseif ($hotelDetails['details']['parking_available'] === 'yes_paid') {
                                    $parkingClass = 'bg-danger';

                                    $available = 'Paid parking is available.';
                                    } elseif ($hotelDetails['details']['parking_available'] === 'no') {
                                    $parkingClass = 'bg-light';
                                    $available = 'Parking is not available';
                                    }
                                    @endphp

                                    <a href="javascript:void(0);" class="btn small-btn {{ $parkingClass }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $available }}"><span
                                            class="icon-car"></span></a>
                                </div>
                                <div class="rating mx-0 ms-2 border-0">
                                    <div class="d-flex align-items-center mx-0 px-0 pe-2">
                                        <p class="d-flex flex-wrap align-items-center"><b>{{intval($hotelDetails['details']['rating'])??''}}</b><span
                                                class="bi bi-star-fill fs-8 text-warning rated pe-2 ps-1"></span><b
                                                class=>Property</b></p>

                                    </div>
                                </div>

                            </div>
                            <div class="d-block d-sm-block d-md-block  d-lg-block d-xl-none ">
                                {{-- @if ($hotelDetails['details']?->sold_out == 1 || empty($allAvailableRoom)) --}}
                                @if ($hotelDetails['details']?->sold_out == 1 || (int)$hotelDetails['availability'] < (int)$hotelDetails['totalRoom'])
                                <div class="text-end">
                                    <span class="sold-out">Sold Out</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
  
                <div class="refundable-section mt-3">
                    {{-- <div class="mb-3">
                    <select class="form-select global-select border"
                        aria-label="Default select example" id="refundPolicy"
                        onchange="updateCancellationText()">
                        <option value="1">Refundable</option>
                        <option value="2">Non refundable </option>
                    </select>
                    </div> --}}
                    <div>


                    </div>
                </div>

                <div class="price mt-3">

                    <div>
                        @php
                        $roomCount = $searchData->roomCount ?? 1;
                        // $total_price = $hotelDetails['total_price'] * $roomCount;
                        $per_night_price = $hotelDetails['per_night_price'] * $roomCount;

                        @endphp
                        <div class="">
                            <small class="d-block">Starting From</small>
                            <div class="main-price d-block">
                                ₹ {{ $per_night_price ?? 0 }}
                            </div>
                        </div>
                        <small>Per Night for {{$roomCount}} {{ucfirst(roomText($roomCount))}} </small>
                    </div>
                </div>

                <div class="btn-section mt-xl-3 mt-2">
                    <div class="d-flex align-items-center">   
                       {{-- @if ($hotelDetails['details']?->sold_out == 1 || empty($allAvailableRoom)) --}}
                        @if ($hotelDetails['details']?->sold_out == 1 ||(int)$hotelDetails['availability'] < (int)$hotelDetails['totalRoom'])
                        <div class="text-end d-none d-sm-none d-md-none  d-lg-none d-xl-block">
                            <span class="sold-out">Sold Out</span>
                        </div>
                        @else
                        <div>
                            <a href="{{ route('hotel.addDetails', ['hotelId' => encode($hotelDetails['details']['id']), 'roomId' => encode($hotelDetails['details']['room']['id']), 'roomTypeId' => encode($hotelDetails['details']['room']['roomType']['id']), 'searchId' => encode($searchData?->id)]) }}"
                                title="Book Now" class="btn btn-outline-primary" id="reserve-button">Book Now</a>
                        </div>
                        <div class="ps-3">
                            <a href="#target_div"
                                title="{{ count($allAvailableRoom) }}More Options">{{ count($allAvailableRoom) }}
                                More Options</a>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <div class="map-section mt-4">
            <div class="image">

                @if ($hotelDetails['details']?->embed_map_url)
                <div>
                    <iframe src="{{ $hotelDetails['details']?->embed_map_url ?? '' }}" class="w-100"></iframe>

                </div>
                @endif

                @if ($hotelDetails['details']?->map_url)
                <div class="title">
                    <h4><a target="_blank" href="{{ $hotelDetails['details']?->map_url ?? '' }}">View in Map</a>
                    </h4>
                </div>
                @endif
            </div>
        </div>

        @if (count($hotelDetails['details']->nearByPlace) > 0)
        <div class="location-section mt-2 py-3 border-bottom">
            <h5 class="mb-xl-2 mb-3 ">Popular Places</h5>
            <!-- Show only the first 4 records -->
            @foreach ($hotelDetails['details']->nearByPlace->take(5) as $nearByPlace)
            <div class="d-flex justify-content-between align-items-center w-100 py-1">
                <div class="d-flex">
                    <div class="icon pe-2">
                        <span class="icon-location-on"></span>
                    </div>
                    <div class="content">
                        <p>{{ ucwords($nearByPlace->placeName->places ?? '') }}</p>
                    </div>
                </div>
                <div class="count-location">
                    {{ $nearByPlace->distance ?? 1 }} Km
                </div>
            </div>
            @endforeach
            @if ($hotelDetails['details']->nearByPlace->count() > 5)
            <div class="text-start pt-2 ps-4">
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#nearest-location"
                    class="pt-5 primary-text view-all-text">View All</a>
            </div>
            @endif
        </div>

        @endif
        

    </div>

    <div class="col-12">
        @if($hotelDetails['details']->video_title && $hotelDetails['details']->video_url)
        <div class="video-wrapper ads-video my-2 pt-xl-0 pt-4">
            <div class="ads-video-container w-100">
                <h2 class="heading">{{ucfirst($hotelDetails['details']->video_title??"")}}</h2>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9">
                        <div class="yt-video">
                            <iframe src="{{$hotelDetails['details']->video_url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-3 d-none d-xl-block">
                        <div class="ads-video-image position-relative">
                            <img src="{{ asset('assets/front/images/hotel-lock.png') }}" alt="" class="" width="" height="" />
                            <a href="{{ url()->previous() }}" class="btn btn-white  position-absolute bottom-0 start-50 translate-middle-x mb-4">Explore Now</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- copied section -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9" id="target_div">
        

        {{-- @dd($allAvailableRoom) --}}
        <div class="choose-room-section mt-xl-3 mt-2">
            <div class="title py-2">
                <h2 class="mb-xl-0 mb-3">Choose your room</h2>
            </div>
        </div>
        <form class="filter-section mt-xl-4 mt-2" id="searchRoom" action="javascript:void(0)">
            <input type="hidden" name="search_id" value="{{ encode($searchData?->id) }}">
            <div class="row">
                <input type="hidden" name="hotel_id" value="{{ $hotelDetails['details']['id'] ?? '' }}">
                <input type="hidden" name="room_id" value="{{ $hotelDetails['details']['room']['id'] ?? '' }}">

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 repeat-section mb-xl-0 mb-5">
                    <div class="input-box">
                        <div>
                            <label class="form-label">Check In</label>

                            <h5 class="section-hotel check-in">
                                {{ Carbon::parse($searchData->checkin_date)->format('F d, Y') ?? date('F d, Y') }}
                            </h5>

                            <input type="hidden" class="form-control d-none" name="checkin_date"
                                value="{{ Carbon::parse($searchData->checkin_date)->format('Y-m-d') ?? date('Y-m-d') }}">
                        </div>
                        <div class="icon first">
                            <!-- <span class="icon-calendar-add"></span> -->
                            <span class="material-symbols-outlined">
                                event_available
                            </span>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 repeat-section mb-xl-0 mb-5">
                    <div class="input-box">
                        <div>
                            <label class="form-label">Check Out</label>
                            <h5 class="section-hotel check-out">
                                {{ Carbon::parse($searchData->checkout_date)->format('F d, Y') ?? date('F d, Y') }}
                            </h5>
                            <input type="hidden" class="form-control d-none" name="checkout_date"
                                value="{{ Carbon::parse($searchData->checkout_date)->format('Y-m-d') ?? date('Y-m-d') }}">
                        </div>
                        <div class="icon">
                            <!-- <span class="icon-event-busy"></span> -->
                            <span class="material-symbols-outlined">
                                event_busy
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section guest-select mb-xl-0 mb-4">
                    <div class="input-box">
                        <div class="search-item">
                            <label for="exampleInputEmail1" class="form-label ">Rooms & Guests</label>
                            <div class="dropdown-container">
                                <input type="text" class="guest-input pb-0" value="Select Guests" readonly />
                                <div class="guest-dropdown dropdown">
                                    <div class="guest-category">
                                        <span>Rooms</span>
                                        <div class="controls d-flex">
                                            <a class="room-decrement decrement" data-type="room">-</a>
                                            <span class="room-count">{{ $searchData->roomCount ?? 1 }}</span>
                                            <a class="room-increment increment" data-type="room">+</a>
                                        </div>
                                    </div>
                                    <div class="guest-category">
                                        <span>Adults</span>
                                        <div class="controls d-flex">
                                            <a class="adult-decrement decrement" data-type="adult">-</a>
                                            <span class="adult-count">{{ $searchData->adultCount ?? 1 }}</span>
                                            <a class="adult-increment increment" data-type="adult">+</a>
                                        </div>
                                    </div>
                                    <div class="guest-category">
                                        <span>Children</span>
                                        <div class="controls d-flex">
                                            <a class="child-decrement decrement" data-type="child">-</a>
                                            <span class="child-count">{{ $searchData->childCount ?? 0 }}</span>
                                            <a class="child-increment increment" data-type="child">+</a>
                                        </div>
                                    </div>
                                    <div class="age-selector">
                                        @foreach ($searchData->child_ages ?? [] as $key => $age)
                                        <div class="child-age">
                                            {{ $age }}
                                            <label for="childAge{{ $key }}">Child
                                                {{ $key }} Age</label>
                                            <select class="child-age-select" name="childAge[]">
                                                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}"
                                                    @selected($age==$i)>
                                                    {{ $i }} year</option>
                                                    @endfor
                                            </select>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="icon">
                                <span class="material-symbols-outlined">
                                    king_bed
                                </span>
                            </div>
                        </div>
                        <div class="traveler-container">
                            <input type="hidden" name="roomCount" class="room-count-input"
                                value="{{ $searchData->roomCount ?? 1 }}">
                            <input type="hidden" name="adultCount" class="adult-count-input"
                                value="{{ $searchData->adultCount ?? 1 }}">
                            <input type="hidden" name="childCount" class="child-count-input"
                                value="{{ $searchData->childCount ?? 0 }}">
                        </div>
                    </div>
                </div>

                <div class="col  repeat-section mb-xl-0 mb-4 d-flex align-items-center">
                    <div class="btn-box">
                        <button class="btn btn-outline-primary" id="clickRoomSearch" title="Search"><span class="icon-search-1 pe-2"></span>Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 d-flex align-items-end">
     <div class="guaranteed-hotel w-100">
            <img data-src="{{ asset('assets/front/images/guaranteed-hotel-detail.jpg') }}" alt="" class="img-fluid lazy w-100 mt-3" />
        </div>
        </div>
    <!-- end copied section -->

    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9  mt-xl-5 mt-2">
       
        <div class="room-skeleton-loading d-none" id="loaderImg">
        <div class="row g-0">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
                <div class="img-bg">
                    <div class="image-bg"></div>
                </div>
            </div>
            <div
                class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 d-flex align-items-center justify-content-center ">
                <div class="center-section">
                    <div class="p-btn">
                        <div class="small-btn"></div>
                        <div class="title mt-xl-3 mt-3"></div>
                        <div class="d-flex">
                            <div class="title mt-xl-3 mt-3 px-4"></div>
                            <div class="title mt-xl-3 mt-3 px-5 ms-2"></div>
                        </div>

                        <div class="title mt-xl-3 mt-2"></div>
                        <div class="">
                            <div class="title mt-xl-2 mt-3"></div>
                            <div class="title mt-xl-2 mt-3"></div>
                            <div class="title mt-xl-2 mt-3"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-5 d-flex align-items-center justify-content-center">
                <div class="recommended-section d-none d-xl-block">
                    <div class="">
                        <div>
                            <div>
                                <div class="d-xl-flex justify-content-xl-between w-100">
                                    <div class="left-section">
                                        <div class="top-head"></div>
                                        <div class="top-head  my-3"></div>
                                    </div>
                                    <div class="right-section">
                                        <div class="top-head"></div>
                                        <div class="top-head  my-3"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-none d-xl-block">
                                <div class="d-xl-flex justify-content-xl-between w-100">
                                    <div class="left-section pe-2">
                                        <div class="top-head"></div>
                                        <div class="top-head  my-3"></div>

                                    </div>
                                    <div class="right-section ps-2">
                                        <div class="top-head"></div>
                                        <div class="top-head  my-3"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        <div id="appendRoom">
            @include('front.search-room')
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3  mt-xl-5 mt-2 section-card">
        <div class="right-card-custom mb-xl-3 mb-3" id="hide-section">
            <form action="{{ route('add_booking_multiple') }}" method="post">
                <input type="hidden" name="search_id" id ="append_search_id" value="{{ encode($searchData?->id)}}">
                @csrf()
                <div class="inner-wrapper">
                    <div class="price-area pb-0">
                        <div class="title pb-0" id="total-night-room"></div>
                    </div>
                    <div class="price-area" id="append_price_section"></div>
                    <div class="total-count" id="total-amount-text"></div>


                    <div class="m-2">
                        @if ($hotelDetails['details']?->sold_out == 1 || empty($allAvailableRoom))
                        <div class="text-end">
                            <span class=" btn btn-outline-primary btn-block w-100 sold-out">Sold Out</span>
                        </div>
                        @else
                        <div class="my-2">
                            <button class="btn btn-outline-primary btn-block w-100">Book Now</button>
                        </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
        <div class="right-card-custom d-none" id="please-select">
            <div class="inner-wrapper bg-remove">
                <div class="price-area pt-0">
                    <div class="title text-center">
                        Select at least one option if you want to book
                    </div>

                    <div>
                        <a href="javascript:void(0);" title="Select an option" class="btn btn-grey w-100">Select an
                            option</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="room-not-found" class="no-record-found d-none">
        <div class="main">
            <div class="d-flex justify-content-center align-items-center">
                <div class="text-center">
                    <img src="{{ asset('assets/front/images/search.png') }}" alt="" height="" width="" />
                    <div class="text mt-xl-2 mt-2">Oops! No Room Found</div>
                    <div class="content">No room in this hotel matches your requirements</div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>
    </div>
    </div>
</section>

@if(isset($hotelDetails['details']?->hotelReview) && count($hotelDetails['details']?->hotelReview) > 0)

<section class="section-38  mt-4">
    <div class="container">
        <div class="row main-section-10">
            <div class="col-12">
                <div class="section-title">
                    <h4 class="title p-0">Google Reviews of {{ucwords($hotelDetails['details']?->name) ?? '' }}</h4>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="row">
                    {{-- <div class="col-12 ">
                        <div class="card-group hotel-reviews-google" >
                            @if(isset($hotelDetails['details']?->hotelReview) && count($hotelDetails['details']?->hotelReview) > 0 && $hotelDetails['details']?->google_rating > 0)
                            @foreach($hotelDetails['details']?->hotelReview as $review)
                                <div class="custom-card">
                                    <div class="d-flex  align-items-center">
                                        <div class="image">
                                            @if($review->review_profile_photo)
                                                <img src="{{asset('storage/'.$review->review_profile_photo)}}" alt=""
                    width="" title="User Image" />
                    @else
                    <img src="https://placehold.co/40x40" alt="" width="" title="User Image" />
                    @endif
                </div>
                <div class="title ps-2">
                    <h3 class="mb-0 pb-0">{{ucwords($review?->author_name??"")}}</h3>
                    @if($review?->date)
                    <p class="mb-0 pb-0">
                        {{ $review?->date ? \Carbon\Carbon::parse($review->date)->format('M jS, Y') : '' }}</p>
                    @endif
                </div>
                <div class="count-rating d-flex align-items-center mx-xl-3 mx-3">
                    <b>{{$review?->rating??""}}</b>
                    <span class="icon-star text-warning ps-1"></span>
                </div>
            </div>
            <div class="text-section">
                <div class="content mx-1">
                    <p>{{$review?->text??''}}</p>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    </div> --}}


    <div class="col-12 p-0">
        <div class="card-group hotel-reviews-google ">
            @if(isset($hotelDetails['details']?->hotelReview) && count($hotelDetails['details']?->hotelReview) > 0)
            @foreach($hotelDetails['details']?->hotelReview as $review)

            <div class="custom-card">
                <div class="card-content">
                    <div class="d-flex align-items-center">
                        <div class="image">
                            @if($review->review_profile_photo && file_exists(storage_path('app/public/'.$review->review_profile_photo)))
                            <img src="{{ asset('storage/'.$review->review_profile_photo) }}" alt="" width="40"
                                title="User Image" />
                            @else
                            {{-- <img src="https://placehold.co/40x40" alt="" width="40" title="User Image" /> --}}
                            <div class="user-name">
                                @php
                                 $firstInitial = strtoupper(substr(explode(' ', $review->author_name)[0], 0, 1));
                                @endphp
                                <p>{{$firstInitial}}</p>
                            </div>
                            @endif
                        </div>
                        <div class="title ps-2">
                            <h3 class="mb-0 pb-0">{{ ucwords($review?->author_name ?? "") }}</h3>
                            @if($review?->date)
                            <p class="mb-0 pb-0">
                                {{ $review?->date ? \Carbon\Carbon::parse($review->date)->format('M jS, Y') : '' }}</p>
                            @endif
                        </div>
                        <div class="count-rating d-flex align-items-center mx-xl-3 mx-3">
                            <b>{{ $review?->rating ?? "" }}</b>
                            <span class="icon-star text-warning ps-1"></span>
                        </div>
                    </div>
                    {{-- <div class="text-section">
                        <div class="content mx-1">
                            <p>{{ $review?->text ?? '' }}</p>
                </div>
            </div> --}}

            <div class="text-section">
                <div class="content mx-1">
                    <p class="review-text" data-full-text="{{ $review?->text ?? '' }}">
                        {{ \Illuminate\Support\Str::limit($review?->text ?? '', 100) }}
                    </p>
                    @if(strlen($review?->text ?? '') > 100)
                    <a href="javascript:void(0);" class="read-more-toggle">Read More</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
    </div>
    </div>

    </div>
    </div>
    </div>
    </div>
</section>
@endif

<section class="section-14 py-xl-5 py-3">
    <div class="container main-section-10 py-xl-4 py-3">
        <div class="row ">
            <div class="col-12">
                <div class="section-title">
                    <h4 class="title">
                        Property Rules of {{ ucwords($hotelDetails['details']?->name) ?? '' }}
                    </h4>
                    <div class="d-flex">
                        <div class="check-in-text">

                            <b>Check-in :</b><span class="ps-1">{{ $hotelDetails['details']['check_in_time'] ?? '' }}
                                PM</span>
                        </div>
                        <div class="check-in-text ps-3">
                            <b>Check-out :</b><span class="ps-1">{{ $hotelDetails['details']['check_out_time'] ?? '' }}
                                AM</span>
                        </div>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                        <div class="text mb-2">
                            General
                        </div>
                        {!! $hotelDetails['details']['general_rules'] !!}

                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                        <div class="text mb-2">
                            Optional
                        </div>
                        {!! $hotelDetails['details']['optinal_rules'] !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- @if(isset($hotelDetails['similarHotelDetails']) && count($hotelDetails['similarHotelDetails']) > 0)
<section class="section-6 hotel-details">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="image">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-xl-flex justify-content-between align-items-xl-center w-100">
                                <div class="section-title mt-xl-0 mt-3">
                                    <h4>Similar Properties to {{ ucwords($hotelDetails['details']['name']) ?? '' }}
</h4>
</div>
</div>
</div>
</div>
<div class="row pt-4 mt-2">

    <div class="col-12">
        <div class="" id="slider-II">

            @if (count($hotelDetails['similarHotelDetails']) > 0)
            @foreach ($hotelDetails['similarHotelDetails'] as $similar)

            @if($similar->room->plan?->total_amount_ep > 0)

            <a
                href="{{ route('hotel.details', ['slug' => $similar?->slug, 'searchId' => encode($hotelDetails['searchData']?->id)]) }}">
                <div class="main-slider">
                    <div class="card-bg bg-image-style lazy"
                        data-bg="{{ !empty($similar['hotelImg']) ? asset('storage/' . $similar['hotelImg']['image']) : asset('assets/media/no-hotel-img.svg') }}">
                        <div class="off">
                            Upto 20% OFF
                        </div>
                        <div class="hotels-details">
                            <div class="d-flex align-items-center pb-1 off off-II pt-1 pb-1 mb-2">
                                <div class="icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div>
                                    <span class="pb-0 ps-1">{{ ucwords($similar['cityName']['name']) ?? '' }}</span>
                                </div>
                            </div>
                            <h3>{{ ucwords($similar['name']) ?? '' }}</h3>


                            @if($similar?->google_rating>0)
                            <div class="d-flex align-items-center py-1">
                                <div>
                                    <img width="25px" height="25px"
                                        src="{{ asset('assets/front/images/google-image.png') }}" alt="">
                                </div>
                                <div class="ps-2">
                                    <small>{{ $similar?->google_rating ?? 0 }}/5 based on
                                        {{$similar?->google_rating_total>0?$similar?->google_rating_total:1}}
                                        reviews</small>
                                </div>
                            </div>
                            @endif

                            <div class="price">₹ {{(int) $similar->room->plan?->total_amount_ep ?? 00 }} <span> per
                                    night</span></div>

                        </div>
                    </div>
                </div>
            </a>

            @endif

            @endforeach
            @endif

        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</section>
@endif --}}

{{-- Amenities modal Create --}}
<div class="modal fade hotel-amenities" id="amenities" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header w-100">
                <div class="w-100 position-relative">
                    <h4 class="modal-title">{{ ucwords($hotelDetails['details']['name']) ?? '' }}</h4>

                    @if (!empty($hotelDetails['details']['amenities']))
                        <ul class="list-unstyled mt-3 mb-0">
                            @foreach ($hotelDetails['details']['amenities'] as $amenity)
                                <li class="d-flex align-items-center mb-1">
                                    <span class="material-symbols-outlined fs-5 me-2">{{ $amenity['amenityName']['icode'] ?? 'spa' }}</span>
                                    <span>{{ $amenity['amenityName']['name'] ?? '' }}</span>
                                </li>
                            @endforeach
                        </ul>

                    @else
                        <p class="mt-3">No amenities available.</p>
                    @endif

                    {{-- Close button --}}
                    <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Nearest Location modal Create --}}
<div class="modal fade hotel-amenities" id="nearest-location" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header w-100">
                <div class=" w-100 position-relative">
                    <h4 class="modal-title">Popular Places</h4>
                    <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="ul-section">
                    @if (count($hotelDetails['details']->nearByPlace) > 0)
                    @foreach ($hotelDetails['details']->nearByPlace as $nearByPlace)
                    <div class="d-flex justify-content-between align-items-center w-100 py-2 border-bottom">
                        <div class="d-flex align-items-center">
                            <div class="icon pe-2">
                                <span class="icon-location-on"></span>
                            </div>
                            <div class="content">
                                <p>{{ ucwords($nearByPlace->placeName->places ?? '') }}</p>
                            </div>
                        </div>
                        <div class="count-location">
                            {{ $nearByPlace->distance ?? 1 }} Km
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Amenities modal End --}}
@if (!$agent->isDesktop())
<section class="search-modal-section search-section search-section-II search-section-mb">
    <div class="modal fade" id="search-modal-section" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-header postion-relative border-0">
                        <div class="text-center">
                            <h5 class="modal-title text-center" id="exampleModalLabel">Search Your Hotel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>

                <div class="modal-body">
                    @include('front.includes.searchForm')

                </div>
            </div>
        </div>
    </div>
</section>
@endif


<!-- Fullscreen Modal -->
<div class="modal fade fullscreen-modal" id="gallery-modal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" data-bs-focus="false">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-black" id="galleryModalLabel">
                    {{ ucwords($hotelDetails['details']['name']) ?? '' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach ($hotelDetails['details']['hotelImages'] as $key => $hotelImg)
                    <div class="col-12 col-sm-6 col-md-3 col-xl-3 ">
                        <div class="thumbnail-gallery">
                            <a href="javascript:void(0);" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal"
                                data-bs-dismiss="modal">
                                <div class="gallery-img-modal">
                                    <img src="{{ asset('storage/' . $hotelImg['image']) }}" alt="{{ImageAltTag($hotelDetails['details'],$hotelImg->alt_tag)}}"
                                        class="img-fluid">
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade fullscreen-modal slider-modal" id="exampleModalToggle3" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <div id="loading-spinner">
                            <div class="text-center">
                                <div class="spinner-border text-light text-center" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <span class="text-white d-block text-center">Please wait....</span>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <div class="top-slider">
                            <div class="slider-for-II" style="display: none;">
                                @foreach ($hotelDetails['details']['hotelImages'] as $key => $hotelImg)
                                <div class="image">
                                    <img src="{{ asset('storage/' . $hotelImg['image']) }}" alt="{{ImageAltTag($hotelDetails['details'],$hotelImg->alt_tag)}}">
                                </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn-close hidden-btn btn-close-II" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                <div class="thumbnail-slider">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12">
                            <div class="slider-nav-II" style="display: none;">
                                @foreach ($hotelDetails['details']['hotelImages'] as $key => $hotelImg)
                                <div class="image">
                                    <img src="{{ asset('storage/' . $hotelImg['image']) }}" alt="{{ImageAltTag($hotelDetails['details'],$hotelImg->alt_tag)}}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@section('scripts')
<script>
function sliderImg() {

    $(".room-img").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        initialSlide: 1,
        arrows: true,
        fade: true,
        prevArrow: '<i class="icon-left-open-1 arrow left-arrow"></i>',
        nextArrow: '<i class="icon-right-open-1 arrow right-arrow"></i>',
        dots: false,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 546,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });
}

$(document).ready(function() {
    const lazyLoadInstance = new LazyLoad({
        elements_selector: "div.lazy",
    });

    $('body').on('click', '#clickRoomSearch', function() {
        
        $('#appendRoom').html('');
        $('#total-night-room').empty();
        $('#append_price_section').empty();
        $('#total-amount-text').empty();
        $('#hide-section').addClass('d-none');

        $('.no-record-found').addClass('d-none');
        $('#loaderImg').removeClass('d-none');

        var formData = $("#searchRoom").serialize();

        // Adding a 2-second delay before making the AJAX request
        setTimeout(function() {
            $.ajax({
                url: "{{ route('search.room') }}",
                type: 'GET',
                data: formData,
                success: function(response) {

                    $('#append_search_id').val(response.searchId);   // Append Search Id

                    $('#loaderImg').addClass('d-none');

                    $('#total-night-room').empty();
                    $('#append_price_section').empty();
                    $('#total-amount-text').empty();

                    $('#please-select').addClass('d-none');

                    if (response.data) {
                        $('#room-not-found').addClass('d-none');
                        // $('#hide-section').removeClass('d-none');
                        $('#please-select').removeClass('d-none');
                        $('#appendRoom').html(response.data);
                        sliderImg();
                        if (lazyLoadInstance) {
                            lazyLoadInstance.update();
                        }
                        // firstRoomShowPrice();
                    } else {
                        $('#appendRoom').html('');
                        $('#room-not-found').removeClass('d-none');
                        $('.no-record-found').removeClass('d-none');
                        $('#hide-section').addClass('d-none');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error occurred: " + error);
                }
            });
        }, 2000); // 2 seconds delay
    });
});

function updateTotal($input, amount, roomType, category, roomId, roomTypeId) {
    var quantity = parseInt($input.val()) || 0;
    var totalAmount = amount * quantity;
    var uniqueKey = `${roomType}-${category}`.replace(/\s+/g, '-').toLowerCase();
    var $existingElement = $(`#summary_${uniqueKey}`);
    if (quantity > 0) {
        $('#hide-section').removeClass("d-none");
        var totalAmount = totalAmount * totalNights();
        var hotelId = $('#hotelId').data('hotel_id');
        var html = `<div id="summary_${uniqueKey}" class="d-flex justify-content-between align-items-center w-100 mb-2">

                        <div class="left-part">
                               ${quantity} x ${roomType} (${category})
                        </div>
                         <div class="right-part total-price" data-amount="${totalAmount}">
                             ₹ ${totalAmount}
                        </div>
                        <input type="hidden" name="hotelId" value="${hotelId}">
                        <input type="hidden" name="quantity[]" value="${quantity}">
                        <input type="hidden" name="roomId[]" value="${roomId}">
                        <input type="hidden" name="roomType[]" value="${roomType}">
                        <input type="hidden" name="roomTypeId[]" value="${roomTypeId}">
                        <input type="hidden" name="category[]" value="${category}">
                        <input type="hidden" name="totalAmount[]" value="${totalAmount}">
                    </div>`;

        if ($existingElement.length > 0) {
            $existingElement.replaceWith(html);
        } else {
            $('#append_price_section').append(html);
        }
    } else {
        $existingElement.remove();
    }
    calculateGrandTotal(totalAmount);
    calculateTotalRoomQuantity();

}

function firstRoomShowPrice() {
    var section = 1;
    $(`#only-room-box-${section}`).removeClass("d-none");
    $(`#select-only-room-box-${section}`).addClass("d-none");
    var $input = $(`#section-only-room-box-${section}`).find("input[type='number']");
    var roomType = $(`#section-only-room-box-${section}`).data('type');
    var roomTypeId = $(`#section-only-room-box-${section}`).data('type-id');
    var category = $(`#section-only-room-box-${section}`).data('category');
    var amount = $(`#section-only-room-box-${section}`).data('amount');
    // var planeId = $(`#section-only-room-box-${section}`).data('plane-id');
    var roomId = $(`#section-only-room-box-${section}`).data('room-id');
    var quantity = parseInt($input.val());

    if (quantity == 0) {
        $input.val(1);
    }
    updateTotal($input, amount, roomType, category, roomId, roomTypeId);
}

$(document).ready(function() {
    // firstRoomShowPrice();

    $('#hide-section').addClass('d-none');
    $('#please-select').removeClass('d-none');

});

function totalNights() {

    // var check_in_date = "{{ $searchData->checkin_date }}";
    // var check_out_date = "{{ $searchData->checkout_date }}";
    // var checkInDate = new Date(check_in_date);
    // var checkOutDate = new Date(check_out_date);
    // var nights = (checkOutDate - checkInDate) / (1000 * 60 * 60 * 24);
    // nights = Math.max(1, Math.floor(nights)); // Minimum 1 night
     var nights = $('.nights').data('nights');
     return nights;

}

$(document).on("click", ".total_price", function() {

    var currentValue = 0;
    $(this).parents('.parent-section').find('input[type="number"]').each(function() {
        currentValue += (parseInt($(this).val()) || 0);
    });
    var availability = parseInt($(this).data('availability'));
     $(this).closest('.room-section').find('small.availability-error').text('');
    if (currentValue >= availability) {
        // $('small.availability-error').text('Only ' + availability + ' rooms are available');
         $(this).closest('.room-section').find('small.availability-error').text('Only ' + availability + ' rooms are available');
        return;
    }

    var section = $(this).data("section");

    $(`#only-room-box-${section}`).removeClass("d-none");
    $(`#select-only-room-box-${section}`).addClass("d-none");
    var $input = $(`#section-only-room-box-${section}`).find("input[type='number']");
    var roomType = $(`#section-only-room-box-${section}`).data('type');
    var roomTypeId = $(`#section-only-room-box-${section}`).data('type-id');

    var category = $(`#section-only-room-box-${section}`).data('category');
    var amount = $(`#section-only-room-box-${section}`).data('amount');
    // var planeId = $(`#section-only-room-box-${section}`).data('plane-id');
    var roomId = $(`#section-only-room-box-${section}`).data('room-id');
    var quantity = parseInt($input.val());

    if (quantity == 0) {
        $input.val(1);
    }
    updateTotal($input, amount, roomType, category, roomId, roomTypeId);
});

$(document).on("click", ".total_price_with_break_fast", function() {
    var currentValue = 0;
    $(this).parents('.parent-section').find('input[type="number"]').each(function() {
        currentValue += (parseInt($(this).val()) || 0);
    });
    var availability = parseInt($(this).data('availability'));
    // $('small.availability-error').text('');
     $(this).closest('.room-section').find('small.availability-error').text('');
    if (currentValue >= availability) {
        // $('small.availability-error').text('Only ' + availability + ' rooms are available');
         $(this).closest('.room-section').find('small.availability-error').text('Only ' + availability + ' rooms are available');
        return;
    }

    var section = $(this).data("section");
    $(`#break-fast-box-${section}`).removeClass("d-none");
    $(`#select-break-fast-box-${section}`).addClass("d-none");
    var $input = $(`#section-break-fast-box-${section}`).find("input[type='number']");
    var roomType = $(`#section-break-fast-box-${section}`).data('type');
    var roomTypeId = $(`#section-break-fast-box-${section}`).data('type-id');

    var category = $(`#section-break-fast-box-${section}`).data('category');
    var amount = $(`#section-break-fast-box-${section}`).data('amount');
    // var planeId = $(`#break-fast-box-${section}`).data('plane-id');
    var roomId = $(`#section-break-fast-box-${section}`).data('room-id');
    var quantity = parseInt($input.val());

    if (quantity == 0) {
        $input.val(1);
    }

    updateTotal($input, amount, roomType, category, roomId, roomTypeId);
});

$(document).on("click", ".total_price_with_break_fast_and_dinner", function() {

    var currentValue = 0;
    $(this).parents('.parent-section').find('input[type="number"]').each(function() {
        currentValue += (parseInt($(this).val()) || 0);
    });
    var availability = parseInt($(this).data('availability'));
    // $('small.availability-error').text('');
     $(this).closest('.room-section').find('small.availability-error').text('');
    if (currentValue >= availability) {
       // $('small.availability-error').text('Only ' + availability + ' rooms are available');
         $(this).closest('.room-section').find('small.availability-error').text('Only ' + availability + ' rooms are available');
         return;
    }

    var section = $(this).data("section");
    $(`#break-fast-dinner-box-${section}`).removeClass("d-none");
    $(`#select-break-fast-dinner-box-${section}`).addClass("d-none");
    var $input = $(`#section-break-fast-dinner-box-${section}`).find("input[type='number']");
    var roomType = $(`#section-break-fast-dinner-box-${section}`).data('type');
    var roomTypeId = $(`#section-break-fast-dinner-box-${section}`).data('type-id');
    var category = $(`#section-break-fast-dinner-box-${section}`).data('category');
    var amount = $(`#section-break-fast-dinner-box-${section}`).data('amount');
    var roomId = $(`#section-break-fast-dinner-box-${section}`).data('room-id');
    var quantity = parseInt($input.val());
    if (quantity == 0) {
        $input.val(1);
    }
    updateTotal($input, amount, roomType, category, roomId, roomTypeId);
});


$(document).on("click", ".total_price_with_break_fast_lunch_and_dinner", function() {

    var currentValue = 0;
    $(this).parents('.parent-section').find('input[type="number"]').each(function() {
        currentValue += (parseInt($(this).val()) || 0);
    });
    var availability = parseInt($(this).data('availability'));
    // $('small.availability-error').text('');
     $(this).closest('.room-section').find('small.availability-error').text('');
    if (currentValue >= availability) {
       // $('small.availability-error').text('Only ' + availability + ' rooms are available');
         $(this).closest('.room-section').find('small.availability-error').text('Only ' + availability + ' rooms are available');
         return;
    }

    var section = $(this).data("section");
    $(`#break-fast-lunch-dinner-box-${section}`).removeClass("d-none");
    $(`#select-break-fast-lunch-dinner-box-${section}`).addClass("d-none");
    var $input = $(`#section-break-fast-lunch-dinner-box-${section}`).find("input[type='number']");
    var roomType = $(`#section-break-fast-lunch-dinner-box-${section}`).data('type');
    var roomTypeId = $(`#section-break-fast-lunch-dinner-box-${section}`).data('type-id');
    var category = $(`#section-break-fast-lunch-dinner-box-${section}`).data('category');
    var amount = $(`#section-break-fast-lunch-dinner-box-${section}`).data('amount');
    var roomId = $(`#section-break-fast-lunch-dinner-box-${section}`).data('room-id');
    var quantity = parseInt($input.val());
    if (quantity == 0) {
        $input.val(1);
    }
    updateTotal($input, amount, roomType, category, roomId, roomTypeId);
});

$(document).on("click", ".plusBtn", function() {

    var $input = $(this).closest(
        ".quantity-section").find(
        "input[type='number']");

    var roomType = $(this).closest(
        ".quantity-section"
    ).data('type');

    var roomTypeId = $(this).closest(
        ".quantity-section"
    ).data('type-id');

    var category = $(this).closest(
        ".quantity-section"
    ).data('category');

    var roomId = $(this).closest(
        ".quantity-section"
    ).data('room-id');

    var currentValue = 0;
    $(this).parents('.parent-section').find('input[type="number"]').each(function() {
        currentValue += (parseInt($(this).val()) || 0);
    });
    var availability = $(this).data('availability');
    // $('small.availability-error').text('');
        $(this).closest('.room-section').find('small.availability-error').text('');

    if (currentValue < availability) {
        let currentEntered = parseInt($input.val()) || 0;
        $input.val(currentEntered + 1);
        var amount = $(this).data('amount');
        updateTotal($input, amount, roomType, category, roomId, roomTypeId);
    } else {
        // $('small.availability-error').text('Only ' + availability + ' rooms are available');
         $(this).closest('.room-section').find('small.availability-error').text('Only ' + availability + ' rooms are available');
          return;
    }
});

$(document).on("click", ".minusBtn", function() {

    // $('small.availability-error').text('');
     $(this).closest('.room-section').find('small.availability-error').text('');

    var $input = $(this).closest(".quantity-section").find("input[type='number']");

    var roomType = $(this).closest(".quantity-section").data('type');

    var roomTypeId = $(this).closest(".quantity-section").data('type-id');

    var category = $(this).closest(".quantity-section").data('category');

    var roomId = $(this).closest(".quantity-section").data('room-id');

    var currentValue = parseInt($input.val()) || 0;
    var amount = $(this).data('amount');

    if (currentValue > 0) {
        $input.val(currentValue - 1);
        updateTotal($input, amount, roomType, category, roomId, roomTypeId);
    }

    if (currentValue == 0 || currentValue == 1) {
        var section = $(this).data('section');
        var type = $(this).data('type_btn');
        if (type === "With Breakfast Dinner") {
            $(`#break-fast-dinner-box-${section}`).addClass("d-none");
            $(`#select-break-fast-dinner-box-${section}`).removeClass("d-none");
        } else if (type === "With Breakfast") {
            $(`#break-fast-box-${section}`).addClass("d-none");
            $(`#select-break-fast-box-${section}`).removeClass("d-none");
        } else if (type == "Room Only") {
            $(`#only-room-box-${section}`).addClass("d-none");
            $(`#select-only-room-box-${section}`).removeClass("d-none");
        } else if (type == "With Breakfast Lunch Dinner") {

            $(`#break-fast-lunch-dinner-box-${section}`).addClass("d-none");
            $(`#select-break-fast-lunch-dinner-box-${section}`).removeClass("d-none");
        }
    
        updateTotal($input, amount, roomType, category, roomId, roomTypeId);
    }
});

$(document).on("keyup", ".quantity-input, .quantity-input-second, .quantity-input-third", function() {
    var $input = $(this);

    var roomType = $(this).closest(
        ".quantity-section, .quantity-section-second, .quantity-section-third"
    ).data('type');

    var roomTypeId = $(this).closest(
        ".quantity-section, .quantity-section-second, .quantity-section-third"
    ).data('type');

    var category = $(this).closest(
        ".quantity-section, .quantity-section-second, .quantity-section-third"
    ).data('category');

    var roomId = $(this).closest(
        ".quantity-section, .quantity-section-second, .quantity-section-third"
    ).data('room-id');
    var currentValue = parseInt($input.val()) || 0;
    if (currentValue > 10) {
        $input.val(10);
        currentValue = 10;
    }
    var amount = $input.data('amount');
    updateTotal($input, amount, roomType, category, roomId, roomTypeId);
});

function calculateGrandTotal(totalAmount) {
    var grandTotal = 0;
    $('#append_price_section .total-price').each(function() {
        var amount = parseFloat($(this).data('amount')) || 0;
        grandTotal += amount;
    });

    if (grandTotal > 0) {
        var amountHtml = ` <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="left-part">Total</div>
                            <div class="right-part">
                                ₹ ${grandTotal}
                            </div>
                        </div>`;
    } else {
        var amountHtml = '';
    }
    $('#total-amount-text').html(amountHtml);

}

function calculateTotalRoomQuantity() {
    let totalQuantity = 0;
    document.querySelectorAll('input[name="quantity[]"]').forEach(input => {
        totalQuantity += parseInt(input.value) || 0;
    });

    if (totalQuantity > 0) {

        var totalNight = totalNights();
        var roomText = totalQuantity === 1 ? "room" : "rooms"; // Check for singular or plural
        var htmlRoomNight =
            `${totalQuantity} ${roomText} for ${totalNight} night${totalNight > 1 ? 's' : ''}`; // Check plural for nights
        $('#total-night-room').html(htmlRoomNight);
        $('#please-select').addClass('d-none');

    } else {
        $('#hide-section').addClass('d-none');
        $('#please-select').removeClass('d-none');
    }
}

$(document).ready(function() {
    const $imageItems = $("#hotel-images-container .image-item");
    const remaining = $imageItems.length;
    if ($imageItems.length > 4) {
        $imageItems.each(function(index) {
            if (index < 3) {
                // Show the first 4 images
                $(this).show();
            } else if (index === 3) {
                // Show the 5th image with "5+" overlay
                $(this).show();

                // Add overlay for the "5+"
                const overlay = `<div class="image-overlay">${remaining}+</div>`;
                $(this).find(".right-image").append(overlay);
            } else {
                // Hide the remaining images
                $(this).hide();
            }
        });
    }
});

function initializeSlider(forSelector, navSelector) {
    // console.log(forSelector, navSelector);
    if ($(forSelector).hasClass("slick-initialized")) {
        return;
    } else {
        // Main slider
        $(forSelector).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: '<i class="icon-left-open-1 arrow left-arrow"></i>',
            nextArrow: '<i class="icon-right-open-1 arrow right-arrow"></i>',
            asNavFor: navSelector,
            infinite: true,
            speed: 500,
            cssEase: "linear",
        });
    }
    if ($(navSelector).hasClass("slick-initialized")) {
        return;
    } else {
        $(navSelector).slick({
            slidesToShow: 9, // Default for larger screens
            slidesToScroll: 1,
            asNavFor: forSelector,
            dots: false,
            centerMode: true,
            focusOnSelect: true,
            infinite: true,
            centerPadding: "0px",
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 5
                    },
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3
                    },
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 3
                    },
                },
            ],
        });
    }
}

function setupSlider({
    spinner,
    forSelector,
    navSelector,
    closeButton
}) {
    $(spinner).show();
    $(forSelector + ", " + navSelector).hide();
    $(closeButton).addClass("hidden-btn");

    setTimeout(() => {
        $(spinner).fadeOut(500, () => {
            $(forSelector + ", " + navSelector).fadeIn();
            $(closeButton).removeClass("hidden-btn");
            initializeSlider(forSelector, navSelector);
        });
    }, 500);
}

function initializeMultipleSliders(sliderConfigs) {
    setupSlider(sliderConfigs);
}

$(document).ready(function() {
    $('#searchBtn').on('click', function() {
        $('#searchBtn').on('click', function() {
        var cityName = $('#data-city-name').data('city_name').toLowerCase();;
        var url = `{{ url('hotels-in-') }}${cityName}/`;
        $('#searchForm').attr('action', url);
        $('#searchForm').submit();
    });
    });

    $('body').on('click', 'a[data-bs-target="#exampleModalToggle3"]', function() {
        initializeMultipleSliders({
            spinner: "#loading-spinner",
            forSelector: ".slider-for-II",
            navSelector: ".slider-nav-II",
            closeButton: ".btn-close-II",
        });
    });

    // $('body').on('click', 'a[data-bs-target="#room-modal-data-1"]', function(){

    //     initializeMultipleSliders({
    //         spinner: "#loading-spinner-II",
    //         forSelector: ".slider-for-III",
    //         navSelector: ".slider-nav-III",
    //         closeButton: ".btn-close-III",
    //     });
    // });

    // Listen for clicks on gallery items
    $('body').on('click', 'a[data-bs-target^="#room-modal-data-"]', function() {
        const targetId = $(this).data('bs-target');
        const modalIndex = targetId.split('-').pop();
        initializeMultipleSliders({
            spinner: `#loading-spinner-${modalIndex}`,
            forSelector: `.slider-for-${modalIndex}`,
            navSelector: `.slider-nav-${modalIndex}`,
            closeButton: `.btn-close-${modalIndex}`,
        });

        // Show the modal
        $(targetId).modal('show');
    });

});

document.addEventListener("DOMContentLoaded", function() {
    const readMoreLinks = document.querySelectorAll('.read-more-toggle');

    readMoreLinks.forEach(link => {
        link.addEventListener('click', function() {
            const paragraph = this.previousElementSibling; // The paragraph element
            const fullText = paragraph.getAttribute(
                'data-full-text'); // Full text from the slick

            // Toggle the expanded state
            paragraph.classList.toggle('expanded');

            if (paragraph.classList.contains('expanded')) {
                // Expand to full text
                paragraph.textContent = fullText;
                this.textContent = 'Read Less';
            } else {
                // Collapse to truncated text
                paragraph.textContent = fullText.slice(0, 100) + '...';
                this.textContent = 'Read More';
            }
        });
    });
});
</script>
@endsection