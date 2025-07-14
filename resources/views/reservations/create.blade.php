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
                            <a href="{{ route('superAdmin.dashboard') }}"
                                class="text-color-secondary text-hover-primary">Dashboard</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('reservations.index') }}"
                                class="text-color-secondary text-hover-primary">Reservation Page</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
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
            <div class="card border-0">
                <!--begin::Card header-->
                <form action="post" onsubmit="return confirm('Do you really want to submit the form?');">
                    <div class="row">
                        <div class="col-md-8 col-12 pe-10">
                            <div class="d-flex flex-column gap-24">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="" class="mb-4 text-color-secondary">First name</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Enter First Name" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="" class="mb-4 text-color-secondary">Last name</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Enter Last Name" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="mb-4 text-color-secondary">Email</label>
                                    <input type="email" class="form-control form-control-solid"
                                        placeholder="Enter Email" />
                                </div>

                                <div class="form-group">
                                    <label for="" class="mb-4 text-color-secondary">Check In - Check Out</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-solid" id="daterange"
                                            placeholder="Recipient's username" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2" />
                                        <div class="box-44 border-0">
                                            <span class="material-symbols-outlined fs-2 text-color-secondary">
                                                edit_calendar
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex flex-column gap-1">
                                            <span class="text-color fs-7">Adults</span>
                                            <span class="text-color-secondary fs-8">18 years and more</span>
                                        </div>
                                        <!--begin::Dialer-->
                                        <div class="position-relative w-md-200px" id="adult_dailer">
                                            <!--begin::Decrease control-->
                                            <button type="button"
                                                class="btn btn-icon box-44-start position-absolute translate-middle-y top-50 end-0 bg-light-dark"
                                                data-kt-dialer-control="increase">
                                                <span class="material-symbols-outlined text-color-secondary">
                                                    add
                                                </span>
                                            </button>
                                            <!--end::Decrease control-->

                                            <!--begin::Input control-->

                                            <input type="text"
                                                class="form-control form-control-solid border-custom h-44px text-center text-color-secondary"
                                                data-kt-dialer-control="input" placeholder="Amount"
                                                name="manageBudget" readonly="readonly" value="0" />
                                            <!--end::Input control-->

                                            <!--begin::Increase control-->

                                            <button type="button"
                                                class="btn btn-icon box-44-end position-absolute translate-middle-y top-50 start-0 bg-light-dark"
                                                data-kt-dialer-control="decrease">
                                                <span class="material-symbols-outlined text-color-secondary">
                                                    remove
                                                </span>
                                            </button>
                                            <!--end::Increase control-->
                                        </div>
                                        <!--end::Dialer-->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex flex-column gap-1">
                                            <span class="text-color fs-7">Children</span>
                                            <span class="text-color-secondary fs-8">12 years and less</span>
                                        </div>
                                        <!--begin::Dialer-->
                                        <div class="position-relative w-md-200px" id="children_dailer">
                                            <!--begin::Decrease control-->
                                            <button type="button"
                                                class="btn btn-icon box-44-start position-absolute translate-middle-y top-50 end-0 bg-light-dark"
                                                data-kt-dialer-control="increase">
                                                <span class="material-symbols-outlined text-color-secondary">
                                                    add
                                                </span>
                                            </button>
                                            <!--end::Decrease control-->

                                            <!--begin::Input control-->

                                            <input type="text"
                                                class="form-control form-control-solid border-custom h-44px text-center text-color-secondary"
                                                data-kt-dialer-control="input" placeholder="Amount"
                                                name="manageBudget" readonly="readonly" value="0" />
                                            <!--end::Input control-->

                                            <!--begin::Increase control-->

                                            <button type="button"
                                                class="btn btn-icon box-44-end position-absolute translate-middle-y top-50 start-0 bg-light-dark"
                                                data-kt-dialer-control="decrease">
                                                <span class="material-symbols-outlined text-color-secondary">
                                                    remove
                                                </span>
                                            </button>
                                            <!--end::Increase control-->
                                        </div>
                                        <!--end::Dialer-->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row justify-content-between">
                                        <div class="col-md-6 col-12">
                                            <div class="d-flex flex-column gap-4">
                                                <span class="text-color-secondary fs-8">Room Type</span>
                                                <select class="form-select form-select-solid" data-control="select2"
                                                    data-placeholder="Select Room Type" data-allow-clear="true">
                                                    <option></option>
                                                    <option value="single">Single Room</option>
                                                    <option value="double">Double Room</option>
                                                    <option value="suite">Suite</option>
                                                    <option value="deluxe">Deluxe Room</option>
                                                    <option value="family">Family Room</option>
                                                    <option value="twin">Twin Room</option>
                                                    <option value="studio">Studio</option>
                                                    <option value="executive">Executive Room</option>
                                                    <option value="presidential">Presidential Suite</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--begin::Dialer-->
                                        <div class="col-md-6 col-12 text-end">
                                            <div class="d-flex flex-column align-items-end gap-4">
                                                <span class="text-color-secondary fs-8">Number of Rooms</span>
                                                <div class="position-relative w-md-200px" id="number_of_rooms">
                                                    <!--begin::Decrease control-->
                                                    <button type="button"
                                                        class="btn btn-icon box-44-start position-absolute translate-middle-y top-50 end-0 bg-light-dark"
                                                        data-kt-dialer-control="increase">
                                                        <span class="material-symbols-outlined text-color-secondary">
                                                            add
                                                        </span>
                                                    </button>
                                                    <!--end::Decrease control-->

                                                    <!--begin::Input control-->

                                                    <input type="text"
                                                        class="form-control form-control-solid border-custom h-44px text-center text-color-secondary"
                                                        data-kt-dialer-control="input" placeholder="Amount"
                                                        name="manageBudget" readonly="readonly" value="0" />
                                                    <!--end::Input control-->

                                                    <!--begin::Increase control-->

                                                    <button type="button"
                                                        class="btn btn-icon box-44-end position-absolute translate-middle-y top-50 start-0 bg-light-dark"
                                                        data-kt-dialer-control="decrease">
                                                        <span class="material-symbols-outlined text-color-secondary">
                                                            remove
                                                        </span>
                                                    </button>
                                                    <!--end::Increase control-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Dialer-->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="mb-4 text-color-secondary">Meal Type</label>
                                    <div class="d-flex align-items-center gap-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="noMeal" />
                                            <label class="form-check-label fs-7" for="noMeal">
                                                No meal included
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="breakfastIncluded" />
                                            <label class="form-check-label fs-7" for="breakfastIncluded">
                                                Breakfast Included
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="breakfastDinnerIncluded" />
                                            <label class="form-check-label fs-7" for="breakfastDinnerIncluded">
                                                Breakfast & Dinner Included
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="mb-4 text-color-secondary">Cancellation
                                        Policy</label>
                                    <div class="d-flex align-items-center gap-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="nonRefundable" />
                                            <label class="form-check-label fs-7" for="nonRefundable">
                                                Non-refundable
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="refundablePartiallyRefundable" />
                                            <label class="form-check-label fs-7" for="refundablePartiallyRefundable">
                                                Refundable/ Partially Refundable
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="d-flex flex-column gap-24">
                                <span class="fs-7 text-color fw-bold">Price Summary</span>

                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex flex-column gap-1">
                                            <span class="text-color fs-7">Original Price</span>
                                            <span class="text-color-secondary fs-8">₹ 4,950 x 6 Nights</span>
                                        </div>
                                        <!--begin::Dialer-->
                                        <span class="fs-7 text-color">₹ 29,700</span>
                                        <!--end::Dialer-->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-md-6 col-6">
                                            <select class="form-select form-select-solid" data-control="select2"
                                                data-placeholder="Select Hotel Discount">
                                                <option></option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-6 text-end">
                                            <!--begin::Dialer-->
                                            <span class="fs-7 text-color">-₹ 0.0</span>
                                            <!--end::Dialer-->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex flex-column gap-1">
                                            <span class="text-color fs-7">Campaign Discount!</span>
                                            <span class="text-color-secondary fs-8">Coupon - HolidayFire10</span>
                                        </div>
                                        <!--begin::Dialer-->
                                        <span class="fs-7 text-color">-₹ 2,970</span>
                                        <!--end::Dialer-->
                                    </div>
                                </div>

                                <div class="form-group bg-total-reservation p-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex flex-column gap-1">
                                            <span class="text-color fs-7 fw-bolder">Total Amount</span>
                                        </div>
                                        <!--begin::Dialer-->
                                        <span class="fs-7 text-color">₹ <span
                                                class="fs-1 fw-bolder">26,130</span></span>
                                        <!--end::Dialer-->
                                    </div>
                                </div>

                                <p class="mb-0 text-color fs-7">Once the booking is confirmed, the Booking Details and
                                    Payment Invoice will be sent to the guest.</p>

                                <div class="row">


                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary w-100 text-center">
                                            Confirm Booking
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $("#daterange").flatpickr({
                    altInput: true,
                    altFormat: "F j, Y",
                    dateFormat: "Y-m-d",
                    mode: "range"
                });

                // Initialize dialers
                var dialerElement = document.querySelector("#adult_dailer");
                var dialerObject = new KTDialer(dialerElement, {
                    min: 0,
                    max: 25,
                    step: 1,
                });

                dialerElement = document.querySelector("#children_dailer");
                dialerObject = new KTDialer(dialerElement, {
                    min: 0,
                    max: 25,
                    step: 1,
                });

                dialerElement = document.querySelector("#number_of_rooms");
                dialerObject = new KTDialer(dialerElement, {
                    min: 0,
                    max: 50,
                    step: 1,
                });
            });
        </script>
    @endpush
</x-app-layout>
