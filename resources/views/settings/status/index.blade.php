<x-app-layout>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex justify-content-between align-items-center w-100">
                    <!--begin::Title-->

                    <div class="d-flex flex-column">
                        <h1 class="page-heading  justify-content-center text-dark fw-bold fs-3 m-0">Status
                            Master</h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ url('/') }}" class="text-muted text-hover-success">Home</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Status Master</li>
                            <!--end::Item-->
                        </ul>
                    </div>
                    <a class="btn btn-primary d-flex  justify-content-center align-content-center" href="{{ route('status.create') }}" data-bs-toggle="modal"
                        data-bs-target="#global_modal" data-bs-whatever="Create New Status">
                        <span class="material-symbols-outlined fs-1">
                            add
                        </span><p class="mb-0 d-none d-sm-block">
                            Create Status
                        </p>
                    </a>
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

            <!--begin::Tab content-->
            <h3 class="mt-4">Existing Status</h3>

                    {{ $dataTable->table() }}


        </div>
        <!--end::Content container-->
    </div>
   <!--end::Content-->
   @push('scripts')
   {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
</x-app-layout>
