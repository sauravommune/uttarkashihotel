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
                        Edit Role
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
                            <a href="{{ route('roles.index') }}"
                                class="text-color-secondary text-hover-primary">Roles List</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-color-secondary">Edit Role</li>
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
                <form action="{{ route('roles.update', $role->id) }}" method="POST" onsubmit="return confirm('Do you really want to submit the form?');">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8 col-12 pe-10">
                            <div class="d-flex flex-column gap-24">
                                <div class="form-group">
                                    <label for="role_name" class="mb-4 text-color-secondary">Role Name</label>
                                    <input type="text" id="role_name" name="name" class="form-control form-control-solid"
                                        placeholder="Enter Role Name" value="{{ old('name', $role->name) }}" required />
                                </div>

                                <div class="form-group">
                                    <label for="permissions" class="mb-4 text-color-secondary">Permissions</label>
                                    <div id="permissions" name="permissions[]" class="form-check-group">
                                        @foreach($permissions as $permission)
                                            <div class="form-check form-check-inline mr-2 mb-1">
                                                <input class="form-check-input" type="checkbox" id="permission{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}"
                                                    {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="permission{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
