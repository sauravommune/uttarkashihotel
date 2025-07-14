<div class="tab-pane show active px-7" id="payment_gateways_tab" role="tabpanel">
    <form id="payment_settings_form">
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-7 my-2">
                <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-12 col-form-label">{{ "Which Payment Gateway Would You Like To Use?"}}</label>
                        <div class="col-12 col-form-label">
                            <div class="checkbox-list">
                                <label class="checkbox">
                                    <input type="checkbox" name="paypal" 
                                    @if($adminsetting->payment_gateways['paypal']['enabled'] ?? false)
                                        checked
                                    @endif
                                    /> PayPal
                                    <span></span>
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="razorpay"
                                    @if($adminsetting->payment_gateways['razorpay']['enabled'] ?? false)
                                        checked
                                    @endif
                                    /> RazorPay (India)
                                    <span></span>
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="stripe" 
                                    @if($adminsetting->payment_gateways['stripe']['enabled'] ?? false)
                                        checked
                                    @endif
                                    /> Stripe
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
            </div>
            <!--end::Group-->
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">
                <h6 class="text-dark font-weight-bold mb-10">
                    <button type="submit" id="payment_settings_form_submit"
                        class="btn btn-light-primary font-weight-bold">
                        Save</a></h6>
            </div>
        </div>
        <!--end::Row-->
    </form>
</div>