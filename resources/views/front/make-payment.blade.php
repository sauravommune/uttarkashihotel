@php
use Carbon\Carbon;
@endphp
@extends('front.layouts.app')
@section('content')
    
<section class="section-9 py-lg-4 py-4">
    <div class="container">
        <div class="row">
            <div class="col-8 d-flex align-items-center">
                <div class="breadcrumb-section">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Hotel Selection</a></li>
                            <li class="breadcrumb-item"><a href="#">Guest Details</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Review & Make Payment</li>
                        </ol>
                    </nav>
                </div>
            </div>
        
        </div>
    </div>
</section>

<section class="section-13 pb-xl-5 pb-3 make-payment">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">
                
                <div class="title-card">
                    <div class="d-flex justify-dcontent-between align-items-center w-100">
                        <div class="icons">
                            <span class="fa fa-user"></span>
                        </div>
                        <div class="ps-2">
                            <h4 class="py-xl-4 py-3">Traveler Details</h4>    
                        </div>
                    </div>
                </div>
            
                <div class="common common-card">
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
                                            @forelse ($bookingDetails->travelers as $traveler)
                                                <?php
                                                    $dob = new DateTime($traveler->dob);
                                                    $today = new DateTime();
                                                    $age = $today->diff($dob)->y;
                                                ?>
                                                <tr>
                                                    <td>{{ ucwords($traveler?->name) ?? '' }}</td>
                                                    <td>{{ $traveler?->email ?? 'N/A' }}</td>
                                                    <td>{{ $age > 0 ? $age : 1 }}</td>
                                                    <td>{{ ucwords($traveler->gender) ?? '' }}</td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="title-card mt-4">
                    <div class="d-flex justify-dcontent-between align-items-center w-100">
                        <div class="icons">
                            <span class="bi bi-buildings"></span>
                        </div>
                        <div class="ps-2">
                            <h4 class="py-xl-4 py-3">Hotel Details</h4>    
                        </div>
                    </div>
                </div>
                <div class="common-card ">
                    <div class="hotel-detail-list">
                    <div class="space-box">
                        <div class="title-card pb-0 border-0">
                            <div class="rating-part">
                                <div class="">
                                    <div class="d-flex align-items-xl-center">
                                        <div class="mt-2 mt-xl-0 marriott">

                                            {{ ucwords($bookingDetails?->hotel?->name) }}
                                        </div>
                                        <div class="star-rating-area mt-1 mt-xl-0">
                                           

                                            @if($bookingDetails?->hotel->rating >0)
                                            {{-- <div class="rating-star">
                                                <p><b>{{intval($bookingDetails?->hotel->rating) ??''}}</b><span class="bi bi-star-fill text-warning fs-10 pe-2"></span><b>Property</b> </p>
                                            </div> --}}
                                            @endif
                                        </div>
                                    </div>
                               
                                </div>
                            </div>

                            @if(count($bookingDetails?->hotel?->amenities)>0)
                            <div class="amenities-section  mt-2">

                                <div class="my-2 d-lg-flex justify-content-start">

                                    @foreach ($bookingDetails?->hotel?->amenities as $amenity)
                                        <div class="pe-xl-3 pe-2 pb-xl-0 pb-2">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <span class="material-symbols-outlined fs-5 me-1">{{$amenity->amenityName->icode?? 'spa'}}</span>                                                </div>
                                                <div class="ps-1 amenity-name">
                                                {{ ucwords($amenity?->amenityName->name) }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    

                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    </div>
                </div>

                <div class="title-card mt-4">
                    <div class="d-flex justify-dcontent-between align-items-center w-100">
                        <div class="icons">
                            <span class="fa fa-bed"></span>
                        </div>
                        <div class="ps-2">
                            <h4 class="py-xl-4 py-3">Room Details</h4>    
                        </div>
                    </div>
                </div>

                <div class="common-card">
                    <div class="detail-section">
                        <div class="main-wrapper">
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-3 mt-3 mt-xl-0">
                                    <div class="hotel-part">
                                        <div class="d-flex">
                                            <div class="icon">
                                                <span class="icon-door-open"></span>
                                            </div>
                                            <div class="text ps-1">
                                                <small>check-in</small>
                                            </div>
                                            @php

                                            @endphp
                                        </div>
                                        <div class="main-date mt-1">
                                            {{ formatDateMdY($bookingDetails->check_in_date) }}
                                            <span class="ms-1">{{ $bookingDetails?->hotel?->check_in_time ?? '' }}</span>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-3 mt-3 mt-xl-0">
                                    <div class="hotel-part">
                                        <div class="d-flex">
                                            <div class="icon">
                                                <span class="icon-door-open"></span>
                                            </div>
                                            <div class="text ps-1">
                                                <small>check-out</small>
                                            </div>
                                        </div>
                                        <div class="main-date mt-1">
                                            {{ formatDateMdY($bookingDetails->check_out_date) }}
                                            <span class="ms-1">{{ $bookingDetails?->hotel?->check_out_time ?? '' }}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-3 mt-xl-0 ">
                                    <div class="hotel-part">
                                        <div class="d-flex">
                                            <div class="icon">
                                                <span class="icon-bed-profile"></span>
                                            </div>
                                            <div class="text ps-1">
                                                <small>Stay</small>
                                            </div>
                                        </div>

                                        <div class="main-date mt-1">
                                            {{ $bookingDetails->total_guest }} {{ucfirst(guestText($bookingDetails->total_guest))}} |
                                            {{ $bookingDetails->bookedRooms->sum('quantity') }}  {{ucfirst(roomText($bookingDetails->bookedRooms->sum('quantity')))}} |
                                            {{ $nights}} {{ucfirst(nightText($nights))}} 

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($roomDetails as $room)

                        <div class="main-wrapper">
                            <div class="">
                                <div>
                                    <h4>{{$room?->quantity}} x {{$room->roomCategory?->name}} |
                                        {{$room?->break_fast_type}}</h4>
                                    <ul>
                                        <li>{{$room?->roomDetails?->room_size}} {{$room?->roomDetails?->measure}}
                                            with room .</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

                <div class="title-card mt-4">
                    <div class="d-flex justify-dcontent-between align-items-center w-100">
                        <div class="icons">
                            <span class="fa fa-file-text"></span>
                        </div>
                        <div class="ps-2">
                            <h4 class="py-xl-4 py-3">Special Requests</h4>    
                        </div>
                    </div>
                </div>
                <div class="common-card">
                    <div class="hotel-detail-list">
                        <div class="space-box">
                            <div class="title-card border-0">
                                <p class="pt-2">No special requests on this booking</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="title-card mt-4">
                    <div class="d-flex justify-dcontent-between align-items-center w-100">
                        <div class="icons">
                            <span class="fa fa-user"></span>
                        </div>
                        <div class="ps-2">
                            <h4 class="py-xl-4 py-3">Contact Information</h4>    
                        </div>
                    </div>
                </div>

                <div class="common-card" id="payment">
                    <div class="detail-section border-0 pb-0">
                        <div class="main-wrapper border-0 m-0 pt-0 ps-0 pb-0">
                            <div class="table-section">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">phone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ ucwords($bookingDetails?->contactInfo?->name) ?? '' }}
                                                </td>
                                                <td>{{ $bookingDetails?->contactInfo?->email }}
                                                </td>
                                                <td>{{ $bookingDetails?->contactInfo?->mobile }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="payment-options">
                    <div>
                    <div class="d-block d-sm-block d-md-block d-lg-block d-xl-none">
                            <div class="box-right-main">
                                <div class="right-item-box mb-3">
                                    <div class="main-card-box border-0">
                                        <div class="common-card bg-white custom-border  border-radius-bottom border-bottom-0 pb-xl-3 pb-0">
                                            <div class="accordion-part">
                                                <div class="accordion" id="accordionExample">
                                                    <div class="accordion-item base-fare-icon">
                                                        <h2 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                                aria-controls="collapseOne">
                                                                <div class="d-flex justify-content-between w-100 mx-2">
                                                                    <div class="accordion-title">
                                                                        Base Fare
                                                                        {{-- <small class="ps-2">(Collected for Hotel)</small> --}}
                                                                    </div>
                                                                    {{-- <div class="total-price">
                                                                        ₹ {{ _nf($bookingDetails?->bookedRooms->sum('total_price'))??'N/A' }}
                                                                    </div> --}}
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                @foreach ($bookingDetails?->bookedRooms as $room )    
                                                                    <div class="d-flex justify-content-between base-fare mx-2">
                                                                        <div>
                                                                            <p>{{ $room->quantity }} {{ $room->roomCategory?->name }} ({{ $room?->plan_name }}) x {{$nights}} {{ucfirst(nightText($nights))}}</p>
                                                                        </div>
                                                                        <div class="amount">
                                                                            <span class="icon-rupee"></span> <span class="total-price">{{ _nf($room->total_price) }}</span>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                        <div class="total-box border-radius-0 stroke-border">
                                            <div class="bottom-box">
                                                <div class="d-flex align-items-center justify-content-between w-100">
                                                    <div class="text">
                                                        Total Amount
                                                    </div>
                                                    <div class="amount">
                                                        <span class="icon-rupee"></span> <span class="payable-amount">{{ _nf($totalPayableAmount) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <a href="#payment" class="btn btn-outline-primary d-block mt-3  mx-0"
                                        type="Make Payment">Make Payment</a> --}}
                                </div>

                                @if( $coupons->count() > 0 )
                                <div class="right-item-box coupons-section">
                                    <div class="common-card">
                                        <div class="space-box">
                                            <div class="title-card mb-0">
                                                <div class="title-card ps-0 border-0 pb-0">Coupons & Offers</div>
                                                <input type="hidden" name="booking_id" value="{{ base64_encode($bookingDetails['booking_id']) }}" />
                                            </div>
                                        </div>
                                        <div class="coupon-section">
                                            {{-- <div class="box">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="coupon_code" id="" placeholder="Have a coupon code?">
                                                </div>
                                                <div>
                                                    <button type="button" class="apply-coupon-btn" data-action="apply">Apply</button>
                                                </div>
                                            </div> --}}
                                        </div>

                                        @forelse ($coupons as $coupon)
                                            <div class="coupon-list">
                                                <div class="d-flex align-items-center">
                                                    <div class="img">
                                                        <img data-src="{{ asset('assets/front/images/logo-img.png') }}" class="lazy">
                                                    </div>
                                                    <div class="text ps-2 d-flex justify-content-between align-items-center w-100">
                                                        {{ $coupon->title }}
                                                        <a href="javascript:void(0);" class="remove-coupon-btn text-danger {{ $bookingDetails?->coupon_id == $coupon?->id ? '' : ' visibility-hidden'}}" title="Click to Remove" data-coupon="{{encode($coupon?->id)}}" data-action="remove">-remove</a>
                                                    </div>
                                                </div>
                                                <p>{{ $coupon->description }}</p>
                                                <div class="coupan-name mt-3">
                                                    <div class="d-flex justify-content-between align-items-center w-100">
                                                        <div class="d-flex align-items-center justify-content-between w-100">
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);">
                                                                    <div class="coupan-one">
                                                                        {{ $coupon->code }}
                                                                    </div>
                                                                </a>
                                                                <div class="save-mony ps-3">
                                                                    @if( $coupon->type == 'percent' )
                                                                        Save ₹{{ ($totalPayableAmount * $coupon->value)/100 }}
                                                                    @else
                                                                        Save ₹{{ $coupon->value }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <button type="button" class="btn {{ $bookingDetails?->coupon_id == $coupon?->id ? 'btn-success' : 'btn-black' }} apply-coupon-btn" title="Click to Apply" data-coupon="{{encode($coupon?->id)}}" data-action="apply">{{ $bookingDetails?->coupon_id == $coupon?->id ? 'Applied' : 'Apply'}}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p>No Coupons Found</p>
                                        @endforelse

                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="title-card mt-4 mb-xl-0 mb-2">
                            <div class="d-flex justify-dcontent-between align-items-center w-100">
                                <div class="icons">
                                    <span class="fa fa-inr"></span>
                                </div>
                                <div class="ps-2">
                                    <h4 class="py-xl-4 py-3"> Select Payment Method</h4>    
                                </div>
                            </div>
                        </div>
                        

                        <div class="payment-section">
                            <form>
                                <div class="form-check ps-0 active">
                                    <div class="d-flex align-items-center justify-content-between w-100 ">
                                        <div class="d-block w-100">
                                            <div class="icon" class="w-100">
                                                <label class="form-check-label w-100 py-3 ps-xl-3 ps-2" for="upi">
                                                    <img src="{{ asset('assets/front/images/bhim-upi.svg') }}" class="pe-2" alt="">
                                                    UPI
                                                </label>
                                            </div>
                                        </div>
                                        <div class="pe-xl-3 pe-2">
                                            <input class="form-check-input " type="radio" name="paymentMethod" id="upi" value="upi" checked />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check ps-0">
                                    <div class="d-flex align-items-center justify-content-between w-100 ">
                                        <div class="w-100 d-block">
                                            <label class="form-check-label w-100 py-3 ps-xl-3 ps-2" for="card">
                                                <img src="{{ asset('assets/front/images/add_card.svg') }}" class="pe-2" alt="">
                                                Debit/Credit Card
                                            </label>
                                        </div>
                                        <div class="pe-xl-3 pe-2">
                                            <input class="form-check-input " type="radio" name="paymentMethod" id="card" value="card" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check payment-text ps-0">
                                    <div class="d-flex align-items-center justify-content-between w-100">
                                        <div class="w-100 d-block">
                                            <label class="form-check-label w-100 py-3 ps-xl-3 ps-2" for="netBanking">
                                                <img src="{{ asset('assets/front/images/assured_workload.svg') }}" class="pe-2" alt="">
                                                Net Banking
                                            </label>
                                        </div>
                                        <div class="pe-xl-3 pe-2">
                                            <input class="form-check-input " type="radio" name="paymentMethod" id="netBanking" value="netBanking">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-check payment-text ps-0">
                                    <div class="d-flex align-items-center justify-content-between w-100">
                                        <div class="w-100 d-block">
                                            <label class="form-check-label w-100 py-3 ps-xl-3 ps-2" for="wallet">
                                                <img src="{{ asset('assets/front/images/savings.svg') }}" class="pe-2" alt="">
                                                Wallet
                                            </label>
                                        </div>
                                        <div class="pe-xl-3 pe-2">
                                            <input class="form-check-input " type="radio" name="paymentMethod" id="wallet" value="wallet">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-check payment-text ps-0">
                                    <div class="d-flex align-items-center justify-content-between w-100">
                                        <div class="w-100 d-block">
                                            <label class="form-check-label w-100 py-3 ps-xl-3 ps-2" for="payLater">
                                                <img src="{{ asset('assets/front/images/checkbook.svg') }}" class="pe-2" alt="">
                                                Pay Later
                                            </label>
                                        </div>
                                        <div class="pe-xl-3 pe-2">
                                            <input class="form-check-input " type="radio" name="paymentMethod" id="payLater" value="payLater">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-outline-primary mx-1 my-3 " id="PayNow" data-booking_id="{{ base64_encode($bookingDetails['booking_id']) }}">
                                        <div class="d-flex align-items-center justify-content-between w-100 price-btn">
                                            <div>
                                                <p class="payment-method">Pay Via 'UPI'</p>
                                            </div>
                                            <div class="mt-2">
                                                <span class="fa fa-forward material-icons"></span> 
                                            </div>
                                            <div class="final-price">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        ₹ <span class="total-price payable-amount">{{ _nf($totalPayableAmount)}}</span>
                                                    </div>
                                                   
                                                </div>

                                                 
                                            </div>
                                        </div>
                                    </button>
                                </div>
                                
                            </form>
                           
                        </div>
                         <div class="payment-img  d-block d-xl-none">
                                <div>
                                    <img src="http://hottel.test/assets/front/images/guaranteed.png" alt="" width="w-100" title="Guaranteed Image">
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 d-none d-sm-none d-md-none d-lg-none d-xl-block">
                <div class="box-right-main">
                    <div class="right-item-box mb-3">
                        <div class="main-card-box border-0">
                            <div class="common-card bg-white custom-border  border-radius-bottom border-bottom-0 pb-xl-3 pb-0">
                                <div class="accordion-part">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item base-fare-icon">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    <div class="d-flex justify-content-between w-100 mx-2">
                                                        <div class="accordion-title">
                                                            Base Fare
                                                            {{-- <small class="ps-2">(Collected for Hotel)</small> --}}
                                                        </div>
                                                        {{-- <div class="total-price">
                                                            ₹ {{ _nf($bookingDetails?->bookedRooms->sum('total_price'))??'N/A' }}
                                                        </div> --}}
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    @foreach ($bookingDetails?->bookedRooms as $room )    
                                                        <div class="d-flex justify-content-between base-fare mx-2">
                                                            <div>
                                                                <p>{{ $room->quantity }} {{ $room->roomCategory?->name }} ({{ $room?->plan_name }}) x {{$nights}} {{ucfirst(nightText($nights))}}</p>
                                                            </div>
                                                            <div class="amount">
                                                                <span class="icon-rupee"></span> <span class="total-price">{{ _nf($room->total_price) }}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                            <div class="total-box border-radius-0 stroke-border">
                                <div class="bottom-box">
                                    <div class="d-flex align-items-center justify-content-between w-100">
                                        <div class="text">
                                            Total Amount
                                        </div>
                                        <div class="amount">
                                            <span class="icon-rupee"></span> <span class="payable-amount">{{ _nf($totalPayableAmount) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#payment" class="btn btn-outline-primary d-block mt-3  mx-0"
                            type="Make Payment">Make Payment</a>
                    </div>

                    @if( $coupons->count() > 0 )
                    <div class="right-item-box coupons-section">
                        <div class="common-card">
                            <div class="space-box">
                                <div class="title-card mb-0">
                                    <div class="title-card ps-0 border-0 pb-0">Coupons & Offers</div>
                                    <input type="hidden" name="booking_id" value="{{ base64_encode($bookingDetails['booking_id']) }}" />
                                </div>
                            </div>
                            <div class="coupon-section">
                                {{-- <div class="box">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="coupon_code" id="" placeholder="Have a coupon code?">
                                    </div>
                                    <div>
                                        <button type="button" class="apply-coupon-btn" data-action="apply">Apply</button>
                                    </div>
                                </div> --}}
                            </div>

                            @forelse ($coupons as $coupon)
                                <div class="coupon-list">
                                    <div class="d-flex align-items-center">
                                        <div class="img">
                                            <img data-src="{{ asset('assets/front/images/logo-img.png') }}" class="lazy">
                                        </div>
                                        <div class="text ps-2 d-flex justify-content-between align-items-center w-100">
                                            {{ $coupon->title }}
                                            <a href="javascript:void(0);" class="remove-coupon-btn text-danger {{ $bookingDetails?->coupon_id == $coupon?->id ? '' : ' visibility-hidden'}}" title="Click to Remove" data-coupon="{{encode($coupon?->id)}}" data-action="remove">-remove</a>
                                        </div>
                                    </div>
                                    <p>{{ $coupon->description }}</p>
                                    <div class="coupan-name mt-3">
                                        <div class="d-flex justify-content-between align-items-center w-100">
                                            <div class="d-flex align-items-center justify-content-between w-100">
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);">
                                                        <div class="coupan-one">
                                                            {{ $coupon->code }}
                                                        </div>
                                                    </a>
                                                    <div class="save-mony ps-3">
                                                        @if( $coupon->type == 'percent' )
                                                            Save ₹{{ ($totalPayableAmount * $coupon->value)/100 }}
                                                        @else
                                                            Save ₹{{ $coupon->value }}
                                                        @endif
                                                    </div>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn {{ $bookingDetails?->coupon_id == $coupon?->id ? 'btn-success' : 'btn-black' }} apply-coupon-btn" title="Click to Apply" data-coupon="{{encode($coupon?->id)}}" data-action="apply">{{ $bookingDetails?->coupon_id == $coupon?->id ? 'Applied' : 'Apply'}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>No Coupons Found</p>
                            @endforelse

                        </div>
                    </div>
                    @endif
                    <div class="payment-img">
                        <div>
                            <img src="{{ asset('assets/front/images/guaranteed.png') }}" alt="" width="w-100" title="Guaranteed Image" />
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    $(document).ready(function() {

        $('body').on('click', '.apply-coupon-btn, .remove-coupon-btn', function() {
            let _this = $(this);
            let _parent = _this.parents('div.coupon-list');
            let action = _this.data('action');
            let booking_id = $('input[name=booking_id]').val();
            let coupon, type;
            if( _this.data('coupon') ) {
                coupon = _this.data('coupon');
                type = 'coupon';
            }else{
                coupon = $('input[name=coupon_code]').val();
                type = 'coupon_code';
            }
            let data = { booking_id, coupon, type, action };
            $.ajax({
                url: "{{ route('apply.coupon') }}",
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if( response.status == 200 ){
                        let couponDiscount = response.couponDiscount;
                        let totalPayableAmount = response.totalPayableAmount;
                        $('.payable-amount').text(totalPayableAmount);
                        $('.coupon-discount').text(couponDiscount);
                        if( action == 'remove' ) {
                            $('.coupon-div').hide('slow');
                            _parent.find('a.remove-coupon-btn').hide('slow');
                            _parent.find('button.apply-coupon-btn').removeClass('btn-success').addClass('btn-black').text('Apply');
                        }else{
                            $('.coupon-div').show('slow');
                            _parent.find('a.remove-coupon-btn').show('slow');
                            _parent.find('button.apply-coupon-btn').removeClass('btn-black').addClass('btn-success').text('Applied');
                        }
                    }else{
                        alert('Something went wrong!');
                    }
                }
            });
        });

        $('#PayNow').on('click', function() {
            var selectedPaymentMethod = $('input[name="paymentMethod"]:checked').val();
            var bookingId = $(this).data('booking_id');

            $.ajax({
                url: "{{ route('order.create') }}",
                type: 'POST',
                data: {
                    'bookingId': bookingId,
                    'method': selectedPaymentMethod
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if ( response.status == 200 ) {
                        var options = response.options;
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    } else {
                        alert('Failed to initiate the payment. Please try again.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', xhr.responseText);
                    alert('Something went wrong. Please try again later.');
                }
            });
        });

        $('input[name="paymentMethod"]').on('change', function() {
            let selectedMethod = $(this).closest('.form-check').find('label').text().trim();
            
            //$('.payment-method').html(`Make Payment Via '${selectedMethod}'`);
            //alert(selectedMethod)
            if (selectedMethod === "Debit/Credit Card") {
                $('.payment-method').html(`Pay Via 'Card'`);
            } else if (selectedMethod === "Pay Later") {
                $('.payment-method').html(`Pay Via 'Pay Later'`);
            } else {
                $('.payment-method').html(`Pay Via '${selectedMethod}'`);
            }
            console.log("Selected Payment Method:", selectedMethod);
        });
    });

    // JavaScript to toggle 'active' class on form-check
    document.querySelectorAll('.form-check-input').forEach(input => {
        input.addEventListener('click', () => {
            // Remove 'active' class from all form-check elements
            document.querySelectorAll('.form-check').forEach(check => {
                check.classList.remove('active');
            });

            // Add 'active' class to the parent of the clicked input
            input.closest('.form-check').classList.add('active');
        });
    });
</script>
@endsection

