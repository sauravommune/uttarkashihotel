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
                       {{$title}}
                    </h1>
                    <!--end::Title-->
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superAdmin.dashboard') }}"
                                class="text-color-secondary text-hover-primary">Dashboard</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('roles.index') }}" class="text-color-secondary text-hover-primary">Roles
                                List</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-color-secondary">{{$title}}</li>
                        <!--end::Item-->
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
                <!--begin::Card header-->
                <form action="{{ route('roles.store') }}" method="POST" class="global-ajax-form" data-redirect-url ="{{route('roles.index')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 col-12 pe-10">
                            <div class="d-flex flex-column gap-24">
                                <div class="form-group">
                                    <label for="role_name" class="mb-4 text-color-secondary">Role Name</label>
                                    <input type="text" id="role_name" name="name" value="{{$role?->name }}"
                                        class="form-control form-control-solid" placeholder="Enter Role Name"
                                        @readonly(!empty($role?->name)) />
                                </div>
                                <input type="hidden" name="id" value="{{ $role?->id }}">
                                <div class="form-group">
                                    <label for="permissions" class="mb-5 text-color-secondary">Permissions</label>
                                    <div id="permissions" name="permissions[]" class="form-check-group">
                                        <div class="col-md-4">
                                            <label for="email-horizontal" class="fs-5 mb-5">
                                               Give All Permission
                                            </label>
                                        </div>
                                        <div class="row">


                                            <div class="col-sm-6 col-md-3 mb-4 col-12">
                                                <div class="form-check form-check-inline mr-2 mb-0 d-flex align-items-center gap-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="selectAll" name="select_all"
                                                        value="" @checked(!empty($rolePermission) && count($rolePermission) == (count($permission,1)-count($permission)))>
                                                    <label class="form-check-label"
                                                        for="permission">
                                                        Select All
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        @foreach ($permission as $key => $permissions)
                                        <div class="col-md-4">
                                            <label for="email-horizontal" class="fs-5 mb-5">
                                                {{ $key }} Permissions
                                            </label>
                                        </div>
                                        <div class="row">

                                            @foreach($permissions as $permission)
                                            <div class="col-sm-6 col-md-3 mb-4 col-12">
                                                <div class="form-check form-check-inline mr-2 mb-0 d-flex align-items-center gap-2">
                                                    <input class="form-check-input inner-select" type="checkbox"
                                                        id="permission{{ $permission->id }}" name="permission[]"
                                                        value="{{ $permission->id }}" @checked(in_array($permission?->id,$rolePermission))>
                                                    <label class="form-check-label"
                                                        for="permission{{ $permission->id }}">
                                                        {{ ucwords(str_replace('-',' ',$permission->name)) }}
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary">Save Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(function () {

                $("body").on("change", "#selectAll", function () {
               if ($(this).prop("checked")) {
                   $(".inner-select").prop("checked", true);
               } else {
                   $(".inner-select").prop("checked", false);
               }
            });
            $("body").on('change','.inner-select',function(){
                 ($('.inner-select').length == $('.inner-select:checked').length) ? $("#selectAll").prop("checked", true) : $("#selectAll").prop("checked", false);
            });
    });
        </script>
    @endpush
</x-app-layout>
