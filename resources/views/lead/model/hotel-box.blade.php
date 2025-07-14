
@if(!empty($searchResult))
    @foreach($searchResult as $key => $otherHotel)

        @php
            $hotel = $otherHotel['hotel'];
        @endphp
        
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 mb-4">
            <div class="hotel-card">
                <a href="{{route('leads.change.hotel.rooms',[$bookingDetails?->booking_id,$hotel?->id])}}" data-target = "#global_modal" data-load="true" data-modal-dialog="modal-xl">
                    <div class="outer-card">
                        <div class="img ss">
                            @php
                            $image = $hotel->hotelImages->first();
                            @endphp
                            <img src="{{ $image?->image ? asset($image?->image) : 'https://placehold.co/600x400' }}" width="" height="" alt="" />
                        </div>
                        <div class="custom-card-text">
                            <div class="d-flex align-items-center">
                                @if($hotel?->parking_available != 'yes')

                                <div class="box parking">
                                    <span class="material-symbols-outlined text-black">
                                        directions_car
                                    </span>
                                </div>
                                @endif
                                {{-- <div class="box left-count mx-3">
                                    {{$otherHotel['availableRoom']?? 1}} left at
                                </div> --}}
                                <div class="box rating ps-2">
                                    @if($hotel?->rating)
                                    @for($i = 0; $i < $hotel?->rating; $i++)

                                        <span class="fa fa-star text-warning"></span>
                                        @endfor
                                        @endif
                                </div>
                            </div>
                            <div class="hotel-name">
                                <div>
                                    <h3>{{ucwords($hotel?->name)}}</h3>
                                    <span>{{ucwords($hotel?->cityDetails?->name)}}</span>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 borde-right">
                                    <div class="left-section">
                                        <div>
                                            <ul>
                                                @if($hotel?->amenities)
                                                @foreach($hotel?->amenities as $key => $amenity)
                                                <li><i class="fas fa-swimming-pool pe-2"></i>{{$amenity?->amenityName?->name }}</li>
                                                @endforeach
                                                @endif

                                            </ul>
                                        </div>
                                        @if($hotel?->google_rating>0)
                                        <div class="rating-area mt-xl-4  mt-4 ">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-green d-inline px-2 py-1 text-white fs-8">
                                                    {{$hotel?->google_rating??''}}/5
                                                </div>
                                                {{-- <div>
                                                    <small class="p-0 m-0 ps-xl-3 rating ps-3 mb-xl-0 mb-3">1 Verified Ratings</small>
                                                </div> --}} 
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="right-section">
                                        <div class="text-xl-end">
                                            <h4>₹ {{$otherHotel['per_night_price']}}</h4>
                                        </div>
                                        <div class="text-xl-end text">
                                            <span>Per Night for 1 Room</span>
                                        </div>
                                        <div class="text-xl-end text pt-2">
                                            <div>
                                                ₹ {{$otherHotel['per_night_price']}} total includes
                                            </div>
                                            <div class="pt-1">taxes & fees</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endforeach

    @else

    <div class="col-12">
        @include('front.no-data-found')
    </div>
@endif
