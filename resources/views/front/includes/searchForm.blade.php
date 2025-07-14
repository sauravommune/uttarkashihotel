<form action="" method="post" id="searchForm">
    <input type="hidden" name="search_id" value="{{ encode($searchData?->id) }}">
    @csrf()
    <div class="row row-cols-1 row-cols-sm-1 row-cols-xl-5 g-0">
        <div class="col repeat-section">
            <div class="search-item position-relative room-search">
                <div>
                    <label for="exampleInputEmail1" class="form-label">City / Location</label>
                    <h4 class="section-hotel origin-room " id="show-city">
                        {{ $searchData->city?->name }}, {{ $searchData->city?->state?->name }}
                    </h4>
                    <input type="hidden" name="cityId" value="{{ $searchData->city?->id }}" id="setCityId" />
                </div>

                <div id="data-city-name" data-city_name="{{ $searchData->city?->name }}"></div>

                <div class="search-sections-part d-none">
                    <div class="search-content-container" id="search-box-container">
                        <ul class=" ">
                            <li class="mb-2 searcher border-0">
                                <a href="javascript:void(0);">
                                    <div class="d-flex justify-content-between w-100">
                                        <input type="text" id="searchCity"
                                            class="form-control-custom w-100 rounded search-depart"
                                            placeholder="City..">
                                    </div>
                                </a>
                            </li>
                            <div id="notFoundMessage"></div>
                            <span class="appender-class"></span>
                            @if (!empty($citiesWithHotelCount))
                            @foreach ($citiesWithHotelCount as $city)
                            <li class="clicker py-2" data-id="{{ $city->id }}">
                                <a href="javascript:void(0);">
                                    <div class="d-flex justify-content-between w-100">
                                        <div class="d-flex align-items-center">
                                            <div class="icon">
                                                <span class="icon-location"></span>
                                            </div>
                                            <div class="text ms-3">
                                                <h5 class="city_name">
                                                    {{ ucwords($city->name) ?? '' }}
                                                </h5>
                                                <p class="state_name">{{$city->state?->name}}</p>
                                            </div>
                                        </div>
                                        <div class="count d-block text-center">
                                            {{-- <p>{{ $city->get_hotel_count ?? 0 }}</p>
                                            <b>Hotels</b> --}}
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col  repeat-section">
            <div class="search-item">
                <label for="checkInDate" class="form-label">Check In</label>
                <h4 class="section-hotel check-in">
                    {{ Carbon\Carbon::parse($searchData->checkin_date)->format('F d, Y') ?? date('F d, Y')
                    }}
                </h4>
                <input type="hidden" class="form-control d-none" id="checkInDate" name="checkin_date"
                    value="{{ Carbon\Carbon::parse($searchData->checkin_date)->format('Y-m-d') }}">
            </div>
        </div>
        <div class="col  repeat-section">
            <div class="search-item">
                <label for="checkout_date" class="form-label">Check out</label>
                <h4 class="section-hotel check-out">
                    {{ Carbon\Carbon::parse($searchData->checkout_date)->format('F d, Y') ?? date('F d, Y')
                    }}
                </h4>
                <input type="hidden" class="form-control d-none" name="checkout_date" id="checkOutDate"
                    value="{{ Carbon\Carbon::parse($searchData->checkout_date)->format('Y-m-d') }}">
            </div>
        </div>
        <div class="col repeat-section guest-select">
            <div class="search-item position-relative">
                <label for="guestInput" class="form-label">Rooms & Guests</label>
                <div class="dropdown-container">
                    <input type="text" class="guest-input" value="Select Guests" readonly />
                    <div class="guest-dropdown dropdown">
                        <div class="guest-category">
                            <span>Rooms</span>
                            <div class="controls d-flex">
                                <a class="room-decrement decrement" data-type="room">-</a>
                                <span class="room-count">{{ $searchData->roomCount ?? 1 }}</span>
                                <a class="room-increment increment" data-type="room">+</a>
                            </div>
                        </div>
                        <div class="guest-category">
                            <span>Adults</span>
                            <div class="controls d-flex">
                                <a class="adult-decrement decrement" data-type="adult">-</a>
                                <span class="adult-count">{{ $searchData->adultCount ?? 1 }}</span>
                                <a class="adult-increment increment" data-type="adult">+</a>
                            </div>
                        </div>
                        <div class="guest-category">
                            <span>Children</span>
                            <div class="controls d-flex">
                                <a class="child-decrement decrement" data-type="child">-</a>
                                <span class="child-count">{{ $searchData->childCount ?? 0 }}</span>
                                <a class="child-increment increment" data-type="child">+</a>
                            </div>
                        </div>
                        <div class="age-selector">
                            @foreach( $searchData->child_ages??[] as $key=>$age )
                            <div class="child-age">
                                {{$age}}
                                <label for="childAge{{$key}}">Child {{$key}} Age</label>
                                <select class="child-age-select" name="childAge[]">
                                    @for($i=1; $i<=12; $i++) <option value="{{$i}}" @selected($age==$i)>{{$i}} year
                                        </option>
                                        @endfor
                                </select>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="traveler-container">
                <input type="hidden" name="roomCount" class="room-count-input"
                    value="{{ $searchData->roomCount ?? 1}}">
                <input type="hidden" name="adultCount" class="adult-count-input"
                    value="{{ $searchData->adultCount ?? 1 }}">
                <input type="hidden" name="childCount" class="child-count-input"
                    value="{{ $searchData->childCount ?? 0}}">
            </div>
        </div>
        <div class="col  repeat-section">
            <div class="search-item">
                <button type="button" id="searchBtn" class="btn btn-outline-primary d-flex align-items-center"
                    title="Search"><span class="icon-search-1 pe-2 pt-0"></span>Search</button>
            </div>
        </div>
    </div>
</form>