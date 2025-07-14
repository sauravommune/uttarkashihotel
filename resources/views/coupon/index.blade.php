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
                    {{-- <h6 class="text-muted">Manage all your Company here!</h6> --}}

                </div>
                <!--end::Page title-->

                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">


                    <a href="{{Route('coupons.create')}}"
                        class="btn btn-sm btn-flex btn-primary h-40px fs-7 fw-bold">
                        <i class="ki-duotone ki-plus"> </i>
                        <p class="mb-0 d-none d-sm-block">
                            Add Coupons
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
                    {{ $dataTable->table(['id' => 'global-datatable', 'class' => 'table table-md']) }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-app-layout>
