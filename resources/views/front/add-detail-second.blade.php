@php
use Carbon\Carbon;
@endphp
@extends('front.layouts.app')
@section('content')
    <style>
        .flatpickr-months .flatpickr-month {
            height: 46px;
        }
    </style>
    <div class="section-hotel-details">
        <div class="container py-xl-4 py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 pb-xl-3 pb-3 ">
                    <div class="breadcrumb-section">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#">Hotel Selection</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Guest Details</li>
                                <li class="breadcrumb-item"><a href="#">Review & Make Payment</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
                {{-- <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 d-flex justify-content-xl-end mt-xl-0 mt-3">
                    <div class="timer">
                        <span class="material-symbols-outlined fs-6">timer</span>
                        <p id="timer"></p>
                    </div>
                    
                </div> --}}
            </div>

            
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8 pb-xl-0 pb-4">

                    <form action="{{ route('add_booking_multiple.details') }}" method="post" class="booking-ajax-form">
                        <input type="hidden" name="hotelId" value="{{$details['traveler_details']['hotelId']}}">
                        <input type="hidden" name="search_id" value="{{$details['searchData']?->id}}">
                        @foreach($details['traveler_details']['total_record'] as $key => $record)
                        <input type="hidden" name="roomId[]" value="{{$record['roomId']}}">
                        <input type="hidden" name="roomType[]" value="{{ $record['roomType'] }}">
                        <input type="hidden" name="roomTypeId[]" value="{{ $record['roomTypeId'] }}">
                        <input type="hidden" name="category[]" value="{{ $record['category'] }}">
                        <input type="hidden" name="quantity[]" value="{{ $record['quantity'] }}">
                        @endforeach
                        <div class="title-card">
                            <h4 class="pb-xl-3 pb-3">Enter Traveler Details</h4>
                        </div>

                        <div class="common-card">
                            <div class="space-box">
                                <div class="title-card mb-xl-4 mb-2">
                                    <p>Enter name and details as per Govt. ID</p>
                                </div>
                            </div>

                            @if(Auth::check())
                            <div class="title-card mb-xl-4 mb-2">
                                <div class="form-check">
                                    <input type="checkbox" name="mainGest" id="mainGest" value="mainGest" class="me-2">
                                    <label class="form-check-label" for="mainGest">
                                        I am the main guest.
                                    </label>
                                </div>
                            </div>
                            @endif
                            <div class="card border-top-0 mb-xl-4 mb-3 mx-xl-4 mx-2">
                                @for ($i = 0; $i < $details['traveler_details']['traveler']['adult']; $i++)
                                @if($i == 1) @break @endif
                                <div class="floating-form border-top">
                                    <div class="row">
                                        <div class="col-12 mb-xl-2 mb-2">
                                            <h6>Guest Details</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  repeat-section custom-field mb-xl-0 mb-3">
                                            <div class="box">
                                                <label class="form-label">Full Name</label>
                                                <input type="text" class="form-control" id="full_name_{{ $i }}" name="full_name[{{ $i }}]" value="{{ old('full_name.' . $i) }}" placeholder="Full Name">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section custom-field mb-xl-0 mb-3">
                                            <div class="box">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" id="email_{{ $i }}" name="email[{{ $i }}]" value="{{ old('email.' . $i) }}" placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section custom-field mb-xl-0 mb-3">
                                            <div class="box">
                                                <label class="form-label">Gender</label>
                                                <select class="form-select form-control" name="gender[{{ $i }}]" id="gender_{{ $i }}">
                                                    {{-- <option value="">Select Gender</option> --}}
                                                    <option value="male" {{ old('gender.' . $i) == 'male' ? 'selected' : '' }}>Male </option>
                                                    <option value="female" {{ old('gender.' . $i) == 'female' ? 'selected' : '' }}>Female </option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-2 mt-md-0  repeat-section custom-field">
                                            <div class="row ">
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="box pt-3 pb-2">
                                                        <h6>Date of Birth</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-xl-2 g-1">
                                                <div class="col-4 col-sm-4 col-md-4 col-lg-12 col-xl-4">
                                                    <div class="box">
                                                        <label class="form-label">Year</label>
                                                        <select class="form-control" name="year[]" id="year_{{ $i }}">
                                                            @for ($year = date('Y'); $year >= 1960; $year--)
                                                                <option value="{{ $year }}">{{ $year }}</option>
                                                            @endfor                                                                
                                                        </select>
                                                    </div>  
                                                </div>
                                                <div class="col-4 col-sm-4 col-md-4 col-lg-12 col-xl-4">
                                                    <div class="box">
                                                        <label class="form-label">Month</label>
                                                        <select class="form-control dob-month custom-radious" name="month[]" data-gtm-form-interact-field-id="0" id="month_{{ $i }}">
                                                            <option value="01">Jan</option>
                                                            <option value="02">Feb</option>
                                                            <option value="03">Mar</option>
                                                            <option value="04">Apr</option>
                                                            <option value="05">May</option>
                                                            <option value="06">Jun</option>
                                                            <option value="07">Jul</option>
                                                            <option value="08">Aug</option>
                                                            <option value="09">Sep</option>
                                                            <option value="10">Oct</option>
                                                            <option value="11">Nov</option>
                                                            <option value="12">Dec</option>
                                                        </select>
                                                    </div>    
                                                </div>
                                                <div class="col-4 col-sm-4 col-md-4 col-lg-12 col-xl-4">
                                                    <div class="box">
                                                        <label class="form-label">Day</label>
                                                        <select class="form-select form-control " name="date[]" id="date_{{ $i }}">
                                                                @for ($date = 1; $date <= 31; $date++)
                                                                <option value="{{ $date }}">{{ $date }}</option>
                                                            @endfor                     
                                                        </select>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12 mb-xl-2 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="is_gst_opted" id="gst-detail">
                                                <label class="form-check-label" for="gst-detail">
                                                    Enter GST Details
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hide" id="gst-detail-section">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section custom-field mb-xl-0 mb-3">
                                                <div class="box">
                                                    <label class="form-label">GST Number</label>
                                                    <input type="text" class="form-control" id="gst_number" name="gst_number" value="" placeholder="EG: 06BZAHM6385P6Z2">
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section custom-field mb-xl-0 mb-3">
                                                <div class="box">
                                                    <label class="form-label">Company Name</label>
                                                    <input type="text" class="form-control" id="company_name" name="company_name" value="" placeholder="EG: ABC Company">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @endfor

                                @for ($i = 0; $i < $details['traveler_details']['traveler']['child']; $i++) 

                                <div class="floating-form border-top">
                                    <div class="row">
                                        <div class="col-12 mb-xl-2 mb-2">
                                            <h6>Child {{$i+1}}</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6  repeat-section custom-field">
                                            <div class="box">
                                                <label class="form-label">Full Name</label>
                                                <input type="text" class="form-control" id="child_full_name_{{ $i }}" name="child_full_name[{{ $i }}]" value="{{ old('child_full_name.' . $i) }}" placeholder="Full Name">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 repeat-section mt-0 custom-field">
                                            <div class="box">
                                                <label class="form-label">Gender</label>
                                                <select class="form-select" name="child_gender[{{ $i }}]" id="child_gender_{{ $i }}">
                                                    {{-- <option value="">Select Gender</option> --}}
                                                    <option value="male" {{ old('child_gender.' . $i) == 'male' ? 'selected' : '' }}> Male</option>
                                                    <option value="female" {{ old('child_gender.' . $i) == 'female' ? 'selected' : '' }}> Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 mt-2 mt-md-0  repeat-section custom-field">
                                            <div class="row">
                                                <div> <h6 class="py-3">Date of birth</h6> </div>
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
                                                    <div class="box">
                                                        <label class="form-label">Year</label>
                                                        <select class="form-control" name="child_year[]">
                                                            @for ($year = 2012; $year >= 1990; $year--)
                                                                <option value="{{ $year }}">{{ $year }}</option>
                                                            @endfor                                                                
                                                        </select>
                                                    </div>  
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
                                                    <div class="box">
                                                        <label class="form-label">Month</label>
                                                        <select class="form-control dob-month custom-radious" name="child_month[]" data-gtm-form-interact-field-id="0">
                                                            <option value="01">January</option>
                                                            <option value="02">February</option>
                                                            <option value="03">March</option>
                                                            <option value="04">April</option>
                                                            <option value="05">May</option>
                                                            <option value="06">June</option>
                                                            <option value="07">July</option>
                                                            <option value="08">August</option>
                                                            <option value="09">September</option>
                                                            <option value="10">October</option>
                                                            <option value="11">November</option>
                                                            <option value="12">December</option>
                                                        </select>
                                                    </div>    
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
                                                    <div class="box">
                                                        <label class="form-label">Day</label>
                                                        <select class="form-select form-control" name="child_date[]">
                                                                @for ($date = 1; $date <= 31; $date++)
                                                                <option value="{{ $date }}">{{ $date }}</option>
                                                            @endfor                     
                                                        </select>
                                                        
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>
                        <div class="title-card mt-xl-3 mt-3">
                            
                            <div class="d-flex justify-dcontent-between align-items-center w-100">
                                <div class="icon">
                                    <span class="bi bi-buildings"></span>
                                </div>
                                <div class="ps-2">
                                    <h4 class="py-xl-4 py-3">Hotel Details</h4>    
                                </div>
                            </div>
                        </div>
                        <div class="common-card">
                            
                            <div class="space-box">
                            <div class="title-card  left-item-box border-0">
                                
                                <div class="name">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6>{{ucwords($details['room_details']['0']['room_data']['hotel']['name'])??''}} </h6>
                                        </div>
                                        <div class="ps-xl-2 ps-2">

                                            @if($details['room_details']['0']['room_data']['hotel']['rating']>0)

                                            {{-- <div class="rating-star">
                                                <p><b>{{intval($details['room_details']['0']['room_data']['hotel']['rating'])??''}}</b><span class="bi bi-star-fill text-warning fs-8 ps-1 pe-2"></span><b>Property</b> </p>
                                            </div> --}}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                

                                @if(isset($details['room_details']['0']['room_data']['hotel']['amenities']))
                                    <div class="ul-section">
                                        @foreach($details['room_details']['0']['room_data']['hotel']['amenities'] as $amenity)
                                            <div class="rooms pb-xl-2 pb-1">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <span class="material-symbols-outlined fs-5 me-1">{{$amenity['amenityName']['icode'] ?? 'spa'}}</span>    
                                                    </div>
                                                    <div>
                                                        {{ucwords($amenity['amenityName']['name'])??''}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="row gx-0 box4">
                                    <div class="col-md-3 col-12">
                                        <span class="heading">check-in</span>
                                        @php
                                            $checkIn = Carbon::parse($details['traveler_details']['traveler']['checkIn'])->format('d M. Y');
                                            $checkOut = Carbon::parse($details['traveler_details']['traveler']['checkOut'])->format('d M. Y');
                                        @endphp
                                        <span class="main">
                                            <span class="main no-repeat-text">{{ $checkIn }}  {{ $details['room_details'][0]['room_data']['hotel']?->check_in_time ?? '' }}</span>
                                        </span>                                       
                                        </div>
                                    <div class="col-md-3 col-12">
                                        <span class="heading">check-out</span>
                                        <span class="main no-repeat-text"> {{ $checkOut }} {{ $details['room_details'][0]['room_data']['hotel']?->check_out_time ?? '' }}</span>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        @php
                                            $child = '';
                                        @endphp

                                        @if(isset($details['traveler_details']['traveler']['child']) && $details['traveler_details']['traveler']['child']> 0)
                                            @php
                                                $child = '+ ' . $details['traveler_details']['traveler']['child'] . ' Children';
                                            @endphp
                                        @endif

                                        <span class="heading">travelers</span>
                                        <span class="main">{{ $details['traveler_details']['traveler']['adult'] ?? '0' }} {{ ucfirst(adultText($details['traveler_details']['traveler']['adult'])) }}
                                            {{ $child }}</span>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <span class="heading">stay</span>
                                        <span class="main"> {{ $details['traveler_details']['total_room'] }} {{ucfirst(roomText($details['traveler_details']['total_room']))}}, {{ $details['traveler_details']['nights'] }} {{ ucfirst(nightText($details['traveler_details']['nights']))}}</span>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="room-details mt-4">
                            
                            <div class="title-card mt-xl-3 mt-3">
                            
                                <div class="d-flex justify-dcontent-between align-items-center w-100">
                                    <div class="icon">
                                        <span class="fa fa-bed"></span>
                                    </div>
                                    <div class="ps-2">
                                        <h4 class="py-xl-4 py-3">Room Details</h4>    
                                    </div>
                                </div>
                            </div>
                            
                            @foreach($details['room_details'] as $key=> $row)
                            <div class="detail-section">
                                <div class="main-wrapper shadow-sm">
                                    <div class="d-xl-flex justify-content-between align-items-xl-center">
                                        <p class="top-section-heading">
                                            {{$row['quantity']??''}} X 
                                            <span class="room_type">{{$row['room_data']['roomType']['name']??""}} | {{$row['category']??''}}</span>
                                        </p>
                                    </div>
                                    <p class="pb-2">{{$row['room_data']['room_size']??''}} {{$row['room_data']['measure']??''}} with room .</p>
                                    <div class="facilities">

                                        <div class="d-xl-flex align-items-center justify-content-between">
                                            @if(isset($row['room_data']['addAmenity']) && count($row['room_data']['addAmenity']) > 0)

                                                @foreach($row['room_data']['addAmenity'] as $key => $amenity)
                                                    @if($key < 4) 
                                                    <p class="facilities-available">
                                                        {{ucwords($amenity['amenityName']['name'])??''}}</p>
                                                    @endif
                                                @endforeach
                                            <button type="button" class="btn btn-primary text-blue bg-white border-0" data-bs-toggle="modal" data-bs-target="#kt_modal_{{ $key }}">
                                                View More
                                            </button>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade hotel-amenities" tabindex="-1" aria-labelledby="exampleModalLabel" id="kt_modal_{{ $key }}">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header w-100">
                                                <div class=" w-100 position-relative">
                                                    <h4 class="modal-title">Room Amenities</h4>
                                                    <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                            </div>

                                            @if(isset($row['room_data']['addAmenity']) && count($row['room_data']['addAmenity']) > 0)

                                            <div class="modal-body">
                                                <div class="facilities">
                                                    <div class="row">
                                                        <div class="col-md-12 col-12 ">
                                                            <div class="ul-section">
                                                                <ul class="p-0 m-0">
                                                                    @foreach($row['room_data']['addAmenity'] as $allAmenity)
                                                                     @if(!empty($allAmenity['amenityName']['name']))
                                                                            <li>{{ucwords($allAmenity['amenityName']['name'])??''}}</li>
                                                                     @endif
                                                                    @endforeach
                                                                </ul>
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
                            @endforeach
                        </div>
                        
                        <div class="title-card mt-xl-3 mt-3">
                            <div class="d-flex justify-dcontent-between align-items-center w-100">
                                <div class="icon">
                                    <span class="fa fa-file-text"></span>
                                </div>
                                <div class="ps-2">
                                    <h4 class="py-xl-4 py-3">Additional Requirements</h4>    
                                </div>
                            </div>
                        </div>

                        <div class="common-card">
                            <div class="space-box">
                                <div class="title-card">
                                    <p>It will enable us to better understand and tailor your information.</p>
                                </div>
                            </div>
                            <div class="detail-section">
                                <div class="main-wrapper">

                                    <div class="mb-3">
                                        <label class="form-label">Any Special Requirement</label>
                                        <textarea class="form-control textarea" id="exampleFormControlTextarea1"
                                            placeholder="Enter any special requirement/s" rows="3"
                                            name="special_requirements"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="check-box-section border-top pt-3">
                                <div class="d-xl-flex justify-content-xl-between w-100 align-items-xl-center">
                                    <div class="d-flex align-items-center">
                                        <div class="icon small-icon">
                                            <span class="icon-add-task"></span>
                                        </div>
                                        <div class="text ps-xl-2 px-3">
                                            Your room will be ready for check-in
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mt-2 mt-xl-0">
                                        <div class="icon small-icon">
                                            <span class="icon-concierge"></span>
                                        </div>
                                        <div class="text ps-xl-2 px-3">
                                            24-hour front desk – help whenever you need it!
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5>Add your estimated arrival time</h5>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                                        <select class="form-select" aria-label="Time Slot Selection" id="time-slot-select"
                                            name="arrival_time">
                                            <option value="" disabled selected>Please select</option>
                                            <option value="I don't know">I don't know</option>
                                            <option value="12:00 AM – 1:00 AM">12:00 AM – 1:00 AM</option>
                                            <option value="1:00 AM – 2:00 AM">1:00 AM – 2:00 AM</option>
                                            <option value="2:00 AM – 3:00 AM">2:00 AM – 3:00 AM</option>
                                            <option value="3:00 AM – 4:00 AM">3:00 AM – 4:00 AM</option>
                                            <option value="4:00 AM – 5:00 AM">4:00 AM – 5:00 AM</option>
                                            <option value="5:00 AM – 6:00 AM">5:00 AM – 6:00 AM</option>
                                            <option value="6:00 AM – 7:00 AM">6:00 AM – 7:00 AM</option>
                                            <option value="7:00 AM – 8:00 AM">7:00 AM – 8:00 AM</option>
                                            <option value="8:00 AM – 9:00 AM">8:00 AM – 9:00 AM</option>
                                            <option value="9:00 AM – 10:00 AM">9:00 AM – 10:00 AM</option>
                                            <option value="10:00 AM – 11:00 AM">10:00 AM – 11:00 AM</option>
                                            <option value="11:00 AM – 12:00 PM">11:00 AM – 12:00 PM</option>
                                            <option value="12:00 PM – 1:00 PM">12:00 PM – 1:00 PM</option>
                                            <option value="1:00 PM – 2:00 PM">1:00 PM – 2:00 PM</option>
                                            <option value="2:00 PM – 3:00 PM">2:00 PM – 3:00 PM</option>
                                            <option value="3:00 PM – 4:00 PM">3:00 PM – 4:00 PM</option>
                                            <option value="4:00 PM – 5:00 PM">4:00 PM – 5:00 PM</option>
                                            <option value="5:00 PM – 6:00 PM">5:00 PM – 6:00 PM</option>
                                            <option value="6:00 PM – 7:00 PM">6:00 PM – 7:00 PM</option>
                                            <option value="7:00 PM – 8:00 PM">7:00 PM – 8:00 PM</option>
                                            <option value="8:00 PM – 9:00 PM">8:00 PM – 9:00 PM</option>
                                            <option value="9:00 PM – 10:00 PM">9:00 PM – 10:00 PM</option>
                                            <option value="10:00 PM – 11:00 PM">10:00 PM – 11:00 PM</option>
                                            <option value="11:00 PM – 12:00 AM">11:00 PM – 12:00 AM</option>
                                            <option value="12:00 AM – 1:00 AM (the next day)">12:00 AM – 1:00 AM (the next day)
                                            </option>
                                            <option value="1:00 AM – 2:00 AM (the next day)">1:00 AM – 2:00 AM (the next day)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>  
                        </div>
                      
                        <div class="title-card mt-xl-3 mt-3">
                            <div class="d-flex justify-dcontent-between align-items-center w-100">
                                <div class="icon">
                                    <span class="fa fa-user"></span>
                                </div>
                                <div class="ps-2">
                                    <h4 class="py-xl-4 py-3">Enter Contact Information</h4>    
                                </div>
                            </div>
                        </div>

                        <div class="common-card">
                            <div class="space-box">
                                <div class="title-card">
                                    <p>Your Ticket will be sent at given number and mail ID.</p>
                                </div>
                            </div>
                            <div class="form-part">

                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  repeat-section mb-xl-0 mb-3">
                                        <div class="box">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="contact_name" name="contact_name"
                                                value="{{ old('contact_name') }}" placeholder="Full Name">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section mb-xl-0 mb-3">
                                        <div class="box">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" id="contact_email" name="contact_email"
                                                value="{{ old('contact_email') }}" placeholder="Email">

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 repeat-section mb-xl-0 mb-3">
                                        <div class="box">
                                            <label class="form-label">Mobile No.</label>
                                            <input type="number" class="form-control" id="contact_no" placeholder="9988776655" name="contact_no"
                                                value="{{ old('contact_no') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 repeat-section mt-2 d-xl-flex justify-content-xl-end">
                                        <div class="box mt-0">
                                            <button type="submit" class="btn btn-outline-primary mt-2" title="Proceed to Pay" id="svaBtn">Proceed to Pay <span class="fa fa-forward material-icons ms-2"></span> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 pe-xl-0 mt-xl-0 mt-0">
                    <div class="right-item-box top-sticky">
                        @if(isset($details['hotelReview']->hotelReview) && count($details['hotelReview']->hotelReview) > 0 || $details['hotelReview']->google_rating > 0)

                        <div class="google-sidebar mb-xl-4 mb-3">

                            @if($details['hotelReview']->google_rating > 0)
                            <div class="top-section">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="google-review">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="{{ asset('assets/front/images/google-image.png') }}" alt="" width="" title="Google Review" />
                                            </div>
                                            <div class="text ps-xl-2">
                                                <div>
                                                    <p>Google Reviews</p>
                                                </div>
                                                <div class="google-rating-text">
                                                    <div class="d-flex align-items-center>">
                                                        <div class="count-rating">{{$details['hotelReview']->google_rating??''}}</div>

                                                        @php
                                                        $rating = $details['hotelReview']->google_rating;
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
                                                        @if($details['hotelReview']['google_rating_total']>0)
                                                            <div class="reviews ps-1 d-flex align-items-center">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="reviews-text">based on {{$details['hotelReview']['google_rating_total']??0}} reviews</div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            @endif
                            @if(count($details['hotelReview']->hotelReview) > 0)
                            <div class="center-section-II">

                                @foreach($details['hotelReview']->hotelReview as $review)
                                <div class="user-review">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="user-image">
                                                @if($review->review_profile_photo && file_exists(storage_path('app/public/'.$review->review_profile_photo)))

                                                <img src="{{asset('storage/'.$review->review_profile_photo)}}" alt="" width="" title="User Image" />

                                                @else
                                                {{-- <img src="https://placehold.co/40x40" alt="" width="" title="User Image" /> --}}

                                                <div class="user-icon">
                                                    <span>
                                                        @php
                                                            $firstInitial = strtoupper(substr(explode(' ', $review->author_name)[0], 0, 1));
                                                            @endphp
                                                            <p>{{$firstInitial}}</p>
                                                    </span>
                                                    
                                                </div>

                                                @endif
                                            </div>
                                            <div class="user-info ps-xl-3 ps-2">
                                                <div class="d-flex align-items-center"> 
                                                    <div>
                                                        <h4>{{ucwords($review?->author_name??"")}}</h4>
                                                        @if($review?->date)
                                                        <p>{{ $review?->date ? \Carbon\Carbon::parse($review->date)->format('M jS, Y') : '' }}</p>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="count-rating">
                                            <div class="d-flex">
                                                <div><b>{{$review?->rating??""}}</b></div>
                                                <div class="ps-1">
                                                    <span class="icon-star text-warning"></span>                                                                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <p>{{$review?->text??''}}</p>
                                    </div>
                                </div>
                                @endforeach
                                
                            </div>
                            @endif
                            
                        </div>
                        @endif


                        <div class="payment-img mt-0">
                            <div>
                                <img src="{{ asset('assets/front/images/guaranteed.png') }}" alt="" width="w-100" title="User Image" />
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

        $(document).ready(function() {
            // Initialize Select2 for dynamically generated selects
            $('select[data-control="select2"]').select2({
                placeholder: function() {
                    return $(this).data('placeholder'); // Fetch placeholder from the attribute
                },
                allowClear: true, // Enable the clear button
                minimumResultsForSearch: Infinity // Disable the search bar
            });

            const initialTime = 15 * 60;
            let countdown = localStorage.getItem('countdown')
                ? parseInt(localStorage.getItem('countdown'))
                : initialTime;

            $('input[name="mainGest"]').on('click', function() {
                if ($('input[name="mainGest"]:checked').val()) {
                    let selectedValue = $('input[name="mainGest"]:checked').val();
                    let authUserName = "{{ auth()->user()->name ?? '' }}";
                    let authUserEmail = "{{ auth()->user()->email ?? '' }}";
                    let authUserGender = "{{ auth()->user()->gender ?? '' }}";
                    let authUserPhone = "{{ auth()->user()->phone ?? '' }}";
                    let authUserDob = "{{ auth()->user()->dob??'' }}";

                    $('#full_name_0').val(authUserName);
                    $('#email_0').val(authUserEmail);
                    $('#gender_0').val(authUserGender ? authUserGender : 'male');
                    if( authUserDob) {      
                        authUserDob = authUserDob.split('-');
                        // console.log(authUserDob);
                        $('#year_0').val(authUserDob[0]);
                        $('#month_0').val(authUserDob[1]);
                        // alert(authUserDob[2]);
                        let dateValue = authUserDob[2]; 
                        if (dateValue.startsWith('0')) {
                            dateValue = dateValue.slice(1);
                        }
                        $('#date_0').val(dateValue);                   
                     }

                    $('#contact_name').val(authUserName);
                    $('#contact_email').val(authUserEmail);
                    {{-- $('#contact_no').val(authUserPhone); --}}

                } else {
                    $('#full_name_0').val('');
                    $('#email_0').val('');
                    $('#gender_0').val('male');
                    $('#contact_name').val();
                    $('#contact_email').val();
                    $('#contact_no').val();

                }

            });

            $('body').on('change', 'input[name=is_gst_opted]', function() {
                if ($(this).is(':checked')) {
                    $('#gst-detail-section').slideDown();
                }else{
                    $('#gst-detail-section').slideUp();
                }
            });

        });
    </script>
@endsection