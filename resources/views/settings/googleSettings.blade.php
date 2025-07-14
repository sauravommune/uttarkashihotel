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
                       Google Login Settings
                    </h1>
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superAdmin.dashboard') }}" class="text-color-secondary text-hover-primary">Home</a>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('settings.index') }}" class="text-muted text-hover-success">Settings</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-color-secondary"> Google Login Settings </li>
                    </ul>
                </div>
                <!--end::Page title-->
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card border-0">
                <div class="card-body p-5">
                    <h3 class="mb-4"></h3>
                    <!--begin::Add Amenity Form-->
                    <form class="global-ajax-form" action="{{ route('save.google.login') }}" method="post" id="validate-form">
                        @csrf

                        <input type="hidden" name="id" value="{{$city->id??''}}">

                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label for="amenity_name" class="form-label">Client Id</label>
                                <input type="password" class="form-control" value="{{$googleLogin->client_id ?? ''}}" name="client_id" placeholder="Enter client id">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="amenity_name" class="form-label">Client Secrete</label>
                                <input type="password" class="form-control" value="{{$googleLogin->client_secrete ?? ''}}" name="client_secrete" placeholder="Enter client secrete">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
