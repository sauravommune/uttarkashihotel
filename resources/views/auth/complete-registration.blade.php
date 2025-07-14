@extends('layouts.app')

@section('page_styles')
<link href="/assets/css/login.css?v=7.0.3" rel="stylesheet" type="text/css" />
@endsection

@section('main')
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            @include('layouts.includes.top-menu')
            <!--begin::Main-->
            <div class="d-flex flex-column flex-root">
                <!--begin::Login-->
                <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid wizard" id="kt_login">
                    <!--begin::Aside-->
                    <div class="login-aside d-flex flex-column flex-row-auto">
                        <!--begin::Aside Top-->
                        <div class="d-flex flex-column-auto flex-column pt-5 px-20">
                            <!--begin: Wizard Nav-->
                            <div class="wizard-nav pt-5 pt-lg-10">
                                <!--begin::Wizard Steps-->
                                <div class="wizard-steps">
                                    <!--begin::Wizard Step 1 Nav-->
                                    <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                        <div class="wizard-wrapper">
                                            <div class="wizard-icon">
                                                <i class="wizard-check ki ki-check"></i>
                                                <span class="wizard-number">1</span>
                                            </div>
                                            <div class="wizard-label">
                                                <h3 class="wizard-title">Account Settings</h3>
                                                <div class="wizard-desc">Setup Your Account Details</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Wizard Step 1 Nav-->
                                    <!--begin::Wizard Step 2 Nav-->
                                    <div class="wizard-step" data-wizard-type="step">
                                        <div class="wizard-wrapper">
                                            <div class="wizard-icon">
                                                <i class="wizard-check ki ki-check"></i>
                                                <span class="wizard-number">2</span>
                                            </div>
                                            <div class="wizard-label">
                                                <h3 class="wizard-title">Address Details</h3>
                                                <div class="wizard-desc">Setup Business Address</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Wizard Step 2 Nav-->
                                    <!--begin::Wizard Step 3 Nav-->
                                    <div class="wizard-step" data-wizard-type="step">
                                        <div class="wizard-wrapper">
                                            <div class="wizard-icon">
                                                <i class="wizard-check ki ki-check"></i>
                                                <span class="wizard-number">3</span>
                                            </div>
                                            <div class="wizard-label">
                                                <h3 class="wizard-title">Business Info</h3>
                                                <div class="wizard-desc">Business info to serve you better.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Wizard Step 3 Nav-->
                                    <!--begin::Wizard Step 4 Nav-->
                                    <div class="wizard-step" data-wizard-type="step">
                                        <div class="wizard-wrapper">
                                            <div class="wizard-icon">
                                                <i class="wizard-check ki ki-check"></i>
                                                <span class="wizard-number">4</span>
                                            </div>
                                            <div class="wizard-label">
                                                <h3 class="wizard-title">Completed!</h3>
                                                <div class="wizard-desc">Review and Submit</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Wizard Step 4 Nav-->
                                </div>
                                <!--end::Wizard Steps-->
                            </div>
                            <!--end: Wizard Nav-->
                        </div>
                        <!--end::Aside Top-->
                    </div>
                    <!--begin::Aside-->
                    <!--begin::Content-->
                    <div class="login-content flex-column-fluid d-flex flex-column p-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-row-fluid flex-center">
                            <!--begin::Signin-->
                            <div class="login-form login-form-signup">
                                <!--begin::Form-->
                                <form class="form complete_registration_form" novalidate="novalidate"
                                    id="kt_login_signup_form" enctype="multipart/form-data">
                                    <!--begin: Wizard Step 1-->
                                    @csrf
                                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                        <!--If email verification is pending (signed up using email ID-->
                                        @if(!Auth::user()->hasVerifiedEmail())
                                        <div class="alert alert-custom alert-warning" role="alert">
                                            <div class="alert-icon">
                                                <i class="flaticon-warning"></i>
                                            </div>
                                            <div class="alert-text">Your email is still unverified. Check your inbox and SPAM folder and verify now! 
                                                <br />
                                                <a id="resend-verification-link-btn" href="javascript:;"
                                                    style="color:#fff;text-underline"><u>Click here</u> to resend the verification link.</a>
                                                    If you are still not getting email, please drop an email from your email to <a class="text-white" href="mailto:support@unlistedzone.live">support@unlistedzone.live</a> and our team will verify it for you.
                                            </div>
                                        </div>
                                        @endif
                                        @if(Auth::user()->hasVerifiedEmail())
                                        @if(Auth::user()->registration_complete && !Auth::user()->hasAdminVerified())
                                        <div class="alert alert-custom alert-warning" role="alert">
                                            <div class="alert-icon">
                                                <i class="flaticon-warning"></i>
                                            </div>
                                            <div class="alert-text">Your Account is still unverified By admin.
                                            </div>
                                        </div>
                                        @endif
                                        @endif

                                        <!--begin::Title-->
                                        <div class="pb-10 pb-lg-15">
                                            <h3 class="font-weight-bolder text-dark display5">Complete Your
                                                Registration</h3>
                                            <div class="text-muted font-weight-bold font-size-h4">It takes less than
                                                2 minutes to complete the registration. {{ "Let's start!"}}
                                            </div>
                                        </div>
                                        <!--begin::Title-->
                                        <!--begin::Form Group-->

                                        <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Type of
                                                Investor</label>

                                            <div id="role">

                                                <select name="role" id="role"
                                                    class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6">
                                                    @foreach(config('data.roles')
                                                    as $key => $role)
                                                    @if(isset(Auth::user()->role) && Auth::user()->role === $key)
                                                    <option value="{{ $key }}" selected>
                                                        {{ $role }}
                                                    </option>
                                                    @else
                                                    <option value="{{ $key }}">
                                                        {{ $role }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Your Aadhar
                                                Number</label>
                                            <input type="text" required
                                                class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6"
                                                name="aadhar_number" placeholder="125698569854"
                                                value="{{ Auth::user()->aadhar_number ?? '' }}" />
                                        </div>

                                        <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Your Mobile
                                                Number</label>
                                            <input type="tel" required
                                                class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6"
                                                name="phone" placeholder="+91-9123456780"
                                                value="{{ Auth::user()->phone ?? '' }}" />
                                        </div>

                                        <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Your PAN Card
                                                Number</label>
                                            <input type="text" required
                                                class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6"
                                                name="pan_number" placeholder="AFZPK7190K"
                                                value="{{ Auth::user()->pan_number ?? '' }}" />
                                        </div>

                                        <div class="form-group">
                                            <label class="font-size-h6 font-weight-bolder text-dark">Reference</label>



                                            <select name="reference" id="reference"
                                                class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6">
                                                @foreach(config('data.reference')
                                                as $key => $reference)
                                                @if(isset(Auth::user()->reference) && Auth::user()->reference === $key)
                                                <option value="{{ $key }}" selected>
                                                    {{ $reference }}
                                                </option>
                                                @else
                                                <option value="{{ $key }}">
                                                    {{ $reference }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>


                                        </div>

                                        <!--end::Form    Group-->
                                    </div>
                                    <!--end: Wizard Step 1-->
                                    <!--begin: Wizard Step 2-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <!--begin::Title-->
                                        <div class="pt-lg-0 pt-5 pb-15">
                                            <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">
                                                Address Details</h3>
                                        </div>
                                        <!--begin::Title-->
                                        <!--begin::Row-->
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label class="font-size-h6 font-weight-bolder text-dark">Address
                                                        Line 1</label>
                                                    <input type="text"
                                                        class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6"
                                                        name="address_1" placeholder="Address Line 1"
                                                        value="{{ Auth::user()->address_1 ?? '' }}" />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label class="font-size-h6 font-weight-bolder text-dark">Address
                                                        Line 2</label>
                                                    <input type="text"
                                                        class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6"
                                                        name="address_2" placeholder="Address Line 2"
                                                        value="{{ Auth::user()->address_2 ?? '' }}" />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label
                                                        class="font-size-h6 font-weight-bolder text-dark">City</label>
                                                    <input type="text"
                                                        class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6"
                                                        name="city" placeholder="City"
                                                        value="{{ Auth::user()->city ?? '' }}" />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label class="font-size-h6 font-weight-bolder text-dark">Post
                                                        code</label>
                                                    <input type="text"
                                                        class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6"
                                                        name="postcode" placeholder="Postcode"
                                                        value="{{ Auth::user()->postcode ?? '' }}" />
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <!--begin::Select-->
                                                <div class="form-group">
                                                    <label
                                                        class="font-size-h6 font-weight-bolder text-dark">Country</label>

                                                    <select name="country" id="country"
                                                        class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6">
                                                        @foreach($countries as $key => $country)
                                                        @if(Auth::user()->country == $key)
                                                        <option value="{{ $key }}" selected>{{ $country }}
                                                        </option>
                                                        @else
                                                        <option value="{{ $key }}">{{ $country }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label
                                                        class="font-size-h6 font-weight-bolder text-dark">State</label>

                                                    <div id="state_div">
                                                        @if(isset(config('data.states')[Auth::user()->country]))
                                                        <select name="state" id="state"
                                                            class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6">
                                                            @foreach(config('data.states')[Auth::user()->country]
                                                            as $state)
                                                            @if(isset(Auth::user()->state) && Auth::user()->state ===
                                                            $state)
                                                            <option value="{{ $state }}" selected>
                                                                {{ $state }}
                                                            </option>
                                                            @else
                                                            <option value="{{ $state }}">
                                                                {{ $state }}
                                                            </option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                        @else
                                                        <input type="text"
                                                            class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6"
                                                            name="state" placeholder="State"
                                                            value="{{ Auth::user()->state??'' }}" />
                                                        @endif
                                                    </div>
                                                    <span class="form-text text-muted">Please enter your
                                                        State.</span>
                                                </div>
                                                <!--end::Input-->
                                            </div>

                                        </div>
                                        <!--end::Row-->
                                    </div>

                                    <div class="pb-5" data-wizard-type="step-content">

                                        <div class="pt-lg-0 pt-5 pb-15">
                                            <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">
                                                Business Info</h3>
                                            <div class="text-muted font-weight-bold font-size-h4">Need This To Serve
                                                You Better.</div>
                                        </div>


                                        <div class="form-group row business_name_div">

                                            <label class="font-size-h6 font-weight-bolder text-dark">
                                                <span class="role_display"></span> Name</label>

                                            <input type="text" required
                                                class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6"
                                                name="business_name" placeholder="UnlistedZone"
                                                value="{{ Auth::user()->business_name ?? '' }}" />
                                        </div>
                                        <div class="form-group row">


                                            <label class="font-size-h6 font-weight-bolder text-dark">
                                                Upload Scanned Pan Card Copy
                                            </label>




                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="user_pancard_file"
                                                    name="user_pancard_file">
                                                <label class="custom-file-label" for="customFile">
                                                </label>
                                            </div>
                                            <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>

                                        </div>

                                        @if(isset(Auth::user()->user_pancard_file))
                                        <div class="form-group row user_pancard_file_div">
                                            <label>
                                                File
                                            </label>
                                            <div></div>

                                            <div class="custom-file">
                                                <a href="{{ url('file' . Auth::user()->user_pancard_file) }}"
                                                    data-fancybox data-caption="Scanned Pan Card Copy">
                                                    <i class="fa fa-file fa-4x " ></i>
                                                </a>
                                                <i class="fa fa-times ml-5 cursor-pointer removefile"
                                                    onclick="remove_file('user_pancard_file','{{ Auth::user()->id }}','user_pancard_file_div')"
                                                    ></i>
                                            </div>

                                        </div>
                                        @endif
                                        <br />

                                        <div class="form-group row">
                                            <label class="font-size-h6 font-weight-bolder text-dark">
                                                Upload Scanned Aadhar Card Copy
                                            </label>


                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="user_aadharcard_file"
                                                    name="user_aadharcard_file">
                                                <label class="custom-file-label" for="customFile">
                                                </label>
                                            </div>
                                            <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>

                                        </div>

                                        @if(isset(Auth::user()->user_aadharcard_file))
                                        <div class="form-group row user_aadharcard_file_div">
                                            <label>
                                                File
                                            </label>
                                            <div></div>

                                            <div class="custom-file">
                                                <a href="{{ url('file' . Auth::user()->user_aadharcard_file) }}"
                                                    data-fancybox data-caption="Scanned Aadhar Card Copy">
                                                    <i class="fa fa-file fa-4x " ></i>
                                                </a>

                                                <i class="fa fa-times ml-5 cursor-pointer removefile"
                                                    onclick="remove_file('user_aadharcard_file','{{ Auth::user()->id }}','user_aadharcard_file_div')"
                                                    ></i>
                                            </div>

                                        </div>
                                        @endif
                                        <br />

                                        <div class="form-group row">
                                            <label class="font-size-h6 font-weight-bolder text-dark">
                                                Upload Scanned Client Mast Report (CMR) Copy <a target="_blank" href="https://investorzone.in/how-to-get-client-master-list-from-different-brokers/">click here to know more</a>
                                            </label>


                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"
                                                    id="user_client_mast_report_file"
                                                    name="user_client_mast_report_file">
                                                <label class="custom-file-label" for="customFile">
                                                </label>
                                            </div>
                                            <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>

                                        </div>

                                        @if(isset(Auth::user()->user_client_mast_report_file))
                                        <div class="form-group row user_client_mast_report_file_div">
                                            <label>
                                                File
                                            </label>
                                            <div></div>

                                            <div class="custom-file">
                                                <a href="{{ url('file' . Auth::user()->user_client_mast_report_file) }}"
                                                    data-fancybox data-caption="Scanned Client Mast Report (CMR) Copy">
                                                    <i class="fa fa-file fa-4x " ></i>
                                                </a>

                                                <i class="fa fa-times ml-5 cursor-pointer removefile"
                                                    onclick="remove_file('user_client_mast_report_file','{{ Auth::user()->id }}','user_client_mast_report_file_div')"
                                                    ></i>
                                            </div>

                                        </div>
                                        @endif
                                        <br />


                                        <div class="others" style="display: none">
                                            <div class="form-group row">

                                                <label class="font-size-h6 font-weight-bolder text-dark"> PAN Card
                                                    Number of <span class="role_display"></span></label>

                                                <input type="text" required
                                                    class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6"
                                                    name="other_pancard" placeholder="AFZPK7190K"
                                                    value="{{ Auth::user()->other_pancard ?? '' }}" />
                                            </div>

                                            <div class="form-group row">
                                                <label class="font-size-h6 font-weight-bolder text-dark">
                                                    Upload PAN Card of <span class="role_display"></span>
                                                </label>


                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        id="user_buisness_pancard_file"
                                                        name="user_buisness_pancard_file">
                                                    <label class="custom-file-label" for="customFile">
                                                    </label>
                                                </div>
                                                <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>

                                            </div>

                                            @if(isset(Auth::user()->user_buisness_pancard_file))
                                            <div class="form-group row user_buisness_pancard_file_div">
                                                <label>
                                                    File
                                                </label>
                                                <div></div>

                                                <div class="custom-file">
                                                    <a href="{{ url('file' . Auth::user()->user_buisness_pancard_file) }}"
                                                        data-fancybox
                                                        data-caption=" Upload  PAN Card of {{ Auth::user()->role }}">
                                                        <i class="fa fa-file fa-4x " ></i>
                                                    </a>

                                                    <i class="fa fa-times ml-5 cursor-pointer removefile"
                                                        onclick="remove_file('user_buisness_pancard_file','{{ Auth::user()->id }}','user_buisness_pancard_file_div')"
                                                        ></i>
                                                </div>

                                            </div>
                                            @endif
                                            <br />

                                            <div class="form-group row">

                                                <label class="font-size-h6 font-weight-bolder text-dark"> GST
                                                    registration number of <span class="role_display"></span></label>

                                                <input type="text" required
                                                    class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6"
                                                    name="gst_number" value="{{ Auth::user()->gst_number ?? '' }}" />
                                            </div>

                                        </div>
                                        <div class="company_files" style="display: none">
                                            <div class="form-group row">
                                                <label class="font-size-h6 font-weight-bolder text-dark">
                                                    Upload MOA of your company
                                                </label>


                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="moa" name="moa">
                                                    <label class="custom-file-label" for="customFile">
                                                    </label>
                                                </div>
                                                <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>

                                            </div>

                                            @if(isset(Auth::user()->moa))
                                            <div class="form-group row moa_file_div">
                                                <label>
                                                    File
                                                </label>
                                                <div></div>

                                                <div class="custom-file">
                                                    <a href="{{ url('file' . Auth::user()->moa) }}" data-fancybox
                                                        data-caption="MOA of your company">
                                                        <i class="fa fa-file fa-4x " ></i>
                                                    </a>

                                                    <i class="fa fa-times ml-5 cursor-pointer removefile"
                                                        onclick="remove_file('moa','{{ Auth::user()->id }}','moa_file_div')"
                                                        ></i>
                                                </div>

                                            </div>
                                            @endif
                                            <div class="form-group row">
                                                <label class="font-size-h6 font-weight-bolder text-dark">
                                                    Upload AOA of your company
                                                </label>


                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="aoa" name="aoa">
                                                    <label class="custom-file-label" for="customFile">
                                                    </label>
                                                </div>
                                                <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>

                                            </div>

                                            @if(isset(Auth::user()->aoa))
                                            <div class="form-group row aoa_file_div">
                                                <label>
                                                    File
                                                </label>
                                                <div></div>

                                                <div class="custom-file">
                                                    <a href="{{ url('file' . Auth::user()->aoa) }}" data-fancybox
                                                        data-caption="AOA of your company">
                                                        <i class="fa fa-file fa-4x " ></i>
                                                    </a>

                                                    <i class="fa fa-times ml-5 cursor-pointer removefile"
                                                        onclick="remove_file('aoa','{{ Auth::user()->id }}','aoa_file_div')"
                                                        ></i>
                                                </div>

                                            </div>
                                            @endif
                                        </div>


                                    </div>
                                    <!--end: Wizard Step 3-->

                                    <!--begin: Wizard Step 4-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <!--begin::Title-->
                                        <div class="pt-lg-0 pt-5 pb-15">
                                            <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">
                                                Complete</h3>
                                            <div class="text-muted font-weight-bold font-size-h4">Complete Your
                                                Signup And Create Your First Invoice Now!</div>
                                        </div>
                                        <!--end::Title-->

                                        <div id="wizard_result"></div>
                                    </div>
                                    <!--end: Wizard Step 4-->


                                    <!--begin: Wizard Actions-->
                                    <div class="d-flex justify-content-between pt-3">
                                        <div class="mr-2">
                                            <button @if(!Auth::user()->hasVerifiedEmail()) disabled @endif
                                                class="btn btn-light-primary font-weight-bolder font-size-h6 pl-6 pr-8
                                                py-4 my-3 mr-3"
                                                data-wizard-type="action-prev">
                                                <span class="svg-icon svg-icon-md mr-1">
                                                    <!--begin::Svg Icon | path:/assets/media/svg/icons/Navigation/Left-2.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                            <rect fill="#000000" opacity="0.3"
                                                                transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000)"
                                                                x="14" y="7" width="2" height="10" rx="1" />
                                                            <path
                                                                d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997)" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>Previous</button>
                                        </div>
                                        <div>
                                            <button @if(!Auth::user()->hasVerifiedEmail()) disabled @endif
                                                class="btn btn-primary font-weight-bolder font-size-h6 pl-5 pr-8 py-4
                                                my-3"
                                                data-wizard-type="action-submit" type="submit"
                                                id="complete_registration_btn">Complete Registeration
                                                <span class="svg-icon svg-icon-md ml-2">
                                                    <!--begin::Svg Icon | path:/assets/media/svg/icons/Navigation/Right-2.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                            <rect fill="#000000" opacity="0.3"
                                                                transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)"
                                                                x="7.5" y="7.5" width="2" height="9" rx="1" />
                                                            <path
                                                                d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span></button>
                                            <button @if(!Auth::user()->hasVerifiedEmail()) disabled @endif
                                                class="btn btn-primary font-weight-bolder font-size-h6 pl-8 pr-4 py-4
                                                my-3"
                                                data-wizard-type="action-next" id="wizard_next_btn">Next Step
                                                <span class="svg-icon svg-icon-md ml-1">
                                                    <!--begin::Svg Icon | path:/assets/media/svg/icons/Navigation/Right-2.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                            <rect fill="#000000" opacity="0.3"
                                                                transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)"
                                                                x="7.5" y="7.5" width="2" height="9" rx="1" />
                                                            <path
                                                                d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <!--end: Wizard Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Signin-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Login-->
            </div>
            <!--end::Main-->
            @include('layouts.includes.footer')
        </div>
        <!--end::wrapper-->
    </div>
    <!--end::Page-->

    @include('layouts.includes.scroll-to-top')
</div>


<div class="modal fade" id="setPasswordModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="changePasswordModal" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set Account Password</h5>

            </div>
            <div class="modal-body">
                <form id="set_password_form">
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="col-form-label">Confirm Password:</label>
                        <input class="form-control" type="password" name="password_confirmation">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" id="set_password_form_submit" class="btn btn-primary" form="set_password_form">
                    Set Password
                </button>
            </div>
        </div>
    </div>
</div>
@if(!isset(Auth()->user()->password))
<input type="hidden" id="show_password_modal" value="true">
@endif
@endsection

@section('page_scripts')
<script src="/js/login.js?v=7.0.3"></script>
<script src="/assets/js/bootstrap-datepicker.js?v=7.0.3"></script>
<script>
    if ($('#show_password_modal').val() === "true") {
        $('#setPasswordModal').modal({
            keyboard: false
        });
        $('#setPasswordModal').modal('show');
    }
    $('#resend-verification-link-btn').on('click', function (e) {
        e.preventDefault();
        KTApp.blockPage({
            overlayColor: "red",
            state: "primary",
            message: "Please wait..."
        })
        $.post('/email/resend').done(function () {
                Swal.fire({
                    text: "Verification mail resent. Please check your inbox.",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                })
            })
            .fail(function () {
                Swal.fire({
                    text: "Sorry, looks like there are some errors detected, please try again.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                })
            }).always(function () {
                KTApp.unblockPage();
            });
    });

    

    function remove_file(columnname,id,div){
        Swal.fire({
            title: "Are you sure?",
            text: "Delete file?",
            icon: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonText: "Yes, delete it!",
            customClass: {
                confirmButton: 'btn-danger'
            },
            preConfirm: function() {
                return $.ajax({
                    url: '{{ route("users_remove_file") }}',
                    type: 'POST',
                    data: {'columnname':columnname,'id':id}
                }).done(function(data) {
                    $(document).find('.'+div).remove();
                });
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                Swal.fire(
                    "Deleted!",
                    "File has been deleted.",
                    "success"
                )
                $('.receipt_image_div').remove();
            }

           
        });
    }

</script>
@endsection