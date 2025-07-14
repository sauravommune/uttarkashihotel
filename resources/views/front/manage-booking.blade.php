@php
use Carbon\Carbon;
@endphp

@extends('front.layouts.app')
@section('content')
<section class="section-11 dark-bg-back"></section>
<section class="section-13 py-xl-5 py-3 manage-booking">
    <div class="container py-xl-4 py-3">

        <div class="row">
            <div class="col-12">
                <div class="top-bar">
                    <div class="main-title">
                        <div class="d-xl-flex">
                            <div class="d-flex">
                                <div>
                                    <a href="javascript:void(0);" title="Back" onclick="window.history.back()"><span class="icon-left-3 pe-3"></span></a>
                                </div>
                                <div>
                                    <b>Booking Details</b>    
                                </div>
                            </div>
                            <div class="mx-xl-3 my-xl-0 my-2">
                                <span class="bg-light-gray">
                                    <span class="ques">ID:</span>
                                    <span class="ans">{{ $manageBooking['details']['booking_id'] ?? 'N/A' }}</span>
                                </span>    
                            </div>
                            <div>
                                <span class="bg-light-gray">
                                    <span class="ques">Date:</span>
                                    <span class="ans"> </span>
                                        @php
                                        $date = \Carbon\Carbon::parse($manageBooking['details']?->updated_at ?? now());
                                        $day = $date->day;
                                        $ordinal = match($day % 10) {
                                        1 => ($day % 100 == 11) ? 'th' : 'st',
                                        2 => ($day % 100 == 12) ? 'th' : 'nd',
                                        3 => ($day % 100 == 13) ? 'th' : 'rd',
                                        default => 'th',
                                        };
                                        @endphp
                                        {{ $date->format('M') }} {{ $day }}<sup>{{ $ordinal }}</sup>, {{ $date->year }}
                                </span>
                            </div>
                        </div>
                        
                    </div>
                    <div>
                        <a href="javascript:void(0);" class="btn btn-light-success primary-border"
                            title="Upcoming">Upcoming</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12  col-lg-12 col-xl-9">
                <div class="common mt-4">
                    <div class="space-box">
                        <div class="title">
                            <h4>Traveler Details </h4>
                        </div>
                    </div>
                    <div class="detail-section border-0 pb-0 pt-0">
                        <div class="main-wrapper border-0 m-0 pt-0 pb-0 p-0">
                            <div class="table-section">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">First Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Age</th>
                                                <th scope="col">Gender</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($manageBooking['details']['bookingTraveler'] as $traveler)
                                            <tr>
                                                @php
                                                    $age = isset($traveler->dob) 
                                                        ? (new DateTime())->diff(new DateTime($traveler->dob))->y 
                                                        : null;
                                                @endphp

                                                <td>{{ $traveler->name ?? 'N/A' }}</td>
                                                <td>{{ $traveler->email ?? 'N/A' }}</td>
                                                <td>{{ $age>0? $age.' years' : 'N/A' }}</td>
                                                <td>{{ $traveler->gender ?? 1 }}</td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hotel-detail-list">
                    <div class="space-box mt-4 mb-2 ">
                        <div class="title-card border-bottom-0">
                            <div class="my-xl-4 my-0 hotel-detail">
                                Hotel Details
                            </div>
                            <div class="hotel-details">
                                <div class="rating-part mt-xl-2">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">
                                            <div class="outer">
                                                <div class="name-add">
                                                    <div class="mt-3 mt-xl-0 hotel-name">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                {{ucwords($manageBooking['details']?->hotel->name??'')}}
                                                            </div>
                                                            <div class="rating-star ms-2">
                                                                <p><b>5</b><span class="bi bi-star-fill text-warning fs-6 ps-1 pe-2"></span><b>Property</b> </p>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <p class="py-xl-1 py-3">{{ucwords($manageBooking['details']?->hotel->address??'')}} India
                                                    </p>
                                                </div>
                                                <div class="rating-star">
                                                    @php
                                                    $rating =
                                                    intval(($manageBooking['details']?->hotel->rating) ?? 0);
                                                    @endphp
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
                                            @if ($manageBooking['details']?->hotel->google_rating > 0)
                                                <div class="rating-verify">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <img src="{{ asset('assets/front/images/google-image.png') }}" alt="">
                                                        </div>
                                                        <div class="ms-2 ">
                                                            <div class="g-rating"> Google Reviews </div>
                                                            <div class="d-flex align-items-center">
                                                                <div class="rating bg-remove-color ps-xl-0 ps-0">
                                                                    <div class="d-flex align-items-center">
                                                                        <div>
                                                                            <p class="mb-0">
                                                                                {{ $manageBooking['details']?->hotel->google_rating ?? '' }}/5
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            @php
                                                                                $rating = $manageBooking['details']?->hotel->google_rating;
                                                                                $full_star = floor($rating);
                                                                                $half_star =
                                                                                    $rating - $full_star >= 0.1 ? 1 : 0;
                                                                                $empty_star = 5 - ($full_star + $half_star);
                                                                            @endphp
                                                                            <div class="rating-star ps-3">
                                                                                @for ($i = 0; $i < $full_star; $i++)
                                                                                    <i
                                                                                        class="bi bi-star-fill text-warning"></i>
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
                                                                        @if($manageBooking['details']?->hotel->google_rating_total >0)
                                                                        <div class="reviews">
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="count-reviews px-2">{{$manageBooking['details']?->hotel->google_rating_total??''}}</div>
                                                                                <div class="reviews-text">Reviews</div>
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
                                </div>
                            </div>

                            @if(count($manageBooking['details']?->hotel->amenities) >0)
                            <div class="amenities-section">
                                <div class="ul-section mt-xl-3 mt-2">
                                    <ul>
                                        @foreach($manageBooking['details']?->hotel->amenities as $amenity)
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <span class="material-symbols-outlined fs-5 me-1">{{$amenity->amenityName->icode ??' spa'}}</span>
                                                </div>
                                                <div class="ps-1">
                                                    {{ucwords($amenity->amenityName->name)??""}}                                                
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif

                            <div class="row gx-0 box4">
                                <div class="col-md-3 col-12">
                                    <span class="heading">check-in</span>
                                    <span class="main no-repeat-text">{{ formatDateMdY($manageBooking['details']->check_in_date) }}  {{ $manageBooking['details']?->hotel?->check_in_time ?? '' }}</span>

                                </div>
                                <div class="col-md-3 col-12">
                                    <span class="heading">check-out</span>
                                    <span class="main no-repeat-text">{{ formatDateMdY($manageBooking['details']->check_out_date) }}   {{ $manageBooking['details']?->hotel?->check_out_time ?? '' }}                                    </span>

                                </div>
                                <div class="col-md-3 col-12">
                                    <span class="heading">guest</span>
                                    <span class="main">
                                        {{$manageBooking['details']['adult']}} {{ucfirst(adultText($manageBooking['details']['adult']))}}
                                        @if(!empty($manageBooking['details']['child']))
                                        {{$manageBooking['details']['child']}} Children
                                        @endif
                                    </span>
                                </div>
                                <div class="col-md-3 col-12">
                                    <span class="heading">stay</span>
                                    <span class="main">{{$manageBooking['totalRoom']??''}} {{ucfirst(roomText($manageBooking['totalRoom']))}}, {{$manageBooking['nights']??''}} {{ucfirst(nightText($manageBooking['nights']))}}</span>
                                </div>
                            </div>
                            <div class="room-details mt-4">
                                <div class="space-box">
                                    <div class="title-card border-0">
                                        <h4 class="mb-3">Room Details</h4>
                                    </div>
                                </div>
                            
                                <div class="detail-section">

                                    @foreach($manageBooking['details']->bookedRooms as $bookedRoom)
                                        <div class="main-wrapper shadow-sm">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="top-section-heading">
                                                    {{$bookedRoom->quantity??""}} X <span class="room_type">{{$bookedRoom->roomCategory?->name??""}} |  {{$bookedRoom->break_fast_type??""}}</span>
                                                </p>

                                            </div>
                                            <p class="pb-2">{{$bookedRoom->roomDetails->description??''}} </p>

                                            <div class="facilities">
                                                {{-- @php
                                                    $arrival_date = $bookedRoom->roomDetails?->arrival_date;
                                                    $check_in_date = formatDateMdY($manageBooking['details']->check_in_date);

                                                    $check_in_time =$manageBooking['details']?->hotel->check_in_time;
                                                    $cancel_booking =  $bookedRoom->roomDetails?->cancel_booking;

                                                    $data = cancellationPolicy(
                                                        $arrival_date,
                                                        $check_in_time,
                                                        $check_in_date,
                                                        $cancel_booking,
                                                    );
                                                @endphp

                                                @if ($data['noCancellation'] != 1)
                                                    <div>
                                                        <p class="free-cancellation"><span class="icon-check-custom pe-2"></span>{{ $data['text'] ?? '' }} </p>
                                                    </div>
                                                @endif  --}}

                                                @if(count($bookedRoom->roomDetails?->addAmenity)>0)
                                                <div class="d-xl-flex align-items-center justify-content-xl-between">
                                                    @foreach($bookedRoom->roomDetails->addAmenity as $key=> $amenity)
                                                    @if($key < 5)
                                                    <p class="facilities-available">{{ucwords($amenity->amenityName?->name??"")}}</p>
                                                    @endif
                                                    @endforeach
                                                </div>
                                                @endif
                                            </div>
                                            <div class="modal fade hotel-amenities" tabindex="-1" id="kt_modal_1">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header w-100">
                                                            <div class=" w-100 position-relative">
                                                                <h4 class="modal-title ">Room Amenities</h4>
                                                                <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="ul-section">
                                                                <ul class="p-0 m-0">
                                                                    @foreach($bookedRoom->roomDetails->addAmenity as  $totalAmenity)
                                                                        <li>{{ucwords($totalAmenity->amenityName->name??"")}}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" tabindex="-1" id="kt_modal_1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Room Amenities</h5>

                                                            <!--begin::Close-->
                                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                <i class="ki-duotone ki-cross fs-1"><span
                                                                        class="path1"></span><span class="path2"></span></i>
                                                            </div>
                                                            <!--end::Close-->
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="facilities">
                                                                <div class="row">
                                                                @foreach($bookedRoom->roomDetails->addAmenity as  $totalAmenity)
                                                                    <div class="col-md-4 col-12">
                                                                        <p class="facilities-available">{{ucwords($totalAmenity->amenityName->name??"")}}</p>
                                                                    </div>
                                                                    @endforeach

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            @if(!empty($manageBooking['details']['special_requirements']))
                            <div class="special-requirement">
                                <h4>Special Requests</h4>
                                <p>{{$manageBooking['details']['special_requirements']??""}} </p>
                            </div>
                            @endif

                            <div class="contact-information">
                                <h4 class="pb-xl-0 pb-4">Contact Information</h4>
                                <div class="detail-section border-0 pb-0 pt-xl-2 ">
                                    <div class="main-wrapper border-0 m-0 pt-0 pb-0 p-0">
                                        <div class="table-section">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">First Name</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Phone number</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ucwords($manageBooking['details']->bookingContact->name ??'')}}</td>
                                                            <td>{{$manageBooking['details']->bookingContact->email??''}}</td>
                                                            <td>+91 {{$manageBooking['details']->bookingContact->mobile??''}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                <div class="right-item-box">
                    <div class="main-title pb-0">
                        <a href="#" title=""><span class="icon-sleft-3 pe-3"></span></a><b>&nbsp;</b>
                    </div>

                    <div class="common-card mt-0">
                        <div class="inner">
                            <div class="space-box">
                                <div class="title-card mb-0">
                                    <h2>Fare Breakup</h2>
                                </div>
                            </div>
                            <div class="accordion-part pb-3">

                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item base-fare-icon">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <div class="d-flex justify-content-between w-100">
                                                    <div class="accordion-title">
                                                        Base Fare
                                                    </div>
                                                    {{-- <div class="total-price">
                                                        ₹ {{ _nf($manageBooking['details']?->bookedRooms->sum('total_price')) }}
                                                    </div> --}}
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                 @foreach ($manageBooking['details']?->bookedRooms as $room )    
                                                    <div class="d-flex justify-content-between base-fare mx-2">
                                                        <div>
                                                            <p>{{ $room->quantity }} {{ $room->roomCategory->name }} ({{ $room?->plan_name }}) x {{ $manageBooking['nights'] }} {{ ucfirst(nightText( $manageBooking['nights']))}}</p>
                                                        </div>
                                                        <div class="amount">
                                                            <span class="icon-rupee"></span>{{ _nf($room->total_price) }}
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $couponAmount = $manageBooking['details']?->transactions?->sum('coupon');
                                @endphp
                                <div class="coupon-div {{ $couponAmount > 0 ? '' : 'visibility-hidden' }}">
                                    <div class="d-flex justify-content-between mx-2 mt-2">
                                        <div>
                                            <p>Coupon Discount</p>
                                        </div>
                                        <div class="total-price text-success fw-bold coupon-discount">
                                            - {{ _nf($couponAmount) }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="bottom-box">
                                <div class="total-count">
                                    <div class="d-flex align-items-center justify-content-between w-100">
                                        <div class="text">
                                            Total Amount
                                        </div>
                                        <div class="amount">
                                            <span class="icon-rupee"></span>{{ _nf( $manageBooking['details']?->transactions->sum('amount') ) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="common-card mt-3">
                        <div class="inner">
                            <div class="space-box">
                                <div class="title-card mb-0">
                                    <h2>Payment Details</h2>
                                </div>
                            </div>
                            <div class="payment-data">
                                <div class="left">Payment Method</div>
                                <div class="right">{{ $manageBooking['details']?->payments?->payment_method??'Other' }}</div>
                            </div>
                            <div class="payment-data">
                                <div class="left">Payment Date</div>
                                <div class="right">{{ formatDateMdYHiA($manageBooking['details']?->payments?->created_at) }}</div>
                            </div>
                            <div class="payment-data">
                                <div class="left">Transaction ID</div>
                                <div class="right">{{ $manageBooking['details']?->payments?->payment_id }}</div>
                            </div>
                            <div class="btns">
                                <a href="{{ Route('download.invoice', encode($manageBooking['details']->id)) }}" class="btn btn-black download-invoice-btn">
                                    Download Receipt
                                    <span class="material-symbols-outlined">
                                        download
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
