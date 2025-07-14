<div class="flex-column" data-kt-stepper-element="content">
    <!--begin::Input group-->
    <form action="{{ route('hotel.save',['step' => 3]) }}" class="global-ajax-form" method="post"
        enctype="multipart/form-data" id="step3form">
        <input type="hidden" name="id" value="{{ $hotel->id }}">

        <div class="card shadow-sm mt-5">
            <div class="card-header">
                <div class="card-title">
                    <!--begin::Title-->
                    <h3 class="fw-bold text-gray-900 m-0">
                        Parking situation at your hotel
                    </h3>
                    <!--end::Title-->
                </div>
            </div>
            <div class="card-body p-5">
                <div class="col-sm-12 d-flex flex-column justify-content-between">
                    <div class="row w-100 mb-5 mt-5">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2">Is parking available to
                                guest?</label>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="position-relative">
                                <div class="d-flex align-content-center gap-8">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" name="parking_available" type="radio"
                                            value="yes_free" id="yes_free" @checked($hotel?->parking_available ==
                                        'yes_free')/>
                                        <label class="form-check-label text-color-secondary" for="yes_free">
                                            Yes, free
                                        </label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" name="parking_available" type="radio"
                                            value="yes_paid" id="yes_paid" @checked($hotel?->parking_available ==
                                        'yes_paid')/>
                                        <label class="form-check-label text-color-secondary" for="yes_paid">
                                            Yes, paid
                                        </label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" name="parking_available" type="radio" value="no"
                                            id="no" @checked($hotel?->parking_available == 'no')/>
                                        <label class="form-check-label text-color-secondary" for="no">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100 mb-5 otherField {{$hotel?->parking_available == 'no' ? 'd-none' : ''}}"
                        id="reserve_park">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2">Do they need to reserve a parking
                                spot?</label>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="d-flex align-content-center gap-8">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" name="reservation_required" type="radio" value="yes"
                                        id="reservation_required_yes" @checked($hotel?->reservation_required == 'yes')
                                    />
                                    <label class="form-check-label text-color-secondary" for="reservation_required_yes">
                                        Reservation required
                                    </label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" name="reservation_required" type="radio" value="no"
                                        id="reservation_required_no" @checked($hotel?->reservation_required == 'no')/>
                                    <label class="form-check-label text-color-secondary" for="reservation_required_no">
                                        No reservation required
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100 mb-5 otherField {{$hotel?->parking_available == 'no' ? 'd-none' : ''}}"
                        id="reserve_location">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-2">Where is parking located</label>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="d-flex align-content-center gap-8">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" name="parking_location" type="radio" value="on_site"
                                        id="parking_location_on_site" @checked($hotel?->parking_location == 'on_site')
                                    />
                                    <label class="form-check-label text-color-secondary" for="parking_location_on_site">
                                        On site
                                    </label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" name="parking_location" type="radio"
                                        value="off_site" id="parking_location_off_site"
                                        @checked($hotel?->parking_location == 'off_site')/>
                                    <label class="form-check-label text-color-secondary"
                                        for="parking_location_off_site">
                                        Off site
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100 mb-5 otherField {{$hotel?->parking_available == 'no' ? 'd-none' : ''}}"
                        id="reserve_park_type">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-5">What type of parking is
                                it?</label>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="d-flex align-content-center gap-8">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" name="parking_type" type="radio" value="private"
                                        id="parking_type_private" @checked($hotel?->parking_type == 'private')/>
                                    <label class="form-check-label text-color-secondary" for="parking_type_private">
                                        Private
                                    </label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" name="parking_type" type="radio" value="public"
                                        id="parking_type_public" @checked($hotel?->parking_type == 'public')/>
                                    <label class="form-check-label text-color-secondary" for="parking_type_public">
                                        Public
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" class="d-none" id="step3">
    </form>
    <!--end::Input group-->
</div>