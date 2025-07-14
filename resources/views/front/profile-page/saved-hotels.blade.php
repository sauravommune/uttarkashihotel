@if (count($savedHotel) > 0)
    <div class="main-card-II">
        <div class="space-box">

            @foreach ($savedHotel as $hotel)
                <div class="main-wrapper saved-hotels">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                            <div class="main-img">
                                <div class="slider-image saved-hotel">

                                    @if (count($hotel->hotel->hotelImages) > 0)
                                        @foreach ($hotel->hotel->hotelImages as $img)
                                            @php
                                                $img = asset('storage/' . $img->image);
                                            @endphp
                                            <div class="image-repeat">
                                                <div class="image bg-image-style" style="background-image: url('{{ $img }}');"></div>
                                            </div>
                                        @endforeach
                                     @else
										@php
										$img = asset('assets/media/no-hotel-img.svg');
										@endphp
                                        <div class="image-repeat">
                                            <div class="image bg-image-style" style="background-image: url('{{ $img }}');"></div>
                                        </div>
										<div class="image-repeat">
                                            <div class="image bg-image-style" style="background-image: url('{{ $img }}');"></div>
                                        </div>
                                    @endif

                                </div>
                                <div class="wish-list">
                                    <a href="javascript:void(0);" title="Add to wish list"><span
                                            class="icon-heart"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 d-flex align-items-center">
                            <div class="row w-100">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="detail-part border-0">
                                        <div class="middle-part">
                                            <div class="d-flex justify-content-between w-100">
                                                <div class="wrapper-title">
                                                    <div class="d-xl-flex align-items-xl-center">
                                                        <div class="mt-3 mt-xl-0">
                                                            <h3>{{ ucwords($hotel?->hotel->name ?? '') }}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mt-2">
                                                        <div class="travel-city">
                                                            <p>{{ ucwords($hotel?->hotel->cityName?->state?->name ?? '') }},
                                                                {{ ucwords($hotel?->hotel?->cityName?->name ?? '') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if (count($hotel?->hotel?->amenities) > 0)
                                                <div class="ul-part">
                                                    <ul>
                                                        @foreach ($hotel?->hotel?->amenities as $amenity)
                                                            <li><span class="icon-pool pe-2"></span>{{ ucwords($amenity?->amenityName?->name ?? '') }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
											<p>{{ substr($hotel['hotel']['description'] ?? '', 0, 100) }}</p>

                                            @if($hotel?->hotel?->google_rating>1)
                                            <div class="rating-verify">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <img src="{{ asset('assets/front/images/google-image.png') }}"
                                                            alt="">
                                                    </div>

                                                    <div class="ms-2 ">
                                                        <div class="g-rating">Google
                                                            Reviews
                                                        </div>
                                                        <div class="d-flex align-items-center">

                                                            <div class="rating border-0 bg-transparent ps-0 ms-0">
                                                                <div class="d-flex">
                                                                    <div>
                                                                        <p class="mb-0 p-0 pe-2">
                                                                            {{$hotel?->hotel?->google_rating??''}}/5
                                                                        </p>
                                                                    </div>
                                                                    <div>

																		@php
                                                                            $rating = $hotel?->hotel?->google_rating;
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
                                                                        {{-- <div class="rating-star">
                                                                            <i class="bi bi-star-fill text-warning"></i>
                                                                            <i class="bi bi-star-fill text-warning"></i>
                                                                            <i class="bi bi-star-fill text-warning"></i>
                                                                            <i class="bi bi-star-fill text-warning"></i>
                                                                            <i class="bi bi-star-half text-warning"></i>
                                                                            <i class="bi bi-star text-secondary"></i>
                                                                        </div> --}}
                                                                    </div>
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
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>

@endif
