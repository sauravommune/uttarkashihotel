<div class="tab-pane px-7" id="paypal" role="tabpanel">
    <form id="paypal_form">
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-7 my-2">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-dark font-weight-bold mb-10">
                            PayPal Settings</h6>
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label for="paypaltype" class="col-lg-4 col-form-label">Type</label>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <select name="mode" class="form-control" id="paypaltype">
                                <option value="live" @if(($adminsetting->payment_gateways['paypal']['mode'] ?? 'sandbox')
                                    == 'live') selected @endif)>Live</option>
                                <option value="sandbox" @if(($adminsetting->payment_gateways['paypal']['mode'] ??
                                    'sandbox') == 'sandbox') selected @endif)>Sandbox</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Username</label>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="la la-user"></i></span></div>
                            <input type="text" name="username" class="form-control" placeholder="Username"
                                value="{{$adminsetting->payment_gateways['paypal']['username'] ??'' }}" />
                        </div>
                    </div>
                </div>
                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Password</label>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="la la-lock"></i></span></div>
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                value="{{$adminsetting->payment_gateways['paypal']['password'] ??'' }}" />
                        </div>
                    </div>
                </div>
                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">API Signature Key</label>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="la la-key"></i></span></div>
                            <input type="password" name="api_signature_key" class="form-control"
                                placeholder="API Signature Key"
                                value="{{$adminsetting->payment_gateways['paypal']['api_signature_key'] ??'' }}" />
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
                    <button type="submit" id="paypal_form_submit" class="btn btn-light-primary font-weight-bold">
                        Save</button></h6>
            </div>
        </div>
        <!--end::Row-->
    </form>
</div>