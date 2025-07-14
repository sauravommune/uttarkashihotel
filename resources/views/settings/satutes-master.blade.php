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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_stacked_1">
                        Create Status
                    </button>
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
            <h3 class="mt-4">Existing Statuses</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Background</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($statuses as $status)
                        <tr>
                            <td>{{ $status->name }}</td>
                            <td style="background-color: {{ $status->color }};">{{ $status->color }}</td>
                            <td style="background-color: {{ $status->background }};">{{ $status->background }}</td>
                            <td>
                                <!-- Edit Button -->
                                {{-- <a href="{{ route('statuses.edit', $status->id) }}" class="btn btn-sm btn-warning">Edit</a> --}}
                                <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_stacked_1" href="$status->id">
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('statuses.destroy', $status->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this status?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!--end::Tab content-->
        </div>
        <!--end::Content container-->
    </div>

    <div class="modal fade" tabindex="-1" id="kt_modal_stacked_1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Create Status</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('status.index') }}" method="POST">
                        @csrf
                        <div class="d-flex flex-column gap-8">
                            <div class="form-group">
                                <label for="name" class="mb-2">Status Name:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="color" class="mb-2">Color:</label>
                                <input type="color" name="color" id="color" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="background" class="mb-2">Background:</label>
                                <input type="color" name="background" id="background" class="form-control">
                            </div>
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Status</button>
                            </div>
                    </form>
                </div>
            </div>

            {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
        </div>
    </div>
    </div>
    <!--end::Content-->
</x-app-layout>
