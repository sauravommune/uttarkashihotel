@push('style')
    <style>

    </style>
@endpush
<x-app-layout>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-column align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-color fw-bold fs-18 m-0">
                        {{ $title }}
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
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
                        <li class="breadcrumb-item text-muted">{{ $title }}</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <!--end::Actions-->
            </div>
            <!--end::Toolbar wrapper-->
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-xl-5  align-items-end mt-5">
               
                <div class="col">
                    <div class="fv-row fv-plugins-icon-container">
                        <label class="form-label">Search</label>
                        <select class="form-select form-select-solid" id="city-select" data-control="select2"
                            data-placeholder="Select a city" style="width: 100%;">
                            <option></option>
                            <option value="1">Mumbai</option>
                            <option value="2">Delhi</option>
                            <option value="3">Bangalore</option>
                            <option value="4">Chennai</option>
                            <option value="5">Jaipur</option>
                            <option value="6">Agra</option>
                            <option value="7">Hyderabad</option>
                            <option value="8">Pune</option>
                            <option value="9">Kolkata</option>
                            <option value="10">Udaipur</option>
                            <option value="11">Ahmedabad</option>
                            <option value="12">Lucknow</option>
                            <option value="13">Goa</option>
                            <option value="14">Chandigarh</option>
                            <option value="15">Coimbatore</option>
                            <!-- Add more cities as needed -->
                        </select>

                    </div>
                </div>

                <div class="col ">
                    <div class="fv-row fv-plugins-icon-container">
                        <label class="form-label">Hotel</label>
                        <select class="form-select form-select-solid" id="hotel-select" data-control="select2"
                            data-placeholder="Select a hotel" style="width: 100%;">
                            <option></option>
                            <option value="1">Taj Mahal Palace, Mumbai</option>
                            <option value="2">The Oberoi, Delhi</option>
                            <option value="3">Leela Palace, Bangalore</option>
                            <option value="4">ITC Grand Chola, Chennai</option>
                            <option value="5">The Lalit, Jaipur</option>
                            <option value="6">Radisson Blu, Agra</option>
                            <option value="7">Hyatt Regency, Hyderabad</option>
                            <option value="8">JW Marriott, Pune</option>
                            <option value="9">The Park, Kolkata</option>
                            <option value="10">Trident, Udaipur</option>
                            <!-- Add more hotels as needed -->
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="fv-row fv-plugins-icon-container">
                        <label class="form-label">From Date</label>
                        <input class="form-control form-control-solid flatpicker" placeholder="Pick a date"
                            id="solid-date-one" />
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row fv-plugins-icon-container">
                        <label class="form-label">To Date</label>
                        <input class="form-control form-control-solid flatpicker" placeholder="Pick a date"
                            id="solid-date-second" />
                    </div>
                </div>
            
                <div class="col">
                    <div class="d-flex text-nowrap justify-content-center justify-content-md-start">
                        <button class="btn btn-primary d-flex justify-content-center w-100">
                            <span class="material-symbols-outlined fs-1">
                                search
                            </span>
                            Search
                        </button>
                    </div>
                </div>

                <div class=" col d-none " id="download-option">
                    <div class="download-option mt-4 mt-sm-0">
                        <select class="form-select btn btn-dark-dark" data-control="select2"
                            data-placeholder="Download Report" data-hide-search="true">
                            <option></option>
                            <option value="1">GST Report</option>
                            <option value="2">Billing Report</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Toolbar container-->

    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <h4 class="text-color fw-semibold pb-4">Search Result</h4>
            <div class="top-cover mb-8">
                <div class="content-left">
                    <div class="d-flex flex-column">
                        <h5 class="text-color mb-0">Fairfield by Marriott Goa calamite</h5>
                        <p class="text-color-secondary mb-0">calamite, Goa</p>
                    </div>
                    <div class="rating">
                        <div class="rating-label checked">
                            <i class="ki-duotone ki-star fs-1"></i>
                        </div>
                        <div class="rating-label checked">
                            <i class="ki-duotone ki-star fs-1"></i>
                        </div>
                        <div class="rating-label checked">
                            <i class="ki-duotone ki-star fs-1"></i>
                        </div>
                        <div class="rating-label">
                            <i class="ki-duotone ki-star fs-1"></i>
                        </div>
                        <div class="rating-label">
                            <i class="ki-duotone ki-star fs-1"></i>
                        </div>
                    </div>
                </div>
                <div class="content-right">
                    <div class="form-check form-switch form-check-custom form-check-solid outer">
                        <input class="form-check-input" type="checkbox" value="" id="flexSwitchChecked"
                            checked="checked" />
                        <label class="form-check-label" for="flexSwitchChecked">
                            Hotel is Live
                        </label>
                    </div>
                </div>
            </div>
            <!--begin::Content container-->
            <div class="row gx-5 gx-xl-10">
                <!--begin::Col-->

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4 col-6">
                            <!--begin::Card widget 4-->
                            <div class="card card-flush mb-5 mb-xl-6">
                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-center">

                                    <!--begin::Labels-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Currency-->
                                            {{-- <span class="fs-4 fw-semibold text-color-secondary me-1 align-self-start">$</span> --}}
                                            <!--end::Currency-->
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-color me-2 lh-1 ls-n2">812</span>
                                            <!--end::Amount-->
                                            <!--begin::Badge-->
                                            <span class="badge badge-light-success fs-base">
                                                <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.2%
                                            </span>
                                            <!--end::Badge-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Subtitle-->
                                        <span class="text-color-secondary pt-1 fw-semibold fs-6">Total Clicks</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 4-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4 col-6">
                            <!--begin::Card widget 4-->
                            <div class="card card-flush mb-5 mb-xl-6">
                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-center">

                                    <!--begin::Labels-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Currency-->
                                            <span
                                                class="fs-4 fw-semibold text-color-secondary me-1 align-self-start">₹</span>
                                            <!--end::Currency-->
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-color me-2 lh-1 ls-n2">620</span>
                                            <!--end::Amount-->
                                            <!--begin::Badge-->
                                            <span class="badge badge-light-success fs-base">
                                                <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.2%
                                            </span>
                                            <!--end::Badge-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Subtitle-->
                                        <span class="text-color-secondary pt-1 fw-semibold fs-6">Total Bookings</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 4-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4 col-6">
                            <!--begin::Card widget 4-->
                            <div class="card card-flush mb-5 mb-xl-6">
                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-center">

                                    <!--begin::Labels-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Currency-->
                                            {{-- <span class="fs-4 fw-semibold text-color-secondary me-1 align-self-start">$</span> --}}
                                            <!--end::Currency-->
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-color me-2 lh-1 ls-n2">12%</span>
                                            <!--end::Amount-->
                                            <!--begin::Badge-->
                                            <span class="badge badge-light-success fs-base">
                                                <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.2%
                                            </span>
                                            <!--end::Badge-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Subtitle-->
                                        <span class="text-color-secondary pt-1 fw-semibold fs-6">Occupancy Share</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 4-->
                        </div>

                        <!--begin::Col-->
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4 col-6">
                            <!--begin::Card widget 4-->
                            <div class="card card-flush mb-5 mb-xl-6">
                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-center">

                                    <!--begin::Labels-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Currency-->
                                            <span
                                                class="fs-4 fw-semibold text-color-secondary me-1 align-self-start">₹</span>
                                            <!--end::Currency-->
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-color me-2 lh-1 ls-n2">1,29,420</span>
                                            <!--end::Amount-->

                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Subtitle-->
                                        <span class="text-color-secondary pt-1 fw-semibold fs-6">Revenue</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 4-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4 col-6">
                            <!--begin::Card widget 4-->
                            <div class="card card-flush mb-5 mb-xl-6">
                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-center">

                                    <!--begin::Labels-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Currency-->
                                            <span
                                                class="fs-4 fw-semibold text-color-secondary me-1 align-se-start">$</span>
                                            <!--end::Currency-->
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-color me-2 lh-1 ls-n2">9,420</span>
                                            <!--end::Amount-->
                                            <!--begin::Badge-->
                                            <span class="badge badge-light-success fs-base">
                                                <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.2%
                                            </span>
                                            <!--end::Badge-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Subtitle-->
                                        <span class="text-color-secondary pt-1 fw-semibold fs-6">Average Room Rate
                                            ARR</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 4-->
                        </div>

                        <!--begin::Col-->
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-4 col-6">
                            <!--begin::Card widget 4-->
                            <div class="card card-flush mb-5 mb-xl-6">
                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-center">

                                    <!--begin::Labels-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Currency-->
                                            <span
                                                class="fs-4 fw-semibold text-color-secondary me-1 align-self-start">₹</span>
                                            <!--end::Currency-->
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-color me-2 lh-1 ls-n2">9,420</span>
                                            <!--end::Amount-->
                                            <!--begin::Badge-->
                                            <span class="badge badge-light-success fs-base">
                                                <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.2%
                                            </span>
                                            <!--end::Badge-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Subtitle-->
                                        <span class="text-color-secondary pt-1 fw-semibold fs-6">Today’s Average Room
                                            Rate</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 4-->
                        </div>
                        <!--end::Col-->
                    </div>
                </div>
            </div>
            <!--begin::Col-->
            <div class="row">
                <div class="col-md-6 col-lg-4 col-12">
                    <div class="d-flex flex-column gap-8">
                        <h2 class="mb-0 text-color">Today’s Room Stats</h2>

                        <div class="card">
                            <div class="card-header p-4 px-5">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title align-items-start d-flex flex-column">
                                        <span class="card-label fw-bold text-color fs-3">Standard AC Room</span>
                                        <div class="d-flex position-relative">
                                            <span class="text-color-secondary mt-2 fw-semibold fs-6">Average Occupancy:
                                                <span class="text-color">42%</span>
                                            </span>
                                            <span class="separator text-color-secondary"></span>
                                            <span class="text-color-secondary mt-2 fw-semibold fs-6">Average Occupancy:
                                                <span class="text-color">42%</span>
                                            </span>
                                        </div>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body p-6 px-5">
                                <div class="row g-0 border-bottom-solid pb-4">
                                    <div class="col-8">
                                        <p class="mb-0 text-color-secondary fw-bold">
                                            Rate Plan
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0 text-color-secondary fw-bold text-center">
                                            Reservations %
                                        </p>
                                    </div>
                                </div>
                                <div class="row g-0 border-bottom pt-4 pb-4">
                                    <div class="col-8">
                                        <p class="mb-0 text-color fw-medium fs-7">
                                            EP
                                            <span class="text-color-secondary fs-6">
                                                (Room only, with no meals)
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0 text-color fw-medium text-center fs-7">
                                            35%
                                        </p>
                                    </div>
                                </div>
                                <div class="row g-0 border-bottom pt-4 pb-4">
                                    <div class="col-8">
                                        <p class="mb-0 text-color fw-medium fs-7">
                                            CP
                                            <span class="text-color-secondary fs-6">
                                                (Breakfast is included along with room.)
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0 text-color fw-medium text-center fs-7">
                                            45%
                                        </p>
                                    </div>
                                </div>
                                <div class="row g-0 border-bottom pt-4 pb-4">
                                    <div class="col-8">
                                        <p class="mb-0 text-color fw-medium fs-7">
                                            MAP
                                            <span class="text-color-secondary fs-6">
                                                (Includes room, breakfast & dinner.)
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0 text-color fw-medium text-center fs-7">
                                            12%
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header p-4 px-5">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title align-items-start d-flex flex-column">
                                        <span class="card-label fw-bold text-color fs-3">Deluxe AC Room</span>
                                        <div class="d-flex position-relative">
                                            <span class="text-color-secondary mt-2 fw-semibold fs-6">Average Occupancy:
                                                <span class="text-color">42%</span>
                                            </span>
                                            <span class="separator text-color-secondary"></span>
                                            <span class="text-color-secondary mt-2 fw-semibold fs-6">Average Occupancy:
                                                <span class="text-color">42%</span>
                                            </span>
                                        </div>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body p-6 px-5">
                                <div class="row g-0 border-bottom-solid pb-4">
                                    <div class="col-8">
                                        <p class="mb-0 text-color-secondary fw-bold">
                                            Rate Plan
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0 text-color-secondary fw-bold text-center">
                                            Reservations %
                                        </p>
                                    </div>
                                </div>
                                <div class="row g-0 border-bottom pt-4 pb-4">
                                    <div class="col-8">
                                        <p class="mb-0 text-color fw-medium fs-7">
                                            EP
                                            <span class="text-color-secondary fs-6">
                                                (Room only, with no meals)
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0 text-color fw-medium text-center fs-7">
                                            35%
                                        </p>
                                    </div>
                                </div>
                                <div class="row g-0 border-bottom pt-4 pb-4">
                                    <div class="col-8">
                                        <p class="mb-0 text-color fw-medium fs-7">
                                            CP
                                            <span class="text-color-secondary fs-6">
                                                (Breakfast is included along with room.)
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0 text-color fw-medium text-center fs-7">
                                            45%
                                        </p>
                                    </div>
                                </div>
                                <div class="row g-0 border-bottom pt-4 pb-4">
                                    <div class="col-8">
                                        <p class="mb-0 text-color fw-medium fs-7">
                                            MAP
                                            <span class="text-color-secondary fs-6">
                                                (Includes room, breakfast & dinner.)
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0 text-color fw-medium text-center fs-7">
                                            12%
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header p-4 px-5">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title align-items-start d-flex flex-column">
                                        <span class="card-label fw-bold text-color fs-3">Double AC Room</span>
                                        <div class="d-flex position-relative">
                                            <span class="text-color-secondary mt-2 fw-semibold fs-6">Average Occupancy:
                                                <span class="text-color">42%</span>
                                            </span>
                                            <span class="separator text-color-secondary"></span>
                                            <span class="text-color-secondary mt-2 fw-semibold fs-6">Average Occupancy:
                                                <span class="text-color">42%</span>
                                            </span>
                                        </div>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body p-6 px-5">
                                <div class="row g-0 border-bottom-solid pb-4">
                                    <div class="col-8">
                                        <p class="mb-0 text-color-secondary fw-bold">
                                            Rate Plan
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0 text-color-secondary fw-bold text-center">
                                            Reservations %
                                        </p>
                                    </div>
                                </div>
                                <div class="row g-0 border-bottom pt-4 pb-4">
                                    <div class="col-8">
                                        <p class="mb-0 text-color fw-medium fs-7">
                                            EP
                                            <span class="text-color-secondary fs-6">
                                                (Room only, with no meals)
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0 text-color fw-medium text-center fs-7">
                                            35%
                                        </p>
                                    </div>
                                </div>
                                <div class="row g-0 border-bottom pt-4 pb-4">
                                    <div class="col-8">
                                        <p class="mb-0 text-color fw-medium fs-7">
                                            CP
                                            <span class="text-color-secondary fs-6">
                                                (Breakfast is included along with room.)
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0 text-color fw-medium text-center fs-7">
                                            45%
                                        </p>
                                    </div>
                                </div>
                                <div class="row g-0 border-bottom pt-4 pb-4">
                                    <div class="col-8">
                                        <p class="mb-0 text-color fw-medium fs-7">
                                            MAP
                                            <span class="text-color-secondary fs-6">
                                                (Includes room, breakfast & dinner.)
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0 text-color fw-medium text-center fs-7">
                                            12%
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-8 col-12">
                    <div class="d-flex flex-column gap-8">
                        <h2 class="mb-0 text-color">Financial Performance</h2>
                        <div class="card">
                            <div class="card-body p-6 px-5">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6 col-12">
                                        <canvas id="kt_chartjs_2" class="mh-400px border-bottom pb-4 pb-lg-0 border-lg-end pe-lg-4"></canvas>
                                    </div>
                                    <div class="col-md-12 col-lg-6 mt-4 mt-lg-0 col-12">
                                        <div class="d-flex flex-wrap justify-content-between border-bottom py-2">
                                            <div class="d-flex justify-content-between gap-4 ">
                                                <div class="box-18 bg-orange"></div>
                                                <div class="d-flex flex-column">
                                                    <h2 class="mb-0 fw-bold text-color">PCBH</h2>
                                                    <p class="text-color-secondary">Payment Collected on Behalf of
                                                        Hotel</p>
                                                </div>
                                            </div>
                                            <h3 class="mb-0 fw-bold text-color">₹ 1,29,420</h3>
                                        </div>
                                        <div class="d-flex flex-wrap justify-content-between py-6">
                                            <div class="d-flex justify-content-between gap-4 ">
                                                <div class="box-18 bg-green"></div>
                                                <div class="d-flex flex-column">
                                                    <h2 class="mb-0 fw-bold text-color">MKUP</h2>
                                                    <p class="text-color-secondary">Payment Collected on Behalf of
                                                        Hotel</p>
                                                </div>
                                            </div>
                                            <h3 class="mb-0 fw-bold text-color">₹ 5,943</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-header p-4 px-5">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title align-items-start d-flex flex-column">
                                                <span class="card-label fw-bold text-color fs-18">Average
                                                    Pax</span>
                                                <span class="text-color-secondary mt-1 fw-semibold fs-6">Average
                                                    no.
                                                    of person booked per booking</span>
                                            </h3>
                                            <div class="card-toolbar">
                                                <h2 class="text-color fw-bold mb-0">3.2</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-6 px-5">

                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="mb-0 text-color-secondary fs-7">Adults <span
                                                    class="fs-8">(above 18 years)</span></p>
                                            <span class="text-color fw-bold">
                                                443
                                                <span class="fw-bold text-color-secondary">
                                                    /527
                                                </span>
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4">
                                            <p class="mb-0 text-color-secondary fs-7">Children <span
                                                    class="fs-8">(above 12 years)</span></p>
                                            <span class="text-color fw-bold">
                                                443
                                                <span class="fw-bold text-color-secondary">
                                                    /527
                                                </span>
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4">
                                            <p class="mb-0 text-color-secondary fs-7">Infants <span
                                                    class="fs-8">(above 02 years)</span></p>
                                            <span class="text-color fw-bold">
                                                443
                                                <span class="fw-bold text-color-secondary">
                                                    /527
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6 col-12 mt-8 mt-lg-0">
                                <div class="card">
                                    <div class="card-header p-4 px-5">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title align-items-start d-flex flex-column">
                                                <span class="card-label fw-bold text-color fs-18">Promotion
                                                    Revenue</span>
                                                <span class="text-color-secondary mt-1 fw-semibold fs-6">City wise
                                                    Promotion Revenue</span>
                                            </h3>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <!--begin::Currency-->
                                                <span class="fs-4 fw-semibold text-color-secondary me-1">₹</span>
                                                <!--end::Currency-->
                                                <!--begin::Amount-->
                                                <span class="fs-18 fw-bold text-color me-2">12,42,000</span>
                                                <!--end::Amount-->
                                                <!--begin::Badge-->
                                                <span class="badge badge-light-success fs-base">
                                                    <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.2%
                                                </span>
                                                <!--end::Badge-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-6 px-5">

                                        <div class="d-flex flex-column gap-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex">
                                                    <p class="mb-0 text-color-secondary fs-7">
                                                        Basic Deal
                                                        <span class="badge badge-light-success bg-white fs-base">
                                                            <i
                                                                class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.6%
                                                        </span>
                                                    </p>
                                                </div>
                                                <span class="text-color fw-bold fs-4">
                                                    ₹ 2,84,254
                                                </span>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex">
                                                    <p class="mb-0 text-color-secondary fs-7">
                                                        Last-minute Deal
                                                        <span class="badge badge-light-success bg-white fs-base">
                                                            <i
                                                                class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.6%
                                                        </span>
                                                    </p>
                                                </div>
                                                <span class="text-color fw-bold fs-4">
                                                    ₹ 1,90,000
                                                </span>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex">
                                                    <p class="mb-0 text-color-secondary fs-7">
                                                        Early Booker Deal <span
                                                            class="badge badge-light-success bg-white fs-base">
                                                            <i
                                                                class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.6%
                                                        </span>
                                                    </p>
                                                </div>
                                                <span class="text-color fw-bold fs-4">
                                                    ₹ 1,00,000
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6 col-12 mt-8">
                                <div class="card">
                                    <div class="card-header p-4 px-5">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title align-items-start d-flex flex-column">
                                                <span class="card-label fw-bold text-color fs-18">Reservations
                                                    by
                                                    Hotel Rating</span>
                                                <span class="text-color-secondary mt-1 fw-semibold fs-6">Total
                                                    Reservations done based on Hotel rating</span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body p-6 px-5">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-color-secondary">1/10 Rating</span>
                                            <span class="text-color fw-bold">
                                                50
                                                <span class="fw-bold text-color-secondary">/100</span>
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4">
                                            <span class="text-color-secondary">2/10 Rating</span>
                                            <span class="text-color fw-bold">
                                                80
                                                <span class="fw-bold text-color-secondary">/100</span>
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4">
                                            <span class="text-color-secondary">3/10 Rating</span>
                                            <span class="text-color fw-bold">
                                                120
                                                <span class="fw-bold text-color-secondary">/200</span>
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4">
                                            <span class="text-color-secondary">4/10 Rating</span>
                                            <span class="text-color fw-bold">
                                                150
                                                <span class="fw-bold text-color-secondary">/200</span>
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4">
                                            <span class="text-color-secondary">5/10 Rating</span>
                                            <span class="text-color fw-bold">
                                                200
                                                <span class="fw-bold text-color-secondary">/300</span>
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4">
                                            <span class="text-color-secondary">6/10 Rating</span>
                                            <span class="text-color fw-bold">
                                                250
                                                <span class="fw-bold text-color-secondary">/400</span>
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4">
                                            <span class="text-color-secondary">7/10 Rating</span>
                                            <span class="text-color fw-bold">
                                                300
                                                <span class="fw-bold text-color-secondary">/400</span>
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4">
                                            <span class="text-color-secondary">8/10 Rating</span>
                                            <span class="text-color fw-bold">
                                                350
                                                <span class="fw-bold text-color-secondary">/500</span>
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4">
                                            <span class="text-color-secondary">9/10 Rating</span>
                                            <span class="text-color fw-bold">
                                                400
                                                <span class="fw-bold text-color-secondary">/600</span>
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4">
                                            <span class="text-color-secondary">10/10 Rating</span>
                                            <span class="text-color fw-bold">
                                                450
                                                <span class="fw-bold text-color-secondary">/600</span>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6 col-12 mt-8">
                                <div class="card">
                                    <div class="card-header p-4 px-5">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title align-items-start d-flex flex-column">
                                                <span class="card-label fw-bold text-color fs-18">Occupancy Graph</span>
                                                <span class="text-color-secondary mt-1 fw-semibold fs-6">Total occupancy:
                                                    <span class="text-color">
                                                        66%
                                                    </span>
                                                </span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body p-6 px-5">
                                        <div id="performance_chart" style="height: 250px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
    </div>
    @push('scripts')
        <style>
            .separator {
                position: unset;
                height: 100%;
                width: 1px;
                background-color: #8597A7;
                top: 0;
                z-index: 1;
                margin: 0 5px;
            }
        </style>
        <script>
            $(document).ready(function() {
                // Function to check if both date fields have values
                function checkDateFields() {
                    const fromDate = $('#solid-date-one').val();
                    const toDate = $('#solid-date-second').val();

                    // If both fields have a value, show the download option
                    if (fromDate && toDate) {
                        $('#download-option').removeClass('d-none');
                    } else {
                        $('#download-option').addClass('d-none');
                    }
                }

                var ctx = document.getElementById('kt_chartjs_2');

                // Define colors for datasets
                var firstColor = '#FDB759'; // Color for PCBH
                var secondColor = '#008000'; // Color for MKUP

                // Define fonts and text styles
                var fontFamily = "'Plus Jakarta Sans', sans-serif"; // Use Plus Jakarta Sans font
                var labelColor = '#7c7c7c'; // Label color
                var fontWeight = 600; // Font weight

                // Chart labels for the X-axis
                const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];

                // Chart data
                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'PCBH',
                        backgroundColor: firstColor,
                        borderColor: firstColor,
                        data: [65, 59, 80, 81, 56, 55, 40],
                        fill: false, // No area fill below the line
                        tension: 0.4, // Smoother curve
                        borderWidth: 2

                    }, {
                        label: 'MKUP',
                        backgroundColor: secondColor,
                        borderColor: secondColor,
                        data: [28, 48, 40, 19, 86, 27, 90],
                        fill: false, // No area fill below the line
                        tension: 0.4, // Smoother curve
                        borderWidth: 2

                    }]
                };

                // Chart config for line graph
                const config = {
                    type: 'line',
                    data: data,
                    options: {
                        plugins: {
                            title: {
                                display: false,
                            },
                            legend: {
                                display: true,
                                labels: {
                                    usePointStyle: true, // To add the square box next to label
                                    generateLabels: function(chart) {
                                        const original = Chart.defaults.plugins.legend.labels.generateLabels;
                                        const labelsOriginal = original.call(this, chart);

                                        // Custom label for PCBH with additional text and price
                                        // labelsOriginal[0].text =
                                        //     'PCBH\nPayment Collected on Behalf of Hotel ₹ 1,29,420';

                                        // // Custom label for MKUP
                                        // labelsOriginal[1].text = 'MKUP ₹ 5,943\nMarkup on PCBH';

                                        return labelsOriginal;
                                    }
                                }
                            }
                        },
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true, // Y-axis starts from zero
                                grid: {
                                    drawBorder: false, // Remove border
                                    display: false // Remove horizontal grid lines
                                },
                                ticks: {
                                    color: labelColor, // Y-axis labels color
                                    font: {
                                        family: fontFamily,
                                        size: 12, // Font size
                                        weight: fontWeight
                                    },
                                    callback: function(value) {
                                        return value + 'k'; // Format Y-axis values with 'k'
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    drawBorder: false, // Remove border
                                    display: true, // Show only vertical grid lines
                                    drawOnChartArea: false, // Remove vertical grid lines over the chart area
                                    drawTicks: false, // Remove ticks from the grid lines
                                },
                                ticks: {
                                    color: labelColor, // X-axis labels color
                                    font: {
                                        family: fontFamily,
                                        size: 12, // Font size
                                        weight: fontWeight
                                    }
                                }
                            }
                        },
                        elements: {
                            point: {
                                radius: 4, // Size of the points
                                backgroundColor: firstColor // Point color for the first dataset
                            },
                            line: {
                                tension: 0.4 // Smoother line curve
                            }
                        }
                    }
                };

                // Init ChartJS for line graph
                var myChart = new Chart(ctx, config);
            });

            $(document).ready(function() {
                var element = document.getElementById('performance_chart');

                var height = parseInt(KTUtil.css(element, 'height'));
                var baseColor = KTUtil.getCssVariableValue('--kt-info');
                var lightColor = KTUtil.getCssVariableValue('--kt-info-light');
                var textColor = '#8597A7'; // Custom text color

                if (!element) {
                    return;
                }

                // Function to generate random data between 10k and 100k
                function generateRandomData() {
                    return Array.from({
                        length: 7
                    }, () => Math.floor(Math.random() * (100 - 10 + 1) + 10) * 1000);
                }

                var options = {
                    series: [{
                        name: 'Net Profit',
                        data: generateRandomData() // Random data between 10k and 100k
                    }],
                    chart: {
                        fontFamily: 'inherit',
                        type: 'area',
                        height: height,
                        toolbar: {
                            show: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    fill: {
                        type: 'gradient', // Use gradient fill
                        gradient: {
                            shadeIntensity: 1,
                            type: 'vertical',
                            gradientToColors: ['#fff'], // Gradient end color (top)
                            stops: [0, 100] // Start from the base color to the top
                        },
                        opacity: 1
                    },
                    stroke: {
                        curve: 'smooth',
                        show: true,
                        width: 3,
                        colors: ['#008000'] // Set the stroke color for the graph line
                    },
                    xaxis: {
                        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'], // Example categories
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: textColor, // Month name color
                                fontSize: '14px', // Font size
                                fontWeight: 600 // Font weight
                            }
                        },
                        crosshairs: {
                            position: 'front',
                            stroke: {
                                color: baseColor,
                                width: 1,
                                dashArray: 3
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return (value / 1000) + 'k'; // Format Y-axis labels as 10k, 20k, etc.
                            },
                            style: {
                                colors: textColor, // Text color for Y-axis
                                fontSize: '14px', // Font size
                                fontWeight: 600 // Font weight
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '12px'
                        },
                        y: {
                            formatter: function(val) {
                                return '$' + (val / 1000) + 'k'; // Format tooltip value
                            }
                        }
                    },
                    colors: ['#008000'], // This controls the main color (stroke and graph start fill)
                    grid: {
                        borderColor: KTUtil.getCssVariableValue('--kt-gray-200'),
                        strokeDashArray: 4,
                        yaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    markers: {
                        strokeColor: '#008000', // Set marker stroke color to match the graph
                        strokeWidth: 3
                    }
                };

                var chart = new ApexCharts(element, options);
                chart.render();
            });
        </script>
    @endpush


</x-app-layout>
