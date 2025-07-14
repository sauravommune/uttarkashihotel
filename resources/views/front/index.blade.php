@php
use Carbon\Carbon;
@endphp

@extends('front.layouts.app')
@section('content')
<style type="text/css">
    .select2-container--open .select2-dropdown--below{
        top: -8px;
    }
    @media (max-width: 1200px) {
        .select2-container--open .select2-dropdown--below{
            top: -35px;
        }   
    }
</style>

<section class="section-1 lazy d-flex align-items-center bg-image-style " data-bg="{{ asset('assets/front/images/hotels-in-uttarkashi.webp') }}" id="book">
    <div class="container d-none d-sm-none d-md-none d-lg-none d-xl-block">
        <div class="row">
            <div class="col-12 col-xl-7 position-relative header-title">
                <h1 class="fs-5">Book Uttarkashi Hotels at Best Prices</h1>
                <h1 style="font-size: 44px;line-height: 68px;">Compare Rates, Check Amenities & <span>Reserve Trusted Stays Online</span></h1>
            </div>
        </div>
    </div>
</section>

<section class="search-section search-section-II search-section-III">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tab-content">
                    <div class="tab-pane active" id="self-booking">
                        @php
                            $selectedCityName = !empty($searchData['city_name']) ? $searchData['city_name'] : ($city['0']['name']??'');
                            $selectedStateName = !empty($searchData['state_name']) ? $searchData['state_name'] : ($city['0']['state']['name']??'');
                        @endphp

                        <form action="" method="post" id="searchForm">

                            <div class="row  g-0">
                                <div class="col-12 col-ms-12 col-md-12 col-lg-12 col-xl-3 repeat-section">
                                    <div class="search-item room-search">
                                        <div class="position-relative">
                                            <label for="exampleInputEmail1" class="form-label">City / Location</label>
                                            <h4 class="section-hotel origin-room" id="show-city">
                                                {{ ucwords($selectedCityName) }}, {{ ucwords($selectedStateName) }}
                                            </h4>
                                            <input type="hidden" name="cityId" value="{{ $searchData['city_id']?? $city['0']['id']??'' }}" id="setCityId" />
                                            <input type="hidden" name="status" value="Search" />
                                        </div>

                                        <div id="data-city-name" data-city_name="{{ $selectedCityName }}">
                                    </div>

                                        <div class="search-sections-part d-none">
                                            <div class="search-content-container" id="search-box-container">
                                                <ul>
                                                    <li class="searcher border-0">
                                                        <a href="javascript:void(0);">
                                                            <div class="d-flex justify-content-between w-100">
                                                                <input type="text" class="form-control-custom w-100 rounded search-depart" id="searchCity" placeholder="City..">
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <div id="notFoundMessage"></div>

                                                    @if (!empty($city))
                                                    @foreach ($city as $value)
                                                    <li class="clicker py-2" data-id="{{ $value->id }}">
                                                        <a href="javascript:void(0);">
                                                            <div class="d-flex justify-content-between w-100">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="icon">
                                                                        <span class="icon-location"></span>
                                                                    </div>
                                                                    <div class="text ms-3">
                                                                        <h5 class="city_name">
                                                                            {{ ucwords($value->name ?? '' )}}</h5>
                                                                        <p class="state_name">{{ucwords($value->state?->name ??"")}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="count d-block text-center">
                                                                    {{-- <p>{{ $value->get_hotel_count ?? 0 }}</p>
                                                                    <b>Hotels</b> --}}
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                    @endif

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12  col-md-12 col-lg-12 col-xl-2 repeat-section bg-white">
                                    <div class="search-item">
                                        <label for="checkInDate" class="form-label">Check In</label>
                                        @php
                                            $checkInDate = !empty($searchData['check_in_date']) ? Carbon::parse($searchData['check_in_date']) : Carbon::now()->addDays(2);
                                            $checkInValue = clone $checkInDate;
                                        @endphp
                                        <h4 class="section-hotel check-in"> {{ $checkInDate->format('F d, Y') }} </h4>
                                        <input type="hidden" class="form-control d-none" id="checkInDate" name="checkin_date" value="{{ $checkInValue->format('Y-m-d') }}" />
                                    </div>
                                </div>

                                <div class="col-12 col-12  col-md-12 col-lg-12 col-xl-2 repeat-section bg-white">
                                    <div class="search-item">
                                        <label for="checkout_date" class="form-label">Check out</label>
                                        @php
                                            $checkOutDate = !empty($searchData['check_out_date']) ? Carbon::parse($searchData['check_out_date']) : Carbon::now()->addDays(3);
                                            $checkOutValue = clone $checkOutDate;
                                        @endphp
                                        <h4 class="section-hotel check-out"> {{ $checkOutDate->format('F d, Y') }} </h4>
                                        <input type="hidden" class="form-control d-none" name="checkout_date" value="{{ $checkOutValue->format('Y-m-d') }}" />
                                    </div>
                                </div>

                                <div
                                    class="col-12 col-ms-12 col-md-12 col-lg-12 col-xl-2 repeat-section repeat-section-category  bg-white">
                                    <div class="search-item">
                                        <div>
                                            <label for="exampleInputEmail1" class="form-label">Category</label>
                                        </div>
                                        <select class="w-100 form-select category select2-class" id="rating"
                                            name="rating">
                                            <option value="0">All </option>
                                            <option value="3">3 Star</option>
                                            <option value="4">4 Star</option>
                                            <option value="5">5 Star</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-ms-12 col-md-12 col-lg-12 col-xl-2 repeat-section guest-select  bg-white">
                                    <div class="search-item position-relative">
                                        <label id="guest-label" for="guestInput" class="form-label">Rooms & Guests</label>

                                        <div class="dropdown-container">
                                            <input type="text" class="guest-input" value="Select Guests" aria-labelledby="guest-label" readonly />

                                            <div class="guest-dropdown dropdown">
                                                <div class="guest-category">
                                                    <span>Rooms</span>
                                                    <div class="controls d-flex">
                                                        <a class="room-decrement decrement" data-type="room">-</a>
                                                        <span class="room-count">1</span>
                                                        <a class="room-increment increment" data-type="room">+</a>
                                                    </div>
                                                </div>
                                                <div class="guest-category">
                                                    <span>Adults</span>
                                                    <div class="controls d-flex">
                                                        <a class="adult-decrement decrement" data-type="adult">-</a>
                                                        <span class="adult-count">1</span>
                                                        <a class="adult-increment increment" data-type="adult">+</a>
                                                    </div>
                                                </div>
                                                <div class="guest-category">
                                                    <span>Children</span>
                                                    <div class="controls d-flex">
                                                        <a class="child-decrement decrement" data-type="child">-</a>
                                                        <span class="child-count">0</span>
                                                        <a class="child-increment increment" data-type="child">+</a>
                                                    </div>
                                                </div>
                                                <div class="age-selector"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="traveler-container">
                                        <input type="hidden" name="roomCount"
                                            class="room-count-input" value="{{ $searchData?->roomCount ?? 1}}">
                                        <input type="hidden" name="adultCount"
                                            class="adult-count-input" value="{{ $searchData?->adultCount ?? 1 }}">

                                        <input type="hidden" name="childCount"
                                            class="child-count-input" value="{{ $searchData?->childCount ?? 0}}">

                                    </div>

                                </div>
                                @csrf()

                                <div class="col-12 col-ms-12 col-md-12 col-lg-12 col-xl-1 repeat-section">
                                    <div class="search-item">
                                        <button id="searchBtn" type="button" class="btn btn-outline-primary d-flex"
                                            title="Search"><span class="icon-search-1 pe-2"></span>Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- <section class="section-bg lazy" data-bg="{{ asset('assets/front/images/section-shape-2.png') }}"> </section> -->
<section class="section-2">
    <div class="container pt-xl-5 pt-1 ">
        <div class="row">
            <div class="col-12">
                <div class="bg-section primary-bg  lazy bg-image-style px-4"
                    data-bg="{{ asset('assets/front/images/section-bg.webp') }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="" id="discound-slider-II">
                                <div class="repeat-section">
                                    <div class="main-area py-4 position-relative mobile-device">
                                        <div class="d-flex align-items-center">
                                            <div class="box">
                                                <div class="icon">
                                                    <span class="icon-check"></span>
                                                </div>
                                            </div>
                                            <div class="text">
                                                <p class="ps-xl-3 ps-3">Most hotels are fully refundable. Because flexibility matters.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="repeat-section">
                                    <div class="main-area py-xl-4 py-md-0 pt-lg-0 py-md-4 py-4 position-relative mobile-device px-xl-4 px-0">
                                        <div class="d-flex align-items-center ">
                                            <div class="box">
                                                <div class="icon">
                                                    <span class="icon-percent-1"></span>
                                                </div>
                                            </div>
                                            <div class="text">
                                                <p class="ps-xl-3 ps-3">Save upto 30% or more on over 1,000 hotels in India.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="repeat-section">
                                    <div class="main-area py-4 position-relative mobile-device  px-xl-4 px-0">
                                        <div class="d-flex align-items-center ">
                                            <div class="box">
                                                <div class="icon">
                                                    <span class="icon-lock"></span>
                                                </div>
                                            </div>
                                            <div class="text">
                                                <p class="ps-xl-3 ps-3">Unlock hot deals & Hotels from our wide variety of
                                                    Hotels</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 repeat-section">
                            <div class="main-area py-4 position-relative mobile-device">
                                <div class="d-xl-flex align-items-xl-center ">
                                    <div class="box">
                                        <div class="icon">
                                            <span class="icon-check"></span>
                                        </div>
                                    </div>

                                    <div class="text">
                                        <p class="ps-xl-3">Most hotels are fully refundable. Because flexibility
                                            matters.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 repeat-section">
                            <div class="main-area py-xl-4 py-md-0 pt-lg-0 py-2 position-relative mobile-device">
                                <div class="d-xl-flex align-items-xl-center ">
                                    <div class="box">
                                        <div class="icon">
                                            <span class="icon-percent-1"></span>
                                        </div>
                                    </div>
                                    <div class="text">
                                        <p class="ps-xl-3">Save upto 30% or more on over <br>1,000 hotels in India.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 repeat-section">
                            <div class="main-area py-4 position-relative mobile-device">
                                <div class="d-xl-flex align-items-xl-center ">
                                    <div class="box">
                                        <div class="icon">
                                            <span class="icon-lock"></span>
                                        </div>
                                    </div>
                                    <div class="text">
                                        <p class="ps-xl-3">Unlock hot deals & Hotels <br> from our wide variety of
                                            Hotels & Resorts</p>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-4 py-xl-3 py-3">
    <div class="container py-xl-3 py-3">
        <div class="row">
            <div class="col-12">
                <div class="d-xl-flex justify-content-xl-between align-items-xl-center w-100">
                    <div class="section-title">
                        <h2>Discover the Divine Beauty of Uttarkashi with Hottel</h2>
                        <p>Hottel - Unveil the Sacred Charm of Uttarkashi with Hottel</p>
                    </div>
                    <!-- <div class="pt-xl-0 pt-3">
                        <a href="#" title="View All" class="btn btn-primary">View All</a>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="row pt-4 mt-1">
            <div class="col-12">
                <div class="" id="destination-slider">
                    <div class="main-box">
                        <a href="javascript:void(0);">
                            <div class="image bg-image-style lazy"
                                data-bg="{{ asset('assets/front/images/Dayara-Bugyal.webp') }}"></div>
                            <div class="content mb-0 pb-0">
                                <h3>Dayara Bugyal</h3>
                                <p class="mb-0">Dayara Bugyal is a picturesque alpine meadow in Uttarakhand, known for lush greenery, panoramic Himalayan views, and ideal trekking trails.</p>
                            </div>
                        </a>
                    </div>
                    <div class="main-box">
                        <a href="javascript:void(0);">
                            <div class="image bg-image-style lazy"
                                data-bg="{{ asset('assets/front/images/gomukh-glacier.webp') }}"></div>
                            <div class="content mb-0 pb-0">
                                <h3>Gangotri Glacier</h3>
                                <p class="mb-0">Gangotri Glacier is a majestic Himalayan glacier in Uttarakhand, the source of the Ganges River, surrounded by breathtaking snow-capped peaks.</p>
                            </div>
                        </a>
                    </div>
                    <div class="main-box">
                        <a href="javascript:void(0);">
                            <div class="image bg-image-style lazy"
                                data-bg="{{ asset('assets/front/images/Hanuman-Chatti.webp') }}"></div>
                            <div class="content mb-0 pb-0">
                                <h3>Kedarkantha</h3>
                                <p class="mb-0">Kedarkantha is a stunning Himalayan peak in Uttarakhand, popular for trekking, offering scenic views, snow-covered trails, and adventure.</p>
                            </div>
                        </a>
                    </div>
                    <div class="main-box">
                        <a href="javascript:void(0);">
                            <div class="image bg-image-style lazy"
                                data-bg="{{ asset('assets/front/images/uttarkashi-vishwanath.webp') }}"></div>
                            <div class="content mb-0 pb-0">
                                <h3>Shree Kashi Vishwanath Temple</h3>
                                <p class="mb-0">Shree Kashi Vishwanath Temple in Uttarkashi is a sacred Hindu shrine dedicated to Lord Shiva, revered for its spiritual significance.</p>
                            </div>
                        </a>
                    </div>
                    <div class="main-box">
                        <a href="javascript:void(0);">
                            <div class="image bg-image-style lazy"
                                data-bg="{{ asset('assets/front/images/eco-lodge-at-dodital.webp') }}"></div>
                            <div class="content mb-0 pb-0">
                                <h3>Dodi Tal Lake</h3>
                                <p class="mb-0">Dodi Tal Lake is a serene freshwater lake in Uttarakhand, surrounded by pine forests and known for its crystal-clear waters.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-5 my-xl-4 my-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="image bg-image-style lazy" data-bg="{{ asset('assets/front/images/hotels-in-uttarkashi-1.webp') }}">
                    <div class="content">
                        <div>
                            <div class="short-logo">
                                <img decoding="async"  class="lazy" data-src="{{ asset('assets/front/images/Uttarkashi-hotel-Icon-WH.png') }}" width="150"
                                    height="" alt="" />
                            </div>
                            <h4 class="text-white" style="font-size: 24px;">
                                Ready to check in to your next adventure?
                            </h4>
                            <p class="text-white" style="font-size: 16px;">Don’t just book it, crook it with us for a steal of a deal!</p>
                            <a class="btn btn-outline-primary mt-3" title="BookNow" href="#book">
                                Book Now <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-6 py-xl-3 py-3">
    <div class="container py-xl-3 py-3">
        <div class="row">
            <div class="col-12">
                <div class="image bg-image-style lazy py-xl-5 py-4 px-xl-5 px-3"
                    data-bg="{{ asset('assets/front/images/on-the-way-to-vasudhara.jpg') }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-xl-flex justify-content-between align-items-xl-center w-100">
                                <div class="section-title">
                                    <h2>Stay at the Top Hotels in Uttarkashi</h2>
                                    {{-- <p>Experience the Comfort of Varanasi’s Most Popular Hotels – Handpicked for You!  {{$popularHotel['0']->cityName->state->name??''}}</p> --}}
                                    <p>Experience the Comfort of Uttarkashi Most Popular Hotels – Handpicked for You!</p>
                                </div>
                                <!-- <div class="pt-xl-0 pt-3">
                                    <a href="#" title="View All" class="btn btn-primary">View All</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4 mt-2">
                        <div class="col-12">
                            @if(count($popularHotel)>0)
                            <div class="" id="slider-II"> 
                                @foreach($popularHotel as $hotel)

                                @if($hotel?->room->plan?->total_amount_ep > 0)
                                  @php
                                    if (!empty($hotel->hotelImg->image) || !empty($hotel?->hotel_img)){
                                        $hotelImg = $hotel?->hotel_img?$hotel?->hotel_img:$hotel->hotelImg->image;
                                        $img = asset('storage/' .$hotelImg);
                                    }else{
                                        $img = asset('assets/media/no-hotel-img.svg');
                                    }
                                @endphp
                                 <div class="main-slider">
                                    <a href="{{ route('hotel.details', ['slug' => $hotel?->slug]) }}/">
                                        <div class="card-bg bg-image-style lazy" data-bg="{{$img}}">
                                            <div class="off position-absolute mt-0">
                                                Upto 20% OFF
                                            </div>
                                            <div class="hotels-details">
                                                <div class="d-flex align-items-center pb-1 off off-II pt-1 pb-1 mb-2">
                                                    <div class="icon">
                                                        <i class="bi bi-geo-alt-fill"></i>
                                                    </div>
                                                    <div>
                                                        <span class="pb-0 ps-1">{{ucwords($hotel->cityName->name??"")}}</span>
                                                    </div>
                                                </div>
                                                <h3>{{ucwords($hotel?->name??"")}}</h3>
                                                @if($hotel?->google_rating>0)
                                                    <div class="d-flex align-items-center py-1">
                                                        <div>
                                                            <img width="25px" height="25px" src="{{ asset('assets/front/images/google-image.png') }}" alt="">
                                                        </div>
                                                        <div class="ps-2">
                                                            <small>{{$hotel?->google_rating??0}}/5 based on {{$hotel?->google_rating_total>0?$hotel?->google_rating_total:1}} reviews</small>
                                                        </div>
                                                    </div>
                                                
                                                @endif
                                                <div class="price">₹ {{(int)$hotel?->room->plan?->total_amount_ep??00.00}} <span> per night</span></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endif
                                
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <section class="section-7 py-xl-3 py-3">
    <div class="container py-xl-3 py-3">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div class="section-title">
                        <h2>Upcoming Locations</h2>
                        <p>Other Cities We'll be Adding Just for You!</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="row pt-4 mt-1">            
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-xl-4 mb-4">
                <div class="main-box">
                    <a href="javascript:void(0);">
                        <div class="image bg-image-style lazy"
                            data-bg="{{ asset('assets/front/images/mathura.webp') }}">
                            <div class="content">
                                <h3>Mathura</h3>
                                <p>250 properties</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-xl-4 mb-4">
                <div class="main-box">
                    <a href="javascript:void(0);">
                        <div class="image bg-image-style lazy"
                            data-bg="{{ asset('assets/front/images/vrindavan.webp') }}">
                            <div class="content">
                                <h3>Vrindavan</h3>
                                <p>125 properties</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-xl-4 mb-4">
                <div class="main-box">
                    <a href="javascript:void(0);">
                        <div class="image bg-image-style lazy"
                            data-bg="{{ asset('assets/front/images/delhi.webp') }}">
                            <div class="content">
                                <h3>Delhi</h3>
                                <p>428 properties</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-xl-4 mb-4">
                <div class="main-box">
                    <a href="javascript:void(0);">
                        <div class="image bg-image-style lazy"
                            data-bg="{{ asset('assets/front/images/mumbai.webp') }}">
                            <div class="content">
                                <h3>Mumbai</h3>
                                <p>230 properties</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<section class="section-8 lazy bg-image-style section-8-II" data-bg="{{ asset('assets/front/images/hotels-in-uttarkashi-2.webp') }}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Ready to check in to your next adventure?</h2>
                    <p class="pt-3 text-black">Book now and leave your worries at the door - we've got the perfect stay just a
                        click away!</p>
                    <!-- <a href="javascript:void(0);" class="btn btn-outline-primary">Learn More <span
                            class="icon-right-open-1"></span></a> -->
                    <a class="btn btn-outline-primary mt-3" title="BookNow" href="#book">
                        Book Now <i class="bi bi-arrow-up-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
    <script>
    $(document).ready(function() {
        $('#searchBtn').on('click', function() {
            var rating = $('#rating').val();
            var cityName = $('#data-city-name').data('city_name').toLowerCase();
            if (rating > 0) {
                var url = `{{ url('${rating}-star-hotels-in-') }}${cityName}/`;
            } else {
                var url = `{{ url('hotels-in') }}-${cityName}/`;
            }
            $('#searchForm').attr('action', url);
            $('#searchForm').submit();
        });
        
    });
    
    </script>
   @if (session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.success('{{ session('status') }}', 'Success', {
                closeButton: true,
                progressBar: true,
                timeOut: 5000,
                extendedTimeOut: 2000,
                positionClass: 'toast-top-right'
            });
        });
    </script>
@endif

@endsection