<x-app-layout>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-color fw-bold fs-18 m-0">
                        {{ $title }}
                    </h1>
                    <!--end::Title-->
                    {{-- <h6 class="text-muted">Manage all your Company here!</h6> --}}
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superAdmin.dashboard') }}" class="text-color-secondary text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>

                        @if( $roomDetails?->hotel_id )
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('hotel') }}" class="text-color-secondary text-hover-primary">Hotels</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('rooms', encode($roomDetails?->hotel_id)) }}" class="text-color-secondary text-hover-primary">Room Lists</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        @endif

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-color-secondary"> {{ $title }}</li>
                        <!--end::Item-->
                    </ul>
                </div>
                <!--end::Page title-->
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card border-0 shadow-none pb-4">
                <!--begin::Card header-->
                <div class="card-body p-0">
                    <form action="{{ route('ratePlan.store') }}" method="POST" class="global-ajax-form" data-redirect-url ="{{ route('rooms', encode($roomDetails?->hotel_id)) }}">
                        @csrf
                        <div class="row align-items-end pb-4">
                            <div class="row ">

                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                    <div class="fv-row fv-plugins-icon-container">
                                        <label class="form-label">Hotel</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            data-placeholder="Select hotel" name="hotel" id=hotel required>
                                            <option></option>
                                            @foreach ($hotel as $value)
                                                <option value="{{ $value->id }}" @selected($roomDetails?->hotel_id == $value?->id)>{{ ucwords($value->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 mt-4 mt-sm-0">
                                    <div class="fv-row fv-plugins-icon-container">
                                        <label class="form-label">Room Type</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            data-placeholder="Select room type" name="room_type" id="room" required>
                                            <option></option>
                                            @foreach ($roomsType as $type)
                                                <option value="{{ $type?->id }}" @selected($roomDetails?->room_type == $type?->room_type)>
                                                    {{ ucwords($type?->roomType?->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 mt-4 mt-xl-0">
                                    <div class="fv-row fv-plugins-icon-container">
                                        <label class="form-label">From Date</label>
                                        <input class="form-control form-control-solid modal-date-picker" placeholder="Pick a date"
                                            id="solid-date-one" name="start_date"/>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 mt-4 mt-xl-0">
                                    <div class="fv-row fv-plugins-icon-container">
                                        <label class="form-label">To Date</label>
                                        <input class="form-control form-control-solid modal-date-picker" placeholder="Pick a date"
                                            id="solid-date-second" name="end_date"/>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-4 mt-xl-4">
                                    <div class="fv-row fv-plugins-icon-container">
                                        <label class="form-label">Days</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            data-placeholder="Select Days" name="days[]" multiple>
                                            <option value="0">Sunday</option>                                                
                                            <option value="1">Monday</option>
                                            <option value="2">Tuesday</option>
                                            <option value="3">Wednesday</option>
                                            <option value="4">Thursday</option>
                                            <option value="5">Friday</option>
                                            <option value="6">Saturday</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="position-relative my-5 pt-1">
                            <div class="separator-vertical "></div>
                        </div>

                        <h3> Rate Plans : </h3>

                        <div class="d-flex align-items-center gap-3 my-5">
                            <div class="col-sm-3"></div>

                            <div class="form-check">
                                <input class="form-check-input extra_config" type="checkbox" name="is_extra_person_allowed" id="is_extra_person_allowed">
                                <label class="form-check-label" for="is_extra_person_allowed">
                                    Extra Person Allowed
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input extra_config" type="checkbox" name="child_with_bed" id="child_with_bed">
                                <label class="form-check-label" for="child_with_bed">
                                    Child With Bed
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input extra_config" type="checkbox" name="child_with_no_bed" id="child_with_no_bed">
                                <label class="form-check-label" for="child_with_no_bed">
                                    Child With No Bed
                                </label>
                            </div>
                        </div>

                        <div class="row pb-5" id="extra_bed_config">
                            <div class="col-sm-3"></div>
                            <div class="col-md-2 no_of_extra_person hidden-div">
                                <input type="number"
                                    class="form-control text-color-secondary"
                                    name="no_of_extra_person" placeholder="No of Allowed Persons"
                                    value="{{ old('no_of_extra_person') }}" />
                            </div>
                            <div class="col-md-2 child_with_bed hidden-div">
                                <input type="number"
                                    class="form-control text-color-secondary"
                                    name="min_child_age" placeholder="Minimum Child Age"
                                    value="{{ old('min_child_age') }}" />
                            </div>
                        </div>





                        <!-- EP Rates -->
                        <div class="row mb-5 py-1 align-items-center" id="ep_rates">
                            <div class="col-sm-3">
                                <div class="d-flex flex-column">
                                    <span class="text-color fs-7 fw-bold">EP Rates & Markup</span>
                                    <span class="text-color-secondary fw-semibold fs-8">Room only, with no
                                        meals.</span>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4 mt-sm-0">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="b2b_rate_ep" placeholder="Enter EP rate"
                                        value="{{ old('b2b_rate_ep') }}">
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4 mt-sm-0">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="markup_ep" placeholder="Enter EP Markup"
                                        value="{{ old('markup_ep') }}">
                                </div>
                            </div>

                            <div class="col-sm-3 no_of_extra_person hidden-div">
                                <span class="text-color text-sm">Extra Person Rates & Markup</span>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="extra_person_price[ep]" placeholder="Extra Person Rate"
                                        value="">
                                </div>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="extra_person_markup[ep]" placeholder="Extra Person Markup" />
                                </div>
                            </div>

                            <div class="col-sm-3 child_with_bed hidden-div">
                                <span class="text-color text-sm">Child with Bed Rates & Markup</span>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="child_with_bed_price[ep]" placeholder="Child with Bed Rate"
                                        value="">
                                </div>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="child_with_bed_markup[ep]" placeholder="Child with Bed Markup" />
                                </div>
                            </div>

                            <div class="col-sm-3 child_with_no_bed hidden-div">
                                <span class="text-color text-sm">Child with No Bed Rates & Markup</span>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="child_with_no_bed_price[ep]" placeholder="Child with No Bed Rate"
                                        value="">
                                </div>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="child_with_no_bed_markup[ep]" placeholder="Child with No Bed Markup" />
                                </div>
                            </div>

                        </div>






                        <!-- CP Rates -->
                        <div class="row mb-5 py-1 align-items-center" id="cp_rates">
                            <div class="col-sm-3">
                                <div class="d-flex flex-column">
                                    <span class="text-color fs-7 fw-bold">CP Rates</span>
                                    <span class="text-color-secondary fw-semibold fs-8">Breakfast is included along
                                        with room.</span>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4 mt-sm-0">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="b2b_rate_cp" placeholder="Enter CP rate"
                                        value="{{ old('b2b_rate_cp') }}">
                                </div>
                                @error('b2b_rate_cp')
                                <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-4 mt-4 mt-sm-0">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="markup_cp" placeholder="Enter CP Markup"
                                        value="{{ old('markup_cp') }}">
                                </div>
                                @error('markup_cp')
                                <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-3 no_of_extra_person hidden-div">
                                <span class="text-color text-sm">Extra Person Rates & Markup</span>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="extra_person_price[cp]" placeholder="Extra Person Rate"
                                        value="">
                                </div>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="extra_person_markup[cp]" placeholder="Extra Person Markup" />
                                </div>
                            </div>

                            <div class="col-sm-3 child_with_bed hidden-div">
                                <span class="text-color text-sm">Child with Bed Rates & Markup</span>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="child_with_bed_price[cp]" placeholder="Child with Bed Rate"
                                        value="">
                                </div>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="child_with_bed_markup[cp]" placeholder="Child with Bed Markup" />
                                </div>
                            </div>

                            <div class="col-sm-3 child_with_no_bed hidden-div">
                                <span class="text-color text-sm">Child with No Bed Rates & Markup</span>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="child_with_no_bed_price[cp]" placeholder="Child with No Bed Rate"
                                        value="">
                                </div>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="child_with_no_bed_markup[cp]" placeholder="Child with No Bed Markup" />
                                </div>
                            </div>
                        </div>







                        <!-- MAP Rates -->
                        <div class="row mb-5 py-1 align-items-center" id="map_rates">
                            <div class="col-sm-3">
                                <div class="d-flex flex-column">
                                    <span class="text-color fs-7 fw-bold">MAP Rates</span>
                                    <span class="text-color-secondary fw-semibold fs-8">Includes room, breakfast &
                                        dinner</span>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4 mt-sm-0">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="b2b_rate_map" placeholder="Enter MAP rate"
                                        value="{{ old('b2b_rate_map') }}">
                                </div>
                                @error('b2b_rate_map')
                                <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-4 mt-4 mt-sm-0">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="markup_map" placeholder="Enter MAP Markup"
                                        value="{{ old('markup_map') }}">
                                </div>
                                @error('markup_map')
                                <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-3 no_of_extra_person hidden-div">
                                <span class="text-color text-sm">Extra Person Rates & Markup</span>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="extra_person_price[map]" placeholder="Extra Person Rate"
                                        value="">
                                </div>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="extra_person_markup[map]" placeholder="Extra Person Markup" />
                                </div>
                            </div>

                            <div class="col-sm-3 child_with_bed hidden-div">
                                <span class="text-color text-sm">Child with Bed Rates & Markup</span>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="child_with_bed_price[map]" placeholder="Child with Bed Rate"
                                        value="">
                                </div>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="child_with_bed_markup[map]" placeholder="Child with Bed Markup" />
                                </div>
                            </div>

                            <div class="col-sm-3 child_with_no_bed hidden-div">
                                <span class="text-color text-sm">Child with No Bed Rates & Markup</span>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="child_with_no_bed_price[map]" placeholder="Child with No Bed Rate"
                                        value="">
                                </div>
                            </div>

                            <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">₹</span>
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="child_with_no_bed_markup[map]" placeholder="Child with No Bed Markup" />
                                </div>
                            </div>
                        </div>







                        <!-- Non-Refundable Rate -->
                        <div class="row mb-5 py-1">
                            <div class="col-sm-3">
                                <div class="d-flex flex-column">
                                    <span class="text-color fs-7 fw-bold">Non Refundable Rate</span>
                                    <span class="text-color-secondary fw-semibold fs-8">Discount when guests book
                                        non-refundable option</span>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4 mt-sm-0">
                                <div class="input-group input-group-solid">
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="non_refundable_rate" placeholder="% Discount"
                                        value="{{ old('non_refundable_rate') }}">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">%</span>
                                </div>
                                @error('non_refundable_rate')
                                <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Weekly Rate -->
                        <div class="row mb-5 py-1">
                            <div class="col-sm-3">
                                <div class="d-flex flex-column">
                                    <span class="text-color fs-7 fw-bold">Weekly Rates</span>
                                    <span class="text-color-secondary fw-semibold fs-8">Discount when guests book
                                        for a week</span>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4 mt-sm-0">
                                <div class="input-group input-group-solid">
                                    <input type="number"
                                        class="form-control form-control-solid text-color-secondary"
                                        name="weekly_rate" placeholder="% Discount"
                                        value="{{ old('weekly_rate') }}">
                                    <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                        id="basic-addon3">%</span>
                                </div>
                                @error('weekly_rate')
                                <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative my-3 pb-5">
                            <div class="separator-vertical "></div>
                        </div>
                        <div class="row mb-5 py-1">
                        </div>

                        <h3> Room Availability : </h3>
                        <div class="row mb-5 py-1">
                            <div class="col-sm-3">
                                <span class="text-color fs-7 fw-bold">Total Rooms</span>
                            </div>
                            <div class="col-sm-4 mt-4 mt-sm-0">
                                <input type="number" class="form-control form-control-solid text-color-secondary" value={{ $roomDetails->total_room }} readonly />
                            </div>
                        </div>
                        <div class="row mb-5 py-1">
                            <div class="col-sm-3">
                                <span class="text-color fs-7 fw-bold">Room Availability</span>
                            </div>
                            <div class="col-sm-4 mt-4 mt-sm-0">
                                <input type="number" class="form-control form-control-solid text-color-secondary" name="availability" value={{ old('availability') }} />
                                @error('availability')
                                <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-md-3 col-xl-3">
                                <button type="submit" class="btn btn-primary">Save Rate Plans</button>
                            </div>
                        </div>
                    </form>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
    <script>

        $(document).ready(function() {
            // Fade out the success message after 3 seconds

            setTimeout(function() {
                $('.alert-success').fadeOut('slow');
            }, 3000);

            $('select[name=hotel]').on('change',function(){
                $.ajax({
                    type: "post",
                    url: "{{route('get.room.type')}}",
                    data: {
                        id:$(this).val()
                    },
                    success: function (response) {
                        $('select[name=room_type]').empty().html(response.data)
                    }
                });
            });

            $('body').on('change', 'input.extra_config', function () {
                const isChecked = $(this).is(':checked');
                const field = $(this).attr('name');
                let html = '';
                if (isChecked) {
                    switch (field) {
                        case 'is_extra_person_allowed':
                            $('div.no_of_extra_person').fadeIn();
                            break;
                        case 'child_with_bed':
                            $('div.child_with_bed').fadeIn();
                            break;
                        case 'child_with_no_bed':
                            $('div.child_with_no_bed').fadeIn();
                            break;
                        default:
                            break;
                    }
                } else {
                    switch (field) {
                        case 'is_extra_person_allowed':
                            $('div.no_of_extra_person').fadeOut();
                            $('div.no_of_extra_person').find('input').val('');
                            break;
                        case 'child_with_bed':
                            $('div.child_with_bed').fadeOut();
                            $('div.child_with_bed').find('input').val('');
                            break;
                        case 'child_with_no_bed':
                            $('div.child_with_no_bed').fadeOut();
                            $('div.child_with_no_bed').find('input').val('');
                            break;
                        default:
                            break;
                    }
                }
            });
        });
    </script>

    @endpush

</x-app-layout>
