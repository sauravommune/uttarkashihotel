@php
    use Carbon\Carbon;
@endphp



<div class="main-card-II">
    <div class="space-box">
        <div class="title-card">
            <div class="botder-bottom">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#upcoming">Upcoming </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#completed">Completed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#cancelled">Cancelled</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Internal Tab start -->
        <div>
            <div class="tab-content">
                <div class="tab-pane active" id="upcoming">

                    @foreach ($manageBooking as $booking)
                        @if ($booking['details']['status'] == 'Pending'  && !empty($booking['details']['hotel']))
                            <div class="main-wrapper div-click"
                                data-booking_id="{{ $booking['details']['booking_id'] }}">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 mb-3 mb-xl-0">
                                        <div class="image lazy bg-image-style"
                                            data-bg="{{ $booking['details']->hotel?->hotelImages->count() > 0 ? asset('storage/'.$booking['details']['hotel']['hotelImages']['0']['image']) : asset('assets/media/no-hotel-img.svg') }}">
                                        </div>
                                    </div>
                                    <div
                                        class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 d-flex align-items-center">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                                                <div class="detail-part">
                                                    <div class="middle-part">
                                                        <div class="d-xl-flex justify-content-xl-between w-100">
                                                            <div class="wrapper-title">
                                                                <div class="d-xl-flex pb-xl-3">
                                                                    <div class="mb-3 mb-xl-0">
                                                                        <h3>{{ ucwords($booking['details']['hotel']['name']) ?? '' }}
                                                                        </h3>
                                                                    </div>
                                                                    @if ($booking['details']['hotel']['google_rating'] > 0)
                                                                        <div class="rating-verify ms-xl-4 ">
                                                                            <div class="d-flex align-items-center">
                                                                                <div>
                                                                                    <img src="{{ asset('assets/front/images/google-image.png') }}"
                                                                                        alt="">
                                                                                </div>

                                                                                <div class="ms-2 ">
                                                                                    <div class="g-rating">Google
                                                                                        Reviews
                                                                                    </div>
                                                                                    <div
                                                                                        class="d-flex align-items-center">

                                                                                        <div
                                                                                            class="rating border-0 bg-transparent ps-0 ms-0">
                                                                                            <div class="d-flex">
                                                                                                <div>
                                                                                                    <p class="mb-0">
                                                                                                        {{ $booking['details']['hotel']['google_rating'] ?? '' }}/5
                                                                                                    </p>
                                                                                                </div>
                                                                                                <div>
                                                                                                    @php
                                                                                                        $rating =
                                                                                                            $booking[
                                                                                                                'details'
                                                                                                            ]['hotel'][
                                                                                                                'google_rating'
                                                                                                            ];
                                                                                                        $full_star = floor(
                                                                                                            $rating,
                                                                                                        );
                                                                                                        $half_star =
                                                                                                            $rating -
                                                                                                                $full_star >=
                                                                                                            0.1
                                                                                                                ? 1
                                                                                                                : 0;
                                                                                                        $empty_star =
                                                                                                            5 -
                                                                                                            ($full_star +
                                                                                                                $half_star);
                                                                                                    @endphp
                                                                                                    <div
                                                                                                        class="rating-star">
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
                                                                                                            <i
                                                                                                                class="bi bi-star text-secondary"></i>
                                                                                                        @endfor
                                                                                                    </div>
                                                                                                </div>
                                                                                                @if($booking['details']['hotel']['google_rating_total']>0)
                                                                                                <div class="ps-2 fs-8 text-black">
                                                                                                {{$booking['details']['hotel']['google_rating_total']}}
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
                                                                <div
                                                                    class="d-xl-flex align-items-xl-center mt-2  mb-3 mb-xl-0">
                                                                    <div class="travel-city">
                                                                        <p>{{ ucwords($booking['details']['hotel']['cityName']['name']) ?? '' }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="booking-id">
                                                                        <b>Booking ID -</b><small
                                                                            class="ps-1">{{ $booking['details']['booking_id'] ?? '' }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <a href="javascript:void(0);" title="Manage Booking"
                                                                    class="btn btn-dark">Manage Booking</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pt-3">
                                                <div class="row">
                                                    <div
                                                        class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-xl-0 mb-3">
                                                        <div class="hotel-part">
                                                            <div class="d-flex">
                                                                <div class="icon">
                                                                    <span class="icon-door-open"></span>
                                                                </div>
                                                                @php
                                                                    $checkIn = Carbon::createFromFormat(
                                                                        'Y-m-d',
                                                                        $booking['details']['check_in_date'],
                                                                    )->format('d M. Y');

                                                                    $checkOut = Carbon::createFromFormat(
                                                                        'Y-m-d',
                                                                        $booking['details']['check_out_date'],
                                                                    )->format('d M. Y');
                                                                @endphp
                                                                <div class="text ps-1">
                                                                    <small>check-in</small>
                                                                </div>
                                                            </div>
                                                            <div class="main-date mt-1">
                                                                {{ $checkIn }}  {{ $booking['details']['hotel']?->check_in_time ?? '' }}
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div
                                                        class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-xl-0 mb-3">
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
                                                                {{ $checkOut }} {{ $booking['details']['hotel']?->check_out_time ?? '' }}

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-xl-0 mb-3">
                                                        <div class="hotel-part">
                                                            <div class="d-flex">
                                                                <div class="icon">
                                                                    <span class="icon-master-list-profile"></span>
                                                                </div>
                                                                <div class="text ps-1">
                                                                    <small>Travelers</small>
                                                                </div>
                                                            </div>
                                                            <div class="main-date mt-1">
                                                                {{ $booking['details']['adult'] }}  {{ucfirst(adultText($booking['details']['adult']))}}
                                                                @if (!empty($booking['details']['child']))
                                                                    {{ $booking['details']['child'] }} Children
                                                                @endif


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-xl-0 mb-3">
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
                                                                {{ $booking['totalRoom'] ?? '' }}
                                                                {{ucfirst(roomText($booking['totalRoom']))}}, {{ $booking['nights'] }} {{ucfirst(nightText($booking['nights']))}}
                                                            </div>
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

                </div>
                <div class="tab-pane" id="completed">

                    @foreach ($manageBooking as $booking)
                        @if ($booking['details']['status'] == 'Completed')
                            <div class="main-wrapper div-click"
                                data-booking_id="{{ $booking['details']['booking_id'] }}">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 mb-3 mb-xl-0">
                                        <div class="image lazy bg-image-style"
                                            data-bg="{{ $booking['details']->hotel->hotelImages->count() > 0 ? asset('storage/'.$booking['details']['hotel']['hotelImages']['0']['image']) : asset('assets/media/no-hotel-img.svg') }}">

                                        </div>

                                    </div>
                                    <div
                                        class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 d-flex align-items-center">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                                                <div class="detail-part">
                                                    <div class="middle-part">
                                                        <div class="d-xl-flex justify-content-xl-between w-100">
                                                            <div class="wrapper-title">
                                                                <div class="d-xl-flex align-items-xl-center">
                                                                    <div class="mb-3 mb-xl-0">
                                                                        <h3>{{ ucwords($booking['details']['hotel']['name']) ?? '' }}
                                                                        </h3>
                                                                    </div>
                                                                    @if ($booking['details']['hotel']['google_rating'] > 0)
                                                                        <div class="rating-verify ms-xl-4 ">
                                                                            <div class="d-flex align-items-center">
                                                                                <div>
                                                                                    <img src="{{ asset('assets/front/images/google-image.png') }}"
                                                                                        alt="">
                                                                                </div>

                                                                                <div class="ms-2 ">
                                                                                    <div class="g-rating">Google
                                                                                        Reviews
                                                                                    </div>
                                                                                    <div
                                                                                        class="d-flex align-items-center">

                                                                                        <div
                                                                                            class="rating border-0 bg-transparent ps-0 ms-0">
                                                                                            <div class="d-flex">
                                                                                                <div>
                                                                                                    <p class="mb-0">
                                                                                                        {{ $booking['details']['hotel']['google_rating'] ?? '' }}/5
                                                                                                    </p>
                                                                                                </div>
                                                                                                <div>
                                                                                                    @php
                                                                                                        $rating =
                                                                                                            $booking[
                                                                                                                'details'
                                                                                                            ]['hotel'][
                                                                                                                'google_rating'
                                                                                                            ];
                                                                                                        $full_star = floor(
                                                                                                            $rating,
                                                                                                        );
                                                                                                        $half_star =
                                                                                                            $rating -
                                                                                                                $full_star >=
                                                                                                            0.1
                                                                                                                ? 1
                                                                                                                : 0;
                                                                                                        $empty_star =
                                                                                                            5 -
                                                                                                            ($full_star +
                                                                                                                $half_star);
                                                                                                    @endphp
                                                                                                    <div
                                                                                                        class="rating-star">
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
                                                                                                            <i
                                                                                                                class="bi bi-star text-secondary"></i>
                                                                                                        @endfor
                                                                                                    </div>
                                                                                                </div>
                                                                                                @if($booking['details']['hotel']['google_rating_total']>0)
                                                                                                <div class="ps-2 fs-8 text-black">
                                                                                                {{$booking['details']['hotel']['google_rating_total']}}
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
                                                                <div
                                                                    class="d-xl-flex align-items-xl-center mt-2  mb-3 mb-xl-0">
                                                                    <div class="travel-city">
                                                                        <p>{{ ucwords($booking['details']['hotel']['cityName']['name']) ?? '' }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="booking-id">
                                                                        <b>Booking ID -</b><small
                                                                            class="ps-1">{{ $booking['details']['booking_id'] ?? '' }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div title="comleted" class="btn badge bg-success">
                                                                    completed
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pt-3">
                                                <div class="row">
                                                    <div
                                                        class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-xl-0 mb-3">
                                                        <div class="hotel-part">
                                                            <div class="d-flex">
                                                                <div class="icon">
                                                                    <span class="icon-door-open"></span>
                                                                </div>
                                                                @php
                                                                    $checkIn = Carbon::createFromFormat(
                                                                        'Y-m-d',
                                                                        $booking['details']['check_in_date'],
                                                                    )->format('d M. Y');

                                                                    $checkOut = Carbon::createFromFormat(
                                                                        'Y-m-d',
                                                                        $booking['details']['check_out_date'],
                                                                    )->format('d M. Y');
                                                                @endphp
                                                                <div class="text ps-1">
                                                                    <small>check-in</small>
                                                                </div>
                                                            </div>
                                                            <div class="main-date mt-1">
                                                                {{ $checkIn }} {{ $booking['details']['hotel']?->check_in_time ?? '' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-xl-0 mb-3">
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
                                                                {{ $checkOut }}  {{ $booking['details']['hotel']?->check_out_time ?? '' }}

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-xl-0 mb-3">
                                                        <div class="hotel-part">
                                                            <div class="d-flex">
                                                                <div class="icon">
                                                                    <span class="icon-master-list-profile"></span>
                                                                </div>
                                                                <div class="text ps-1">
                                                                    <small>Travelers</small>
                                                                </div>
                                                            </div>
                                                            <div class="main-date mt-1">
                                                                {{ $booking['details']['adult'] }}  {{ucfirst(adultText($booking['details']['adult']))}}
                                                                @if (!empty($booking['details']['child']))
                                                                    {{ $booking['details']['child'] }} Children
                                                                @endif


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-xl-0 mb-3">
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
                                                                {{ $booking['totalRoom'] ?? '' }}
                                                                {{ucfirst(roomText($booking['totalRoom']))}}, {{ $booking['nights'] }} {{ucfirst(nightText($booking['nights']))}}
                                                            </div>
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

                </div>

                <div class="tab-pane" id="cancelled">
                    @foreach ($manageBooking as $booking)
                        @if ( in_array($booking['details']['status'], ['Cancelled By Client', 'Cancelled By Vendor']) )
                            <div class="main-wrapper div-click"
                                data-booking_id="{{ $booking['details']['booking_id'] }}">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 mb-3 mb-xl-0">
                                        <div class="image lazy bg-image-style"
                                            data-bg="{{ $booking['details']->hotel->hotelImages->count() > 0 ? asset('storage/'.$booking['details']['hotel']['hotelImages']['0']['image']) : asset('assets/media/no-hotel-img.svg') }}">
                                        </div>

                                    </div>
                                    <div
                                        class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 d-flex align-items-center">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                                                <div class="detail-part">
                                                    <div class="middle-part">
                                                        <div class="d-xl-flex justify-content-xl-between w-100">
                                                            <div class="wrapper-title">
                                                                <div class="d-xl-flex align-items-xl-center">
                                                                    <div class="mb-3 mb-xl-0">
                                                                        <h3>{{ ucwords($booking['details']['hotel']['name']) ?? '' }}
                                                                    </div>
                                                                    @if ($booking['details']['hotel']['google_rating'] > 0)
                                                                        <div class="rating-verify ms-xl-4 ">
                                                                            <div class="d-flex align-items-center">
                                                                                <div>
                                                                                    <img src="{{ asset('assets/front/images/google-image.png') }}" alt="">
                                                                                </div>

                                                                                <div class="ms-2 ">
                                                                                    <div class="g-rating">Google Reviews</div>
                                                                                    <div class="d-flex align-items-center">

                                                                                        <div class="rating border-0 bg-transparent ps-0 ms-0">
                                                                                            <div class="d-flex">
                                                                                                <div>
                                                                                                    <p class="mb-0">
                                                                                                        {{ $booking['details']['hotel']['google_rating'] ?? '' }}/5
                                                                                                    </p>
                                                                                                </div>
                                                                                                <div>
                                                                                                    @php
                                                                                                        $rating =
                                                                                                            $booking[
                                                                                                                'details'
                                                                                                            ]['hotel'][
                                                                                                                'google_rating'
                                                                                                            ];
                                                                                                        $full_star = floor(
                                                                                                            $rating,
                                                                                                        );
                                                                                                        $half_star =
                                                                                                            $rating -
                                                                                                                $full_star >=
                                                                                                            0.1
                                                                                                                ? 1
                                                                                                                : 0;
                                                                                                        $empty_star =
                                                                                                            5 -
                                                                                                            ($full_star +
                                                                                                                $half_star);
                                                                                                    @endphp
                                                                                                    <div
                                                                                                        class="rating-star">
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
                                                                                                            <i
                                                                                                                class="bi bi-star text-secondary"></i>
                                                                                                        @endfor
                                                                                                    </div>
                                                                                                </div>
                                                                                                  @if($booking['details']['hotel']['google_rating_total']>0)
                                                                                                <div class="ps-2 fs-8 text-black">
                                                                                                {{$booking['details']['hotel']['google_rating_total']}}
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
                                                                <div
                                                                    class="d-xl-flex align-items-xl-center mt-2  mb-3 mb-xl-0">
                                                                    <div class="travel-city">
                                                                        <p>{{ ucwords($booking['details']['hotel']['cityName']['name']) ?? '' }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="booking-id">
                                                                        <b>Booking ID -</b><small
                                                                            class="ps-1">{{ $booking['details']['booking_id'] ?? '' }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div title="Cancelled" class="btn badge bg-danger">
                                                                    Cancelled
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pt-3">
                                                <div class="row">
                                                    <div
                                                        class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-xl-0 mb-3">
                                                        <div class="hotel-part">
                                                            <div class="d-flex">
                                                                <div class="icon">
                                                                    <span class="icon-door-open"></span>
                                                                </div>
                                                                @php
                                                                    $checkIn = Carbon::createFromFormat(
                                                                        'Y-m-d',
                                                                        $booking['details']['check_in_date'],
                                                                    )->format('d M. Y');

                                                                    $checkOut = Carbon::createFromFormat(
                                                                        'Y-m-d',
                                                                        $booking['details']['check_out_date'],
                                                                    )->format('d M. Y');
                                                                @endphp
                                                                <div class="text ps-1">
                                                                    <small>check-in</small>
                                                                </div>
                                                            </div>
                                                            <div class="main-date mt-1">
                                                                {{ $checkIn }} {{ $booking['details']['hotel']?->check_in_time ?? '' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-xl-0 mb-3">
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
                                                                {{ $checkOut }} {{ $booking['details']['hotel']?->check_out_time ?? '' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-xl-0 mb-3">
                                                        <div class="hotel-part">
                                                            <div class="d-flex">
                                                                <div class="icon">
                                                                    <span class="icon-master-list-profile"></span>
                                                                </div>
                                                                <div class="text ps-1">
                                                                    <small>Travelers</small>
                                                                </div>
                                                            </div>
                                                            <div class="main-date mt-1">
                                                                {{ $booking['details']['adult'] }}  {{ucfirst(adultText($booking['details']['adult']))}}
                                                                @if (!empty($booking['details']['child']))
                                                                    {{ $booking['details']['child'] }} Children
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-xl-0 mb-3">
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
                                                                {{ $booking['totalRoom'] ?? '' }}
                                                                {{ucfirst(roomText($booking['totalRoom']))}}, {{ $booking['nights'] }} {{ucfirst(nightText($booking['nights']))}}
                                                            </div>
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
                </div>
            </div>
        </div>
        <!--  Internal Tab end-->
    </div>
</div>


<script>
    var baseUrl = "{{ route('manage.booking', ':bookingId') }}";
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.div-click').on('click', function() {
            var bookingId = btoa($(this).data("booking_id"));
            let finalUrl = baseUrl.replace(':bookingId', bookingId);
            window.location.href = finalUrl;
        });
    });
</script>
