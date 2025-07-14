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
                        <li class="breadcrumb-item text-muted">{{ $title }}
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <input class="form-control form-control-solid w-fc" placeholder="Pick date & time" id="date_range" />

                <!--end::Page title-->
                <!--begin::Actions-->
                <!--end::Actions-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid h-100">
            <div class="row hotel-details h-100">
                <div class="col-md-3 col-xl-2 col-12 border-end">
                    <div class="nav d-flex flex-nowrap flex-row flex-md-column  nav-pills pe-4 overflow-auto" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <button class="nav-link text-nowrap active" id="v-pills-about-hotel-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-about-hotel" type="button" role="tab"
                            aria-controls="v-pills-about-hotel" aria-selected="true">About Hotel</button>
                        <button class="nav-link text-nowrap" id="v-pills-amenities-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-amenities" type="button" role="tab"
                            aria-controls="v-pills-amenities" aria-selected="false">Amenities</button>
                        <button class="nav-link text-nowrap" id="v-pills-breakfast-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-breakfast" type="button" role="tab"
                            aria-controls="v-pills-breakfast" aria-selected="false">Breakfast Details</button>
                        <button class="nav-link text-nowrap" id="v-pills-house-rules-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-house-rules" type="button" role="tab"
                            aria-controls="v-pills-house-rules" aria-selected="false">House Rules</button>
                        <button class="nav-link text-nowrap" id="v-pills-invoice-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-invoice" type="button" role="tab"
                            aria-controls="v-pills-invoice" aria-selected="false">Invoicing & Taxes</button>
                        <button class="nav-link text-nowrap" id="v-pills-pictures-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-pictures" type="button" role="tab"
                            aria-controls="v-pills-pictures" aria-selected="false">Upload Pictures</button>
                    </div>
                </div>
                <div class="col-md-9 col-xl-10 col-12 pt-8 pt-md-0">
                    <div class="tab-content ps-4" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-about-hotel" role="tabpanel"
                            aria-labelledby="v-pills-about-hotel-tab" tabindex="0">
                            @include('hotelmanager.hoteldetails.abouthotel')
                        </div>
                        <div class="tab-pane fade" id="v-pills-amenities" role="tabpanel"
                            aria-labelledby="v-pills-amenities-tab" tabindex="0">
                            @include('hotelmanager.hoteldetails.editaminitites')
                        </div>
                        <div class="tab-pane fade" id="v-pills-breakfast" role="tabpanel"
                            aria-labelledby="v-pills-breakfast-tab" tabindex="0">
                            @include('hotelmanager.hoteldetails.breakfastdetails')
                        </div>
                        <div class="tab-pane fade" id="v-pills-house-rules" role="tabpanel"
                            aria-labelledby="v-pills-house-rules-tab" tabindex="0">
                            @include('hotelmanager.hoteldetails.houserule')
                        </div>
                        <div class="tab-pane fade" id="v-pills-invoice" role="tabpanel"
                            aria-labelledby="v-pills-invoice-tab" tabindex="0">
                            @include('hotelmanager.hoteldetails.invoicentaxes')
                        </div>
                        <div class="tab-pane fade" id="v-pills-pictures" role="tabpanel"
                            aria-labelledby="v-pills-pictures-tab" tabindex="0">
                            @include('hotelmanager.hoteldetails.uploadimg')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-app-layout>
