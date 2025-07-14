<!--begin::Stepper-->
<div class="stepper stepper-pills" id="kt_stepper_example_basic">
    <!--begin::Nav-->
    <div class="stepper-nav flex-center flex-wrap mb-10">
        <!--begin::Step 1-->
        <div class="stepper-item mx-8 my-4 current" data-kt-stepper-element="nav">
            <!--begin::Wrapper-->
            <div class="stepper-wrapper d-flex align-items-center">
                <!--begin::Icon-->
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">1</span>
                </div>
                <!--end::Icon-->

                <!--begin::Label-->
                <div class="stepper-label">
                    <h3 class="stepper-title">
                        Hotel Details
                    </h3>

                    <div class="stepper-desc">
                        Description
                    </div>
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
                <!--begin::Icon-->
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">2</span>
                </div>
                <!--begin::Icon-->

                <!--begin::Label-->
                <div class="stepper-label">
                    <h3 class="stepper-title">
                        Near by Places
                    </h3>

                    <div class="stepper-desc">
                        Description
                    </div>
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
                <!--begin::Icon-->
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">3</span>
                </div>
                <!--begin::Icon-->

                <!--begin::Label-->
                <div class="stepper-label">
                    <h3 class="stepper-title">
                        Hotel Images
                    </h3>

                    <div class="stepper-desc">
                        Description
                    </div>
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
                <!--begin::Icon-->
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">4</span>
                </div>
                <!--begin::Icon-->

                <!--begin::Label-->
                <div class="stepper-label">
                    <h3 class="stepper-title">
                        Hotel Policy
                    </h3>

                    <div class="stepper-desc">
                        Description
                    </div>
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
                <!--begin::Icon-->
                <div class="stepper-icon w-40px h-40px">
                    <i class="stepper-check fas fa-check"></i>
                    <span class="stepper-number">5</span>
                </div>
                <!--begin::Icon-->

                <!--begin::Label-->
                <div class="stepper-label">
                    <h3 class="stepper-title">
                        Owner Details
                    </h3>

                    <div class="stepper-desc">
                        Description
                    </div>
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

    <!--begin::Form-->
    <form action="{{ route('hotel.save') }}" class="global-ajax-form" method="POST" enctype="multipart/form-data"
        data-redirect-url="{{ route('hotel') }}" id="kt_stepper_example_basic_form">
        @csrf
        <!--begin::Group-->
        <div class="mb-5">
            <!--begin::Step 1-->
            <div class="flex-column current" data-kt-stepper-element="content">
                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <div class="card-title">
                                <!--begin::Title-->
                                <h3 class="fw-bold text-gray-900 m-0">
                                    Hotel Details
                                </h3>
                                <!--end::Title-->
                            </div>
                        </div>
                        <div class="card-body p-5">
                            <input type="hidden" name="id" value="{{ $hotel->id }}">
                            <div class="row mb-5">
                                <label class="required fw-semibold mb-2 col-sm-3">Hotel Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control mb-3 mb-lg-0"
                                        placeholder="Enter hotel name" value="{{ old('name', $hotel->name) }}" />
                                </div>
                            </div>

                            <div class="row mb-5">
                                <label class="required fw-semibold mb-2 col-sm-3">Hotel Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control mb-3 mb-lg-0"
                                        placeholder="Enter Email Address" value="{{ old('email', $hotel->email) }}" />
                                </div>
                            </div>

                            <div class="row mb-5">
                                <label class="required fw-semibold mb-2 col-sm-3">Contact No.</label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" class="form-control mb-3 mb-lg-0"
                                        placeholder="Enter Phone number." value="{{ old('phone', $hotel->phone) }}" />
                                </div>
                            </div>


                            <div class="row mb-5">
                                <label class="required fw-semibold mb-2 col-sm-3">Address</label>
                                <div class="col-sm-9">
                                    {{-- <input type="text" name="address" class="form-control mb-3 mb-lg-0"
                                        placeholder="Enter Hotel Address" value="{{ old('address', $hotel->address) }}" /> --}}

                                    <textarea placeholder="Enter Hotel Address" class="form-control mb-3 mb-lg-0" data-kt-autosize="true"
                                        data-kt-initialized="1" name ="address"> {{ old('address', $hotel->address) }}</textarea>
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
                                            <select name="city" aria-label="Select a city" data-control="select2"
                                                data-placeholder="Select a city..."
                                                class="form-select form-select-lg fw-semibold" id="city">
                                                <option></option>
                                                @foreach ($city as $c)
                                                    <option value="{{ $c->id }}" @selected($c->id == $hotel->city)>
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
                                        value="{{ old('zip_code', $hotel->zip_code) }}" />
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
                                                @if (old('room_type') == $roomType) selected @endif>{{ $roomType }}
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
                                        <option value="yes" @selected($hotel->parking_available == 'yes')>Yes</option>
                                        <option value="no" @selected($hotel->parking_available == 'no')>No</option>
                                        <option value="comment" @selected($hotel->parking_available == 'comment')>Comment</option>

                                    </select>
                                </div>
                                <div
                                    class="col-md-5 comment_box {{ $hotel->parking_available != 'comment' ? 'd-none' : '' }}">
                                    <input type="text" name="parking_comment" class="form-control mb-3 mb-lg-0"
                                        placeholder="Enter Parking Comment"
                                        value="{{ old('parking_comment', $hotel->parking_comment) }}" />
                                </div>
                            </div>

                            <div class="row mb-5">
                                <label class="fw-semibold mb-2 col-sm-3">Rating</label>
                                <div class="col-sm-9">
                                    <div class="rating">

                                        <!--begin::Star 1-->

                                        @for ($i = 1; $i <= 5; $i++)
                                            <label class="rating-label" for="kt_rating_2_input_{{ $i }}">
                                                <i class="ki-duotone ki-star fs-1"></i>
                                            </label>
                                            <input class="rating-input" name="rating2" value="{{ $i }}"
                                                type="radio" id="kt_rating_2_input_{{ $i }}" />
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <label class="fw-semibold mb-2 col-sm-3">Hotel Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description" placeholder="Enter Hotel Description" class="form-control mb-3 mb-lg-0"
                                        id="modal-tiny-editor2" rows="5">{{ old('description', $hotel->description) }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <label class="fw-semibold mb-2 col-sm-3">Google Map Url </label>
                                <div class="col-sm-9">
                                    <input type="text" name="google_embed_url" class="form-control mb-3 mb-lg-0"
                                        placeholder="Google Map Url"
                                        value="{{ old('google_embed_url', $hotel->google_embed_url) }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    @empty($hotel)
                        <div class="card shadow-sm mt-5">
                            <div class="card-header">
                                <div class="card-title">
                                    <!--begin::Title-->
                                    <h3 class="fw-bold text-gray-900 m-0">
                                        Hotel Images
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

                                        <input type="file" name="hotel_images[]" class="form-control mb-3 mb-lg-0"
                                            placeholder="Enter Place" value="" multiple />

                                    </div>

                                </div>
                            </div>

                        </div>
                    @endempty
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-10">
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
                                <div class="col-sm-3">
                                    <label class="fw-semibold mb-2 mt-5">Places & Distance form Hotel</label>
                                </div>


                                <div class="col-sm-8">
                                    <table class="table">

                                        <tbody>

                                            <tr class="f_row">
                                                @if ($hotel->near_by_place)
                                                    @foreach ($hotel->near_by_place as $place)
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
                                                @if ($hotel->near_by_distance)
                                                    @foreach ($hotel->near_by_distance as $distance)
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
                                <div class="col-sm-1 text-end mt-3">
                                    <button type="button" class="btn btn-primary" id="near_by_add_btn">Add
                                        +</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-10">
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
                                <div class="col-sm-3">
                                    <label class="fw-semibold mb-2 mt-5">Places & Distance form Hotel</label>
                                </div>


                                <div class="col-sm-8">
                                    <table class="table">

                                        <tbody>

                                            <tr class="f_row">
                                                @if ($hotel->near_by_place)
                                                    @foreach ($hotel->near_by_place as $place)
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
                                                @if ($hotel->near_by_distance)
                                                    @foreach ($hotel->near_by_distance as $distance)
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
                                <div class="col-sm-1 text-end mt-3">
                                    <button type="button" class="btn btn-primary" id="near_by_add_btn">Add
                                        +</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <div class="card shadow-sm mt-5">
                        <div class="card-header">
                            <div class="card-title">
                                <!--begin::Title-->
                                <h3 class="fw-bold text-gray-900 m-0">
                                    Hotel Images
                                </h3>
                                <!--end::Title-->
                            </div>
                        </div>
                        <div class="card-body p-5">
                            <div class="col-sm-12 d-flex justify-content-between">
                                <div class="col-sm-3">
                                    <label class="fw-semibold mb-2 mt-5" id="hotel-imgs">Select Image(s)</label>
                                </div>


                                <div class="col-sm-9">
                                    <div class="dropzone" id="kt_dropzonejs_example_1">
                                        <!--begin::Message-->
                                        <div class="dz-message needsclick">
                                            <i class="ki-duotone ki-file-up fs-3x text-primary"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <!--begin::Info-->
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to
                                                    upload.</h3>
                                                <span class="fs-7 fw-semibold text-gray-500">Upload up to 10
                                                    files</span>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <div class="card shadow-sm mt-5">
                        <div class="card-header">
                            <div class="card-title">
                                <!--begin::Title-->
                                <h3 class="fw-bold text-gray-900 m-0">
                                    Hotel Policy
                                </h3>
                                <!--end::Title-->
                            </div>
                        </div>
                        <div class="card-body p-5">
                            {{-- Hotel policy --}}
                            <div class="row mb-5">
                                <label class="fw-semibold mb-2 col-sm-3">Check In & Check Out Time</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" name="check_in_time"
                                                class="form-control mb-3 mb-lg-0 kt_time_flatpickr"
                                                placeholder="Check In  Time"
                                                value="{{ old('check_in_time', $hotel->check_in_time) }}" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="check_out_time"
                                                class="form-control mb-3 mb-lg-0 kt_time_flatpickr"
                                                placeholder="Check Out  Time"
                                                value="{{ old('check_out_time', $hotel->check_out_time) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <label class="fw-semibold mb-2 col-sm-3">Early Check In/Out Available</label>
                                <div class="col-sm-9">

                                    <select class="form-control datatable-input" data-control="select2"
                                        name="early_check_in_check_out" data-placeholder="Select an option">
                                        <option></option>
                                        <option value="yes" @selected($hotel->early_check_in_check_out == 'yes')>Yes</option>
                                        <option value="no" @selected($hotel->early_check_in_check_out == 'no')>No</option>
                                        <option value="depends" @selected($hotel->early_check_in_check_out == 'depends')>Depends</option>

                                    </select>

                                </div>
                            </div>
                            <div class="row mb-5">
                                <label class="fw-semibold mb-2 col-sm-3">Cancellation before Check In
                                    <br>
                                    <p class="text-muted">(Days before check In, user can cancel booking)</p>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="cancellation_before"
                                        class="form-control mb-3 mb-lg-0" placeholder="Enter days"
                                        value="{{ old('cancellation_before', $hotel->cancellation_before ?? 7) }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-10">
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
                                        value="{{ old('owner_name', $hotel->owner_name) }}" />
                                </div>
                            </div>
                            <div class="row mb-5">
                                <label class="fw-semibold mb-2 col-sm-3">Owner Phone Number</label>
                                <div class="col-sm-9">
                                    <input type="text" name="owner_contact_no" class="form-control mb-3 mb-lg-0"
                                        placeholder="Owner Phone  Number"
                                        value="{{ old('owner_contact_no', $hotel->owner_contact_no) }}" />
                                </div>
                            </div>
                            <div class="row mb-5">
                                <label class="fw-semibold mb-2 col-sm-3">Owner Email Address</label>
                                <div class="col-sm-9">
                                    <input type="email" name="owner_email" class="form-control mb-3 mb-lg-0"
                                        placeholder="Owner Email Address"
                                        value="{{ old('owner_email', $hotel->owner_email) }}" />
                                </div>
                            </div>
                            <div class="row mb-5">
                                <label class="fw-semibold mb-2 col-sm-3">Active/Inactive</label>
                                <div class="col-sm-9">

                                    <div class="form-check form-switch">
                                        <input class="form-check-input custom-pointer" type="checkbox" role="switch"
                                            id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Input group-->
            </div>
            <!--begin::Step 1-->

            <!--begin::Step 1-->
            <div class="flex-column" data-kt-stepper-element="content">
                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="form-label">Example Label 1</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" name="input1" placeholder=""
                        value="" />
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="form-label">Example Label 2</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <textarea class="form-control form-control-solid" rows="3" name="input2" placeholder=""></textarea>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="form-label">Example Label 3</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <label class="form-check form-check-custom form-check-solid">
                        <input class="form-check-input" checked="checked" type="checkbox" value="1" />
                        <span class="form-check-label">
                            Checkbox
                        </span>
                    </label>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
            </div>
            <!--begin::Step 1-->

            <!--begin::Step 1-->
            <div class="flex-column" data-kt-stepper-element="content">
                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="form-label d-flex align-items-center">
                        <span class="required">Input 1</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                            title="Example tooltip"></i>
                    </label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" name="input1" placeholder=""
                        value="" />
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="form-label">
                        Input 2
                    </label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" name="input2" placeholder=""
                        value="" />
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
            </div>
            <!--begin::Step 1-->

            <!--begin::Step 1-->
            <div class="flex-column" data-kt-stepper-element="content">
                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="form-label d-flex align-items-center">
                        <span class="required">Input 1</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                            title="Example tooltip"></i>
                    </label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" name="input1" placeholder=""
                        value="" />
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="form-label">
                        Input 2
                    </label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" name="input2" placeholder=""
                        value="" />
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="form-label">
                        Input 3
                    </label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" name="input3" placeholder=""
                        value="" />
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
            </div>
            <!--begin::Step 1-->
        </div>
        <!--end::Group-->

        <!--begin::Actions-->
        <div class="d-flex flex-stack">
            <!--begin::Wrapper-->
            <div class="me-2">
                <button type="button" class="btn btn-light btn-active-light-primary"
                    data-kt-stepper-action="previous">
                    Back
                </button>
            </div>
            <!--end::Wrapper-->

            <!--begin::Wrapper-->
            <div>
                <button type="button" class="btn btn-primary" data-kt-stepper-action="submit">
                    <span class="indicator-label">
                        Submit
                    </span>
                    <span class="indicator-progress">
                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>

                <button type="button" class="btn btn-primary" data-kt-stepper-action="next">
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
