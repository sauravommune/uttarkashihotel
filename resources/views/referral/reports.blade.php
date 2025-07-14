<x-app-layout>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex justify-content-between align-items-center me-3 w-100">
                    <div>
                        <!--begin::Title-->
                        <h1 class="page-heading text-color fw-bold fs-18 m-0">
                            Reports
                        </h1>
                        <!--end::Title-->
                        {{-- <h6 class="text-muted">Manage all your Company here!</h6> --}}
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
                            <li class="breadcrumb-item text-color-secondary">Reports</li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Page title-->
                    </div>
                    <div>
                        <a href="{{ route('referral.register') }}" class="btn btn-sm btn-flex btn-primary h-40px fs-7 fw-bold">

                            <p class="mb-0 d-none d-sm-block">Add New Referrals</p>
                        </a>
                        <a href="{{ route('referral.payouts') }}" class="btn btn-sm btn-flex btn-primary h-40px fs-7 fw-bold">

                            <p class="mb-0 d-none d-sm-block">Payouts</p>
                        </a>
                        <a href="{{ route('referral.reports') }}" class="btn btn-sm btn-flex btn-primary h-40px fs-7 fw-bold">

                            <p class="mb-0 d-none d-sm-block">Reports</p>
                        </a>
                    </div>


                </div>

            </div>

        </div>

    </div>



    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card border-0">
                <!--begin::Card header-->
                <div class="row">


                    <div class="mb-2 fv-plugins-icon-container col-md-3 fv-row">
                        <label class="form-label" for="name">Select User<span class="text-danger">*</span></label>
                        <select class="form-control select" id="user" name="user" data-control="select2" data-placeholder="Select User">
                            <option value=""></option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <div class="mb-2 fv-plugins-icon-container col-md-3 fv-row">
                        <label class="form-label" for="name">From Date<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="from_date" name="from_date">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>

                    <div class="mb-2 fv-plugins-icon-container col-md-3 fv-row">
                        <label class="form-label" for="name">To Date<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="to_date" name="from_date">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>

                    <div class="fv-plugins-icon-container col-md-3 fv-row mt-5">
                        <label class="form-label"><br></label>
                        <input type="button" class="btn btn-primary search_btn" value="Search">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>


                </div>

                <div class="card-body p-0">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>


    </div>
    @push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $('body').on('click', '.search_btn', function(r) {
            r.preventDefault();
            let table = window.LaravelDataTables['referralreport-table'];
            table.settings()[0].ajax.data = function(d) {
                d.user = $('#user').val();
                d.from_date = $('#from_date').val();
                d.to_date = $('#to_date').val();
            }
            table.draw();
        })
        $('#from_date').flatpickr({
            onChange: function(selectedDates, dateStr, instance) {
                $('#to_date').flatpickr().set('minDate', selectedDates[0]);
            }
        });
        $('#to_date').flatpickr();

       

    </script>
    @endpush
</x-app-layout>
