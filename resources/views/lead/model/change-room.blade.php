<section class="section-35">
    <div class="mb-3">
        <div class="hotel-detail border-0 px-0 pt-0">
            <h5 class="text-color fw-semibold mb-4">Current Room</h5>
            <div class="row g-0 border-danger-custom align-items-center rounded-2 px-3 py-4">
                <div class="col-sm-12 col-md-12 col-lg-9 col-12 border-down-left">
                    <div class="left">
                        <div class="d-flex flex-column gap-2">
                            @if (count($roomDetails['bookedRooms']) > 0)
                                @foreach ($roomDetails['bookedRooms'] as $key => $bookedRoom)
                                    <div class="d-flex align-items-center">
                                        <p class="text-color-secondary mb-0"> {{ $bookedRoom?->quantity }} x <span
                                                class="fw-semibold">{{ $bookedRoom?->roomCategory?->name }} |
                                                {{ $bookedRoom?->break_fast_type }} | Refundable</span></p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3 col-12 mt-4 mt-lg-0">
                    <div class="d-flex flex-column justify-content-end align-items-start align-items-lg-end">
                        <div class="d-flex align-items-end">
                            <span class="material-symbols-outlined fs-7">
                                currency_rupee
                            </span>
                            <h2 id="previous_price" class="text-color fw-bold mb-0"
                                data-previous_price="{{ $roomDetails['bookedRooms']->sum('total_price') ?? 0 }}">
                                {{ $roomDetails['bookedRooms']->sum('total_price') ?? 0 }}</h2>
                        </div>
                        <p class="text-color mb-0">Total includes taxes & fees</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="hotel-search ">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex align-items-center">
                    <div class="dark-bg w-100">
                        <ul>
                            <li>{{ ucwords($roomDetails['bookings']?->hotel?->cityDetails?->name) }}</li>
                            <li>{{ $roomDetails['bookings']?->adult }} Adult(s)
                                {{ $roomDetails['bookings']?->child > 0 ? ' ,' . $roomDetails['bookings']?->child . 'Child(s)' : '' }},
                                {{ $roomDetails['bookings']?->total_room }} Room(s)</li>
                            <li>{{ formatDateMdY($roomDetails['bookings']->check_in_date) }}</li>
                            <li>to</li>
                            <li>{{ formatDateMdY($roomDetails['bookings']->check_out_date) }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="title-section pb-3">
        <h3>{{ ucwords($roomDetails['selectedHotel']?->name) }} Rooms</h3>
    </div>
    @if ($roomDetails['availableRooms'])

        <div class="row">
            <div id="total_nights" data-total_nights="{{stayNights($roomDetails['bookings']?->check_in_date, $roomDetails['bookings']?->check_out_date)}}"></div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">
                @foreach ($roomDetails['availableRooms'] as $key => $availableRoom)
                    <div class="hotte-detail-card mb-5">
                        <div class="row g-0">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 border-detail">
                                <div class="p-5">
                                    <div class="box-1">
                                        <div class="title">
                                            <h3>{{ ucwords($availableRoom?->roomType?->name) }}</h3>
                                            <p>{{ $availableRoom?->description }}</p>
                                        </div>
                                        <div class="ul-section">
                                            <ul>
                                                <li><i class="fa fa-user pe-2"></i>{{ $availableRoom?->stay_guest }}
                                                    Guests</li>
                                                @if (!empty($availableRoom?->getBed))
                                                    @foreach ($availableRoom?->getBed as $key => $bedType)
                                                        <li><i class="fa fa-bed pe-2"></i>{{ $bedType?->total_bed }}
                                                            {{ $bedType?->bedTypeName?->bed_type }}</li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="box-1 room-feature">
                                        <div class="title">
                                            <h3>Room Features</h3>
                                        </div>
                                        <div class="ul-section">

                                            <ul>
                                                @foreach ($availableRoom->AddAmenity as $key => $aminity)
                                                @if($key <=5)
                                                    {{-- @if ($loop->index > 4) --}}
                                                        {{-- <li>{{ count($availableRoom->AddAmenity) - 5 }} more</li> --}}
                                                    {{-- @break --}}
                                                {{-- @endif --}}
                                                <li>{{ $aminity->amenityName->name }}</li>
                                                @endif
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $total_ep = $availableRoom->ratePlan->sum('total_amount_ep');
                            $total_cp = $availableRoom->ratePlan->sum('total_amount_cp');
                            $total_map = $availableRoom->ratePlan->sum('total_amount_map');
                            $ratePlanCount = $availableRoom->ratePlan->count();

                            $avgPrices = [
                                'EP' => [
                                    'name' => 'EP',
                                    'title' => 'Room Only',
                                    'shortName' => 'room_only',
                                    'breakFastType' => 'Room Only',

                                    'avgPrice' => averageRoomRate($total_ep, $ratePlanCount),
                                ],
                                'CP' => [
                                    'name' => 'CP',
                                    'title' => 'With Breakfast',
                                    'shortName' => 'with_breakfast',
                                    'breakFastType' => 'With Breakfast',

                                    'avgPrice' => averageRoomRate($total_cp, $ratePlanCount),
                                ],
                                'MAP' => [
                                    'name' => 'MAP',
                                    'title' => 'With Breakfast + Dinner',
                                    'shortName' => 'with_breakfast_dinner',
                                    'breakFastType' => 'With Breakfast Dinner',
                                    'avgPrice' => averageRoomRate($total_map, $ratePlanCount),
                                ],
                            ];
                        @endphp
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                            <div class="recommended-section">
                                @foreach ($avgPrices as $price)
                                    @if ($price['avgPrice'] <= 0)
                                        @continue
                                    @endif

                                    <div class="border-bottom">
                                        <input type="hidden" name="room_name"
                                            value="{{ $availableRoom?->id }}">

                                            <input type="hidden" name="hotel_id"
                                            value="{{ $availableRoom?->hotel_id }}">
                                        <div class="p-3 price-section" id="hide">
                                            <div class="d-flex justify-content-between w-100 my-5 ">
                                                <div class="title">
                                                    {{ $price['title'] }}
                                                </div>
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button"
                                                        id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                        aria-expanded="false">Refundable</a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <li><a class="dropdown-item" href="#">Refundable</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#">Non
                                                                Refundable</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between w-100">
                                                <div>
                                                    <div class="price"> ₹ {{ $price['avgPrice'] }} </div>
                                                    <div class="room">per room for <span>1 Room</span> </div>
                                                </div>
                                                <div class="counter">
                                                    <button class="counter__btn counter__btn--decrement"
                                                        break-fast-type="{{ $price['breakFastType'] }}"
                                                        room-type="{{ $price['shortName'] }}"
                                                        room-type-id ="{{ $availableRoom?->roomType?->id }}"
                                                        room-name="{{ ucwords($availableRoom?->roomType?->name) }}">-</button>
                                                    <div class="counter__display"
                                                        data-amount = "{{ $price['avgPrice'] }}">0</div>
                                                    <button class="counter__btn counter__btn--increment"
                                                        break-fast-type="{{ $price['breakFastType'] }}"
                                                        room-type="{{ $price['shortName'] }}"
                                                        room-type-id ="{{ $availableRoom?->roomType?->id }}"
                                                        room-name="{{ ucwords($availableRoom?->roomType?->name) }}">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
            <div class="right-card-custom mb-5 total-price-wrapper d-none">
                <form action ="{{ route('save.change.room.hotel') }}" method="post" class="global-ajax-form">
                    @csrf()
                    <input type="hidden" name="booking_id" value="{{ $roomDetails['bookings']->booking_id}}">
                    <div class="inner-wrapper">
                        <div class="price-area">
                            <div class="title">
                                <span class="total-room">{{ $roomDetails['bookings']?->total_room }}</span> rooms
                                for
                                {{ stayNights($roomDetails['bookings']?->check_in_date, $roomDetails['bookings']?->check_out_date) }}
                                night
                            </div>

                        </div>

                        <div class="price-areas px-3 pb-3">
                            <div class="title d-flex justify-content-between w-100">
                                <div>
                                    <span><b>Total Amount</b></span>
                                </div>
                                <div>
                                    <span><b class="total-price">₹ 0</b></span>
                                </div>
                            </div>
                        </div>

                        <div class="total-count border-radius">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="left-part refund-amount">
                                    Total Pay Amount
                                </div>
                                <div class="right-part total-pay-price">
                                    ₹ 0
                                </div>
                            </div>
                        </div>
                        <div class="total-btn  mt-3">
                            <div class="mx-2">
                                {{-- <a href="javascript(0);" class="btn btn-primary w-100">Book Now</a> --}}
                                <button type="submit" class="btn btn-primary w-100">Book Now</button>

                            </div>
                        </div>

                    </div>

                    </from>
            </div>
            <div class="right-card-custom select-min-one">
                <div class="inner-wrapper bg-remove">
                    <div class="price-area ">
                        <div class="title text-center">
                            Select at least one option if you want to book
                        </div>

                        <div>
                            <a href="javascript:void(0);" title="Select an option"
                                class="btn btn-grey w-100">Select an option</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endif
<div class="modal-footer mt-5 pe-0">
    <div>
        <button type="button" class="btn btn-secondary btn-border" data-bs-dismiss="modal">Cancel</button>
        {{-- <button type="button" class="btn btn-primary ms-xl-3 ms-3" title="Change Room">Change Room</button> --}}
    </div>
</div>
</section>
