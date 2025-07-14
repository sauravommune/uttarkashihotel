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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Payment Gateway Settings</h1>
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
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('settings.index') }}" class="text-muted text-hover-success">Settings</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Payment Gateway Settings</li>
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
                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-success pb-4 active" data-bs-toggle="tab" href="#options1">Settings</a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-success pb-4" data-bs-toggle="tab" href="#options2">PayPal</a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-success pb-4" data-bs-toggle="tab" href="#options3">Stripe</a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-success pb-4" data-bs-toggle="tab" href="#options4">RazorPay</a>
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="options1" role="tab-panel">
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body p-9">
                                <form action="{{ route('settings.payment-gateway') }}" class="global-ajax-form">
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Which Payment Gateway Would You Like To Use?</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 my-auto">
                                            <form id="payment_settings_form" action="{{ route('settings.payment-gateway') }}" method="post" class="global-ajax-form">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-row">
                                                        <div class="form-check form-check-success form-check-solid mb-4">
                                                            <input class="form-check-input" name="paypal" type="checkbox" id="kt_checkbox_1_3" @if($adminsetting->payment_gateways['paypal']['enabled'] ?? false) checked @endif>
                                                            <label class="form-check-label" for="kt_checkbox_1_3">
                                                                PayPal
                                                            </label>
                                                        </div>

                                                        <div class="form-check form-check-success form-check-solid mb-4">
                                                            <input class="form-check-input" name="razorpay" type="checkbox" id="kt_checkbox_1_31" @if($adminsetting->payment_gateways['razorpay']['enabled'] ?? false) checked @endif>
                                                            <label class="form-check-label" for="kt_checkbox_1_31">
                                                                RazorPay (India)
                                                            </label>
                                                        </div>

                                                        <div class="form-check form-check-success form-check-solid mb-4">
                                                            <input class="form-check-input" name="stripe" type="checkbox" id="kt_checkbox_1_32" @if($adminsetting->payment_gateways['stripe']['enabled'] ?? false) checked @endif>
                                                            <label class="form-check-label" for="kt_checkbox_1_32">
                                                                Stripe
                                                            </label>
                                                        </div>

                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                                <div class="d-flex justify-content-start py-6">
                                                    <!--begin::Button-->
                                                    <button type="submit" id="payment_settings_form_submit" class="btn btn-primary">
                                                        <span class="indicator-label">Save Changes</span>
                                                        <span class="indicator-progress">Please wait...
                                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                    <!--end::Button-->
                                                </div>
                                            </form>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade" id="options2" role="tab-panel">
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <form action="{{ route('settings.gateway.paypal') }}" method="post" class="global-ajax-form">
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Type</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12">
                                                    <select name="mode" class="form-control" id="paypaltype" data-control="select2">
                                                        <option value="live" @if(($adminsetting->payment_gateways['paypal']['mode'] ?? 'sandbox')
                                                            == 'live') selected @endif)>Live</option>
                                                        <option value="sandbox" @if(($adminsetting->payment_gateways['paypal']['mode'] ??
                                                            'sandbox') == 'sandbox') selected @endif)>Sandbox</option>
                                                    </select>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Username</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12">
                                                    <div class="input-group">
                                                        <span class="input-group-text border-1" id="basic-addon1"><i class="bi bi-at fs-2"></i></span>
                                                        <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" value="{{$adminsetting->payment_gateways['paypal']['username'] ??'' }}" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Password</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12">
                                                    <div class="input-group">
                                                        <span class="input-group-text border-1" id="basic-addon1"><i class="bi bi-lock fs-2"></i></span>
                                                        <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" value="{{$adminsetting->payment_gateways['paypal']['password'] ??'' }}" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">API Signature Key</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12">
                                                    <div class="input-group">
                                                        <span class="input-group-text border-1" id="basic-addon1"><i class="bi bi-key fs-2"></i></span>
                                                        <input type="password" name="api_signature_key" class="form-control" placeholder="API Signature Key" aria-label="api_signature_key" value="{{$adminsetting->payment_gateways['paypal']['api_signature_key'] ??'' }}" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--begin::Actions-->
                                    <div class="card-footer d-flex justify-content-end py-6 px-9 pe-0">
                                        <!--begin::Button-->
                                        <button type="submit" id="paypal_settings_form_submit" class="btn btn-primary">
                                            <span class="indicator-label">Save Changes</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Actions-->
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade" id="options3" role="tab-panel">
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <form action="{{ route('settings.invoice.stripe') }}" method="post" class="global-ajax-form">
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Type</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 my-auto">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-row">
                                                    <select name="mode" class="form-control" id="stripetype">
                                                        <option value="live" @if(($adminsetting->payment_gateways['stripe']['mode'] ?? 'test')
                                                            == 'live') selected @endif>Live</option>
                                                        <option value="test" @if(($adminsetting->payment_gateways['stripe']['mode'] ?? 'test')
                                                            == 'test') selected @endif>Test</option>
                                                    </select>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Publishable Key</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 my-auto">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-row">
                                                    <div class="input-group">
                                                        <span class="input-group-text border-1" id="basic-addon1"><i class="bi bi-key fs-2"></i></span>
                                                        <input type="password" name="publishable_key" class="form-control" placeholder="Publishable Key" aria-label="publishable_key" value="{{$adminsetting->payment_gateways['stripe']['publishable_key'] ??'' }}" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Secret Key</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 my-auto">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-row">
                                                    <div class="input-group">
                                                        <span class="input-group-text border-1" id="basic-addon1"><i class="bi bi-key fs-2"></i></span>
                                                        <input type="password" name="secret_key" class="form-control" placeholder="Secret Key" aria-label="Secret Key" value="{{$adminsetting->payment_gateways['stripe']['secret_key'] ??'' }}" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Actions-->
                                    <div class="card-footer d-flex justify-content-end py-6 px-9 pe-0">
                                        <!--begin::Button-->
                                        <button type="submit" id="stripe_form_submit" class="btn btn-primary">
                                            <span class="indicator-label">Save Changes</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Actions-->
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade" id="options4" role="tab-panel">
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <form action="{{ route('settings.invoice.razorpay') }}" method="post" class="global-ajax-form">
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Type</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 my-auto">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-row">
                                                    <select name="mode" class="form-control">
                                                        <option value="live" @if(($adminsetting->payment_gateways['razorpay']['mode'] ?? 'test')
                                                            == 'live') selected @endif)>Live</option>
                                                        <option value="test" @if(($adminsetting->payment_gateways['razorpay']['mode'] ?? 'test')
                                                            == 'test') selected @endif>Test</option>
                                                    </select>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Key ID</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 my-auto">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-row">
                                                    <div class="input-group">
                                                        <span class="input-group-text border-1" id="basic-addon1"><i class="bi bi-key fs-2"></i></span>
                                                        <input type="text" name="key_id" class="form-control" placeholder="Key ID" aria-label="Key ID" value="{{$adminsetting->payment_gateways['razorpay']['key_id'] ??'' }}" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Key Secret</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 my-auto">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-row">
                                                    <div class="input-group">
                                                        <span class="input-group-text border-1" id="basic-addon1"><i class="bi bi-key fs-2"></i></span>
                                                        <input type="text" name="key_secret" class="form-control" placeholder="Key Secret" aria-label="Key Secret" value="{{$adminsetting->payment_gateways['razorpay']['key_secret'] ??'' }}" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Actions-->
                                    <div class="card-footer d-flex justify-content-end py-6 px-9 pe-0">
                                        <!--begin::Button-->
                                        <button type="submit" id="razorpay_form_submit" class="btn btn-primary">
                                            <span class="indicator-label">Save Changes</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Actions-->
                                    <!--begin::Row-->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="col-12 alert alert-primary alert-outline-danger fade show mb-5" role="alert">
                                                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                                <div class="alert-text"><a href="https://rzp.io/i/DKax4BQ" target="_blank">Don't have a RazorPay account? Click here to open a new account.</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Row-->
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end::Tab pane-->
                </div>
                <!--end::Tab content-->
            </div>
            <!--end::Main column-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</x-app-layout>
