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
                        {{ $title }}</h1>
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
                <div class="d-flex fs-7 text-white flex-column bg-theme-success p-3 px-4 rounded">
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="fs-2 fw-semibold">8.8</span>/10
                    </div>
                    <p class="mb-0">68 Verified Ratings</p>
                </div>
                <!--end::Actions-->
                <!--end::Actions-->
            </div>
            <!--end::Toolbar wrapper-->

        </div>
        <!--end::Toolbar container-->
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-5 align-items-end">
                
                <div class="col">
                    <div class="fv-row fv-plugins-icon-container">
                        <label class="form-label">Search</label>
                        <div class="d-flex align-items-center position-relative">
                            <span class="material-symbols-outlined fs-3 fs-3 position-absolute ms-3">
                                search
                            </span>
                            <input type="text" id="kt_filter_search"
                                class="form-control form-control-solid ps-10" placeholder="Search">
                        </div>
                    </div>
                </div>

                <div class="col">
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
                                filter_alt
                            </span>
                            Apply Filter
                        </button>
                    </div>
                </div>

                <div class="col mt-4 d-none" id="download-option">
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
            <div class="row mt-12">
                @for ($i = 0; $i < 12; $i++)
                    <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4 col-xxl-3 col-12 mb-8">
                        <div class="card border-none card-outer-hover shadow-custom-xs">
                            <div class="card-header border-bottom-0 p-0 px-8">
                                <div class="border-bottom  d-flex align-items-center justify-content-between py-4">
                                    <div class="d-flex align-items-center flex-grow-1">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-45px me-3">
                                            <img src="{{ asset('assets/media/avatars/300-6.jpg') }}"
                                                class="rounded-circle" alt="">
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-color text-hover-primary fs-18 fw-bolder">per
                                                Bhat Verma</a>
                                            <span class="text-color fw-semibold">
                                                <span>
                                                    <img src="{{ asset('assets/media/avatars/india_flag.svg') }}"
                                                        alt="">
                                                </span>
                                                India
                                            </span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <div class="card-toolbar">
                                        <span class="badge badge-theme-success p-2 px-3">8.0</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0 px-8 py-6">
                                <div class="d-flex flex-column gap-2 border-bottom pb-8">
                                    <span class="text-color-secondary fw-normal fs-6">
                                        Reviewed on: 11 Aug. 2024
                                    </span>
                                    <span class="text-color fw-semibold fs-7">
                                        Very nice and comfortable hotel, thank you for accompanying my vacation.
                                    </span>

                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="button"
                                            class="btn btn-light d-flex align-items-center gap-2 w-fc p-2 px-3"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                                            <span class="material-symbols-outlined fs-2">
                                                comment
                                            </span>
                                            View response
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer p-0 border-0">
                                <div class="d-flex justify-content-between px-8 pb-6">
                                    <div class="d-flex align-items-start gap-2">
                                        <span class="material-symbols-outlined fs-2 text-color">
                                            comment
                                        </span>
                                        <span class="d-flex flex-column">
                                            <p class="fs-6 text-color mb-0">
                                                View response
                                            </p>
                                            <p class="fs-7 text-color mb-0">
                                                Aug. 2024
                                            </p>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-start gap-2">
                                        <span class="material-symbols-outlined fs-2 text-color">
                                            meeting_room
                                        </span>
                                        <span class="d-flex flex-column">
                                            <p class="fs-6 text-color mb-0">
                                                Standard Room
                                            </p>
                                            <p class="fs-7 text-color mb-0">
                                                15 guests
                                            </p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor

            </div>
        </div>
    </div>
</x-app-layout>
<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Response</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="d-flex align-items-center justify-content-between py-4">
                    <div class="d-flex align-items-center flex-grow-1">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-45px me-3">
                            <img src="{{ asset('assets/media/avatars/300-6.jpg') }}"
                                class="rounded-circle" alt="">
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Info-->
                        <div class="d-flex flex-column">
                            <a href="#" class="text-color text-hover-primary fs-18 fw-bolder">per
                                Bhat Verma</a>
                            <span class="text-color fw-semibold">
                                <span>
                                    <img src="{{ asset('assets/media/avatars/india_flag.svg') }}"
                                        alt="">
                                </span>
                                India
                            </span>
                        </div>
                        <!--end::Info-->
                    </div>
                    <div class="card-toolbar">
                        <span class="badge badge-theme-success p-2 px-3">8.0</span>
                    </div>
                </div>
                <div class="d-flex flex-column gap-2 pt-8">
                    <span class="text-color-secondary fw-normal fs-6">
                        Reviewed on: 11 Aug. 2024
                    </span>
                    <span class="text-color fw-semibold fs-7">
                        Very nice and comfortable hotel, thank you for accompanying my vacation.
                    </span>
                </div>
                <div class="mt-8">
                    <textarea class="form-control form-control form-control-solid" placeholder="Write your response" data-kt-autosize="true"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> --}}
                <button type="button" class="btn btn-primary w-100">Add Response</button>
            </div>
        </div>
    </div>
</div>
