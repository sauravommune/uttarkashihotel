<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Manager</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="">
                            <label for="firstName" class="required form-label mb-3">First Name</label>
                            <input type="text" id="firstName" class="form-control form-control-solid" placeholder="Enter first name" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="">
                            <label for="lastName" class="required form-label mb-3">Last Name</label>
                            <input type="text" id="lastName" class="form-control form-control-solid" placeholder="Enter last name" />
                        </div>
                    </div>

                    <div class="col-md-12 mt-8">
                        <div class="">
                            <label for="email" class="required form-label mb-3">Email</label>
                            <input type="email" id="email" class="form-control form-control-solid" placeholder="Enter email address" />
                        </div>
                    </div>

                    <div class="col-md-12 mt-8">
                        <div class="">
                            <label for="role" class="required form-label mb-3">Select Role</label>
                            <select id="role" class="form-select form-select-solid" data-control="select2"
                                data-dropdown-parent="#kt_modal_1" data-placeholder="Select Role"
                                data-allow-clear="true">
                                <option></option>
                                <option value="manager">Manager</option>
                                <option value="admin">Admin</option>
                                <option value="super_admin">Super Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-10">
                        <button type="button" class="btn btn-primary w-100">Save changes</button>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.querySelector('#kt_modal_1 .btn[data-bs-dismiss="modal"]').addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('kt_modal_1'));
            modal.hide();
        });
    </script>
@endpush
