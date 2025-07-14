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
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superAdmin.dashboard') }}" class="text-color-secondary text-hover-primary">Home</a>
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

                <div class="d-flex flex-column gap-2 border-start-success ps-3">
                    <span class="text-color-secondary pt-1 fw-semibold fs-7">Total Revenue</span>
                    <span class="fs-18 fw-bold text-color">₹ {{ number_format($totalSum, 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card border-0">
                <!--begin::Card header-->
                <div class="card-body p-0">

                        <div class="row align-items-end" id="download-option-data">
                            <div class="col-md-3">
                                <div class="fv-row fv-plugins-icon-container">
                                    <label class="form-label">Search</label>
                                    <div class="d-flex align-items-center position-relative">
                                        <span class="material-symbols-outlined fs-3 fs-3 position-absolute ms-3">search</span>
                                        <input type="search" name="search" class="form-control form-control-sm ps-10" placeholder="Cust., Booking ID, Payment ID...">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 mt-4 mt-md-0">
                                <div class="fv-row fv-plugins-icon-container">
                                    <label class="form-label">From Date</label>
                                    <input class="form-control form-control-sm flatpicker" placeholder="Pick a date" name="startDate" value="{{ Carbon\Carbon::now()->subDays(30)->format('Y-m-d') }}" />
                                </div>
                            </div>

                            <div class="col-md-2 mt-4 mt-md-0">
                                <div class="fv-row fv-plugins-icon-container">
                                    <label class="form-label">To Date</label>
                                    <input class="form-control form-control-sm flatpicker" placeholder="Pick a date" name="endDate" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" />
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <button class="btn btn-sm btn-primary d-flex justify-content-center">
                                    <span class="material-symbols-outlined fs-1">filter_alt</span> Apply Filter
                                </button>
                            </div>
                        </div>

                        
                    <div id="kt_app_content" class="app-content flex-column-fluid  mt-8">
                        <!--begin::Content container-->
                        <div id="kt_app_content_container" class="container-fluid">
                            <div class="card border-0 shadow-none">
                                <!--begin::Card header-->
                                <div class="card-body p-0">
                                    <table class="table table-sm table-striped table-bordered" id="global-datatable">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Client</th>
                                                <th rowspan="2">Booking ID</th>
                                                <th rowspan="2">Payment ID</th>
                                                <th class="text-center bg-light-primary border-1" colspan="3">Accounting at RazorPay's End</th>
                                                <th class="text-center bg-light-success border-1" colspan="6">Net Accounting</th>
                                                <th rowspan="2">Status</th>
                                                <th rowspan="2">Date</th>
                                            </tr>
                                            <tr>
                                                <th>Rzp Fees</th>
                                                <th>Rzp GST</th>
                                                <th>Rzp Total</th>

                                                <th>Customer Paid</th>
                                                <th>Paid to Vendor</th>
                                                <th>Markup</th>
                                                <th>Markup GST</th>
                                                <th>Net Markup Profit</th>
                                                <th>Net GST Input</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}
    <script>
        window.LaravelDataTables = window.LaravelDataTables || {};
        window.LaravelDataTables["global-datatable"] = $('#global-datatable').DataTable({
            buttons: [
                'print',
                'postExcel',
                'postCsv',
                'postPdf',
            ],
            aaSorting: [],
            responsive: false,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            searching: true,
            stateSave: true,
            ajax: {
                url: "{{ route('transactions.datatable') }}",
                type: "POST",
                data: function(d) {
                    d.status = $('input[name="status"]:checked').map(function() {
                        return $(this).val();
                    }).get();
                    d.startDate = $('input[name="startDate"]').val();
                    d.endDate = $('input[name="endDate"]').val();
                },
                complete: function() {
                },
            },
            columns: [
                {
                    data: 'client',
                    name: 'client',
                },
                {
                    data: 'booking_id',
                    name: 'booking_id',
                },
                {
                    data: 'payment_id',
                    name: 'payment_id',
                },
                {
                    data: 'gateway_fee',
                    name: 'gateway_fee',
                    className: 'bg-light-primary'
                },
                {
                    data: 'gateway_tax',
                    name: 'gateway_tax',
                    className: 'bg-light-primary'
                },
                {
                    data: 'gateway_charges',
                    name: 'gateway_charges',
                    className: 'bg-light-primary'
                },
                {
                    data: 'customer_paid',
                    name: 'customer_paid',
                    className: 'bg-light-success'
                },
                {
                    data: 'vendor_paid',
                    name: 'vendor_paid',
                    className: 'bg-light-success'
                },
                {
                    data: 'markup',
                    name: 'markup',
                    className: 'bg-light-success'
                },
                {
                    data: 'markup_tax',
                    name: 'markup_tax',
                    className: 'bg-light-success'
                },
                {
                    data: 'net_markup_profit',
                    name: 'net_markup_profit',
                    className: 'bg-light-success'
                },
                {
                    data: 'net_gst_input',
                    name: 'net_gst_input',
                    className: 'bg-light-success'
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'payment_date',
                    name: 'payment_date',
                },
            ],
        });
    </script>
    @endpush

</x-app-layout>