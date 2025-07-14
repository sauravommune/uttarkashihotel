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
                    <a href="{{ route('users.create') }}"
                        class="btn btn-sm btn-flex btn-primary h-40px fs-7 fw-bold">
                        <i class="ki-duotone ki-plus"> </i>Add User
                    </a>
                    @can('Role-view')    
                        <a href="{{ route('roles.index') }}"
                            class="btn btn-sm btn-flex btn-primary h-40px fs-7 fw-bold">
                            <i class="ki-duotone ki-plus"> </i>Role Management
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
                <form action="javascript:void(0)" id="filter-user-form">
                    <div class="row">
                        <div class="col-md-2">
                            <select class="form-select form-select-sm" name="role">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select form-select-sm" name="status">
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <!--begin::Card header-->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="ration_calculation">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Screener Ratios</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-success ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body body_form">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script>
            
            const _reloadTable = () => {
                var globalDatatable = window.LaravelDataTables["global-datatable"];
                globalDatatable.settings()[0].ajax.data = function(d) {
                    d.role      = $('select[name=role]').val();
                    d.status    = $('select[name=status]').val();
                };
                globalDatatable.ajax.reload(null, false);
            }

            $(document).ready(function() {
                $('body').on('change', '#user-table .status-change', function() {
                    var id = $(this).data('id');
                    var status = $(this).is(':checked') ? 1 : 0;
                    $.ajax({
                        url: '{{ route("users.updateStatus") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                            status: status
                        },
                        success: function(response) {
                            if (response.success) {
                                "use strict";
                            Swal.fire({
                                text: "User status updated",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Okay!",
                                customClass: {
                                    confirmButton: "btn btn-success"
                                }
                            });
                                $('#user-table').DataTable().ajax.reload();
                            } else {
                                alert('Failed to update status.');
                            }
                        },
                        error: function() {
                            alert('An error occurred.');
                        }
                    });
                });

                $('body').on('submit', '#filter-user-form', function(e) {
                    e.preventDefault();
                    _reloadTable();
                });
            });
        </script>

    @endpush
</x-app-layout>
