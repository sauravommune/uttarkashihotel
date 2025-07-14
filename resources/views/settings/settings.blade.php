@extends('layouts.app')

@section('page_styles')
    <style>
        #datatable_example th {
            color: grey !important;
        }

    </style>
@endsection

@section('main')
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                @include('layouts.includes.top-menu')
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->
                    <div class="subheader min-h-lg-175px pt-5 pb-7 subheader-transparent" id="kt_subheader">
                        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                            <!--begin::Details-->
                            <div class="d-flex align-items-center flex-wrap mr-2">
                                <!--begin::Heading-->
                                <div class="d-flex flex-column">
                                    <!--begin::Title-->
                                    <h2 class="text-white font-weight-bold my-2 mr-5">Admin Settings</h2>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                            </div>
                            <!--end::Details-->
                            @include('layouts.includes.topheader')
                        </div>
                    </div>
                    <!--end::Subheader-->
                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container">
                            <div class="row" data-sticky-container="">
                                <div class="col-lg-3 col-xl-2">
                                    @include('settings.includes.sidebar')
                                </div>
                                <div class="col-lg-9 col-xl-10 tab-content" id="secondory_tabs">

                                    <div id="personal_information" role="tabpanel"
                                        class="card card-custom tab-pane fade active show">
                                        <!--begin::Card header-->
                                        @include('settings.includes.personal-information.menu')
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body px-0">
                                            <div class="tab-content">
                                                <!--begin::Tab-->
                                                @include('settings.includes.personal-information.tabs.profile')
                                                <!--end::Tab-->

                                                <!--begin::Tab-->
                                                @include('settings.includes.personal-information.tabs.change-password')
                                                <!--end::Tab-->
                                                <!--begin::tab-->
                                                {{-- @include('settings.includes.personal-information.tabs.settings') --}}
                                                <!--end::Tab-->
                                            </div>

                                        </div>
                                        <!--end::Card body-->
                                    </div>

                                    <div id="t2" role="tabpanel" class="card card-custom tab-pane fade">
                                        <!--begin::Card header-->
                                        @include('settings.includes.business-information.menu')
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body px-0">
                                            <div class="tab-content">
                                                <!--begin::Tab-->
                                                @include('settings.includes.business-information.tabs.business-info')
                                                <!--end::Tab-->
                                                <!--begin::Tab-->
                                                @include('settings.includes.business-information.tabs.business-address')
                                                <!--end::Tab-->


                                                <!--begin::Tab-->
                                                @include('settings.includes.business-information.tabs.bank-details')
                                                <!--end::Tab-->
                                            </div>
                                        </div>
                                        <!--end::Card body-->
                                    </div>

                                    <div id="notification_order" role="tabpanel" class="card card-custom tab-pane fade">
                                        <!--begin::Card header-->

                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body px-0">
                                            <div class="tab-content">
                                                @include('settings.includes.order-notification.orderuseralert')
                                            </div>
                                        </div>
                                        <!--end::Card body-->
                                    </div>

                                    <div id="invoice_settings" role="tabpanel" class="card card-custom tab-pane fade">
                                        <!--begin::Card header-->
                                        @include('settings.includes.invoice-settings.menu')
                                        <!--end::Card header-->

                                        <!--begin::Card body-->
                                        <div class="card-body px-0">
                                            <div class="tab-content">
                                                <!--begin::Tab-->
                                                @include('settings.includes.invoice-settings.tabs.layout-settings')
                                                <!--end::Tab-->
                                                <!--begin::Tab-->
                                                @include('settings.includes.invoice-settings.tabs.taxes')
                                                <!--end::Tab-->
                                                <!--begin::Tab-->
                                                @include('settings.includes.invoice-settings.tabs.currency')
                                                <!--end::Tab-->
                                            </div>
                                        </div>
                                        <!--end::Card body-->
                                    </div>

                                    <div id="payment_gateways" role="tabpanel" class="card card-custom tab-pane fade">
                                        <!--begin::Card header-->
                                        @include('settings.includes.payment-gateways.menu')
                                        <!--end::Card header-->

                                        <!--begin::Card body-->
                                        <div class="card-body px-0">
                                            <div class="tab-content">
                                                <!--begin::Tab-->
                                                @include('settings.includes.payment-gateways.tabs.settings')
                                                <!--end::Tab-->
                                                <!--begin::Tab-->
                                                @include('settings.includes.payment-gateways.tabs.paypal')
                                                <!--end::Tab-->
                                                <!--begin::Tab-->
                                                @include('settings.includes.payment-gateways.tabs.stripe')
                                                <!--end::Tab-->
                                                <!--begin::Tab-->
                                                @include('settings.includes.payment-gateways.tabs.razorpay')
                                                <!--end::Tab-->
                                            </div>
                                        </div>
                                        <!--end::Card body-->
                                    </div>

                                    <div id="email_settings" role="tabpanel" class="card card-custom tab-pane fade">
                                        <!--begin::Card header-->
                                        @include('settings.includes.email-settings.menu')
                                        <!--end::Card header-->

                                        <!--begin::Card body-->
                                        <div class="card-body px-0">
                                            <div class="tab-content">
                                                <!--begin::Tab-->
                                                @include('settings.includes.email-settings.tabs.new-invoice-template')
                                                <!--end::Tab-->
                                                <!--begin::Tab-->
                                                @include('settings.includes.email-settings.tabs.due-invoice-template')
                                                <!--end::Tab-->
                                            </div>
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Container-->
                    </div>
                </div>
                <!--end::Content-->
                @include('layouts.includes.footer')
            </div>
            <!--end::wrapper-->
        </div>
        <!--end::Page-->
        @include('layouts.includes.scroll-to-top')
    </div>
@endsection


@section('page_scripts')



    <!-- Sortable (for table row drag & drop)-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.2/Sortable.min.js"></script>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <link href="{{ asset('assets/css/datatables.bundle.css?v=7.0.3') }}" rel="stylesheet" type="text/css" />
    <script src="{{asset('js/settings.js')}}"></script>
    <script src="{{ asset('assets/js/datatables.bundle.js?v=7.0.3') }}"></script>
    <script type="text/javascript">
        var base_url = "{{ url('/') }}";
    </script>
    <script>
        var alertable
        $(document).ready(function() {


            $('#kt_search').on('click', function(e) {
                e.preventDefault();
                alertable.table().draw();
            });

            $('#kt_reset').on('click', function(e) {
                e.preventDefault();
                $('#serach_form')[0].reset();
                alertable.table().draw();
            });

            $('#broker_business').change(function() {
                if ($(this).val() == 'Individual') {
                    $('.upload_certificate_div').hide();
                } else {
                    $('.upload_certificate_div').show();
                }
            });

            $('#broker_gst_compliant').change(function() {
                if ($(this).val() == 'No') {
                    $('.broker_gst_compliant_div').hide();
                } else {
                    $('.broker_gst_compliant_div').show();
                }
            });

        });
    </script>

@endsection
