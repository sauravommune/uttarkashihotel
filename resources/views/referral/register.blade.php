<x-app-layout>



    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card border-0">
                <!--begin::Card header-->

                <div class="card-body p-0">
                    <div class="section-lead section-general p-4">

                        <div class="d-flex justify-content-between card-section pb-3 align-items-center">
                            <div>
                                <h5 class="d-flex align-items-center mb-0">Create Referral</h5>
                            </div>
                            <div>
                                <button type="button" onclick="window.history.back()" class="btn btn-primary fw-semibold">Back</button>
                            </div>
                        </div>
                        <div class="card-section pt-2 border-bottom-0">
                            <form method="post" action="{{route('referral.store')}}" data-redirect-url="{{route('referral.index')}}" class="event-form pt-0 fv-plugins-bootstrap5 fv-plugins-framework row global-ajax-form" id="referralForm">
                                @csrf
                                <input type="hidden" name="id" value="{{$user?->id}}">
                                <div class="mb-2 fv-plugins-icon-container col-md-6 fv-row">
                                    <label class="form-label" for="name">Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{$user?->name}}" id="name" name="name" placeholder="Enter Your Name...">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="mb-2 fv-plugins-icon-container col-md-6 fv-row">
                                    <label class="form-label" for="name">Company Name</label>
                                    <input type="text" class="form-control" value="{{$user?->userDetails?->company_name}}" id="company_name" name="company_name" placeholder="Enter Company Name...">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="mb-2 fv-plugins-icon-container col-md-6 fv-row">
                                    <label class="form-label" for="email">Email Address<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" value="{{$user?->email}}" id="email" name="email" placeholder="Enter Your Email...">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="mb-2 fv-plugins-icon-container col-md-6 fv-row">
                                    <label class="form-label" for="phone">Phone Number<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control js-input-mobile" value="{{$user?->mobile}}" maxlength="10" id="phone" name="phone" placeholder="Enter Your phone...">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>


                                @if (empty($user->id))
                                <div class="mb-2 fv-plugins-icon-container col-md-6 fv-row">
                                    <label class="form-label" for="password">Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password...">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="mb-2 fv-plugins-icon-container col-md-6 fv-row">
                                    <label class="form-label" for="confirm_password">Confirm Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="confirm_password" name="password_confirmation" placeholder="Enter Confirm Password...">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                @endif
                                <div class="mb-2 fv-plugins-icon-container col-md-6 fv-row">
                                    <label class="form-label" for="phone">Referral Code<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control js-input-mobile" value="{{$user->referral_code ?? $referral_code}}" name="referral_code" disabled="true">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                    <input type="hidden" class="form-control js-input-mobile" value="{{$user->referral_code ?? $referral_code}}" name="referral_code">
                                </div>
                                <div class="mb-2 fv-plugins-icon-container col-md-6 fv-row">
                                    <label class="form-label" for="phone">Profit Share(%)<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control js-input-mobile" name="profit_share" placeholder="Enter Profit Share..." value="{{$user?->profit_share}}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div>
                                    <h5 class="d-flex align-items-center mt-3">Bank Details</h5>
                                    <hr>
                                </div>
                                <div class="mb-2 fv-plugins-icon-container col-md-6 fv-row">
                                    <label class="form-label" for="phone">Bank Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control js-input-mobile" name="bank_name" placeholder="Enter Bank Name..." value="{{$user?->bank_details ? $user?->bank_details['bank_name'] : null }}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="mb-2 fv-plugins-icon-container col-md-6 fv-row">
                                    <label class="form-label" for="phone">Account Number<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control js-input-mobile" name="account_number" placeholder="Enter Account Number..." value="{{$user?->bank_details ? $user?->bank_details['account_number'] : null }}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="mb-2 fv-plugins-icon-container col-md-6 fv-row">
                                    <label class="form-label" for="phone">Account Type<span class="text-danger">*</span></label>
                                    <select class="form-select" name="account_type" data-control="select2" data-placeholder="Select Account Type...">
                                        <option value="saving" @selected(($user?->bank_details ? $user?->bank_details['account_type'] : null)  == 'saving') >Savings</option>
                                        <option value="current" @selected(($user?->bank_details ? $user?->bank_details['account_type'] : null) == 'current')>Current</option>
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="mb-2 fv-plugins-icon-container col-md-6 fv-row">
                                    <label class="form-label" for="phone">IFSC Code<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control js-input-mobile" name="ifsc_code" placeholder="Enter IFSC Code..." value="{{$user?->bank_details ? $user?->bank_details['ifsc_code'] : null}}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="mb-2 fv-plugins-icon-container col-md-6 fv-row">
                                    <label class="form-label" for="phone">NEFT Code<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control js-input-mobile" name="neft_code" placeholder="Enter NEFT Code..." value="{{$user?->bank_details ? $user?->bank_details['neft_code'] : null}}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-12 d-flex gap-2 mt-4">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>




                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
    @push('scripts')


    @endpush
</x-app-layout>
