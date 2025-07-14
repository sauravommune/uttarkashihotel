<div class="tab-pane px-7" id="razorpay" role="tabpanel">
    <form id="razorpay_form">
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-7 my-2">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-9">
                        <h6 class="text-dark font-weight-bold mb-10">
                            RazorPay Settings</h6>
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Type</label>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <select name="mode" class="form-control">
                                <option value="live" @if(($adminsetting->payment_gateways['razorpay']['mode'] ?? 'test')
                                    == 'live') selected @endif)>Live</option>
                                <option value="test" @if(($adminsetting->payment_gateways['razorpay']['mode'] ?? 'test')
                                    == 'test') selected @endif>Test</option>
                            </select>
                        </div>
                    </div>

                </div>
                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Key ID</label>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="la la-key"></i></span></div>
                            <input name="key_id" type="password" class="form-control" placeholder="Key ID"
                            value="{{$adminsetting->payment_gateways['razorpay']['key_id'] ??'' }}" />
                            <span style="margin-left:20px; margin-top:10px"><a href="https://dashboard.razorpay.com/app/keys" target="_blank">
                            <div class="alert-icon"><i class="flaticon-questions-circular-button text-success icon-lg" data-toggle="tooltip" title="Click here to get your Key ID & Key Secret"></i></div></a></span>
                        </div>
                        </div>
                </div>
                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Key Secret</label>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="la la-key"></i></span></div>
                            <input name="key_secret" type="password" class="form-control" placeholder="Key Secret"
                            value="value="{{$adminsetting->payment_gateways['razorpay']['key_secret'] ??'' }}"" />
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
                    <button type="submit" id="razorpay_form_submit"
                        class="btn btn-light-primary font-weight-bold">
                        Save</a></h6>
            </div>
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row">
        <div class="col-2"></div>
            <div class="col-10">
            <div class="col-12 alert alert-custom alert-outline-primary fade show mb-5" role="alert">
                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                <div class="alert-text"><a href="https://rzp.io/i/DKax4BQ" target="_blank">Don't have a RazorPay account? Click here to open a new account.</a></div>
            </div>
            </div>
        </div>
        <!--end::Row-->
    </form>
</div>