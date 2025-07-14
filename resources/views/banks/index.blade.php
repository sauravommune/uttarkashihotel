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
                        Banks</h1>
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
                        <li class="breadcrumb-item text-color-secondary">All Banks List</li>
                        <!--end::Item-->
                    </ul>
                </div>
                <!--end::Page title-->

                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <button
                        class="btn btn-sm btn-flex btn-outline btn-color-gray-700 btn-active-color-success bg-body h-40px fs-7 fw-bold"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="ki-solid ki-dots-square-vertical">
                        </i>
                        <p class="mb-0 d-none d-sm-block">
                            Export
                        </p>
                    </button>

                    <a href="{{ route('banks.add') }}" data-bs-toggle="modal" data-bs-target="#global_modal"
                        data-bs-whatever="Add New Bank" class="btn btn-sm btn-flex btn-primary h-40px fs-7 fw-bold">
                        <i class="ki-duotone ki-plus"> </i>
                        <p class="mb-0 d-none d-sm-block">
                            New Bank
                        </p>
                    </a>
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
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-app-layout>
