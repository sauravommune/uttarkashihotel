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
                            {{ $title }}
                        </h1>
                        <!--end::Title-->
                        {{-- <h6 class="text-muted">Manage all your Company here!</h6> --}}
                        <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('superAdmin.dashboard') }}"
                                    class="text-color-secondary text-hover-primary">Home</a>
                            </li>
                            <!--end::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet text-color-secondary w-5px h-2px"></span>
                            </li>
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-color-secondary">{{ $title }}</li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Page title-->
                    </div>
                    <div>
                        @can('Hotel-Add')
                            <a href="{{ route('hotel.add') }}" class="btn btn-sm btn-flex btn-primary h-40px fs-7 fw-bold">
                                <i class="ki-duotone ki-plus"> </i>
                                <p class="mb-0 d-none d-sm-block">Add New Hotel</p>
                            </a>
                        @endcan
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
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-6 row-cols-lg-6 row-cols-xxl-6 mb-5">
                    <div class="col">
                        <input type="text" class="form-control form-control-sm" name="search" value="{{ $hotelSearch['searchTerm']??'' }}" placeholder="search hotel name"/>
                    </div>
                    {{-- @dd($hotelSearch['rating']) --}}
                    <div class="col mt-4 mt-sm-0">
                        <select class="form-select form-select-sm" name="rating">
                            <option value="">By Rating</option>
                            <option value="1" @selected(($hotelSearch['rating']??'') == 1)>1 Star</option>
                            <option value="2" @selected(($hotelSearch['rating']??'') == 2)>2 Star</option>
                            <option value="3" @selected(($hotelSearch['rating']??'') == 3)>3 Star</option>
                            <option value="4" @selected(($hotelSearch['rating']??'') == 4)>4 Star</option>
                            <option value="5" @selected(($hotelSearch['rating']??'') == 5)>5 Star</option>
                        </select>
                    </div>
                    
                    <div class="col  mt-4 mt-md-0">
                        <select class="form-select form-select-sm" name="city">
                       
                            <option value="">By City</option>
                            @foreach($cities as $city)
                            {{-- <option value="{{$city->id}}" @selected($hotelSearch['city']??'' == $city->id)>{{ucwords($city->name)}}</option> --}}
                            <option value="{{ $city->id }}" @selected(($hotelSearch['city'] ?? '') == $city->id)>{{ ucwords($city->name) }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col  mt-4 mt-md-0">
                        <select class="form-select form-select-sm" name="status">
                            <option value="">By Status</option>
                            <option value="active" @selected($hotelSearch['status']??'' == 'active')>Active</option>
                            <option value="inactive" @selected($hotelSearch['status']??'' == 'inactive')>Inactive</option>
                        </select>
                    </div>
                    <div class="col  mt-4 mt-md-0 col-sm-12">
                        <button class="btn btn-sm btn-primary d-flex justify-content-center text-nowrap w-100" id="filter-btn">
                            Apply Filter
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="ration_calculation">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Screener Ratios</h3>
                        <div class="btn btn-icon btn-sm btn-active-light-success ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body body_form">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script>
            $(document).ready(function(){
                setTimeout(function(){
                    const globalDatatable = window.LaravelDataTables["global-datatable"];

                    const filterData = () => {
                        var searchTerm = $('input[name=search]').val();
                        var rating = $('select[name=rating]').val();
                        var city = $('select[name=city]').val();
                        var status = $('select[name=status]').val();

                        globalDatatable.settings()[0].ajax.data = function(d) {
                            d.searchTerm = searchTerm;
                            d.rating = rating;
                            d.city = city;
                            d.status = status;
                        };
                        // Reload the table with the new filters
                        globalDatatable.ajax.reload();
                    }
                    $('body').on('click', '#filter-btn', function(){
                        filterData();
                    });

                    let searchTimeout;
                    $('body').on('input', 'input[name=search]', function () {
                        clearTimeout(searchTimeout);
                        searchTimeout = setTimeout(function () {
                            filterData();
                        }, 500);
                    });

                }, 1000)
            });
        </script>
    @endpush
</x-app-layout>
