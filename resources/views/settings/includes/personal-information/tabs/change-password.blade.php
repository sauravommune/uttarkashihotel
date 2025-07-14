<div class="tab-pane px-7" id="change_password_tab" role="tabpanel">
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-7">
                <form id="change_password_form">
                    <!--begin::Row-->
                    <div class="row">
                        <label class="col-3"></label>
                        <div class="col-9">
                            <h6 class="text-dark font-weight-bold mb-10">
                                Change Or Recover Your Password:</h6>
                        </div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label
                            class="col-form-label col-3 text-lg-right text-left">Current
                            Password</label>
                        <div class="col-9">
                            <input name="current_password"
                                placeholder="Current Password"
                                class="form-control form-control-lg form-control-solid mb-1"
                                type="password">

                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label
                            class="col-form-label col-3 text-lg-right text-left">New
                            Password</label>
                        <div class="col-9">
                            <input name="password"
                                class="form-control form-control-lg form-control-solid"
                                type="password" placeholder="New password">
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label
                            class="col-form-label col-3 text-lg-right text-left">Verify
                            Password</label>
                        <div class="col-9">
                            <input name="password_confirmation"
                                class="form-control form-control-lg form-control-solid"
                                type="password"
                                placeholder="Verify password">
                        </div>
                    </div>
                    <!--end::Group-->
                </form>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Body-->
    <!--begin::Footer-->
    <div class="card-footer pb-0">
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-7">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-9">
                        <a href="javascript:;"
                            id="change_password_form_submit"
                            onclick="UserSettings.change_password()"
                            class="btn btn-light-primary font-weight-bold">
                            Change Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Footer-->
</div>