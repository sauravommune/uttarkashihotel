@php
    $j = 0;
@endphp

@if (count($hotelList) > 0)
    @if ($agent->isDesktop())
        {{-- for desktop view --}}
        <style type="text/css">
            a:hover {
                color: #;
            }
        </style>

        <div class="pb-1">
            {{ count($hotelList) == 1 ? count($hotelList) . ' Hotel Found' : count($hotelList) . ' Hotels Found' }}
        </div>
        @foreach ($hotelList as $hotel)
            @if (
                !empty($hotel['hotel']['hotelImg']['image']) &&
                    checkImageExists($hotel['hotel']['hotelImages']) &&
                    (!empty($hotel['hotel']?->hotel_img) && checkImageExists($hotel['hotel']?->hotel_img)))
                <div class="result-box-container {{ $hotel['hotel']->recommended == 1 ? 'recommended-box' : '' }}">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-12">
                            <div class="result-box-container-left">
                                <div class="hotel-img" id="hotel-img">
                                    {{-- <a href="{{ route('hotel.details', ['slug' => $hotel['hotel']['slug'], 'searchId' => encode($searchTerms->id)]) }}"> --}}
                                    <a href="{{ route('hotel.details', $hotel['hotel']['slug']) }}/">
                                        @if (!empty($hotel['hotel']['hotelImg']['image']) || !empty($hotel['hotel']?->hotel_img))
                                            @php
                                                $hotelImg = $hotel['hotel']?->hotel_img  ? $hotel['hotel']?->hotel_img : $hotel['hotel']['hotelImg']['image'];
                                                $altTag = $hotel['hotel']?->hotel_img ? ImageAltTag($hotel['hotel'], $hotel['hotel']->alt_tag ?? '') : ImageAltTag(  $hotel['hotel'], $hotel['hotel']['hotelImg']->alt_tag ?? '', );
                                            @endphp
                                            <img src="{{ asset('storage/' . $hotelImg) }}"alt="{{ $altTag }}">
                                        @else
                                            <img src="{{ asset('assets/media/no-hotel-img.svg') }}" alt="">
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-9 col-12">

                            {{-- <a href="{{ route('hotel.details', ['slug' => $hotel['hotel']['slug'], 'searchId' => encode($searchTerms->id)]) }}"> --}}
                            <a href="{{ route('hotel.details', $hotel['hotel']['slug']) }}/">
                                <div class="result-box-container-right">
                                    <div class="row w-100">
                                        <div class="col-8">
                                            <div class="content">
                                                <div class="d-flex justify-content-between w-100">
                                                    <div class="d-flex flex-column gap-1">
                                                        <h6>{{ ucwords($hotel['hotel']['name']) ?? '' }}</h6>
                                                        <span class="location">{{ ucwords($hotel['city_name']) }}</span>
                                                    </div>
                                                    <div>
                                                        @if ($hotel['hotel']->recommended == 1)
                                                            <div class="d-flex align-items-center recommended-item">
                                                                <div class="recommended-icon">
                                                                    <div class="inner-icon">
                                                                        <img src="{{ asset('assets/front/images/hand-icon.svg') }}"
                                                                            alt="Recommended" width=""
                                                                            height="">
                                                                    </div>
                                                                </div>
                                                                <div class="recommended-text">
                                                                    Recommended
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                @if (isset($hotel['amenities']) && count($hotel['amenities']) > 0)
                                                    <div class="facilities">
                                                        @foreach ($hotel['amenities'] as $key => $amenity_name)
                                                            @if ($key < 3)
                                                                <div class="facilities-box">
                                                                    <div class="icon d-flex">
                                                                        <span lass="material-symbols-outlined fs-5 me-1">{{ $amenity_name['icode'] ?? 'spa' }}</span>
                                                                        <span>{{ ucwords($amenity_name['name']) ?? '' }}</span>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif

                                                <p>{{ substr($hotel['hotel']['description'] ?? '', 0, 138) }}</p>

                                                @if ($hotel['hotel']['google_rating'] > 0)
                                                    <div class="rating-verify">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <img src="{{ asset('assets/front/images/google-image.png') }}"
                                                                    alt="">
                                                            </div>
                                                            <div class="ms-2 ">
                                                                <div class="g-rating">
                                                                    Google Reviews
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rating">
                                                                        <div class="d-flex align-items-center">
                                                                            <div>
                                                                                <p class="mb-0">
                                                                                    {{ $hotel['hotel']['google_rating'] ?? 0 }}/5
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                @php
                                                                                    $rating = $hotel['hotel'][  'google_rating' ];
                                                                                    $full_star = floor($rating);
                                                                                    $half_star = $rating - $full_star >= 0.1  ? 1 : 0;
                                                                                    $empty_star = 5 - ($full_star + $half_star);
                                                                                @endphp
                                                                                <div class="rating-star ps-1">
                                                                                    @for ($i = 0; $i < $full_star; $i++)
                                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                                    @endfor
                                                                                    {{-- Half Star --}}
                                                                                    @if ($half_star)
                                                                                        <i class="bi bi-star-half text-warning"></i>
                                                                                    @endif
                                                                                    {{-- Empty Stars --}}
                                                                                    @for ($i = 0; $i < $empty_star; $i++)
                                                                                        <i  class="bi bi-star text-secondary"></i>
                                                                                    @endfor
                                                                                </div>
                                                                            </div>
                                                                            @if ($hotel['hotel']['google_rating_total'] > 0)
                                                                                <div class="reviews ps-1">
                                                                                    <div
                                                                                        class="d-flex align-items-center">
                                                                                        <div class="reviews-text">based
                                                                                            on
                                                                                            {{ $hotel['hotel']['google_rating_total'] ?? 0 }}
                                                                                            reviews</div>
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
                                        <div class="col-4 ">
                                            <div class="content-right">

                                                @if ($hotel['hotel']?->sold_out == 1 || (int) $hotel['availableRoom'] < $searchTerms->roomCount)
                                                    <div class="text-end">
                                                        <span class="sold-out">Sold Out</span>
                                                    </div>
                                                @endif
                                                <div class="parking-rating">
                                                    @php
                                                        $rating = intval($hotel['hotel']['rating'] ?? 0);
                                                        $html = $rating == 1 ? 'Property' : 'Property';
                                                    @endphp
                                                    @if ($rating > 1)
                                                        <div class="star-rating">
                                                            {{-- <img src="{{ asset('assets/front/images/grade.svg') }}" alt=""> --}}
                                                            <div class="d-flex gap-1 align-items-center">
                                                                <div class="rating-star">
                                                                    <p><b>{{ $rating }}</b><span
                                                                            class="bi bi-star-fill text-warning fs-8 ps-1 pe-2"></span><b>{{ $html }}</b>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @php
                                                        $parkingClass = '';
                                                        $available = '';
                                                        if ($hotel['hotel']['parking_available'] === 'yes_free') {
                                                            $parkingClass = 'bg-success';
                                                            $available = 'Free Parking Available';
                                                        } elseif ($hotel['hotel']['parking_available'] === 'yes_paid') {
                                                            $parkingClass = 'bg-danger';

                                                            $available = 'Paid Parking Available';
                                                        } elseif ($hotel['hotel']['parking_available'] === 'no') {
                                                            $parkingClass = 'bg-light';
                                                            $available = 'Parking Not Available';
                                                        }
                                                    @endphp
                                                    <div class="box-32 parking {{ $parkingClass }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ $available }}">
                                                        <span class="icon-car"></span>
                                                    </div>
                                                </div>

                                                <div class="price-rate">
                                                    @php
                                                        $roomCount = $searchTerms->roomCount ?? 1;
                                                        $per_night_price =
                                                            ($hotel['per_night_price'] ?? 0) * $roomCount;
                                                        $per_night_price =
                                                            $per_night_price + $hotel['extra_person_price'];
                                                    @endphp

                                                    {{-- @dd($searchTerms->roomCount,$searchTerms->id); --}}
                                                    {{-- <span class="left_at">{{ $hotel['availableRoom'] }} Left</span> --}}
                                                    <div class="price-cut">
                                                        {{-- <p><s>15,000</s></p> --}}
                                                        <div class="price-night">
                                                            <h4>₹ {{ $per_night_price }}</h4>
                                                            <p>Per Night for <strong>{{ $roomCount }}</strong>
                                                                {{ roomText($roomCount) }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="rest-detials">
                                                        <p> Includes taxes & fees </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            @if (isset($hotelId) && $j == 0)
                <div>
                    <h4 class="pb-3">Others Hotels</h4>
                </div>
                @php $j=1; @endphp
            @endif
        @endforeach
    @else
        {{-- for mobile view --}}
        <div class="col-12">
            <div class="pb-2">
                {{ count($hotelList) == 1 ? count($hotelList) . ' Hotel Found' : count($hotelList) . ' Hotels Found' }}
            </div>
            @foreach ($hotelList as $hotel)
                @if (
                    !empty($hotel['hotel']['hotelImg']['image']) &&
                        checkImageExists($hotel['hotel']['hotelImages']) &&
                        (!empty($hotel['hotel']?->hotel_img) && checkImageExists($hotel['hotel']?->hotel_img)))
                    <div
                        class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-2 @if ($hotel['hotel']?->room?->sold_out == '0') disabled-div @endif">
                        {{-- <a href="{{ route('hotel.details', ['slug' => $hotel['hotel']['slug'], 'searchId' => encode($searchTerms->id)]) }}"> --}}
                        <a href="{{ route('hotel.details', $hotel['hotel']['slug']) }}/">
                            <div
                                class="result-box-container {{ $hotel['hotel']->recommended == 1 ? 'recommended-box' : '' }}">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                        <div class="result-box-container-left">
                                            <div class="hotel-img" id="hotel-img">
                                                @if (!empty($hotel['hotel']['hotelImg']['image']) || !empty($hotel['hotel']?->hotel_img))
                                                    @php
                                                        $hotelImg = $hotel['hotel']?->hotel_img
                                                            ? $hotel['hotel']?->hotel_img
                                                            : $hotel['hotel']['hotelImg']['image'];
                                                        $altTag = $hotel['hotel']?->hotel_img
                                                            ? ImageAltTag(
                                                                $hotel['hotel'],
                                                                $hotel['hotel']->alt_tag ?? '',
                                                            )
                                                            : ImageAltTag(
                                                                $hotel['hotel'],
                                                                $hotel['hotel']['hotelImg']->alt_tag ?? '',
                                                            );
                                                    @endphp
                                                    <img
                                                        src="{{ asset('storage/' . $hotelImg) }}"alt="{{ $altTag }}">
                                                @else
                                                    <img src="{{ asset('assets/media/no-hotel-img.svg') }}"
                                                        alt="">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                        {{-- <a href="{{ route('hotel.details', ['slug' => $hotel['hotel']['slug'], 'searchId' => encode($searchTerms->id)]) }}"> --}}
                                        <a href="{{ route('hotel.details', $hotel['hotel']['slug']) }}/">

                                            <div class="result-box-container-right">

                                                <div class="md-hotel-info w-100">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <div class="parking_rating">
                                                                @php
                                                                    $parkingClass = '';
                                                                    $available = '';
                                                                    if ( $hotel['hotel']['parking_available'] ===  'yes_free') {
                                                                        $parkingClass = 'bg-success';
                                                                        $available = 'Free Parking Available';
                                                                    } elseif ( $hotel['hotel']['parking_available'] === 'yes_paid' ) {
                                                                        $parkingClass = 'bg-danger';

                                                                        $available = 'Paid Parking Available';
                                                                    } elseif (
                                                                        $hotel['hotel']['parking_available'] === 'no'
                                                                    ) {
                                                                        $parkingClass = 'bg-light';
                                                                        $available = 'Parking Not Available';
                                                                    }
                                                                @endphp
                                                                <div class="parking_sign {{ $parkingClass }}"
                                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                    title="{{ $available }}">
                                                                    <span class="icon-car"></span>
                                                                </div>
                                                                {{-- <span
                                                            class="left_at mb-2 d-block">{{ $hotel['availableRoom'] }}
                                                            Left</span> --}}

                                                                {{-- @if ($hotel['hotel']?->room?->sold_out == 1 || (int) $hotel['availableRoom'] <= 0)  --}}

                                                                {{-- @endif --}}
                                                            </div>

                                                        </div>
                                                        <div>
                                                            @if ($hotel['hotel']?->sold_out == 1 || (int) $hotel['availableRoom'] < $searchTerms->roomCount)
                                                                <div class="text-end ps-5 mb-3">
                                                                    <span class="sold-out">Sold Out</span>
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>

                                                    <div class="name-recommended">
                                                        <div class="name py-2">
                                                            <h6>{{ ucwords($hotel['hotel']['name'] ?? 'Hotel Name') }}
                                                            </h6>

                                                            @php
                                                                $rating = intval($hotel['hotel']['rating'] ?? 0);
                                                                $html = $rating == 1 ? 'Property' : 'Property';
                                                            @endphp
                                                            @if ($rating > 1)
                                                                <div class="star-rating">
                                                                    {{-- <img src="{{ asset('assets/front/images/grade.svg') }}" alt=""> --}}
                                                                    <div class="d-flex gap-1 align-items-center">
                                                                        <div class="rating-star pt-1">
                                                                            <p><b>{{ $rating }}</b><span
                                                                                    class="bi bi-star-fill text-warning rated ps-1 pe-2"></span>{{ $html }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>


                                                    </div>
                                                    <div class="d-flex justify-content-between w-100">
                                                        <div>
                                                            <span
                                                                class="location">{{ ucwords($hotel['city_name']) }}</span>
                                                        </div>
                                                        <div>
                                                            @if ($hotel['hotel']->recommended == 1)
                                                                <div
                                                                    class="d-flex align-items-center recommended-item">
                                                                    <div class="recommended-icon">
                                                                        <div class="inner-icon">
                                                                            <img src="{{ asset('assets/front/images/hand-icon.svg') }}"
                                                                                alt="Recommended" width=""
                                                                                height="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="recommended-text">
                                                                        Recommended
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>

                                                    <div class="row justify-content-xl-between">
                                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">

                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                                            <div class="result-box-container-right pt-0 mt-0">
                                                                <div class="md-hotel-info w-100 mt-1">
                                                                    <div class="row justify-content-xl-between g-0">
                                                                        <div
                                                                            class="col-6 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                                                            <div class="content-md-left border-0">
                                                                                @if (isset($hotel['amenities']) && count($hotel['amenities']) > 0)
                                                                                    <div class="facilities pt-0">
                                                                                        @foreach ($hotel['amenities'] as $key => $amenity_name)
                                                                                            @if ($key < 4)
                                                                                                <div
                                                                                                    class="facilities-box">
                                                                                                    <div
                                                                                                        class="icon d-flex">
                                                                                                        <span
                                                                                                            class="material-symbols-outlined fs-5 me-1">{{ $amenity_name['icode'] ?? ' spa' }}</span>
                                                                                                        {{-- <span
                                                                                                    class="{{$amenity_name['icode']??' spa'}}"></span> --}}
                                                                                                        <span>{{ ucwords($amenity_name['name']) ?? '' }}</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                @endif
                                                                            </div>

                                                                        </div>
                                                                        <div
                                                                            class="col-6 col-sm-12 col-md-6 col-lg-6 col-xl-9 ">
                                                                            <div>

                                                                                <div
                                                                                    class="content-md-right p-0 m-0 gap-0">
                                                                                    <div class="price-rate">
                                                                                        <div class="price-rate">
                                                                                            @php

                                                                                                $roomCount =  $searchTerms->roomCount ?? 1;
                                                                                                $per_night_price = ($hotel[ 'per_night_price' ] ?? 0) * $roomCount;
                                                                                                $per_night_price =  $per_night_price + $hotel[ 'extra_person_price' ];
                                                                                            @endphp
                                                                                            <div
                                                                                                class="price-cut mt-0">
                                                                                                <div
                                                                                                    class="price-night mb-2">
                                                                                                    <h4 class="mb-2 text-end">
                                                                                                        ₹
                                                                                                        {{ $per_night_price }}
                                                                                                    </h4>
                                                                                                    <p class="text-end">
                                                                                                        Per Night for
                                                                                                        <strong>{{ $roomCount }}</strong>
                                                                                                        {{ roomText($roomCount) }}
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="rest-detials">


                                                                                                <p class="text-end">
                                                                                                    Includes taxes &
                                                                                                    fees
                                                                                                </p>

                                                                                                @if ($hotel['hotel']?->sold_out == 0 && (int) $hotel['availableRoom'] > 0)
                                                                                                    <div class="mt-3 text-end ">
                                                                                                        <small  class="btn btn-outline-primary">Book Now</small>
                                                                                                    </div>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="content-md-left border-0 mt-3">
                                                                                @if ($hotel['hotel']['google_rating'] > 0)
                                                                                    <div class="rating-verify pt-0">
                                                                                        <div
                                                                                            class="d-flex align-items-center">
                                                                                            <div>
                                                                                                <img src="{{ asset('assets/front/images/google-image.png') }}"
                                                                                                    alt="">
                                                                                            </div>
                                                                                            <div class="ms-2 ">
                                                                                                <div class="g-rating">
                                                                                                    Google Reviews
                                                                                                </div>
                                                                                                <div class="d-flex align-items-center">

                                                                                                    <div class="rating">
                                                                                                        <div class="d-flex">
                                                                                                            <div>
                                                                                                                <p  class="mb-0">
                                                                                                                    {{ $hotel['hotel']['google_rating'] ?? '' }}/5
                                                                                                                </p>
                                                                                                            </div>
                                                                                                            @php
                                                                                                                $rating = $hotel['hotel' ][ 'google_rating' ];
                                                                                                                $full_star = floor( $rating,);
                                                                                                                $half_star = $rating - $full_star >= 0.1  ? 1 : 0;
                                                                                                                $empty_star = 5 - ($full_star + $half_star);
                                                                                                            @endphp
                                                                                                            <div
                                                                                                                class="rating-star ps-1">
                                                                                                                @for ($i = 0; $i < $full_star; $i++)
                                                                                                                    <i class="bi bi-star-fill text-warning"></i>
                                                                                                                @endfor
                                                                                                                {{-- Half Star --}}
                                                                                                                @if ($half_star)
                                                                                                                    <i class="bi bi-star-half text-warning"></i>
                                                                                                                @endif
                                                                                                                {{-- Empty Stars --}}
                                                                                                                @for ($i = 0; $i < $empty_star; $i++)
                                                                                                                    <i class="bi bi-star text-secondary"></i>
                                                                                                                @endfor
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    @if ($hotel['hotel']['google_rating_total'] > 0)
                                                                                                        <div
                                                                                                            class="reviews ">
                                                                                                            <div
                                                                                                                class="d-flex align-items-center">
                                                                                                                <div
                                                                                                                    class="reviews-text ps-2">
                                                                                                                    based
                                                                                                                    on
                                                                                                                    {{ $hotel['hotel']['google_rating_total'] ?? 0 }}
                                                                                                                    reviews
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endif
                                                                                                </div>

                                                                                            </div>
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
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif

                @if (isset($hotelId) && $j == 0)
                    <div>
                        <h4 class="pb-3">Others Hotels</h4>
                    </div>
                    @php $j=1; @endphp
                @endif
            @endforeach
        </div>
    @endif
@else
    <div class="col-12">
        @include('front.no-data-found')
    </div>
@endif
