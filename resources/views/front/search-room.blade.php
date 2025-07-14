{{-- @dd($allAvailableRoom) --}}
@if (isset($allAvailableRoom) && !empty($allAvailableRoom))
    @foreach ($allAvailableRoom as $index =>$room)
  
    {{-- @dd(checkImageExists($room['rooms']['roomImages'])); --}}
    @if($room['rooms']['roomImages']->count() >0 && checkImageExists($room['rooms']['roomImages']))
        <span id="hotelId" data-hotel_id="{{$room['rooms']?->hotel_id}}"></span>
        <span class="nights" data-nights="{{$room['nights']}}"></span>

        <div class="main-box mb-xl-3 mb-3 bor">
            <div class="row g-0">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
                    <strong class="badge-left">{{ $room['availableRoom'] }} {{ $room['availableRoom'] > 1 ? 'Rooms' : 'Room'}} Left</strong>
                    <div class="room-img" id="room-img">
                        @if(count($room['rooms']['roomImages'])>0)
                            @foreach($room['rooms']['roomImages'] as $roomImg)
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#room-modal-{{$index}}">

                                    <div class="image bg-image-style lazy" data-bg="{{ asset('storage/' .$roomImg->image) }}"></div>
                                </a>
                            @endforeach
                        @else
                        <a href="{{asset('assets/media/no-hotel-img.svg')}}" data-bs-toggle="modal" data-bs-target="#room-modal"  data-title="Room Image">
                            <div class="image bg-image-style lazy" data-bg="{{asset('assets/media/no-hotel-img.svg')}}"></div>
                        </a>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                    <div class="center-section">
                        <div class="p-btn">
                        </div>
                        <div class="title mt-xl-3 mt-3">
                            <h3>{{ucwords($room['rooms']->roomType->name)}}</h3>
                            <p class="pt-2">
                                ({{$room['rooms']->room_size}} {{$room['rooms']->measure}}) 
                            </p>
                            <span class="pt-2 d-block">
                                <span class="icon-user pe-1"></span>
                                <strong>Ideal for {{$room['rooms']?->stay_guest}} {{ $room['rooms']?->stay_guest >0 ? 'Guests' : 'Guest'}}</strong> <br/>
                            </span>

                            @if (!empty($room['rooms']['addAmenity']) && count($room['rooms']['addAmenity']) > 0)
                                <h4 class="mt-4">Room Features</h4>
                                <ul class="mt-3 main-ul">
                                    @foreach ($room['rooms']['addAmenity'] as $key=> $amenity)
                                        @if($key < 4) 
                                            <li> {{ $amenity['amenityName']['name'] ?? 'N/A' }}</li>

                                        @endif
                                    @endforeach

                                    @if (count($room['rooms']['addAmenity']) > 4)
                                        <li><a data-bs-toggle="modal" data-bs-target="#room-amenities_{{$index}}" href="javascript:void(0);" title="More amenities">{{count($room['rooms']['addAmenity'])-4}} more</a></li>
                                    @endif
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            
                <div class="modal fade hotel-amenities" id="room-amenities_{{$index}}" tabindex="-1" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header w-100">
                                <div class=" w-100 position-relative">
                                    <h4 class="modal-title ">{{ ucwords($room['rooms']?->hotel?->name) ?? '' }}</h4>
                                    <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="section-title">
                                    <h6>Room Amenities</h6>
                                </div>
                                <div class="ul-section">
                                    <ul class="p-0 m-0">
                                        @foreach ($room['rooms']['addAmenity'] as $key=> $amenity)
                                            <li>{{ $amenity['amenityName']['name'] ?? 'N/A' }}</li>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-5 recommended-section">
                    <div class="w-100 position-relative room-section">
                    <small class="availability-error text-danger px-3"></small>
                        @php
                            $plansType = [
                                'total_price' => [
                                'title' => 'Room Only (EP Plan)',
                                'category' => 'Room Only',
                                'id' => 'only-room-box'
                                ],
                                'total_price_with_break_fast' => [
                                'title' => 'With Breakfast (CP Plan)',
                                'category' => 'With Breakfast',
                                'id' => 'break-fast-box'
                                ],
                                'total_price_with_break_fast_and_dinner' => [
                                'title' => 'With Breakfast, Dinner (MAP Plan)',
                                'category' => 'With Breakfast Dinner',
                                'id' => 'break-fast-dinner-box'
                                ],
                                'total_price_with_break_fast_lunch_and_dinner' => [
                                'title' => 'With Breakfast, Lunch ,Dinner (AP Plan)',
                                'category' => 'With Breakfast Lunch Dinner',
                                'id' => 'break-fast-lunch-dinner-box'
                                ],
                            ]
                        @endphp
                        <div class="parent-section">
                            @foreach ($plansType as $key => $title)
                                @if($room[$key] > 0)
                                    <div class="title">
                                        <div class="repeat-box">
                                            <div class="d-flex justify-content-between w-100 align-items-center">
                                                <div>
                                                    <h3 class="price-title">{{ $title['title'] }}</h3>
                                                    <div class="price-section mt-1">
                                                        <div class="price">
                                                            <b>₹ {{$room[$key]}}</b>
                                                            <small class="ps-2">per night</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    {{-- <div class="{{ $key=='total_price' ? 'd-none' : '' }}" id="select-{{$title['id']}}-{{$index+1}}"> --}}

                                                    <div class="" id="select-{{$title['id']}}-{{$index+1}}">
                                                        <a href="javascript:void(0);" data-section="{{$index+1}}" class="btn btn-black {{$key}}" title="Select" data-availability="{{$room['availableRoom']}}">Select</a>
                                                    </div>

                                                    {{-- <div class="mt-3 {{ $key == 'total_price' ? '' : 'd-none' }}" id="{{$title['id']}}-{{$index+1}}"> --}}
                                                    <div class="mt-3 d-none" id="{{$title['id']}}-{{$index+1}}">

                                                        <div class="quantity-section" id="section-{{$title['id']}}-{{$index+1}}" 
                                                            data-type="{{ ucwords($room['rooms']->roomType->name) }}" 
                                                            data-type-id="{{$room['rooms']->roomType->id}}" 
                                                            data-room-id="{{$room['rooms']->id}}" 
                                                            data-category="{{ $title['category'] }}" 
                                                            data-amount="{{$room[$key]}}">
                                                            <div class="d-flex justify-content-between w-100">
                                                                <button class="btn btn-primary quantity-btn minusBtn" data-type_btn="{{ $title['category'] }}" data-section="{{$index+1}}" data-amount="{{$room[$key]}}">
                                                                    <span class="icon-minus"></span>
                                                                </button>
                                                                <input type="number" class="form-control mx-2 quantity-input" data-amount="{{$room[$key]}}" value="{{ $key=='total_price' ? 0 : 0 }}" readonly>
                                                                <button class="btn btn-primary quantity-btn plusBtn" data-amount="{{$room[$key]}}" data-availability="{{$room['availableRoom']}}" >
                                                                    <span class="icon-plus"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($room)) 
            <div class="modal fade fullscreen-modal" id="room-modal-{{$index}}"  data-bs-backdrop="static" tabindex="-1" data-bs-focus="false">
                <div class="modal-dialog modal-fullscreen modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title text-black" id="galleryModalLabel">{{ ucwords($room['rooms']?->hotel?->name) ?? '' }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row" data-index={{$index}}>
                                @if(count($room['rooms']['roomImages'])>0)
                                    @foreach($room['rooms']['roomImages'] as $roomImg)
                                        <div class="col-12 col-sm-6 col-md-3 col-xl-3">
                                            <a href="javascript:void(0);" data-bs-target="#room-modal-data-{{$index}}" data-bs-toggle="modal" data-bs-dismiss="modal" >
                                                <div class="gallery-img-modal">
                                                    <img src="{{ asset('storage/' .$roomImg->image) }}" alt="{{ImageAltTag($room['rooms']?->hotel,$roomImg->alt_tag)}}" class="img-fluid">
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12 col-sm-6 col-md-3 col-xl-3">
                                        @if( isset($hotelImg['image']) )
                                        <a href="{{ asset('storage/' . $hotelImg['image']) }}" data-bs-target="#room-modal-data" data-bs-toggle="modal" data-bs-dismiss="modal">
                                            <div class="gallery-img-modal">
                                                <img src="{{asset('assets/media/no-hotel-img.svg')}}" alt="{{ImageAltTag($room['rooms']?->hotel,$hotelImg->alt_tag)}}" class="img-fluid">
                                            </div>
                                        </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="modal fade fullscreen-modal slider-modal" id="room-modal-data-{{$index}}" data-bs-backdrop="static" data-bs-focus="false">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <div id="loading-spinner-{{$index}}">
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
                                    <div class="slider-for-{{$index}}" style="display: none;">
                                        @if(count($room['rooms']['roomImages'])>0)
                                            @foreach($room['rooms']['roomImages'] as $roomImg)
                                                <div class="image">
                                                    <img src="{{ asset('storage/' .$roomImg->image) }}" alt="{{ImageAltTag($room['rooms']?->hotel,$roomImg->alt_tag)}}">
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="image">
                                                <img src="{{asset('assets/media/no-hotel-img.svg')}}" alt="Image">
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn-close hidden-btn btn-close-{{$index}}" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        <div class="thumbnail-slider">
                            <div class="row d-flex justify-content-center">
                                <div class="col-12">
                                    <div class="slider-nav-{{$index}}" style="display: none;">
                                            @if(count($room['rooms']['roomImages'])>0)
                                                @foreach($room['rooms']['roomImages'] as $roomImg)
                                                    <div class="image">
                                                        <img src="{{ asset('storage/' .$roomImg->image) }}" alt="{{ImageAltTag($room['rooms']?->hotel,$roomImg->alt_tag)}}">
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="image">
                                                    <img src="{{asset('assets/media/no-hotel-img.svg')}}" alt="Image {{ $key }}">
                                                </div>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif
   @endforeach
@endif
