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
                        {{ $data['title'] }}
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
                        <li class="breadcrumb-item text-color-secondary">  {{ $data['title'] }}</li>
                        <!--end::Item-->
                    </ul>
                </div>
                <!--end::Page title-->

                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">

                    <a href="{{ route('roles.create') }}"
                        class="btn btn-sm btn-flex btn-primary h-40px fs-7 fw-bold">
                        <i class="ki-duotone ki-plus"> </i> Add Role
                    </a>
                    @can('User-View')    
                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-flex btn-primary h-40px fs-7 fw-bold">
                            <i class="ki-duotone ki-plus"> </i>User Management
                        </a>
                    @endcan
                </div>
                <!--end::Actions-->

            </div>
        </div>
    </div>


    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card border-0">
                <!--begin::Card header-->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        {{ $dataTable->table() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
</x-app-layout>
