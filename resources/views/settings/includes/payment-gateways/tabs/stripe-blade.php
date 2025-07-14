<div class="tab-pane px-7" id="stripe" role="tabpanel">
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-2"></div>
        <div class="col-xl-7 my-2">
            <!--begin::Row-->
            <div class="row">
                <div class="col-12">
                    <h6 class="text-dark font-weight-bold mb-10">
                        Stripe Settings</h6>
                </div>
            </div>
            <!--end::Row-->
            <!--begin::Group-->
            <div class="form-group row">
                <label for="stripetype" class="col-lg-4 col-form-label">Type</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <select class="form-control" id="stripetype">
                            <option>Disable</option>
                            <option>Live</option>
                            <option>Test</option>
                        </select>
                    </div>
                </div>
            </div>
            <!--end::Group-->
            <!--begin::Group-->
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Publishable Key</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-key"></i></span></div>
                        <input type="password" class="form-control" placeholder="Publishable Key" />
                    </div>
                </div>
            </div>
            <!--end::Group-->
            <!--begin::Group-->
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Secret Key</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-key"></i></span></div>
                        <input type="password" class="form-control" placeholder="Secret Key" />
                    </div>
                </div>
            </div>
            <!--end::Group-->

        </div>
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row">
        <div class="col-2"></div>
        <div class="col-10">
            <h6 class="text-dark font-weight-bold mb-10">
                <a href="javascript:;" id="change_password_form_submit" onclick="UserSettings.change_password()" class="btn btn-light-primary font-weight-bold">
                    Save</a></h6>
        </div>
    </div>
    <!--end::Row-->
</div>