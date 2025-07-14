<!DOCTYPE html>
<html lang="en">

<head>

    <!-- End Google Tag Manager -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="HandheldFriendly" content="True" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.svg') }}" />
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/flatpickr.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/select2.min.css') }}?" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/select2-bootstrap-5-theme.min.css') }}" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link
        href="{{ asset('assets/front/css/main-style.css') }}?v={{ filemtime(public_path('assets/front/css/main-style.css')) }}"
        rel="stylesheet">
</head>

<body data-instant-intensity="mousedown">


    @include('front.layouts.header')
    <main>
        <section class="section-39 py-xl-5 py-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="form-card">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-between">
                        <h1 class="text-start">Hotel Data</h1>
                        <div>
                            <a href="{{route('external.hotels')}}"><button class="btn btn-primary">Hotel List
                                </button></a>
                        </div>
                    </div>
                    @if(session()->has('message'))
                    <div class="alert alert-success mt-2" role="alert">
                        {{session('message')}}
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-error mt-2" role="alert">
                        {{session('error')}}
                    </div>
                    @endif
                    <div class="col-12 mt-4">
                        <div class="form-section">
                            <form action="{{route('secret.page.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 mb-3">
                                        <label for="exampleInputName" class="form-label">Hotel Name</label>
                                        <input type="text" class="form-control" id="exampleInputName"
                                            aria-describedby="NamelHelp" name="hotel"
                                            value="{{old('hotel',$hotel?->hotel)}}" placeholder="Enter Hotel Name">
                                        <input type="hidden" class="form-control" aria-describedby="NamelHelp" name="id"
                                            value={{$hotel?->id}}>
                                        @error('hotel')

                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="exampleInputName" class="form-label">City</label>
                                        <select class="form-select" aria-label="Default select example" name="city">
                                            <option selected value="lucknow" @selected($hotel?->hotel ==
                                                'lucknow')>Lucknow</option>
                                            <option value="hardoi" @selected($hotel?->hotel == 'hardoi')>Hardoi</option>
                                            <option value="kanpur" @selected($hotel?->hotel == 'kanpur')>Kanpur</option>
                                            <option value="varanasi" @selected($hotel?->hotel == 'varanasi')>Varanasi
                                            </option>
                                        </select>
                                        @error('city')

                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="exampleInputName" class="form-label">Location</label>
                                        <input type="hidden" class="form-control" aria-describedby="NamelHelp"
                                            name="latitude" value={{$hotel?->latitude}}>
                                        <input type="hidden" class="form-control" aria-describedby="NamelHelp"
                                            name="longitude" value={{$hotel?->longitude}}>
                                        <button class="btn btn-primary mx-3" id="getLocation" type="button">Get
                                            Location</button>
                                        <p id="location" class="form-control @if(!$hotel?->latitude)' d-none' @endif">
                                            Latitude: {{$hotel?->latitude}}<br>
                                            Longitude: {{$hotel?->longitude}}
                                        </p>
                                    </div>


                                    <div class="col-12 col-md-3 mb-3">
                                        <label class="form-label">Hotel Check-In</label>
                                        <input type="time" class="form-control" name="check_in" value="14:00">
                                    </div>
                                    <div class="col-12 col-md-3 mb-3">
                                        <label class="form-label">Hotel Check-Out</label>
                                        <input type="time" class="form-control" name="check_out" value="22:00">
                                    </div>
                                    <div class="col-12 text-end">
                                        <div>
                                            <button type="button" id="add-room-section" class="btn btn-primary"><span
                                                    class="icon-plus"></span> Add</button>
                                        </div>
                                    </div>
                                    @forelse($externalHotelRoomTypes as $key => $roomType)
                                        <div id="room-section-wrapper">


                                        <div class="row  my-3 room-section  position-relative">


                                            <div class="col-12 col-md-3">
                                                <label class="form-label mt-xl-0 mt-2">Room Type</label>
                                                <select class="form-select" name="rooms[0][room_type]">
                                                    <option value="">-- Select Room Type --</option>
                                                    @foreach($roomTypes as $key => $label)
                                                    <option value="{{ $key }}" @selected($key == $roomType?->room_type)>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                @error('rooms.*.room_type')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>


                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 " id="retailPriceDiv">
                                                <label class="form-label mt-xl-0 mt-2">Retail Price</label>
                                                <input type="number" class="form-control" name="rooms[0][retail_price]" value="{{$roomType?->retail_price}}">
                                                @error('rooms.*.retail_price')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 " id="b2bPriceDiv">
                                                <label class="form-label mt-xl-0 mt-2">B2B Price</label>
                                                <input type="number" class="form-control" name="rooms[0][b2b_price]" value="{{$roomType?->b2b_price}}">
                                                @error('rooms.*.b2b_price')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="form-label mt-xl-0 mt-2">Room Size</label>
                                                <div class="d-flex">
                                                    <input type="number" class="form-control me-1" name="rooms[0][room_size]" value="{{$roomType?->room_size}}">
                                                    <select class="form-select" name="rooms[0][size_in]">
                                                        <option value="square_feet" @selected($roomType?->size_in == 'square_feet') >Square Feet</option>
                                                        <option value="square_meter" @selected($roomType?->size_in == 'square_meter')>Square Meter</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-end mt-3">
                                                <a href="javascript:void(0);" class="remove-room-section text-white">
                                                    <i class="bi bi-trash "></i>
                                                </a>
                                            </div>

                                        </div>

                                    </div>
                                    @empty
                                        
                                    <div id="room-section-wrapper">
                                        <div class="row align-items-end my-3 room-section gx-3 gy-3 position-relative">
                                            <div class="col-12 col-xl-3">
                                                <label class="form-label mt-xl-0 mt-2">Room Type</label>
                                                <select class="form-select" name="rooms[0][room_type]">
                                                    <option value="">-- Select Room Type --</option>
                                                    @foreach($roomTypes as $key => $label)
                                                    <option value="{{ $key }}" @selected($key == 1)>{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                @error('rooms.*.room_type')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-xl-3" id="retailPriceDiv">
                                                <label class="form-label mt-xl-0 mt-2">Retail Price</label>
                                                <input type="number" class="form-control" name="rooms[0][retail_price]"
                                                    value="{{$hotel?->retail_price}}">
                                                @error('rooms.*.retail_price')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-xl-3" id="b2bPriceDiv">
                                                <label class="form-label mt-xl-0 mt-2">B2B Price</label>
                                                <input type="number" class="form-control" name="rooms[0][b2b_price]"
                                                    value="{{$hotel?->b2b_price}}">
                                                @error('rooms.*.b2b_price')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-xl-3">
                                                <div class="d-flex align-items-end gap-3">
                                                    <div>
                                                        <label class="form-label mt-xl-0 mt-2">Room Size</label>
                                                        <div class="d-flex gap-2">
                                                            <input type="number" class="form-control me-1"
                                                                name="rooms[0][room_size]">
                                                            <select class="form-select" name="rooms[0][size_in]">
                                                                <option value="square_feet" selected>Square Feet
                                                                </option>
                                                                <option value="square_meter">Square Meter</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <a href="javascript:void(0);"
                                                        class="remove-room-section text-white mb-1">
                                                        <i class="bi bi-trash "></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforelse

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="exampleInputName" class="form-label">Bed Type</label>
                                        <select class="form-select" aria-label="Default select example" name="bed_type">
                                            <option value="">-- Select Bed Type --</option>
                                            <option value="single" @selected($hotel?->bed_type == 'single')>Single Bed
                                            </option>
                                            <option value="double" @selected($hotel?->bed_type == 'double')>Double Bed
                                            </option>
                                            <option value="queen" @selected($hotel?->bed_type == 'queen')>Queen Bed
                                            </option>
                                            <option value="king" @selected($hotel?->bed_type == 'king')>King Bed
                                            </option>
                                        </select>
                                        @error('rooms.*.bed_type')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="exampleInputName" class="form-label">Extra Bed</label>

                                        <div class="d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="ExtraBedYes" checked
                                                    name="extra_bed" value="yes" @checked($hotel?->extra_bed == 'yes')>
                                                <label class="form-check-label" for="ExtraBedYes">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" id="ExtraBedNo"
                                                    name="extra_bed" value="no" @checked($hotel?->extra_bed == 'no')>
                                                <label class="form-check-label" for="ExtraBedNo">
                                                    No
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="exampleInputName" class="form-label">Is parking available to
                                            guest?</label>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="parking"
                                                    id="parkingYesFree" value="yes_free" @checked($hotel?->parking ==
                                                'yes_free')>
                                                <label class="form-check-label" for="parkingYesFree">
                                                    Yes, free
                                                </label>
                                            </div>
                                            <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="parking"
                                                    id="parkingYesPaid" value="yes_paid" @checked($hotel?->parking ==
                                                'yes_paid')>
                                                <label class="form-check-label" for="parkingYesPaid">
                                                    Yes, paid
                                                </label>
                                            </div>
                                            <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="parking"
                                                    id="parkingNO" value="no" @checked($hotel?->parking == 'no')>
                                                <label class="form-check-label" for="parkingNO">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="exampleInputName" class="form-label">What type of parking is
                                            it?</label>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="parking_type"
                                                    id="parking_typePrivate" value="private"
                                                    @checked($hotel?->parking_type == 'private')>
                                                <label class="form-check-label" for="parking_typePrivate">
                                                    Private

                                                </label>
                                            </div>
                                            <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="parking_type"
                                                    id="parking_typePublic" value="public"
                                                    @checked($hotel?->parking_type == 'public')>
                                                <label class="form-check-label" for="parking_typePublic">
                                                    Public
                                                </label>
                                            </div>
                                            @error('parking_type')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h4>Amenities that guests can use</h4>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="exampleInputName" class="form-label">What amenities facilities are
                                            available to guests?</label>
                                        <div class="row">
                                            @foreach($amenities as $key => $aminity)
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexCheckDefault_{{$key}}" name="amenities[]"
                                                        value="{{$key}}" @checked(in_array($key,$hotelAmenities))>
                                                    <label class="form-check-label" for="flexCheckDefault1">
                                                        {{ucwords($aminity)}}
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h4>Meal Details</h4>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="exampleInputName" class="form-label">Do you offer meals for
                                            guests?</label>
                                        <div class="d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="guest_meal" id="yes"
                                                    checked value="yes" @checked($hotel?->guest_meal == 'yes')>
                                                <label class="form-check-label" for="yes">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="guest_meal" id="no"
                                                    value="no" @checked($hotel?->guest_meal == 'no')>
                                                <label class="form-check-label" for="no">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="exampleInputName" class="form-label">What type of breakfast do you
                                            serve</label>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="Indian"
                                                        value="indian" name="breakfast[]" @checked((isset($hotel) &&
                                                        in_array('indian',$hotel?->breakfast)) || (!isset($hotel) &&
                                                    true))>
                                                    <label class="form-check-label" for="Indian">
                                                        Indian
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="Chinese"
                                                        value="continental" name="breakfast[]" @checked( isset($hotel)
                                                        && in_array('continental',$hotel?->breakfast))>
                                                    <label class="form-check-label" for="Chinese">
                                                        Continental
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="Other"
                                                        value="other" name="breakfast[]" @checked(isset($hotel) &&
                                                        in_array('other',$hotel?->breakfast))>
                                                    <label class="form-check-label" for="Other">
                                                        Other
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="exampleInputName" class="form-label">Meal Offered</label>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="veg" value="veg"
                                                        name="meal_offered[]" @checked((isset($hotel) &&
                                                        in_array('veg',$hotel?->meal_offered)) || (!isset($hotel) &&
                                                    true))>
                                                    <label class="form-check-label" for="veg">
                                                        Veg
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="non_veg"
                                                        value="non_veg" name="meal_offered[]" @checked( isset($hotel) &&
                                                        in_array('non_veg',$hotel?->meal_offered))>
                                                    <label class="form-check-label" for="non_veg">
                                                        Non Veg
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="Jain"
                                                        value="jain" name="meal_offered[]" @checked(isset($hotel) &&
                                                        in_array('jain',$hotel?->meal_offered))>
                                                    <label class="form-check-label" for="Jain">
                                                        Jain
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h4>House Rules</h4>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="exampleInputName" class="form-label">Do you allow pets?</label>
                                        <div class="d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pet_allow"
                                                    id="petyes" value="yes" @checked($hotel?->pet_allow == 'yes')>
                                                <label class="form-check-label" for="petyes">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="pet_allow" id="petno"
                                                    value="no" @checked($hotel?->pet_allow == 'no')>
                                                <label class="form-check-label" for="petno">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="exampleInputName" class="form-label">Couple friendly?</label>
                                        <div class="d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="couple_friendly"
                                                    id="coupleyes" value="yes" @checked($hotel?->couple_friendly ==
                                                'yes')>
                                                <label class="form-check-label" for="coupleyes">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="couple_friendly"
                                                    id="coupleno" value="no" @checked($hotel?->couple_friendly == 'no')>
                                                <label class="form-check-label" for="coupleno">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="exampleInputName" class="form-label">Banquet Halls</label>
                                        <div class="d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="banquet"
                                                    id="BanquetYes" value="yes" @checked($hotel?->banquet == 'yes')>
                                                <label class="form-check-label" for="BanquetYes">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="banquet"
                                                    id="BanquetNo" value="no" @checked($hotel?->banquet == 'no')>
                                                <label class="form-check-label" for="BanquetNo">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="exampleInputName" class="form-label">Conference Room</label>
                                        <div class="d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="conference"
                                                    id="ConferenceYes" checked value="yes" @checked($hotel?->conference
                                                == 'yes')>
                                                <label class="form-check-label" for="ConferenceYes">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="conference"
                                                    id="ConferenceNo" value="no" @checked($hotel?->conference == 'no')>
                                                <label class="form-check-label" for="ConferenceNo">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="exampleInputName" class="form-label">Day Use Room</label>
                                        <div class="d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="day_used_room"
                                                    id="DayUsedYes" checked value="yes" @checked($hotel?->day_used_room
                                                == 'yes')>
                                                <label class="form-check-label" for="DayUsedYes">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="day_used_room"
                                                    id="DayUsedNo" value="no" @checked($hotel?->day_used_room == 'no')>
                                                <label class="form-check-label" for="DayUsedNo">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="exampleInputName" class="form-label">Star Rating</label>
                                        <select class="form-select" aria-label="Default select example" name="rating">
                                            <option value="">-- Select Rating --</option>
                                            <option value="3" @selected($hotel?->rating == '3')>3 Star</option>
                                            <option value="4" @selected($hotel?->rating == '4')>4 Star</option>
                                            <option value="5" @selected($hotel?->rating == '5')>5 Star</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="exampleInputName" class="form-label">Is smoking allowed in the
                                            hotel?</label>
                                        <div class="d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="smoking_allowed"
                                                    id="smoking_allowed" checked value="yes"
                                                    @checked($hotel?->smoking_allowed == 'yes')>
                                                <label class="form-check-label" for="smoking_allowed">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="smoking_allowed"
                                                    id="smoking_allowed_no" value="no" @checked($hotel?->smoking_allowed
                                                == 'no')>
                                                <label class="form-check-label" for="smoking_allowed_no">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <label for="formFile" class="form-label">Hotel Image</label>
                                        <input class="form-control" type="file" id="formFile" multiple name="image[]">
                                    </div>



                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12  mb-3">
                                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
        </section>



    </main>
    @include('front.layouts.footer')

    <script src="{{ asset('assets/front/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/front/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/instantpages.5.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/lazyload.17.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/slick.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/custom.js') }}?v={{ filemtime(public_path('assets/front/js/custom.js')) }}">
    </script>
    <script src="{{ asset('assets/js/app.custom.js') }}?v={{ filemtime(public_path('assets/js/app.custom.js')) }}">
    </script>
    <script
        src="{{ asset('assets/front/js/booking.js') }}?v={{ filemtime(public_path('assets/front/js/booking.js')) }}">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
    @if(session('error'))
    toastr.error('{{ session('
        error ') }}', {
            positionClass: 'toast-top-right',
            closeButton: true,
            progressBar: true
        });
    @endif
    @if(session('success'))
    toastr.success('{{ session('
        success ') }}', {
            positionClass: 'toast-top-right',
            closeButton: true,
            progressBar: true
        });
    @endif
    </script>

    <script>
    $(document).ready(function() {
        $('#getLocation').on('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                $('#location').html("Geolocation is not supported by this browser.");
            }
        });

        function showPosition(position) {
            $('#location').removeClass('d-none');
            $('input[name=latitude]').val(position.coords.latitude);
            $('input[name=longitude]').val(position.coords.longitude);
            $('#location').removeClass('d-none');
            $('#location').html(
                "Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude
            );
        }

        function showError(error) {
            alert("Sorry, no position available.");
        }
    });


    let roomIndex = 1;

    document.getElementById('add-room-section').addEventListener('click', function() {
        const wrapper = document.getElementById('room-section-wrapper');
        const firstRoom = wrapper.querySelector('.room-section');
        const clone = firstRoom.cloneNode(true);

        // Clear inputs and update names
        clone.querySelectorAll('input, select').forEach(input => {
            if (input.name) {
                input.name = input.name.replace(/\[\d+\]/, `[${roomIndex}]`);
                input.value = 'square_feet';
            }
        });

        wrapper.appendChild(clone);
        roomIndex++;
    });

    // Delete button inside <a>
    document.getElementById('room-section-wrapper').addEventListener('click', function(e) {
        if (e.target.closest('.remove-room-section')) {
            const allRooms = document.querySelectorAll('.room-section');
            if (allRooms.length > 1) {
                e.target.closest('.room-section').remove();
            } else {
                alert("At least one room section is required.");
            }
        }
    });
    </script>


    @yield('scripts')
</body>

</html>