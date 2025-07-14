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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Email Settings</h1>
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
                        <li class="breadcrumb-item text-muted">Email Settings</li>
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
                        <a class="nav-link text-active-success pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">New Invoice Template</a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-success pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">Due Invoice Template</a>
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <!--begin::Form-->
                        <form id="newInvoiceForm" action="{{ route('settings.emails.update') }}" method="post" class="global-ajax-form">
                            <input type="hidden" name="type" value="invoice_created">
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body p-9">
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Email Subject</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-row">
                                                    <input type="text" name="subject" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Your Invoice is Here!" value="{{ $adminsetting->email_settings['mails']['invoice_created']['subject'] ?? '' }}" required />
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Email Body</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-row">
                                                    <div id="new_invoice_email_quil" style="height: 325px">
                                                        {!! $adminsetting->email_settings['mails']['invoice_created']['message']??'' !!}
                                                    </div>
                                                    <input type="hidden" name="message" id="messageCreated" value="{!! $adminsetting->email_settings['mails']['invoice_created']['message']??'' !!}">
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="card-footer d-flex justify-content-end py-6 px-9 pe-0">
                                        <!--begin::Button-->
                                        <button type="submit" id="new_invoice_submit" class="btn btn-success">
                                            <span class="indicator-label">Save Changes</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card body-->
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::Inventory-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body p-9">
                                    <form id="dueInvoiceForm" action="{{ route('settings.emails.update') }}" method="post" class="global-ajax-form">
                                        <input type="hidden" name="type" value="invoice_due">
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Email Subject</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-row">
                                                        <input type="text" name="subject" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Your Invoice is Here!" value="{{ $adminsetting->email_settings['mails']['invoice_due']['subject'] ?? '' }}" required />
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Email Body</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-row">
                                                        <div id="due_invoice_email_quil" style="height: 325px">
                                                            {!! $adminsetting->email_settings['mails']['invoice_due']['message']??'' !!}
                                                        </div>
                                                        <input type="hidden" name="message" id="dueMessage" value="{!! $adminsetting->email_settings['mails']['invoice_due']['message']??'' !!}">
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <div class="card-footer d-flex justify-content-end py-6 px-9 pe-0">
                                            <!--begin::Button-->
                                            <button type="submit" id="due_invoice_submit" class="btn btn-success">
                                                <span class="indicator-label">Save Changes</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                        <!--end::Input group-->

                                    </form>
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Inventory-->
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

    @push('scripts')
    <script>
        var quillnew = new Quill('#new_invoice_email_quil', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image']
                ]
            },
            placeholder: 'Type your message here...',
            theme: 'snow'
        });

        var quilldue = new Quill('#due_invoice_email_quil', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image']
                ]
            },
            placeholder: 'Type your message here...',
            theme: 'snow'
        });

        $(function() {
            $('body').on('keyup', '#new_invoice_email_quil .ql-editor', function(e) {
                $('#messageCreated').val($(this).html());
            })

            $('body').on('keyup', '#due_invoice_email_quil .ql-editor', function(e) {
                $('#dueMessage').val($(this).html());
            })
        });
    </script>
    @endpush
</x-app-layout>
