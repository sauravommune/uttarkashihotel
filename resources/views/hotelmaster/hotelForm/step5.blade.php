<div class="flex-column" data-kt-stepper-element="content">
    <!--begin::Input group-->
    <form action="{{ route('hotel.save',['step' => 5]) }}" class="global-ajax-form" method="post" enctype="multipart/form-data" id="step5form">
        <input type="hidden" name="id" value="{{ $hotel->id }}">
    <div class="card shadow-sm mt-5">
        <div class="card-header">
            <div class="card-title">
                <!--begin::Title-->
                <h3 class="fw-bold text-gray-900 m-0">
                    House Rules
                </h3>
                <!--end::Title-->
            </div>
        </div>
        <div class="card-body p-5">

            <div class="row mb-5">
                <label class="fw-semibold col-sm-3 mt-4">Check In & Check Out Time</label>
                <div class="col-sm-9">
                    <div class="row mb-2">
                        <div class="col-md-6 col-12">
                            <input type="text" name="check_in_time" id="checkin_time"
                                class="form-control mb-3 mb-lg-0"
                                placeholder="Select Check In Time" value="{{$hotel?->check_in_time ?? '12:00'}}" />
                        </div>
                        <div class="col-md-6 col-12">
                            <input type="text" name="check_out_time" id="checkout_time"
                                class="form-control mb-3 mb-lg-0"
                                placeholder="Select Check Out Time" value="{{ $hotel?->check_out_time ?? '11:00'}}" />
                        </div>
                    </div>
                </div>
            </div>
{{-- 
            <div class="row w-100 mb-5">
                <div class="col-sm-3">
                    <label class="fw-semibold mb-2 mt-5">Do you allow children?</label>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="d-flex align-content-center gap-8">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" name="children_allowed" type="radio"
                                value="yes" id="children_allowed_yes" @checked($hotel?->) />
                            <label class="form-check-label text-color-secondary"
                                for="children_allowed_yes">
                                Yes
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" name="children_allowed" type="radio"
                                value="no" id="children_allowed_no" />
                            <label class="form-check-label text-color-secondary"
                                for="children_allowed_no">
                                No
                            </label>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row w-100 mb-5">
                <div class="col-sm-3">
                    <label class="fw-semibold mb-2 mt-5">Do you allow pets?</label>
                </div>
                <div class="col-sm-6 col-md-4 align-content-center">
                <div class="position-relative">
                    <div class="d-flex align-content-center gap-8">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" name="pets_allowed" type="radio"
                                value="yes" id="pets_allowed_yes" @checked($hotel?->pets_allowed == 'yes')>
                            <label class="form-check-label text-color-secondary"
                                for="pets_allowed_yes">
                                Yes
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" name="pets_allowed" type="radio"
                                value="upon_request" id="pets_allowed_upon_request" @checked($hotel?->pets_allowed == 'upon_request')/>
                            <label class="form-check-label text-color-secondary"
                                for="pets_allowed_upon_request">
                                Upon request
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" name="pets_allowed" type="radio"
                                value="no" id="pets_allowed_no" @checked($hotel?->pets_allowed == 'no')/>
                            <label class="form-check-label text-color-secondary"
                                for="pets_allowed_no">
                                No
                            </label>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <label class="fw-semibold mb-2 col-sm-3">Property Rules</label>
                <div class="col-sm-9">
                    <div class="d-flex flex-column gap-8">
                        <div>
                            <p class="fs-7 text-color fw-semibold mb-4">General</p>
                            <textarea name="property_rules_general"
                                class="form-control-solid form-control mt-4" id="general">

                            @if(empty($hotel->general_rules))
                            <ul class="editor_hotel">
                                <li>
                                    Couple Friendly.
                                </li>
                                <li>
                                    Unmarried couples/guests with Local IDs are allowed.
                                </li>
                                <li>
                                    Guests below 18 years of age are not allowed at the property.
                                </li>
                                <li>
                                    Passport, Aadhar, Driving License and Govt. ID are accepted as ID proof(s).
                                </li>
                                <li>
                                    Pets are not allowed.
                                </li>
                                <li>
                                    Outside food is not allowed.
                                </li>
                                <li>
                                    Smoking within the premises is not allowed.
                                </li>
                            </ul>
                            @endif
                            {!! $hotel->general_rules!!}
                        </textarea>
                        </div>
                        <div>
                            <p class="fs-7 text-color fw-semibold mb-4">Optional</p>
                            <textarea name="property_rules_optional"
                                class="form-control-solid form-control mt-4" id="optional" name="">
                                @if(empty($hotel->optinal_rules))
                                <ul class="editor_hotel">
                                    <li>
                                        Airport shuttle fee: INR 1800 per vehicle (one-way)|Rollaway bed fee: INR 1500.0 per day.
                                    </li>
                                    <li>
                                        Extra-person charges may apply and vary depending on property policy|Government-issued photo identification and a credit card may be required at check-in for incidental charges|Special requests are subject to availability upon check-in and may incur additional charges; special requests cannot be guaranteed|This property accepts credit cards, debit cards, and cash|This property uses a grey water recycling system.
                                    </li>
                                </ul>
                                @endif
                                {!! $hotel->optinal_rules!!}
                        </textarea>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    <input type="submit" class="d-none" id="step5">
    </form>
    <!--end::Input group-->
</div>