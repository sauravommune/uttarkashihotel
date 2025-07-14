<x-app-layout>
    @push('styles')
    <style>
    li.nav-item.active a {
        color: #fff;
    }
    </style>
    @endpush
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch ps-2">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="d-xl-flex justify-content-between align-items-center gap-1 w-100 me-3">
                    <!--begin::Title-->
                    <div>
                        <h1 class="page-heading text-color fw-bold fs-18 m-0">
                            {{ $title }}
                        </h1>
                    </div>
                </div>
                <div class="row w-100 describe-element mr-xl-4 mt-4">
                    <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-4">
                        <ul class="nav nav-pills list-group list-group-horizontal overflow-rounded" role="tablist">
                            <li class="nav-item list-group-item p-0 mb-0 mb-md-2 mb-lg-2 mb-xl-0 mb-3 {{ !in_array(auth()->user()->roles[0]->name, ['Super Admin', 'Admin']) ? 'active' : '' }}"
                                role="presentation" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="All Pending Leads">
                                <a class="booking-btn fw-medium px-2" type="button" role="tab" data-type="pending">ALL PENDING</a>
                            </li>
                            <li class="nav-item list-group-item p-0 mb-0 mb-md-2 mb-lg-2 mb-xl-0 mb-3"
                                role="presentation" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Hold At Hottel">
                                <a class="booking-btn fw-medium px-2" type="button" role="tab"
                                    data-type="hold">HOLD</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-6 col-md-12 col-lg-12 col-xl-2 py-xl-0">
                        <ul class="nav nav-pills list-group list-group-horizontal overflow-rounded" role="tablist">
                            <li class="nav-item list-group-item p-0 mb-0 mb-md-2 mb-lg-2 mb-xl-0 mb-3"
                                role="presentation" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Razorpay Authorized Status">
                                <a class="booking-btn fw-medium px-2" type="button" role="tab"
                                    data-type="authorized">AUTH</a>
                            </li>

                            <li class="nav-item list-group-item p-0 mb-0 mb-md-2 mb-lg-2 mb-xl-0 mb-3"
                                role="presentation" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Refunded">
                                <a class="booking-btn fw-medium px-2" type="button" role="tab"
                                    data-type="refunded">REF</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-3">
                        <ul class="nav nav-pills list-group list-group-horizontal overflow-rounded" role="tablist">
                            <li class="nav-item list-group-item p-0 mb-0 mb-md-2 mb-lg-2 mb-xl-0 mb-3 {{ in_array(auth()->user()->roles[0]->name, ['Super Admin', 'Admin']) ? 'active' : '' }}"
                                role="presentation" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="All Booking">
                                <a class="booking-btn fw-medium px-2" type="button" role="tab" data-type="all">ALL
                                    LEADS</a>
                            </li>

                            <li class="nav-item list-group-item p-0 mb-0 mb-md-2 mb-lg-2 mb-xl-0 mb-3"
                                role="presentation" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Booked Hotel">
                                <a class="booking-btn fw-medium px-2" type="button" role="tab"
                                    data-type="confirmed">BKG</a>
                            </li>
                            <li class="nav-item list-group-item p-0 mb-0 mb-md-2 mb-lg-2 mb-xl-0 mb-3"
                                role="presentation" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Abandoned Leads">
                                <a class="booking-btn fw-medium px-2" type="button" role="tab"
                                    data-type="abandoned">ABD</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1 py-xl-0 py-3">
                        <ul class="nav nav-pills list-group list-group-horizontal overflow-rounded" role="tablist">
                            <li class="nav-item list-group-item p-0 mb-0 mb-md-2 mb-lg-2 mb-xl-0" role="presentation"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Change Revival - Booking was generated and after that Customer asks for Changes/Rescheduling.">
                                <a class="booking-btn fw-medium px-2 bg-warning text-nowrap" type="button"
                                    data-type="is_change">CNG
                                    REV</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">
                        <ul class="nav nav-pills list-group list-group-horizontal overflow-rounded" role="tablist">

                            <li class="nav-item list-group-item p-0 mb-0 mb-md-2 mb-lg-2 mb-xl-0" role="presentation"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Chargeback From Razorpay">
                                <a class="booking-btn fw-medium px-2" type="button" disabled="">CHRG</a>
                            </li>
                            <li class="nav-item list-group-item p-0 mb-0 mb-md-2 mb-lg-2 mb-xl-0" role="presentation"
                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cancelled By Client">
                                <a class="booking-btn fw-medium px-2" type="button" data-type="cancelled_by_client">CBC</a>
                            </li>
                            <li class="nav-item list-group-item p-0 mb-0 mb-md-2 mb-lg-2 mb-xl-0" role="presentation"
                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cancelled By Vendor">
                                <a class="booking-btn fw-medium px-2" type="button" data-type="cancelled_by_vendor">CBV</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <form action="javascript:void(0)" id="filter_lead_form">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-6 px-0 py-5">
                                <div class="col">
                                    <input type="search" class="form-control form-control-sm" name="search"
                                        placeholder="Search Customer, Hotel, Booking ID" />
                                </div>
                                <div class="col mt-4 mt-sm-0">
                                    <select class="form-select form-select-sm" name="city_id" data-control="select2">
                                        <option value="">All Cities</option>
                                        @forelse ( $cities as $city )
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                </div>
                                <div class="col mt-4 mt-lg-0">
                                    <input class="form-control form-control-sm flatpicker" name="bookingDate"
                                        placeholder="Booking Date" value="" />
                                </div>
                                <div class="col mt-4 mt-xl-0">
                                    <input class="form-control form-control-sm flatpicker" name="startDate"
                                        placeholder="From date"
                                        value="{{ Carbon\Carbon::now()->subDays(30)->format('Y-m-d') }}" />
                                </div>
                                <div class="col mt-4 mt-xl-0">
                                    <input class="form-control form-control-sm flatpicker" name="endDate"
                                        placeholder="To date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" />
                                </div>
                                <div class="col mt-4 mt-xl-0">
                                    <button type="submit"
                                        class="btn btn-sm btn-primary d-flex justify-content-center w-100">
                                        <span class="material-symbols-outlined fs-3">filter_alt</span>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="kt_app_content" class="app-content flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="section-32 px-3">
                <!--begin::Content container-->
                <p class="bg-secondary p-2 current-leads"></p>
                <div class="d-flex align-items-center flex-wrap gap-4 gap-md-12 mb-3">
                    <div class="mb-xl-0 mb-md-3 d-flex align-items-center gap-3">
                        <i class="bi bi-diamond-fill text-light-success me-2 mt-1"></i>
                        <span class="mb-0 fs-7">Completed</span>
                    </div>
                    <div class="mb-xl-0 mb-md-3 d-flex align-items-center gap-3">
                        <i class="bi bi-diamond-fill text-light-warning me-2 mt-1"></i>
                        <span class="mb-0 fs-7">Pending</span>
                    </div>
                    <div class="mb-xl-0 mb-md-3 d-flex align-items-center gap-3">
                        <i class="bi bi-diamond-fill text-light-danger me-2 mt-1"></i>
                        <span class="mb-0 fs-7">Cancelled</span>
                    </div>
                    <div class="mb-xl-0 mb-md-3 d-flex align-items-center gap-3">
                        <i class="bi bi-diamond-fill text-danger me-2 mt-1"></i>
                        <span class="mb-0 fs-7">Hold / Blocked</span>
                    </div>
                </div>
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const getCurrentAssignedLeads = () => {
                $.get("{{ route('leads.current.assigned') }}", function(data) {
                    if (data) {
                        $('.current-leads').html(data.currentAssignedLeads);
                    }
                })
            }
        </script>
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script>
            "use strict";
            $(document).ready(function() {

                const _reloadTable = () => {
                    let _filter = $('li.nav-item.active .booking-btn').attr('data-type') || '';
                    var globalDatatable = window.LaravelDataTables["global-datatable"];
                    globalDatatable.settings()[0].ajax.data = function(d) {
                        d.filterTerm    = _filter;
                        d.searchGlobal  = $('input[name=search]').val();
                        d.startDate     = $('input[name=startDate]').val();
                        d.endDate       = $('input[name=endDate]').val();
                        d.bookingDate   = $('input[name=bookingDate]').val();
                        d.city_id       = $('select[name=city_id]').val();
                    };
                    globalDatatable.ajax.reload(null, false);
                }
                $('body').on('click', 'li .booking-btn', function(e) {
                    e.preventDefault();
                    let _this = $(this);
                    if (!_this.attr('disabled')) {
                        $('li.nav-item').removeClass('active');
                        _this.parent('li.nav-item').addClass('active');
                        _reloadTable()
                    }
                });

                setInterval(function(){
                    _reloadTable();
                }, 1000*60);

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

                $('body').on('click', 'a.lock-unlock', function(e){
                    e.preventDefault();
                    let _this = $(this);
                    let _action = _this.attr('href');
                    $.get(_action, function(data) {
                        globalToast({ message: data.message, icon: data.status==200 ? 'success' : 'error' });
                        setTimeout(() => {
                            _reloadTable();
                        }, 500);
                    })
                });
            })

            // Open the offcanvas modal
            function openOffcanvas(triggerElement) {
                const offcanvas = document.getElementById('offcanvas');
                const overlay = document.getElementById('overlay');
                console.log(offcanvas, overlay);
                if (!offcanvas || !overlay) return;

                const $trigger = $(triggerElement);
                const url = $trigger.data('url');
                const offcanvasTitle = $trigger.attr('title') || $trigger.attr('offcanvas-title');

                offcanvas.classList.add('open');  // Show the offcanvas
                overlay.style.display = 'block';  // Show the overlay

                $('#offcanvas-title').text(offcanvasTitle || ''); // Set the title
                $('#offcanvas-content').html(`
                    <center>
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </center>
                `); // Show loading spinner

                // Fetch content via AJAX
                $.ajax({
                    url: url,
                    success: function (response) {
                        $('#offcanvas-content').html(response); // Populate with response
                    },
                    error: function () {
                        $('#offcanvas-content').html('<p class="text-danger">Failed to load content. Please try again.</p>');
                    }
                });
            }

            // Close the offcanvas modal
            function closeOffcanvas() {
                const offcanvas = document.getElementById('offcanvas');
                const overlay = document.getElementById('overlay');

                if (!offcanvas || !overlay) return;

                offcanvas.classList.remove('open');  // Hide the offcanvas
                overlay.style.display = 'none';      // Hide the overlay

                // Reset title and content
                $('#offcanvas-title').text('');
                $('#offcanvas-content').html(''); // Clear content
            }

        </script>
    @endpush
</x-app-layout>
<x-off-canvas />