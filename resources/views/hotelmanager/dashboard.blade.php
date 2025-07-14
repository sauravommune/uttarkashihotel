<x-app-layout>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-color fw-bold fs-3 m-0">
                        {{$title}}
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
                        <li class="breadcrumb-item text-muted">{{$title}}
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <input class="form-control form-control-solid w-fc" placeholder="Pick date & time" id="date_range"/>

                <!--end::Page title-->
                <!--begin::Actions-->
                <!--end::Actions-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="top-cover mb-4">
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
                    <span class="badge badge-light-danger fs-7 ms-2 p-2 px-3 rounded-2">Open for Booking</span>
                </div>
                <div class="content-right">
                    <div class="form-check form-switch form-check-custom form-check-solid outer">
                        <input class="form-check-input" type="checkbox" value="" id="flexSwitchChecked"
                            checked="checked" />
                        <label class="form-check-label" for="flexSwitchChecked">
                            Hotel is Live
                        </label>
                    </div>
                    <div class="d-flex align-items-center outer">
                        <span class="material-symbols-outlined fs-3">
                            autorenew
                        </span>
                        <p class="text-color-secondary mb-0 ms-1" style="line-height: 1.7">Update images</p>
                    </div>
                    <div class="box-40 btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-44px w-44px">
                        <span class="material-symbols-outlined">
                            edit
                        </span>
                    </div>
                </div>
            </div>
            <!--begin::Content container-->
            <div class="row gx-5 gx-xl-10 mb-xl-10">
                <!--begin::Col-->

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-2 col-xxl-2">
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
                                            <span class="fs-2hx fw-bold text-color me-2 lh-1 ls-n2">12</span>
                                            <!--end::Amount-->
                                            <!--begin::Badge-->
                                            <span class="badge badge-light-success fs-base">
                                                <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.2%
                                            </span>
                                            <!--end::Badge-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Subtitle-->
                                        <span class="text-color-secondary pt-1 fw-semibold fs-6">Today’s
                                            Check-Ins</span>
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
                        <div class="col-md-6 col-lg-6 col-xl-2 col-xxl-2">
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
                                            <span class="fs-2hx fw-bold text-color me-2 lh-1 ls-n2">66%</span>
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
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-6 col-lg-6 col-xl-2 col-xxl-2">
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
                                        <span class="text-color-secondary pt-1 fw-semibold fs-6">Cancellation
                                            Rate</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 4-->
                        </div>

                        <!--begin::Col-->
                        <div class="col-md-6 col-lg-6 col-xl-2 col-xxl-2">
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
                                            <span class="fs-2hx fw-bold text-color me-2 lh-1 ls-n2">1,029,420</span>
                                            <!--end::Amount-->
                                            <!--begin::Badge-->
                                            <span class="badge badge-light-success fs-base">
                                                <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.6%
                                            </span>
                                            <!--end::Badge-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Subtitle-->
                                        <span class="text-color-secondary pt-1 fw-semibold fs-6">Today’s Revenue</span>
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
                        <div class="col-md-6 col-lg-6 col-xl-2 col-xxl-2">
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
                                            <span class="fs-2hx fw-bold text-color me-2 lh-1 ls-n2">40</span>
                                            <!--end::Amount-->
                                            <!--begin::Badge-->
                                            <span class="badge badge-light-success fs-base">
                                                <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.2%
                                            </span>
                                            <!--end::Badge-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Subtitle-->
                                        <span class="text-color-secondary pt-1 fw-semibold fs-6">Total Guests</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 4-->
                        </div>

                        <!--begin::Col-->
                        <div class="col-md-6 col-lg-6 col-xl-2 col-xxl-2">
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
            <div class="col-xl-12 mb-5 mb-xl-10">
                <!--begin::Table Widget 4-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Card header-->
                    <div class="card-header pt-7 d-flex justify-content-between align-items-center">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column d-flex">
                            <span class="card-label fw-bold text-color fs-18">Todays Bookings</span>
                            <span class="text-color-secondary mt-1 fw-semibold fs-6">Recent Bookings from this
                                week</span>
                        </h3>
                        <!--end::Title-->
                        <!--begin::Actions-->
                        <div class="card-toolbar">
                            <!--begin::Filters-->
                            <div class="d-flex flex-stack flex-wrap gap-4">
                                <!--begin::Destination-->
                                <div class="d-flex align-items-center fw-bold">
                                    <!--begin::Select-->
                                    <select class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="Select Room Type">
                                        <option></option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                    </select>
                                    <!--end::Select-->
                                </div>
                                <!--end::Destination-->
                                <!--begin::Status-->
                                <div class="d-flex align-items-center fw-bold">
                                    <!--begin::Select-->
                                    <select class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="Select Date">
                                        <option></option>
                                        <option value="1">Today</option>
                                        <option value="2">Yesterday</option>
                                        <option value="2">Last 3 Months</option>
                                        <option value="2">Last 6 Months</option>
                                        <option value="2">Last 1 Year</option>
                                    </select><!--end::Select-->
                                </div>
                                <!--end::Status-->
                                <!--begin::Search-->
                                {{-- <div class="position-relative my-1">
                                    <i
                                        class="ki-outline ki-magnifier fs-2 position-absolute top-50 translate-middle-y ms-4"></i>
                                    <input type="text" data-kt-table-widget-4="search"
                                        class="form-control w-150px fs-7 ps-12" placeholder="Search">
                                </div> --}}
                                <!--end::Search-->
                            </div>
                            <!--begin::Filters-->
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-2">
                        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6 dashboard-manager">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 active" data-bs-toggle="tab"
                                    href="#arrivals">
                                    <span class="material-symbols-outlined fs-3">
                                        flight_land
                                    </span>
                                    Arrivals
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="tab"
                                    href="#departures">
                                    <span class="material-symbols-outlined fs-3">
                                        flight_takeoff
                                    </span>
                                    Departures
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="tab"
                                    href="#stay-overs">
                                    <span class="material-symbols-outlined fs-3">
                                        hotel
                                    </span>
                                    Stay-overs
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="arrivals" role="tabpanel">
                                <div class="table-responsive">
                                    {{ $dataTable->table() }}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="departures" role="tabpanel">
                                <div class="table-responsive">
                                    {{ $dataTable->table() }}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="stay-overs" role="tabpanel">
                                <div class="table-responsive">
                                    {{ $dataTable->table() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Table Widget 4-->
            </div>
            <!--end::Col-->
        </div>
    </div>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script>
            $("#date_range").flatpickr({
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                mode: "range"
            });
        </script>
        <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    @endpush
</x-app-layout>
