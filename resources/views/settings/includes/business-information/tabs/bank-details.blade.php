<div class="tab-pane px-7" id="bank_details" role="tabpanel">
    <form id="bank_details_form">
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-7">
                    <!--begin::Row-->
                    <div class="row">
                        <label class="col-4"></label>
                        <div class="col-8">
                            <h6 class="text-dark font-weight-bold mb-10">
                                Bank Account Details</h6>
                        </div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-4 text-lg-right text-left">Bank
                            Account Name</label>
                        <div class="col-8">
                            <input name="account_name" class="form-control form-control-lg form-control-solid"
                                type="text" value="{{ Auth::user()->bank_details['account_name']  ?? ''}}">
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-4 text-lg-right text-left">Bank
                            Account Number</label>
                        <div class="col-8">
                            <input name="account_number" class="form-control form-control-lg form-control-solid"
                                type="text" value="{{ Auth::user()->bank_details['account_number']  ?? ''}}">
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-4 text-lg-right text-left">Account Type</label>
                        <div class="col-8">
                            <select name="account_type" class="form-control form-control-lg form-control-solid">
                                <option value="current" selected>
                                    Current
                                </option>
                                <option value="saving" selected>
                                    Savings
                                </option>
                            </select>
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-4 text-lg-right text-left">Bank
                            Name</label>
                        <div class="col-8">
                            <input name="bank_name" class="form-control form-control-lg form-control-solid" type="text"
                                value="{{ Auth::user()->bank_details['bank_name']  ?? ''}}">
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <div class="col-4 text-lg-right pr-0 text-left">
                            <i class="flaticon2-pen"></i>
                            <input class="col-10 cin_text border-0 col-form-label" name="neft_code_text" style="outline: none"
                                type="text" value="{{ Auth::user()->bank_details['neft_code_text'] ?? 'NEFT Code' }}">
                        </div>
                        <div class="col-8">
                            <input name="neft_code" class="form-control form-control-lg form-control-solid" type="text"
                                value="{{ Auth::user()->bank_details['neft_code']  ?? ''}}">
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-4 text-lg-right text-left">Swift
                            Code</label>
                        <div class="col-8">
                            <input name="swift_code" class="form-control form-control-lg form-control-solid" type="text"
                                value="{{ Auth::user()->bank_details['swift_code']  ?? ''}}">
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-4 text-lg-right text-left">MICR
                            Code</label>
                        <div class="col-8">
                            <input name="micr_code" class="form-control form-control-lg form-control-solid" type="text"
                                value="{{ Auth::user()->bank_details['micr_code']  ?? ''}}">
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-4 text-lg-right text-left">Your
                            Bank Branch's Address</label>
                        <div class="col-8">
                            <input name="branch_address" class="form-control form-control-lg form-control-solid"
                                type="text" value="{{ Auth::user()->bank_details['branch_address']  ?? ''}}">
                        </div>
                    </div>
                    <!--end::Group-->


                    <div class="form-group row align-items-center" style="display:none;">
                        <label class="col-form-label col-4 text-lg-right text-left">Show
                            on Invoice</label>
                        <div class="col-8">
                            <div class="checkbox-list bank-details-show">
                                <label class="checkbox">
                                    <input type="checkbox" name="show[account_name]" {{(Auth::user()->bank_details['show']['account_name'] ??
                                    true) ?
                                     'checked="checked"' : ''
                                    }} data-type='account_name'>Bank Account Name
                                    <span></span></label>
                                <label class="checkbox">
                                    <input type="checkbox" name="show[bank_name]" {{(Auth::user()->bank_details['show']['bank_name'] ??
                                    true) ?
                                     'checked="checked"' : ''
                                    }} data-type='bank_name'>Bank Name
                                    <span></span></label>
                                <label class="checkbox">
                                    <input type="checkbox" name="show[account_number]" {{(Auth::user()->bank_details['show']['account_number'] ??
                                        true) ?
                                         'checked="checked"' : ''
                                        }} data-type='account_number'>Bank Account
                                    Number
                                    <span></span></label>
                                <label class="checkbox">
                                    <input type="checkbox" name="show[account_type]" {{(Auth::user()->bank_details['show']['account_type'] ??
                                            true) ?
                                             'checked="checked"' : ''
                                            }} data-type='account_number'>Account Type
                                    <span></span></label>
                                <label class="checkbox">
                                    <input type="checkbox" name="show[neft_code]" {{(Auth::user()->bank_details['show']['neft_code'] ??
                                    true) ?
                                     'checked="checked"' : ''
                                    }} data-type='neft_code'>NEFT Code
                                    <span></span></label>
                                <label class="checkbox">
                                    <input type="checkbox" name="show[micr_code]" {{(Auth::user()->bank_details['show']['micr_code'] ??
                                    false) ?
                                     'checked="checked"' : ''
                                    }} data-type='micr_code'>MICR Code
                                    <span></span></label>
                                <label class="checkbox">
                                    <input type="checkbox" name="show[swift_code]" {{(Auth::user()->bank_details['show']['swift_code'] ??
                                    false) ?
                                     'checked="checked"' : ''
                                    }} data-type='swift_code'>SWIFT Code
                                    <span></span></label>
                            </div>
                        </div>
                    </div>



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
                        <div class="col-4"></div>
                        <div class="col-8">
                            <button type="submit" id="bank_details_form_submit"
                                class="btn btn-light-primary font-weight-bold">
                                Save Changes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Footer-->
    </form>
</div>