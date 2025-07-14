<x-app-layout>
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
                            Booking Searches
                        </h1>
                    </div>
                    <div>
                        <div class="d-xl-flex mt-xl-0 mt-4">
                            <div>
                                <div class="fv-row fv-plugins-icon-container">
                                    <input class="form-control form-control-solid flatpicker" placeholder="Pick a check-in date" id="checkin_date" />
                                </div>
                            </div>
                            <div class="px-xl-5 px-0 py-xl-0 py-4">
                                <div class="fv-row fv-plugins-icon-container">
                                    <input class="form-control form-control-solid flatpicker" placeholder="Pick a check-out date" id="checkout_date" />
                                </div>
                            </div>
                            <div>
                                <div class="d-flex text-nowrap justify-content-center justify-content-md-start">
                                    <button class="btn btn-primary d-flex justify-content-center w-100" id="applyFilterButton">
                                        <span class="material-symbols-outlined fs-1">
                                            filter_alt
                                        </span>
                                        Apply Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2 mt-5 bg-unset">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="container-fluid d-flex align-items-stretch px-0">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="d-flex  justify-content-between align-items-center w-100">
                    <div class="card mt-2 w-100">
                        <div class="card-body text-color fw-medium text-sm">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script type="module">
        // Initialize Flatpickr
        flatpickr("#checkin_date", {
            dateFormat: "Y-m-d",
        });
        flatpickr("#checkout_date", {
            dateFormat: "Y-m-d",
        });

        // Apply filter functionality
        document.getElementById('applyFilterButton').addEventListener('click', function() {
            let checkinDate = document.getElementById('checkin_date').value;
            let checkoutDate = document.getElementById('checkout_date').value;

            // Use DataTable API to apply the filters
            let table = $('#searchleads-table').DataTable();

            table
                .column(5) // Assuming checkin_date is in the 5th column, adjust as needed
                .search(checkinDate ? checkinDate : '')
                .column(6) // Assuming checkout_date is in the 6th column, adjust as needed
                .search(checkoutDate ? checkoutDate : '')
                .draw();
        });
    </script>
@endpush
</x-app-layout>
