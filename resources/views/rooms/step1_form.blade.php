<div class="flex-column current" data-kt-stepper-element="content" id="step-1">
    <form class="global-ajax-form" action="{{ route('rooms.save') }}" method="post" novalidate="novalidate"
        id="step1form">
        @csrf
        <!--begin::Input group-->
        <div class="card shadow-sm mt-5">
            <div class="card-header">
                <div class="card-title">
                    <!--begin::Title-->
                    <h3 class="fw-bold text-color m-0">
                        Room Details
                    </h3>
                </div>
            </div>
            <div class="card-body p-5">
                <div class="col-sm-12 d-flex flex-column justify-content-between">

                    @if (!empty($roomDetails->id))
                    <input type="hidden" name="id" value="{{ $roomDetails->id ?? '' }}">
                    @endif

                    <div class="row w-100 mb-5 mt-4">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-3">Hotel Name</label><br>
                            <span id="hotel_error" class="text-danger"></span>
                        </div>

                        <div class="col-sm-4">
                            <div class="position-relative">
                                <input type="text" class="form-control form-control-solid" name="hotel_name" value="{{ $hotel?->name ?? '' }}" readonly />
                                <input type="hidden" name="hotel" value="{{ $hotel?->id ?? '' }}">
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row w-100 mb-5 mt-4">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-3">Select Hotel</label><br>
                            <span id="hotel_error" class="text-danger"></span>
                        </div>

                        <div class="col-sm-4">
                            <div class="position-relative">
                                <select class="form-select form-select-solid" data-control="select2"
                                    data-placeholder="Select hotel" name="hotel" id="hotel" required>
                                    <option></option>

                                    @foreach ($hotels as $value)
                                    <option value="{{ $value->id }}"
                                        {{ !empty($roomDetails->hotel_id) && $roomDetails->hotel_id == $value->id ? 'selected' : '' }}>
                                        {{ ucwords($value->name) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div> --}}

                    <div class="row w-100 mb-5 mt-4">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-3">What type of room is this?</label><br>
                            <span id="room_type_error" class="text-danger"></span>
                        </div>
                        <div class="col-sm-4">
                            <div class="position-relative">
                                <select class="form-select form-select-solid" data-control="select2"
                                    data-placeholder="Select room type" id="room_type" name="room_type" required>
                                    <option></option>
                                    @foreach ($room_category as $type)
                                    <option value="{{ $type->id }}"
                                        {{ !empty($roomDetails->room_type) && $roomDetails->room_type == $type->id ? 'selected' : '' }}>
                                        {{ ucwords($type->name) ?? '' }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100 mb-5 mt-4">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-5">Room Description</label><br>
                            <span id="room_desc_error" class="text-danger"></span>

                        </div>
                        <div class="col-sm-6">
                            <div class="rounded d-flex flex-column">
                                <textarea class="form-control form-control form-control-solid" data-kt-autosize="true"
                                    placeholder="Enter description" name="room_desc"
                                    id="room_desc">{{ $roomDetails->description ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100 mb-5 mt-4 pb-2">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-3">How many rooms of this type do you
                                have?</label></br>
                            <span id="total_rooms_error" class="text-danger"></span>

                        </div>
                        <div class="col-sm-4">
                            <div class="position-relative">
                                <input type="number" name="total_rooms" id="total_rooms"
                                    class="form-control form-control-solid" value="{{ $roomDetails->total_room ?? '' }}"
                                    placeholder="0" min="0" />
                            </div>
                        </div>
                    </div>

                    <div class="position-relative mb-5">
                        <div class="separator-vertical "></div>
                    </div>

                    <div class="row w-100 mb-5 mt-4 py-2">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-3">What beds do you have in this room?</label>
                            <span id="bed_error" class="text-danger"></span>
                        </div>

                        <div class="col-sm-9">

                            <div class="position-relative">
                                @if ($roomDetails?->getBed->count() > 0)
                                    @foreach ($roomDetails->getBed as $key => $item)
                                        <div class="d-flex flex-column gap-4" id="bed-{{ $item->id }}">
                                            <div id="room_bed">
                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <select name="bed_type[]"
                                                            class="form-select form-select-solid select2 error_bed"
                                                            data-placeholder="Select bed type" style="width: 100%;" required>

                                                            <option></option>
                                                            @foreach ($bed_type as $bed)
                                                            @if ($bed->id == $item->bed_type_id)
                                                            <option value="{{ $bed->id }}" selected>
                                                                {{ ucwords($bed->bed_type) ?? '' }}</option>
                                                            @else
                                                            <option value="{{ $bed->id }}">
                                                                {{ucwords($bed->bed_type) ?? '' }}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <!--begin::Dialer-->
                                                        <div class="position-relative" data-kt-dialer="true"
                                                            data-kt-dialer-min="0" data-kt-dialer-max="10"
                                                            data-kt-dialer-step="1">
                                                            <!--begin::Decrease control-->

                                                            <!--end::Decrease control-->
                                                            <!--begin::Input control-->
                                                            <button type="button"
                                                                class="btn btn-icon box-44-end position-absolute translate-middle-y top-50 start-0 bg-light-dark"
                                                                data-kt-dialer-control="decrease">
                                                                <span class="material-symbols-outlined text-color-secondary">
                                                                    remove
                                                                </span>
                                                            </button>
                                                            <input type="text"
                                                                class="form-control form-control-solid border-custom h-44px text-center text-color-secondary"
                                                                name="bed[]" value="{{ $item->total_bed ?? 0 }}" required />

                                                            <button type="button"
                                                                class="btn btn-icon box-44-start position-absolute translate-middle-y top-50 end-0 bg-light-dark"
                                                                data-kt-dialer-control="increase">
                                                                <span class="material-symbols-outlined text-color-secondary">
                                                                    add
                                                                </span>
                                                            </button>
                                                            <!--end::Input control-->
                                                            <!--begin::Increase control-->

                                                            <!--end::Increase control-->
                                                        </div>
                                                        <!--end::Dialer-->
                                                    </div>

                                                    <div class="col-md-2" id="room_bed_btn">
                                                        @if ($key == 0)
                                                        <button id="add_btn" type="button"
                                                            class="btn btn-primary d-flex align-items-center gap-2">
                                                            <span class="material-symbols-outlined fs-3">
                                                                add
                                                            </span>
                                                            Add
                                                        </button>
                                                        @else
                                                        <button type="button"
                                                            class="btn btn-dark box-40 remove_button delete_add_bed"
                                                            data-id="{{ $item->id }}">
                                                            <span class="material-symbols-outlined fs-1">delete</span>
                                                        </button>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                <div class="d-flex flex-column gap-4">
                                    <div id="room_bed">
                                        <div class="row mb-4" id="select_bed_type">
                                            <div class="col-md-4">
                                                <select name="bed_type[]" class="form-select form-select-solid"
                                                    id="bed_type" data-control="select2"
                                                    data-placeholder="Select bed type" style="width: 100%;" required>
                                                    <option></option>
                                                    @foreach ($bed_type as $bed)
                                                    <option value="{{ $bed->id }}">
                                                        {{ ucwords($bed->bed_type) ?? '' }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <!--begin::Dialer-->
                                                <div class="position-relative" data-kt-dialer="true"
                                                    data-kt-dialer-min="0" data-kt-dialer-max="10"
                                                    data-kt-dialer-step="1">
                                                    <!--begin::Decrease control-->
                                                    <button type="button"
                                                        class="btn btn-icon box-44-end position-absolute translate-middle-y top-50 start-0 bg-light-dark"
                                                        data-kt-dialer-control="decrease">
                                                        <span class="material-symbols-outlined text-color-secondary">
                                                            remove
                                                        </span>
                                                    </button>
                                                    <!--end::Decrease control-->
                                                    <!--begin::Input control-->
                                                    <input type="text"
                                                        class="form-control form-control-solid border-custom h-44px text-center text-color-secondary"
                                                        data-kt-dialer-control="input" placeholder="0" name="bed[0]"
                                                        value="1" required readonly />
                                                    <!--end::Input control-->
                                                    <!--begin::Increase control-->
                                                    <button type="button"
                                                        class="btn btn-icon box-44-start position-absolute translate-middle-y top-50 end-0 bg-light-dark"
                                                        data-kt-dialer-control="increase">
                                                        <span class="material-symbols-outlined text-color-secondary">
                                                            add
                                                        </span>
                                                    </button>
                                                    <!--end::Increase control-->
                                                </div>
                                                <!--end::Dialer-->
                                            </div>

                                            <div class="col-md-2" id="room_bed_btn">
                                                <button id="add_btn" type="button"
                                                    class="btn btn-primary d-flex align-items-center gap-2"> <span
                                                        class="material-symbols-outlined fs-3">
                                                        add
                                                    </span>
                                                    Add
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endif

                            </div>
                        </div>
                    </div>


                    <!-- <div class="position-relative mb-5">
                        <div class="separator-vertical "></div>
                    </div>

                    <div class="row w-100 mb-5 mt-4 py-2">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-3">Do you have extra beds available?</label>
                            <span id="bed_error" class="text-danger"></span>
                        </div>

                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="extra_bed_option" id="extra_bed_yes" value="yes"
                                {{ !empty($roomDetails->extra_bed_option) && $roomDetails->extra_bed_option=='yes'? 'checked' : '' }}>

                                <label class="form-check-label" for="extra_bed_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="extra_bed_option" id="extra_bed_no" value="no">
                                <label class="form-check-label" for="extra_bed_no">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100 mb-5 mt-4 py-2" id="extra_bed_pricing" style="display: none;">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-3">Extra Bed Prices</label>
                            <span id="price_error" class="text-danger"></span>
                        </div>

                        <div class="col-sm-9">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label class="fw-semibold mb-4">Adult Bed Price</label>
                                    <input type="number" value="{{ isset($roomDetails->extra_bed_adult_price) ? intval($roomDetails->extra_bed_adult_price) : 0}}" class="form-control form-control-solid border-custom" id="adult_bed_price" name="adult_bed_price" placeholder="Enter price for children bed">

                                </div>
                                <div class="col-md-6">
                                    <label class="fw-semibold mb-4">Children Bed Price</label>
                                    <input type="number" value="{{ isset($roomDetails->extra_bed_child_price) ? intval($roomDetails->extra_bed_child_price) : 0 }}" class="form-control form-control-solid border-custom" id="children_bed_price" name="children_bed_price" placeholder="Enter price for children bed">

                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="position-relative mb-5">
                        <div class="separator-vertical "></div>
                    </div>



                    <div class="row w-100 mb-5 mt-4 pt-2">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-3">How many guests can stay in this
                                room?</label><br>
                            <span id="gest_stay_error" class="text-danger"></span>
                        </div>

                        <div class="col-sm-4 col-md-2">
                            <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="0"
                                data-kt-dialer-max="10" data-kt-dialer-step="1">
                                <!--begin::Decrease control-->
                                <button type="button"
                                    class="btn btn-icon box-44-end position-absolute translate-middle-y top-50 start-0 bg-light-dark"
                                    data-kt-dialer-control="decrease">
                                    <span class="material-symbols-outlined text-color-secondary">
                                        remove
                                    </span>
                                </button>
                                <!--end::Decrease control-->
                                <!--begin::Input control-->
                                <input type="text"
                                    class="form-control form-control-solid border-custom h-44px text-center text-color-secondary"
                                    data-kt-dialer-control="input" placeholder="Amount" id="gest_stay" name="gest_stay"
                                    readonly="readonly" value="{{ $roomDetails->stay_guest ?? 0 }}" />
                                <!--end::Input control-->
                                <!--begin::Increase control-->
                                <button type="button"
                                    class="btn btn-icon box-44-start position-absolute translate-middle-y top-50 end-0 bg-light-dark"
                                    data-kt-dialer-control="increase">
                                    <span class="material-symbols-outlined text-color-secondary">
                                        add
                                    </span>
                                </button>
                                <!--end::Increase control-->
                            </div>
                        </div>
                    </div>

                    <div class="row w-100 mb-5 mt-4">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-3">What is the room size?</label><br>
                            <span id="room_size_error" class="text-danger"></span>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="input-group position-relative mb-3">
                                <input type="number" name="room_size" class="form-control form-control-solid"
                                    value="{{ $roomDetails->room_size ?? '' }}" placeholder="Enter rooms size">
                                <div class="position-absolute-select2">
                                    <select class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="" name="measure" id="measure">

                                        <option value="square feet"
                                            {{ !empty($roomDetails->measure) && $roomDetails->measure == 'square feet' ? 'selected' : '' }}>
                                            Square Feet</option>
                                        <option value="square meter"
                                            {{ !empty($roomDetails->measure) && $roomDetails->measure == 'square meter' ? 'selected' : '' }}>
                                            Square Meter</option>
                                    </select>
                                </div>

                                <span id="measure_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100 mb-5 mt-4">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-3">Is smoking allowed in this
                                room?</label><br>
                            <span id="smoking_option_error" class="text-danger"></span>
                        </div>

                        <div class="col-sm-6 col-md-4">

                            <div class="d-flex align-items-center gap-8 position-relative">
                                <!-- Smoking Allowed: Yes -->
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" name="smoking_option" id="yes" type="radio"
                                        value="yes" {{ $roomDetails->smoking_allow == 'yes' ? 'checked' : '' }} />
                                    <label class="form-check-label user-select-none" for="yes">Yes</label>
                                </div>
                            
                                <!-- Smoking Allowed: No -->
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" name="smoking_option" id="no" type="radio"
                                        value="no" {{ $roomDetails->smoking_allow == 'no' ? 'checked' : '' }} />
                                    <label class="form-check-label user-select-none" for="no">No</label>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Input group-->
        </div>
        <input type="hidden" name="step" value="1">

        <input type="submit" class="d-none" id="step1">

    </form>
    <!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const extraBedYes = document.getElementById('extra_bed_yes');
        const extraBedNo = document.getElementById('extra_bed_no');
        const extraBedPricing = document.getElementById('extra_bed_pricing');

        extraBedYes.addEventListener('click', function () {
            extraBedPricing.style.display = 'flex';
        });

        extraBedNo.addEventListener('click', function () {
            extraBedPricing.style.display = 'none';
        });
        if (extraBedYes.checked){
            extraBedPricing.style.display = 'flex';
        }
    });

    </script> -->
</div>
