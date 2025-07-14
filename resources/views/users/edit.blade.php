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
                            <a href="{{ route('users.index') }}" class="text-color-secondary text-hover-primary">Users
                                List</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-color-secondary">Edit User</li>
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
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-4 row-cols-xl-5">
                                <!-- User Information -->
                                <div class="col">
                                    <div class="form-group">
                                        <label for="user_name" class="mb-4 text-color-secondary">User Name</label>
                                        <input type="text" id="user_name" name="name"
                                            class="form-control form-control-solid"
                                            value="{{ old('name', $user->name) }}" placeholder="Enter User Name"
                                            required />
                                    </div>
                                </div>

                                <div class="col mt-4 mt-sm-0">
                                    <div class="form-group">
                                        <label for="email" class="mb-4 text-color-secondary">Email Address</label>
                                        <input type="email" id="email" name="email"
                                            class="form-control form-control-solid"
                                            value="{{ old('email', $user->email) }}" placeholder="Enter Email Address"
                                            required />
                                    </div>
                                </div>

                                <div class="col mt-4 mt-md-0">
                                    <div class="form-group">
                                        <label for="password" class="mb-4 text-color-secondary">Password</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-solid" placeholder="Enter Password" />
                                        <small class="text-muted">Leave blank to keep the current password.</small>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 mt-8">
                                <div class="form-group">
                                    <label for="roles" class="mb-0 text-color-secondary">Roles</label>
                                    <div id="roles" class="form-check-group">
                                        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-4 row-cols-xl-6">
                                            @foreach($roles as $role)
                                            <div class="col mt-4">
                                            <div class="form-check form-check-inline mr-2 mb-1">
                                                <input class="form-check-input" type="checkbox" id="role{{ $role->id }}"
                                                    name="roles[]" value="{{ $role->id }}"
                                                    {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="role{{ $role->id }}">
                                                    {{ $role->name }}
                                                </label>
                                            </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>