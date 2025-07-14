<div class="modal-body body-color">
    <section class="section-35">
        <div class="my-3">
            <div class="title-section">
                <h3>Current Hotel</h3>
            </div>
            <div class="hotel-detail mt-5">
                <div class="row">
                    <div class="col-12 col-ms-12 col-md-12 col-lg-12 col-xl-8 border-right">
                        <div class="left-section">
                            <div class="d-xl-flex align-items-center">
                                <div>
                                    <h4 class="hotel-name">{{ ucwords($bookingDetails?->hotel?->name) }} </h4>
                                  
                                </div>
                                <div class="ps-xl-3 mt-xl-0 mt-3">
                                    @if($bookingDetails?->hotel?->rating > 0)
                                    <div>
                                        @for($i = 0; $i < $bookingDetails?->hotel?->rating; $i++)
                                            <i class="fa fa-star text-warning"></i>
                                            @endfor
                                    </div>

                                    @endif
                                </div>
                            </div>
                            <div class="city-name mt-xl-0 mt-3">
                                <span>{{ucwords($bookingDetails?->hotel?->cityDetails?->name)}}</span>
                            </div>
                            <div class="ul-section mt-3">
                                <ul>
                                    @if($bookingDetails?->hotel?->amenities)
                                    @foreach($bookingDetails?->hotel?->amenities as $key => $amenity)
                                    <li><i class="fas fa-swimming-pool pe-2"></i>{{$amenity?->amenityName?->name }}</li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="rating-area mt-4">
                                <div class="d-flex align-items-xl-center">
                                    <div class="bg-green d-xl-inline px-2 py-1 text-white fs-8">
                                        {{$$bookingDetails?->hotel->google_rating??1}}/5
                                    </div>
                                    {{-- <div>
                                        <small class="p-0 m-0 ps-3 rating">1 Verified Ratings</small>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-ms-12 col-md-12 col-lg-12 col-xl-4 d-flex justify-content-xl-end">
                        <div class="right-section mt-xl-0 mt-4">
                            <div class="text-xl-end">
                                <h4>₹  {{$bookingDetails?->bookedRooms?->sum('total_price') ?? 0 }}</h4>
                            </div>
                            <div class="text-xl-end py-1 text">
                                <span>total includes taxes & fees</span>
                            </div>
                            <div class="text-xl-end  text">
                                <div>
                                    {{$bookingDetails?->bookedRooms->sum('quantity')}} Rooms, {{stayNights($bookingDetails->check_in_date,$bookingDetails->check_out_date)}} Nights stay
                                </div>
                                <div class="pt-1">{{$bookingDetails?->adult}} Adult(s) {{ $bookingDetails?->child > 0 ? ','.$bookingDetails?->child .'Child(s)' : ''}} </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hotel-search mt-4">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8 d-flex align-items-center">
                        <div class="dark-bg w-100">
                            <ul>
                                <li>{{ucwords($bookingDetails?->hotel?->cityDetails?->name)}}</li>
                                <li>{{ $bookingDetails?->adult }} Adult(s) {{ $bookingDetails?->child > 0 ? ' ,'.$bookingDetails?->child .'Child(s)' : ''}}, {{ $bookingDetails?->total_room }} Room(s)</li>
                                <li>{{formatDateMdY($bookingDetails->check_in_date)}}</li>
                                <li>to</li>
                                <li>{{formatDateMdY($bookingDetails->check_out_date)}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  d-flex align-items-center">
                        <div class="w-100 position-relative mt-xl-0 mt-4">
                            <input type="text" class="form-control" name="search-hotel" id="search-hotel" placeholder="Search by hotel name"/>
                            <input type="hidden" class="form-control" bookingId="search-hotel" id="bookingId" value="{{$bookingDetails?->booking_id}}"/>


                            <div class="search-icon">
                                <span class="fa fa-search"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="search-result">
             
                <div class="row" id ="result-text">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">
                        <div class="title-section">
                            <h3>Search Result</h3>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 text-xl-end">
                        {{-- <div class="total-count">
                            50+ properties found
                        </div> --}}
                    </div>
                </div>

                <div class="row" id ="appendSearchHotel">

                    @include('lead.model.hotel-box')
                    {{-- <div class ="loader" data-url = "{{route('search.hotels')}}">
                    
                    <div class="d-flex justify-content-center align-items-center my-4">
                        <div class="spinner-border text-info text-center" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
</div>
