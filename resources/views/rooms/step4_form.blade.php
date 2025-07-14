<div class="flex-column" data-kt-stepper-element="content" id="step-3">
    <form class="global-ajax-form" action="{{ route('rooms.save') }}" method="post" novalidate="novalidate"
        id="step3form">
        <!--begin::Input group-->
        <div class="card shadow-sm mt-5">
            <div class="card-header">
                <div class="card-title">
                    <!--begin::Title-->
                    <h3 class="fw-bold text-color m-0">
                        Cancellation Policy
                    </h3>
                    <!--end::Title-->
                </div>

            </div>
            <div class="card-body p-5">
                <div class="col-sm-12 d-flex flex-column justify-content-between">
                    @if (!empty($roomDetails->id))
                    <input type="hidden" name="id" value="{{ $roomDetails->id ?? '' }}">
                    @endif
                    <div class="row w-100 mb-5 pb-1">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-5">When can guest cancel their bookings for free?</label>
                            <span id="gust_cancel_error" class="text-danger"></span>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="position-relative">
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control form-control-solid"
                                        placeholder="Enter time/day" id="guest_cancel" name="guest_cancel"
                                        value="{{ $roomDetails->cancel_booking ?? 0 }}">

                                    <div class="position-absolute-select2">
                                        <!-- <select class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="" name="measure_day" id="measure_day"> -->
                                        <select class="form-select form-select-solid" data-control=""
                                            data-placeholder="Select date of arrival" name="measure_day">
                                            <option value="days before arrival"
                                                {{ !empty($roomDetails->arrival_date) && $roomDetails->arrival_date == 'days before arrival' ? 'selected' : '' }}>
                                                days before arrival
                                            </option>
                                            <option value="hours before arrival"
                                                {{ !empty($roomDetails->arrival_date) && $roomDetails->arrival_date == 'hours before arrival' ? 'selected' : '' }}>
                                                hours before arrival
                                            </option>
                                        </select>
                                    </div>
                                    <span id="measure_day_error" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="position-relative mb-5 py-1">
                        <div class="separator-vertical "></div>
                    </div>

                    <div class="row w-100 mb-5 pb-1 position-relative">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-5">How much are guests charged if
                                they cancel after the free cancellation period?</label>
                            <span id="cancellation_period_error" style="color:red"></span>
                        </div>


                        <div class="col-sm-6 col-md-4 mt-5">
                            <div class="position-relative">
                                <div class="d-flex align-items-center gap-20">
                                    <div class="form-check">
                                        <input class="form-check-input" name="cancellation_period" type="radio"
                                            value="100" id="cancellation_period"
                                            {{ !empty($roomDetails->cancellation_period) && $roomDetails->cancellation_period == '100' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="cancellation_period">
                                            100%
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="cancellation_period" type="radio"
                                            value="75" id="cancellation_period"
                                            {{ !empty($roomDetails->cancellation_period) && $roomDetails->cancellation_period == '75' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="cancellation_period">
                                            75%
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="cancellation_period" type="radio"
                                            value="50" id="cancellation_period"
                                            {{ !empty($roomDetails->cancellation_period) && $roomDetails->cancellation_period == '50' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="cancellation_period">
                                            50%
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="cancellation_period" type="radio"
                                            value="25" id="cancellation_period_25"
                                            {{ !empty($roomDetails->cancellation_period) && $roomDetails->cancellation_period == '25' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="cancellation_period">
                                            25%
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" class="d-none" name="step" value="3">

        <input type="submit" class="d-none" id="step3">
    </form>
    <!--end::Input group-->
</div>
