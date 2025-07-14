<div class="flex-column" data-kt-stepper-element="content" id="step-2">
    <form class="global-ajax-form" action="{{ route('rooms.save') }}" method="post" novalidate="novalidate"
        id="step2form" enctype="multipart/form-data">

        @if (!empty($roomDetails->id))
        <input type="hidden" name="id" value="{{ $roomDetails->id ?? '' }}">
        @endif

        @if (!empty($roomDetails->payAmount->id))
        <input type="hidden" name="rate_plan_id" value="{{ $roomDetails->payAmount->id ?? '' }}">
        @endif
        <!--begin::Input group-->
        <div class="card shadow-sm mt-5">
            <div class="card-header">
                <div class="card-title">
                    <!--begin::Title-->
                    <h3 class="fw-bold text-color m-0">
                        Rate Plan
                    </h3>
                    <!--end::Title-->
                </div>
            </div>
            <div class="card-body p-5">
                <div class="col-sm-12 d-flex flex-column justify-content-between">

                    <div class="row w-100 mb-5 py-1">
                        <div class="col-sm-3">
                            <div class="d-flex flex-column">
                                <span class="text-color fs-7 fw-bold">EP Rates</span>
                                <span class="text-color-secondary fw-semibold  fs-8">Room
                                    only, with no meals.</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group input-group-solid">
                                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                    id="basic-addon3">₹</span>
                                <input type="number" class="form-control form-control-solid text-color-secondary"
                                    id="ep_b2b_amount" aria-describedby="basic-addon3"
                                    value="{{ $roomDetails->payAmount->ep_rate_b2b_amount ?? 0 }}" name="ep_b2b_amount"
                                    placeholder="Enter amount">
                            </div>
                            <span id="ep_b2b_amount_error" style="color:red"></span>
                        </div>
                    </div>

                    <div class="row w-100 mb-5 py-1">
                        <div class="col-sm-3">
                            <div class="d-flex flex-column">
                                <span class="text-color fs-7 fw-bold">CP Rates</span>
                                <span class="text-color-secondary fw-semibold  fs-8">Breakfast
                                    is included along with room.</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group input-group-solid">
                                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                    id="basic-addon3">₹</span>
                                <input type="number" class="form-control form-control-solid text-color-secondary"
                                    id="cp_b2b_amount" aria-describedby="basic-addon3" placeholder="Enter amount"
                                    name="cp_b2b_amount" value="{{ $roomDetails->payAmount->cp_rate_b2b_amount ?? 0 }}">
                            </div>
                            <span id="cp_b2b_amount_error" style="color:red"></span>
                        </div>
                    </div>

                    <div class="row w-100 mb-5 py-1">
                        <div class="col-sm-3">
                            <div class="d-flex flex-column">
                                <span class="text-color fs-7 fw-bold">MAP Rates</span>
                                <span class="text-color-secondary fw-semibold  fs-8">Includes
                                    room, breakfast & dinner</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group input-group-solid">
                                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                    id="basic-addon3">₹</span>
                                <input type="number" class="form-control form-control-solid text-color-secondary"
                                    id="map_b2b_amount" aria-describedby="basic-addon3" placeholder="Enter amount"
                                    name="map_b2b_amount"
                                    value="{{ $roomDetails->payAmount->map_rate_b2b_amount ?? 0 }}">
                            </div>
                            <span id="map_b2b_amount_error" style="color:red"></span>
                        </div>
                    </div>

                    <div class="position-relative mb-5">
                        <div class="separator-vertical "></div>
                    </div>

                    <div class="row w-100 mb-5 py-1">
                        <div class="col-sm-3">
                            <div class="d-flex flex-column">
                                <span class="text-color fs-7 fw-bold">Non Refundable Rate</span>
                                <span class="text-color-secondary fw-semibold  fs-8">Discount when
                                    guests book non-refundable option</span>
                            </div>
                            <span id="non_refundable_rate_error"></span>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control form-control-solid text-color-secondary"
                                    aria-describedby="basic-addon3" placeholder="% Discount" name="non_refundable_rate"
                                    id="non_refundable_rate"
                                    value="{{ $roomDetails->payAmount->non_refundable_rate ?? 0 }}">
                                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                    id="basic-addon3">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="position-relative mb-5">
                        <div class="separator-vertical "></div>
                    </div>

                    <div class="row w-100 mb-5 pt-1">
                        <div class="col-sm-3">
                            <div class="d-flex flex-column">
                                <span class="text-color fs-7 fw-bold">Weekly Rates</span>
                                <span class="text-color-secondary fw-semibold  fs-8">Discount when
                                    guests book for a week</span>
                            </div>
                            <span id="weekly_rate_error" style="color:red"></span>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group input-group-solid">
                                <input type="number" class="form-control form-control-solid text-color-secondary"
                                    aria-describedby="basic-addon3" placeholder="% Discount" name="weekly_rate"
                                    id="weekly_rate" value="{{ $roomDetails->payAmount->weekly_rate ?? 0 }}">
                                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                    id="basic-addon3">%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Input group-->
        <input type="hidden" name="step" value="2">

        <input type="submit" class="d-none" id="step2">

    </form>
</div>
