<div class="tab-pane px-7" id="stripe" role="tabpanel">
    <form id="stripe_form">
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
                            <select name="mode" class="form-control" id="stripetype">
                                <option value="live" @if(($adminsetting->payment_gateways['stripe']['mode'] ?? 'test')
                                    == 'live') selected @endif>Live</option>
                                <option value="test" @if(($adminsetting->payment_gateways['stripe']['mode'] ?? 'test')
                                    == 'test') selected @endif>Test</option>
                            </select></div>
                    </div>
                </div>
                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Publishable Key</label>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="la la-key"></i></span></div>
                            <input type="password" name="publishable_key" class="form-control"
                                placeholder="Publishable Key" value="{{$adminsetting->payment_gateways['stripe']['publishable_key'] ??'' }}"/>
                            <span style="margin-left:20px; margin-top:10px"><a id="stripe_api_keys_link" href="https://dashboard.stripe.com/test/apikeys" target="_blank">
                            <div class="alert-icon"><i class="flaticon-questions-circular-button text-success icon-lg" data-toggle="tooltip" title="Click here to get your Publishable Key & Secret Key"></i></div></a></span>
                        </div>
                    </div>
                </div>
                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Secret Key</label>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="la la-key"></i></span></div>
                            <input type="password" name="secret_key" class="form-control" placeholder="Secret Key"
                            value="{{$adminsetting->payment_gateways['stripe']['secret_key'] ??'' }}" />
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
                    <button type="submit" id="stripe_form_submit" class="btn btn-light-primary font-weight-bold">
                        Save</a></h6>
            </div>
        </div>
        <!--end::Row-->
    </form>
</div>