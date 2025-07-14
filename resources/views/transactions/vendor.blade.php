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
                    <span class="text-color-secondary pt-1 fw-semibold fs-7">Total Paid</span>
                    <span class="fs-18 fw-bold text-color total-paid"></span>
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
                    <form action="javascript:void(0)" id="filter_lead_form">
                        <div class="row align-items-end">
                            <div class="col-md-8 col-lg-9 col-12">
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-4 row-cols-xl-4 align-items-end" id="download-option-data">
                                    <div class="col">
                                        <div class="fv-row fv-plugins-icon-container">
                                            <label class="form-label">Search</label>
                                            <div class="d-flex align-items-center position-relative">
                                                <span class="material-symbols-outlined fs-3 fs-3 position-absolute ms-3">
                                                    search
                                                </span>
                                                <input type="search" name="search" class="form-control form-control-sm ps-10" placeholder="Booking ID, Hotel, Payment ID...">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col mt-4 mt-sm-0">
                                        <div class="fv-row fv-plugins-icon-container">
                                            <label class="form-label">Hotel</label>
                                            <select class="form-select form-select-sm" name="hotel_id" data-control="select2" data-placeholder="Select a hotel">
                                                <option></option>
                                                @forelse ( $hotels as $hotel )
                                                    <option value="{{ $hotel->id }}">{{ $hotel->name }}, {{ $hotel->cityName?->name }}</option>
                                                @empty
                                                    <option value="">No Hotel Transactions Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col mt-4 mt-md-0">
                                        <div class="fv-row fv-plugins-icon-container">
                                            <label class="form-label">From Date</label>
                                            <input class="form-control form-control-sm flatpicker" placeholder="Pick a date" name="startDate" value="{{ Carbon\Carbon::now()->subDays(30)->format('Y-m-d') }}" />
                                        </div>
                                    </div>

                                    <div class="col mt-4 mt-md-0">
                                        <div class="fv-row fv-plugins-icon-container">
                                            <label class="form-label">To Date</label>
                                            <input class="form-control form-control-sm flatpicker" placeholder="Pick a date" name="endDate" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-3 col-12">
                                <button class="btn btn-sm btn-primary d-flex justify-content-center">
                                    <span class="material-symbols-outlined fs-1">filter_alt</span> Apply Filter
                                </button>
                            </div>
                        </div>
                    </form>
                    <div id="kt_app_content" class="app-content flex-column-fluid  mt-8">
                        <!--begin::Content container-->
                        <div id="kt_app_content_container" class="app-container container-fluid">
                            <div class="card border-0 shadow-none">
                                <!--begin::Card header-->
                                <div class="card-body p-0">
                                    {{ $dataTable->table() }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const getTotalPaid = () => {
            let searchGlobal    = $('input[name=search]').val();
            let hotel_id        = $('select[name=hotel_id]').val();
            let startDate       = $('input[name=startDate]').val();
            let endDate         = $('input[name=endDate]').val();

            $.post(`{{ route('transactions.vendor.total_paid') }}`, { searchGlobal, hotel_id, startDate, endDate }, function(res) {
                $('span.total-paid').html(res.totalPaid);
            });
        }
    </script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function() {
            const _reloadTable = () => {
                let _filter = $('li.nav-item.active .booking-btn').attr('data-type') || '';
                var globalDatatable = window.LaravelDataTables["global-datatable"];
                globalDatatable.settings()[0].ajax.data = function(d) {
                    d.searchGlobal  = $('input[name=search]').val();
                    d.hotel_id       = $('select[name=hotel_id]').val();
                    d.startDate     = $('input[name=startDate]').val();
                    d.endDate       = $('input[name=endDate]').val();
                };
                globalDatatable.ajax.reload(null, false);
            }

            let searchTimeout;
            $('body').on('input', 'input[name=search]', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    _reloadTable();
                }, 500);
            });

            $('body').on('submit', '#filter_lead_form', function(e) {
                e.preventDefault();
                _reloadTable();
            });
        });
    </script>
    @endpush

</x-app-layout>