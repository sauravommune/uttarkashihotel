<x-app-layout>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                        Settings</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superAdmin.dashboard') }}" class="text-muted text-hover-success">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Settings</li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <div class="row">
                    <div class="col-sm-6 col-md-4 col-lg-3 mt-5">
                        <div class="serviceBox red">
                            <div class="service-icon">
                                <span class="fa-symbols-outlined"><span class="material-symbols-outlined">
                                        payments
                                    </span></span>
                            </div>
                            <span class="title text-muted fs-4 fw-400 lh-lg">Manage Payment Gateways</span>
                            <br>
                            <a href="{{ route('settings.payment-gateways') }}"
                                class="btn btn-sm btn-primary mt-5">Manage</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 mt-5">
                        <div class="serviceBox red">
                            <div class="service-icon">
                                <span class="fa-symbols-outlined"><span class="material-symbols-outlined">
                                        language
                                    </span></span>
                            </div>
                            <span class="title text-muted fs-4 fw-400 lh-lg">Manage Website Settings</span>
                            <br>
                            <a href="{{ route('settings.financial-info') }}"
                                class="btn btn-sm btn-primary mt-5">Manage</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 mt-5">
                        <div class="serviceBox red">
                            <div class="service-icon">
                                <span class="fa-symbols-outlined"><span class="material-symbols-outlined">
                                    alternate_email
                                    </span></span>
                            </div>
                            <span class="title text-muted fs-4 fw-400 lh-lg">Manage Mail Settings</span>
                            <br>
                            <a href="{{ route('settings.smtp') }}"
                            class="btn btn-sm btn-primary mt-5">Manage</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 mt-5">
                        <div class="serviceBox red">
                            <div class="service-icon">
                                <span class="fa-symbols-outlined"><span class="material-symbols-outlined">
                                    request_quote
                                    </span></span>
                            </div>
                            <span class="title text-muted fs-4 fw-400 lh-lg">Manage Invoice Settings</span>
                            <br>
                            <a href="{{ route('settings.invoice') }}"
                            class="btn btn-sm btn-primary mt-5">Manage</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 mt-5">
                        <div class="serviceBox red">
                            <div class="service-icon">
                                <span class="fa-symbols-outlined"><span class="material-symbols-outlined">
                                    input
                                    </span></span>
                            </div>
                            <span class="title text-muted fs-4 fw-400 lh-lg">Google Login Settings</span>
                            <br>
                            <a href="{{ route('google.login.form') }}"
                            class="btn btn-sm btn-primary mt-5">Manage</a>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3 mt-5">
                        <div class="serviceBox red">
                            <div class="service-icon">
                                <span class="fa-symbols-outlined"><span class="material-symbols-outlined">directory_sync</span></span>
                            </div>
                            <span class="title text-muted fs-4 fw-400 lh-lg">Page SEO Settings</span>
                            <br>
                            <a href="{{ route('seo.routes.index') }}" class="btn btn-sm btn-primary mt-5">Manage</a>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3 mt-5">
                        <div class="serviceBox red">
                            <div class="service-icon">
                                <span class="fa-symbols-outlined"><span class="material-symbols-outlined">directory_sync</span></span>
                            </div>
                            <span class="title text-muted fs-4 fw-400 lh-lg">API Key Settings</span>
                            <br>
                            <a href="{{ route('serverkey.index') }}" class="btn btn-sm btn-primary mt-5">Manage</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Main column-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</x-app-layout>

@push('scripts')
@endpush
