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
                            Referrals
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
                            <li class="breadcrumb-item text-color-secondary">Referrals</li>
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
