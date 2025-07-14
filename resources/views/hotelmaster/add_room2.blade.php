<x-app-layout>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-18 m-0">
                        {{ $title }}
                    </h1>

                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="index.html" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Hotel</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Add Room</li>
                        <!--end::Item-->
                    </ul>
                </div>
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="javascript:void(0);"
                        class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-success bg-body h-40px fs-7 fw-bold"
                        onclick="window.history.back()"> <i class="ki-outline ki-black-left fs-2"></i> Back</a>
                </div>
                <!--end::Actions-->
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid create-hotel">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Stepper-->
            <div class="stepper stepper-pills" id="create_hotel">
                <!--begin::Nav-->
                <div class="stepper-nav overflow-auto">
                    <!--begin::Step 1-->
                    <div class="stepper-item ms-0 mx-8 my-4 current" data-kt-stepper-element="nav">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label">
                                <h3 class="stepper-title stepper-switch">
                                    Room Details
                                </h3>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 1-->

                    <!--begin::Step 2-->
                    <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label">
                                <h3 class="stepper-title">
                                    Near by Places
                                </h3>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 2-->

                    <!--begin::Step 3-->
                    <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label">
                                <h3 class="stepper-title">
                                    Room Images
                                </h3>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 3-->

                    <!--begin::Step 4-->
                    <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label">
                                <h3 class="stepper-title">
                                    Room Policy
                                </h3>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 4-->

                    <!--begin::Step 5-->
                    <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label">
                                <h3 class="stepper-title">
                                    Owner Details
                                </h3>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 5-->
                </div>
                <!--end::Nav-->

                <div class="progress h-10px mb-8" id="progress_bar_container" role="progressbar"
                    aria-label="Example 20px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 0%" id="progress_bar_width"></div>
                </div>


                <!--begin::Form-->
                <form action="{{ route('hotel.save') }}" class="global-ajax-form" method="POST"
                    enctype="multipart/form-data" data-redirect-url="{{ route('hotel') }}" id="create_hotel_form">
                    @csrf


                    <!--begin::Group-->
                    <div class="mb-5">
                        <!--begin::Step 1-->
                        <div class="flex-column current" data-kt-stepper-element="content">
                            <!--begin::Input group-->
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <div class="card-title">
                                        <!--begin::Title-->
                                        <h3 class="fw-bold text-gray-900 m-0">
                                            Room Details
                                        </h3>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <div class="card-body p-5">
                                    <input type="hidden" name="id" value="{{ $room->id }}">
                                    <div class="row mb-5">
                                        <label class="required fw-semibold mb-2 col-sm-3">Hotel Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control mb-3 mb-lg-0"
                                                placeholder="Enter Room name"
                                                value="{{ old('name', $room->name) }}" />
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <label class="required fw-semibold mb-2 col-sm-3">Hotel Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" name="email" id="hotel_email"
                                                class="form-control mb-3 mb-lg-0" placeholder="Enter Email Address"
                                                value="{{ old('email', $room->email) }}" />
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <label class="required fw-semibold mb-2 col-sm-3">Contact Number</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="phone" maxlength="10"
                                                id="hotel_phone_number" class="form-control mb-3 mb-lg-0"
                                                placeholder="Enter Phone number."
                                                value="{{ old('phone', $room->phone) }}" />
                                        </div>
                                    </div>


                                    <div class="row mb-5">
                                        <label class="required fw-semibold mb-2 col-sm-3">Address</label>
                                        <div class="col-sm-9">
                                            {{-- <input type="text" name="address" class="form-control mb-3 mb-lg-0"
                                                    placeholder="Enter Room Address" value="{{ old('address', $room->address) }}" /> --}}

                                            <textarea placeholder="Enter Room Address" class="form-control mb-3 mb-lg-0" data-kt-autosize="true"
                                                data-kt-initialized="1" name ="address"> {{ old('address', $room->address) }}</textarea>
                                        </div>
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Label-->
                                        <label class="fw-semibold mb-2 col-sm-3">City</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-sm-9">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->


                                                <div class="col-lg-12 col-12">
                                                    <select name="city" aria-label="Select a city"
                                                        data-control="select2" data-placeholder="Select a city..."
                                                        class="form-select form-select-lg fw-semibold" id="city">
                                                        <option></option>
                                                        @foreach ($city as $c)
                                                            <option value="{{ $c->id }}"
                                                                @selected($c->id == $room->city)>
                                                                {{ ucwords($c?->name) }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <!--end::Col-->
                                            </div>


                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>



                                    <div class="row mb-5">
                                        <label class="fw-semibold mb-2 col-sm-3">Zip Code</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="zip_code" class="form-control mb-3 mb-lg-0"
                                                placeholder="Enter Zip Code"
                                                value="{{ old('zip_code', $room->zip_code) }}" />
                                        </div>
                                    </div>

                                    <div class="form-group row mb-5">
                                        <label class="col-md-3 form-label">Room Type</label>
                                        <div class="col-md-9">
                                            <select class="form-control datatable-input" data-control="select2"
                                                name="room_type" data-placeholder="Select an option">
                                                <option></option>
                                                @foreach (config('data.roomTypes') as $roomType)
                                                    <option value="{{ $roomType }}"
                                                        @if (isset($room->room_type) && $room->room_type == $roomType) selected @endif
                                                        @if (old('room_type') == $roomType) selected @endif>
                                                        {{ $roomType }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-5">
                                        <label class="col-md-3 form-label">Parking Available</label>
                                        <div class="col-md-4">
                                            <select class="form-control datatable-input" data-control="select2"
                                                name="parking_available" data-placeholder="Select an option">
                                                <option></option>
                                                <option value="yes" @selected($room->parking_available == 'yes')>Yes</option>
                                                <option value="no" @selected($room->parking_available == 'no')>No</option>
                                                <option value="comment" @selected($room->parking_available == 'comment')>Comment
                                                </option>

                                            </select>
                                        </div>
                                        <div
                                            class="col-md-5 comment_box {{ $room->parking_available != 'comment' ? 'd-none' : '' }}">
                                            <input type="text" name="parking_comment"
                                                class="form-control mb-3 mb-lg-0" placeholder="Enter Parking Comment"
                                                value="{{ old('parking_comment', $room->parking_comment) }}" />
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <label class="fw-semibold mb-2 col-sm-3">Rating</label>
                                        <div class="col-sm-9">
                                            <div class="rating">

                                                <!--begin::Star 1-->

                                                @for ($i = 1; $i <= 5; $i++)
                                                    <label class="rating-label"
                                                        for="kt_rating_2_input_{{ $i }}">
                                                        <i class="ki-duotone ki-star fs-1"></i>
                                                    </label>
                                                    <input class="rating-input" name="rating2"
                                                        value="{{ $i }}" type="radio"
                                                        id="kt_rating_2_input_{{ $i }}" />
                                                @endfor
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <label class="fw-semibold mb-2 col-sm-3">Hotel Description</label>
                                        <div class="col-sm-9">
                                            <textarea name="description" placeholder="Enter Room Description" class="form-control mb-3 mb-lg-0"
                                                id="modal-tiny-editor2" rows="5">{{ old('description', $room->description) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <label class="fw-semibold mb-2 col-sm-3">Google Map Url </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="google_embed_url"
                                                class="form-control mb-3 mb-lg-0" placeholder="Google Map Url"
                                                value="{{ old('google_embed_url', $room->google_embed_url) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty($room)
                                <div class="card shadow-sm mt-5">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <!--begin::Title-->
                                            <h3 class="fw-bold text-gray-900 m-0">
                                                Room Images
                                            </h3>
                                            <!--end::Title-->
                                        </div>
                                    </div>

                                    <div class="card-body p-5">
                                        <div class="col-sm-12 d-flex justify-content-between">
                                            <div class="col-sm-3">
                                                <label class="fw-semibold mb-2 mt-5">Upload Images</label>
                                            </div>


                                            <div class="col-sm-8">

                                                <input type="file" name="hotel_images[]"
                                                    class="form-control mb-3 mb-lg-0" placeholder="Enter Place"
                                                    value="" multiple />

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            @endempty
                            <!--end::Input group-->
                        </div>
                        <!--end::Step 1-->

                        <!--begin::Step 2-->
                        <div class="flex-column" data-kt-stepper-element="content">
                            <!--begin::Input group-->
                            <div class="card shadow-sm mt-5">
                                <div class="card-header">
                                    <div class="card-title">
                                        <!--begin::Title-->
                                        <h3 class="fw-bold text-gray-900 m-0">
                                            Near by Places
                                        </h3>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <div class="card-body p-5">
                                    <div class="col-sm-12 d-flex justify-content-between">
                                        <div class="row">
                                        <div class="col-sm-3">
                                            <label class="fw-semibold mb-2 mt-5">Places & Distance</label>
                                        </div>


                                        <div class="col-sm-8">
                                            <table class="table">
                                                <tbody>
                                                    <tr class="f_row">
                                                        @if ($room->near_by_place)
                                                            @foreach ($room->near_by_place as $place)
                                                                <td>
                                                                    <input type="text"
                                                                        name="near_by_place[{{ $loop->index }}]"
                                                                        class="form-control mb-3 mb-lg-0"
                                                                        placeholder="Enter Place"
                                                                        value="{{ $place }}" />
                                                                </td>
                                                            @endforeach
                                                        @else
                                                            <td>
                                                                <input type="text" name="near_by_place[0]"
                                                                    class="form-control mb-3 mb-lg-0"
                                                                    placeholder="Enter Place" value="" />
                                                            </td>


                                                        @endif
                                                        @if ($room->near_by_distance)
                                                            @foreach ($room->near_by_distance as $distance)
                                                                <td>
                                                                    <input type="text" name="near_by_distance[0]"
                                                                        class="form-control mb-3 mb-lg-0"
                                                                        placeholder="Enter Distance"
                                                                        value="{{ $distance }}" />
                                                                </td>
                                                            @endforeach
                                                        @else
                                                            <td>
                                                                <input type="text" name="near_by_distance[0]"
                                                                    class="form-control mb-3 mb-lg-0"
                                                                    placeholder="Enter Distance" value="" />
                                                            </td>
                                                        @endif
                                                    </tr>



                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-1  text-end  mt-3">
                                            <button type="button" class="btn btn-primary text-nowrap p-2 py-4 p-md-auto" id="near_by_add_btn">Add
                                                +</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Step 2-->

                        <!--begin::Step 3-->
                        <div class="flex-column" data-kt-stepper-element="content">
                            <!--begin::Input group-->
                            <div class="card shadow-sm mt-5">
                                <div class="card-header">
                                    <div class="card-title">
                                        <!--begin::Title-->
                                        <h3 class="fw-bold text-gray-900 m-0">
                                            Room Images
                                        </h3>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <div class="card-body p-5">
                                    <div class="col-sm-12 d-flex justify-content-between">
                                        <div class="col-sm-3">
                                            <label class="fw-semibold mb-2 mt-5" id="hotel-imgs">Select
                                                Image(s)</label>
                                        </div>


                                        <div class="col-sm-9">
                                            <div class="dropzone" id="kt_dropzonejs_example_1">
                                                <!--begin::Message-->
                                                <div class="dz-message needsclick">
                                                    <i class="ki-duotone ki-file-up fs-3x text-primary"><span
                                                            class="path1"></span><span class="path2"></span></i>
                                                    <!--begin::Info-->
                                                    <div class="ms-4">
                                                        <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here
                                                            or click to
                                                            upload.</h3>
                                                        <span class="fs-7 fw-semibold text-gray-500">Upload up to
                                                            10
                                                            files</span>
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Step 3-->

                        <!--begin::Step 4-->
                        <div class="flex-column" data-kt-stepper-element="content">
                            <!--begin::Input group-->
                            <div class="card shadow-sm mt-5">
                                <div class="card-header">
                                    <div class="card-title">
                                        <!--begin::Title-->
                                        <h3 class="fw-bold text-gray-900 m-0">
                                            Room Policy
                                        </h3>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <div class="card-body p-5">
                                    {{-- Room policy --}}
                                    <div class="row mb-5">
                                        <label class="fw-semibold mb-2 col-sm-3">Check In & Check Out Time</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" name="check_in_time"
                                                        class="form-control mb-3 mb-lg-0 kt_time_flatpickr"
                                                        placeholder="Check In  Time"
                                                        value="{{ old('check_in_time', $room->check_in_time) }}" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" name="check_out_time"
                                                        class="form-control mb-3 mb-lg-0 kt_time_flatpickr"
                                                        placeholder="Check Out  Time"
                                                        value="{{ old('check_out_time', $room->check_out_time) }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <label class="fw-semibold mb-2 col-sm-3">Early Check In/Out
                                            Available</label>
                                        <div class="col-sm-9">

                                            <select class="form-control datatable-input" data-control="select2"
                                                name="early_check_in_check_out" data-placeholder="Select an option">
                                                <option></option>
                                                <option value="yes" @selected($room->early_check_in_check_out == 'yes')>Yes</option>
                                                <option value="no" @selected($room->early_check_in_check_out == 'no')>No</option>
                                                <option value="depends" @selected($room->early_check_in_check_out == 'depends')>Depends
                                                </option>

                                            </select>

                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="fw-semibold mb-2 col-sm-3">Cancellation before Check In
                                            <br>
                                            <p class="text-muted">(Days before check In, user can cancel booking)
                                            </p>
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="cancellation_before"
                                                class="form-control mb-3 mb-lg-0" placeholder="Enter days"
                                                value="{{ old('cancellation_before', $room->cancellation_before ?? 7) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Step 4-->

                        <!--begin::Step 5-->
                        <div class="flex-column" data-kt-stepper-element="content">
                            <!--begin::Input group-->
                            <div class="card shadow-sm mt-5">
                                <div class="card-header">
                                    <div class="card-title">
                                        <!--begin::Title-->
                                        <h3 class="fw-bold text-gray-900 m-0">
                                            Owner Details
                                        </h3>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <div class="card-body p-5">

                                    <div class="row mb-5">
                                        <label class="fw-semibold mb-2 col-sm-3">Owner Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="owner_name" class="form-control mb-3 mb-lg-0"
                                                placeholder="Enter Owner Name"
                                                value="{{ old('owner_name', $room->owner_name) }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="fw-semibold mb-2 col-sm-3">Owner Phone Number</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="owner_contact_no"
                                                class="form-control mb-3 mb-lg-0" id="owner_hotel_phone_number"
                                                placeholder="Owner Phone  Number"
                                                value="{{ old('owner_contact_no', $room->owner_contact_no) }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="fw-semibold mb-2 col-sm-3">Owner Email Address</label>
                                        <div class="col-sm-9">
                                            <input type="email" name="owner_email"
                                                class="form-control mb-3 mb-lg-0" id="owner_hotel_email"
                                                placeholder="Owner Email Address"
                                                value="{{ old('owner_email', $room->owner_email) }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="fw-semibold mb-2 col-sm-3">Active/Inactive</label>
                                        <div class="col-sm-9">

                                            <div class="form-check form-switch">
                                                <input class="form-check-input custom-pointer" type="checkbox"
                                                    role="switch" id="flexSwitchCheckChecked">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckChecked">Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Step 5-->
                    </div>
                    <!--end::Group-->

                    <!--begin::Actions-->
                    <div class="d-flex flex-stack mt-10">
                        <!--begin::Wrapper-->
                        <div class="me-2">
                            <button type="button" id="back_stipper_btn"
                                class="btn btn-light btn-active-light-primary" data-kt-stepper-action="previous">
                                Back
                            </button>
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Wrapper-->
                        <div>
                            <button type="submit" id="submit_stipper_btn" class="btn btn-primary"
                                data-kt-stepper-action="submit">
                                <span class="indicator-label">
                                    Submit
                                </span>
                                <span class="indicator-progress">
                                    Please wait... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>

                            <button type="button" id="continue_stipper_btn" class="btn btn-primary"
                                data-kt-stepper-action="next">
                                Continue
                            </button>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Stepper-->
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {

                var imageInputElement = document.querySelector("#my_image_input_control");
                var imageInput = new KTImageInput(imageInputElement);

                $(".dynamic-select2").select2({
                    tags: true,
                });

                tinymce.init({
                    selector: '#modal-tiny-editor1',
                    height: 300,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste wordcount'
                    ],
                    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',

                });

                $('#near_by_add_btn').on('click', function() {
                    let row = `<tr class="f_row">
                             <td>
                <input type="text" name="near_by_place[]" class="form-control mb-3 mb-lg-0" placeholder="Enter Place" value="" />
                    </td>
                    <td>
                        <input type="text" name="near_by_distance[]" class="form-control mb-3 mb-lg-0" placeholder="Enter Distance" value="" />
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger delete-row"><span class="fa fa-trash"></span></button>
                    </td>
                            </tr>`;
                    $('tbody').append(row);

                })

                $('select[name="parking_available"]').on('change', function() {
                    let _this = $(this);
                    let commentBox = $('.comment_box');
                    let type = _this.val();
                    type == 'comment' ? commentBox.removeClass('d-none') : commentBox.addClass('d-none')
                })
                $(document).on('click', '.delete-row', function() {
                    $(this).closest('tr').remove();
                });

                Dropzone.autoDiscover = false;
                var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
                    url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
                    paramName: "hotel_imgs", // The name that will be used to transfer the file
                    maxFiles: 10,
                    maxFilesize: 10, // MB
                    addRemoveLinks: true,
                    acceptedFiles: ".png, .jpg, .jpeg",
                    init: function() {
                        this.on("addedfile", function(file) {
                            updateLabelText();
                        });

                        this.on("removedfile", function(file) {
                            updateLabelText();
                        });
                    }
                });

                function updateLabelText() {
                    var label = document.getElementById("hotel-imgs");
                    if (myDropzone.files.length > 0) {
                        label.textContent = "Selected Image(s)";
                    } else {
                        label.textContent = "Select Image(s)";
                    }
                }
                this.on("queuecomplete", function() {
                    document.getElementById("#create_hotel_form")
                        .submit(); // Submit the form after all files are uploaded
                });


            });

            $(document).ready(function() {
                function updateProgressBar() {
                    var containerWidth = $('#progress_bar_container').width();
                    var progressWidth = $('#progress_bar_width').width();
                    var steps = Math.ceil(progressWidth / (containerWidth * 0.2));
                    var separatorWidth = 4;

                    $('#progress_bar_container .separator').remove(); // Remove existing separators

                    for (var i = 1; i <= steps; i++) {
                        $('<div class="separator"></div>').css({
                            left: (i * (containerWidth * 0.2)) + (separatorWidth * (i - 1)) + 'px'
                        }).appendTo('#progress_bar_container');
                    }
                }

                $('#continue_stipper_btn').click(function() {
                    var containerWidth = $('#progress_bar_container').width();
                    var currentWidth = $('#progress_bar_width').width();
                    var newWidth = Math.min(currentWidth + containerWidth * 0.2,
                    containerWidth); // Ensure the width doesn't exceed 100%
                    $('#progress_bar_width').width(newWidth);
                    updateProgressBar();
                });

                $('#back_stipper_btn').click(function() {
                    var containerWidth = $('#progress_bar_container').width();
                    var currentWidth = $('#progress_bar_width').width();
                    var newWidth = Math.max(currentWidth - containerWidth * 0.2,
                    0); // Ensure the width doesn't go below 0%
                    $('#progress_bar_width').width(newWidth);
                    updateProgressBar();
                });

                $('#submit_stipper_btn').click(function() {
                    $('#progress_bar_width').width('100%');
                    updateProgressBar();
                });

                updateProgressBar(); // Initial call to set up separators
            });
        </script>
    @endpush
</x-app-layout>
