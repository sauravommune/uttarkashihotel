<div class="flex-column" data-kt-stepper-element="content">
    <!--begin::Input group-->
    <form action="{{ route('hotel.save',['step' => 8]) }}" class="global-ajax-form" method="post"
        enctype="multipart/form-data" id="step8form" data-redirect-url="{{route('hotel')}}">
        <input type="hidden" name="id" value="{{ $hotel->id }}">
        <div class="card shadow-sm mt-5">
            <div class="card-header">
                <div class="card-title">
                    <!--begin::Title-->
                    <h3 class="fw-bold text-gray-900 m-0">
                        Admin Details
                    </h3>
                    <!--end::Title-->
                </div>
            </div>
            <div class="card-body p-5">
                {{-- <div class="row w-100 mb-5">
                <div class="col-sm-3">
                    <label class="fw-semibold mb-2 mt-2">Designation of Hotel Admin</label>
                </div>
                <div class="col-sm-9 col-md-4">
                    <select class="form-select form-select-solid" data-control="select2"
                        data-placeholder="Select an option" data-hide-search="true" name="owner_type">
                        <option></option>
                        <option value="1" @selected($hotel?->owner_type == '1')>Owner</option>
                        <option value="2" @selected($hotel?->owner_type == '2')>Hotel Manager</option>
                    </select>
                </div>
            </div> --}}

                {{-- <div class="position-relative mb-5">
                <div class="separator-vertical "></div>
            </div> --}}

                <p class="text-color fw-bold fs-3 pt-8">
                    This Information will be used to create the Hotel Admin Account
                </p>

                <div class="row w-100 mb-5">
                    <div class="col-sm-3">
                        <label class="fw-semibold mb-2 mt-5">First name*</label>
                    </div>
                    <div class="col-sm-9 col-md-4">
                        <input type="text" name="owner_name" class="form-control form-control-solid"
                            placeholder="Enter first name" value="{{$hotel?->owner_name}}" />
                    </div>
                </div>

                <div class="row w-100 mb-5">
                    <div class="col-sm-3">
                        <label class="fw-semibold mb-2 mt-5">Middle name</label>
                    </div>
                    <div class="col-sm-9 col-md-4">
                        <input type="text" name="middle_name" class="form-control form-control-solid"
                            placeholder="Enter middle name" value="{{$hotel?->middle_name}}" />
                    </div>
                </div>

                <div class="row w-100 mb-5">
                    <div class="col-sm-3">
                        <label class="fw-semibold mb-2 mt-5">Last name</label>
                    </div>
                    <div class="col-sm-9 col-md-4">
                        <input type="text" class="form-control form-control-solid" placeholder="Enter last name"
                            value="{{$hotel?->last_name}}" name="last_name" />
                    </div>
                </div>

                <div class="row w-100 mb-5">
                    <div class="col-sm-3">
                        <label class="fw-semibold mb-2 mt-5">Email*</label>
                    </div>
                    <div class="col-sm-9 col-md-4">
                        <input type="text" name="owner_email" class="form-control form-control-solid"
                            placeholder="Enter email" value="{{$hotel?->owner_email}}" />
                    </div>
                </div>

                <div class="row w-100 mb-5 pb-3">
                    <div class="col-sm-3">
                        <label class="fw-semibold mb-2 mt-5">Phone number*</label>
                    </div>
                    <div class="col-sm-9 col-md-4">
                        <div class="position-relative">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">+91</span>
                                <input type="number" name="owner_contact_no" class="form-control"
                                    placeholder="Enter phone number" aria-label="Username"
                                    aria-describedby="basic-addon1" value="{{$hotel?->owner_contact_no}}" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="position-relative mb-5">
                    <div class="separator-vertical "></div>
                </div>


                <div class="row w-100 pt-5 mb-5">
                    <div class="col-12">
                        <div class="form-check pb-3">
                            <div class="position-relative">
                                <input class="form-check-input mt-1" type="checkbox" value="yes" id="first"
                                    name="terms1" {{ $hotel->term_first === 'yes' ? 'checked' : '' }}/>
                                <label class="form-check-label text-color-secondary fs-7" for="first">
                                    I hereby certify that this is a legitimate hotel business with all
                                    necessary licenses and permits. Hottel.in reserves the right to
                                    verify and investigate any details provided in this registration.
                                </label>
                            </div>
                        </div>

                        <div class="form-check mt-5">
                            <div class="position-relative">
                                <input class="form-check-input" type="checkbox" value="yes" id="second"
                                 name="terms2" {{ $hotel->term_second === 'yes' ? 'checked' : '' }}/>
                                <label class="form-check-label text-color-secondary fs-7" for="second">
                                    I have read, accepted and agreed to the <a href="">Terms and
                                        conditions</a> and <a href="">Privacy policy</a>.
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <input type="submit" class="d-none" id="step8">
    </form>
    <!--end::Input group-->
</div>