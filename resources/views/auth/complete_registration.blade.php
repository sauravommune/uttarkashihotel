<x-app-layout>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                        {{ $title }}
                    </h1>
                    <small class="text-muted">Complete your registration first!</small>
                </div>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card">
                <div class="card-body pt-0">
                    <div class="stepper stepper-pills" id="kt_stepper_example_basic">
                        <div class="stepper-nav  d-flex flex-wrap mb-10 justify-content-between mb-10 p-12">
                            <div class="stepper-item mx-8 my-4 current" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper d-flex align-items-center">
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">1</span>
                                    </div>

                                    <div class="stepper-label">
                                        <h3 class="stepper-title">
                                            Account Settings
                                        </h3>

                                        <div class="stepper-desc">
                                            Setup Your Account Details
                                        </div>
                                    </div>
                                </div>

                                <div class="stepper-line h-40px"></div>
                            </div>

                            <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper d-flex align-items-center">
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">2</span>
                                    </div>

                                    <div class="stepper-label">
                                        <h3 class="stepper-title">
                                            Address Details
                                        </h3>

                                        <div class="stepper-desc">
                                            Setup Business Address
                                        </div>
                                    </div>
                                </div>

                                <div class="stepper-line h-40px"></div>
                            </div>

                            <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper d-flex align-items-center">
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">3</span>
                                    </div>

                                    <div class="stepper-label">
                                        <h3 class="stepper-title">
                                            Business Info
                                        </h3>

                                        <div class="stepper-desc">
                                            Business info to serve you better
                                        </div>
                                    </div>
                                </div>

                                <div class="stepper-line h-40px"></div>
                            </div>

                            <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper d-flex align-items-center">
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">4</span>
                                    </div>

                                    <div class="stepper-label">
                                        <h3 class="stepper-title">
                                            Completed!
                                        </h3>

                                        <div class="stepper-desc">
                                            Review and Submit
                                        </div>
                                    </div>
                                </div>

                                <div class="stepper-line h-40px"></div>
                            </div>
                        </div>

                        <form class="form w-lg-800px mx-auto" action="{{ url('complete-registration') }}" novalidate="novalidate" method="post" id="kt_stepper_example_basic_form">
                            @csrf
                            <div class="mb-5">
                                <div class="flex-column current" data-kt-stepper-element="content">
                                    <div class="fv-row mb-6">
                                        <label class="form-label">Type of Investor</label>
                                        <div>
                                            <select name="role" id="role" data-control="select2" class="form-control form-control-solid">
                                                @foreach(config('data.roles')
                                                as $key => $role)
                                                @if(isset(Auth::user()->role) && Auth::user()->role === $key)
                                                <option value="{{ $key }}">
                                                    {{ $role }}
                                                </option>
                                                @else
                                                <option value="{{ $key }}">
                                                    {{ $role }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <span class="text-danger clr roleError"></span>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-6">
                                        <label class="form-label">Your Aadhar Number</label>
                                        <input type="text" class="form-control form-control-solid" id="aadhar_number" name="aadhar_number" placeholder="125698569854" value="{{ Auth::user()->aadhar_number ?? '' }}" />
                                        <span class="text-danger clr aadharError"></span>
                                    </div>

                                    <div class="fv-row mb-6">
                                        <label class="form-label">Your Mobile Number</label>
                                        <input type="tel" id="phone" class="form-control form-control-solid" name="phone" placeholder="+91-9123456780" value="{{ Auth::user()->phone ?? '' }}" />
                                        <span class="text-danger clr mobileError"></span>
                                    </div>

                                    <div class="fv-row mb-6">
                                        <label class="form-label">Your PAN Card Number</label>
                                        <input type="text" id="pan_number" class="form-control form-control-solid" name="pan_number" placeholder="AFZPK7190K" value="{{ Auth::user()->pan_number ?? '' }}" />
                                        <span class="text-danger clr PANError"></span>
                                    </div>

                                    <div class="fv-row mb-6">
                                        <label class="form-label">Reference</label>
                                        <select name="reference" id="reference" data-control="select2" class="form-control form-control-solid">
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
                                        <span class="text-danger clr refError"></span>
                                    </div>
                                </div>

                                <div class="flex-column" data-kt-stepper-element="content">
                                    <div class="fv-row mb-7">
                                        <label class="form-label">Address Line 1</label>
                                        <input type="text" class="form-control form-control-solid" name="address_1" placeholder="Address Line 1" value="{{ Auth::user()->address_1 ?? '' }}" />
                                        <span class="text-danger clr address_1Error"></span>
                                    </div>

                                    <div class="fv-row mb-7">
                                        <label class="form-label">Address Line 2</label>
                                        <input type="text" class="form-control form-control-solid" name="address_2" placeholder="Address Line 2" value="{{ Auth::user()->address_2 ?? '' }}" />
                                        <span class="text-danger clr address_2Error"></span>
                                    </div>

                                    <div class="row">
                                        <div class="fv-row mb-7 col-6">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control form-control-solid" name="city" placeholder="City" value="{{ Auth::user()->city ?? '' }}" />
                                            <span class="text-danger clr cityError"></span>
                                        </div>

                                        <div class="fv-row mb-7 col-6">
                                            <label class="form-label">Post Code</label>
                                            <input type="text" class="form-control form-control-solid" name="postcode" placeholder="Postcode" value="{{ Auth::user()->postcode ?? '' }}" />
                                            <span class="text-danger clr postcodeError"></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="fv-row mb-7 col-6">
                                            <label class="form-label">Country</label>
                                            <select name="country" id="country" class="form-select form-select-solid">
                                                @foreach($countries as $key => $country)
                                                @if(Auth::user()->country == $key)
                                                <option value="{{ $key }}" selected>{{ $country }}
                                                </option>
                                                @else
                                                <option value="{{ $key }}">{{ $country }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <span class="text-danger clr countryError"></span>
                                        </div>

                                        <div class="fv-row mb-7 col-6">
                                            <label class="form-label">State</label>
                                            <div id="state_div">
                                                @if(isset(config('data.states')[Auth::user()->country]))
                                                <select name="state" id="state" class="form-select form-select-solid">
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
                                                <input type="text" class="form-select form-select-solid" name="state" placeholder="State" value="{{ Auth::user()->state??'' }}" />
                                                @endif
                                                <span class="text-danger clr stateError"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-column" data-kt-stepper-element="content">
                                    <div class="fv-row business_name_div mb-7">
                                        <label class="form-label">
                                            <span class="role_display"></span> Name
                                        </label>
                                        <input type="text" class="form-control form-control-solid" name="business_name" placeholder="UnlistedZone" value="{{ Auth::user()->business_name ?? '' }}" />
                                        <span class="business_nameError clr text-danger"></span>
                                    </div>

                                    <div class="fv-row row mb-7">
                                        <div class="col">
                                            <label class="form-label">Upload Scanned Pan Card Copy</label>
                                            <input type="file" class="form-control form-control-solid" id="user_pancard_file" name="user_pancard_file" accept=".pdf, .png, .jpeg, .jpg">
                                            <span class="user_pancard_fileError clr text-danger"></span>
                                            <div class="text-muted">Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                                        </div>

                                        @if(isset(Auth::user()->user_pancard_file))
                                        <div class="form-group col-2 user_pancard_file_div">
                                            <label class="ps-5">File</label>
                                            <div class="custom-file p-5">
                                                <a href="{{ storage_asset(Auth::user()->user_pancard_file) }}" data-caption="Scanned Pan Card Copy">
                                                    <i class="fa fa-file fa-4x fs-1" ></i>
                                                </a>
                                                <i class="fa fa-times fs-3 ml-5 cursor-pointer remove-file" data-table="users" data-col="user_pancard_file" data-id="{{ Auth::user()->id }}" data-file="{{Auth::user()->user_pancard_file}}" ></i>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="fv-row row mb-7">
                                        <div class="col">
                                            <label class="form-label">Upload Scanned Aadhar Card Copy</label>
                                            <input type="file" class="form-control form-control-solid" id="user_aadharcard_file" name="user_aadharcard_file" accept=".pdf, .png, .jpeg, .jpg">
                                            <span class="user_aadharcard_fileError clr text-danger"></span>
                                            <div class="text-muted">Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                                        </div>

                                        @if(isset(Auth::user()->user_aadharcard_file))
                                        <div class="form-group col-2 user_aadharcard_file_div">
                                            <label class="ps-5">File</label>
                                            <div class="custom-file p-5">
                                                <a href="{{ storage_asset(Auth::user()->user_aadharcard_file) }}" data-caption="Scanned Pan Card Copy">
                                                    <i class="fa fa-file fa-4x fs-1" ></i>
                                                </a>
                                                <i class="fa fa-times fs-3 ml-5 cursor-pointer remove-file" data-table="users" data-col="user_aadharcard_file" data-id="{{ Auth::user()->id }}" data-file="{{Auth::user()->user_aadharcard_file}}" ></i>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="fv-row row mb-7">
                                        <div class="col">
                                            <label class="form-label">
                                                Upload Scanned Client Master Report (CMR) Copy
                                                <a target="_blank" href="https://investorzone.in/how-to-get-client-master-list-from-different-brokers/">
                                                    click here to know more
                                                </a>
                                            </label>
                                            <input type="file" class="form-control form-control-solid" id="user_client_mast_report_file" name="user_client_mast_report_file" accept=".pdf, .png, .jpeg, .jpg">
                                            <span class="user_client_mast_report_fileError clr text-danger"></span>
                                            <div class="text-muted">Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                                        </div>

                                        @if(isset(Auth::user()->user_client_mast_report_file))
                                        <div class="form-group col-2 user_client_mast_report_file_div">
                                            <label class="ps-5">File</label>
                                            <div class="custom-file p-5">
                                                <a href="{{ storage_asset(Auth::user()->user_client_mast_report_file) }}" data-caption="Scanned Pan Card Copy">
                                                    <i class="fa fa-file fa-4x fs-1" ></i>
                                                </a>
                                                <i class="fa fa-times fs-3 ml-5 cursor-pointer remove-file" data-table="users" data-col="user_client_mast_report_file" data-id="{{ Auth::user()->id }}" data-file="{{Auth::user()->user_client_mast_report_file}}" ></i>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="others" style="display:none">
                                        <div class="fv-row row mb-7">
                                            <div class="col">
                                                <label class="form-label">
                                                    PAN Card Number of <span class="role_display"></span>
                                                </label>
                                                <input type="text" required class="form-control form-control-solid" name="other_pancard" placeholder="AFZPK7190K" value="{{ Auth::user()->other_pancard ?? '' }}" />
                                            </div>
                                        </div>

                                        <div class="fv-row row mb-7">
                                            <div class="col">
                                                <label class="form-label">
                                                    Upload PAN Card of <span class="role_display"></span>
                                                </label>
                                                <input type="file" class="form-control form-control-solid" id="user_buisness_pancard_file" name="user_buisness_pancard_file" accept=".pdf, .png, .jpeg, .jpg">
                                                <div class="text-muted">Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                                            </div>

                                            @if(isset(Auth::user()->user_buisness_pancard_file))
                                            <div class="form-group col-2 user_buisness_pancard_file_div">
                                                <label class="ps-5">File</label>
                                                <div class="custom-file p-5">
                                                    <a href="{{ storage_asset(Auth::user()->user_buisness_pancard_file) }}" data-caption="Scanned Pan Card Copy">
                                                        <i class="fa fa-file fa-4x fs-1" ></i>
                                                    </a>
                                                    <i class="fa fa-times fs-3 ml-5 cursor-pointer remove-file" data-table="users" data-col="user_buisness_pancard_file" data-id="{{ Auth::user()->id }}" data-file="{{Auth::user()->user_buisness_pancard_file}}" ></i>
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="fv-row row mb-7">
                                            <div class="col">
                                                <label class="form-label">
                                                    GST registration number of <span class="role_display"></span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid" name="gst_number" value="{{ Auth::user()->gst_number ?? '' }}" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="company_files" style="display:none">
                                        <div class="row mb-7">
                                            <div class="col">
                                                <label class="form-label">
                                                    Upload MOA of your company
                                                </label>
                                                <input type="file" class="form-control form-control-solid" id="moa" name="moa" accept=".pdf, .png, .jpeg, .jpg">
                                                <div class="text-muted">Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                                            </div>

                                            @if(isset(Auth::user()->moa))
                                            <div class="form-group col-2 moa_file_div">
                                                <label class="ps-5">File</label>
                                                <div class="custom-file p-5">
                                                    <a href="{{ storage_asset(Auth::user()->moa) }}" data-caption="Scanned Pan Card Copy">
                                                        <i class="fa fa-file fa-4x fs-1" ></i>
                                                    </a>
                                                    <i class="fa fa-times fs-3 ml-5 cursor-pointer remove-file" data-table="users" data-col="moa" data-id="{{ Auth::user()->id }}" data-file="{{Auth::user()->moa}}" ></i>
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="row mb-7">
                                            <div class="col">
                                                <label class="form-label">
                                                    Upload AOA of your company
                                                </label>
                                                <input type="file" class="form-control form-control-solid" id="aoa" name="aoa" accept=".pdf, .png, .jpeg, .jpg">
                                                <div class="text-muted">Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                                            </div>

                                            @if(isset(Auth::user()->aoa))
                                            <div class="form-group col-2 aoa_file_div">
                                                <label class="ps-5">File</label>
                                                <div class="custom-file p-5">
                                                    <a href="{{ storage_asset(Auth::user()->aoa) }}" data-caption="Scanned Pan Card Copy">
                                                        <i class="fa fa-file fa-4x fs-1" ></i>
                                                    </a>
                                                    <i class="fa fa-times fs-3 ml-5 cursor-pointer remove-file" data-table="users" data-col="aoa" data-id="{{ Auth::user()->id }}" data-file="{{Auth::user()->aoa}}" ></i>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="flex-column" data-kt-stepper-element="content">
                                    <div id="wizard_result"></div>
                                </div>
                            </div>

                            <div class="d-flex flex-stack">
                                <div class="me-2">
                                    <button type="button" class="btn btn-light btn-active-light-success" data-kt-stepper-action="previous">
                                        Back
                                    </button>
                                </div>

                                <div>
                                    <button type="button" class="btn btn-success submit-registration" data-kt-stepper-action="submit">
                                        <span class="indicator-label">
                                            Submit
                                        </span>
                                        <span class="indicator-progress">
                                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>

                                    <button type="button" class="btn btn-success" data-kt-stepper-action="next">
                                        Continue
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(function() {
            var element = document.querySelector("#kt_stepper_example_basic");

            var stepper = new KTStepper(element);

            stepper.on("kt.stepper.next", function(stepper) {
                var step = stepper.getCurrentStepIndex();
                if (step == 1) {
                    var valid = true;
                    var aadhar = $('#aadhar_number').val();
                    $('.clr').text(' ');
                    if (!$('#role').val()) {
                        valid = false;
                        $('.roleError').text('Role is required!');
                    }
                    if (!aadhar || aadhar.length < 12) {
                        valid = false;
                        if (aadhar.length < 12 && aadhar) {
                            $('.aadharError').text('Invalid Aadhar Number!');
                        } else {
                            $('.aadharError').text('Aadhar is required!');
                        }
                    }
                    if (!$('#phone').val()) {
                        valid = false;
                        $('.mobileError').text('Phone is required!');
                    }
                    if (!$('#pan_number').val()) {
                        valid = false;
                        $('.PANError').text('Pan number is required!');
                    }
                    if (!$('#reference').val()) {
                        valid = false;
                        $('.refError').text('Reference is required!');
                    }
                    if (valid === true) {
                        submitForm(step);
                    }
                } else if (step == 2) {
                    var valid = true;
                    $('.clr').text(' ');
                    if (!$('input[name=address_1]').val()) {
                        valid = false;
                        $('.address_1Error').text('Address_1 is required!');
                    }
                    if (!$('input[name=address_2]').val()) {
                        valid = false;
                        $('.address_2Error').text('Address_2 is required!');
                    }
                    if (!$('input[name=city]').val()) {
                        valid = false;
                        $('.cityError').text('City is required!');
                    }
                    if (!$('input[name=postcode]').val()) {
                        valid = false;
                        $('.postcodeError').text('Postcode is required!');
                    }
                    if (!$('select[name=country]').val()) {
                        valid = false;
                        $('.countryError').text('Country is required!');
                    }
                    if (!$('select[name=state]').val()) {
                        valid = false;
                        $('.stateError').text('State is required!');
                    }
                    if (valid === true) {
                        submitForm(step);
                    }
                } else if (step == 3) {
                    var valid = true;
                    $('.clr').text(' ');
                    if (valid === true) {
                        submitForm(step);
                    }
                } else if (step == 4) {
                    var valid = true;
                    $('.clr').text(' ');
                    if (valid === true) {
                        submitForm(step);
                    }
                }

            });

            $('body').on('click', '.submit-registration', function() {
                submitForm(4);
            });

            function submitForm(step) {
                let formElement = document.getElementById("kt_stepper_example_basic_form");
                let formData = new FormData(formElement);
                formData.append('step', step);
                $.ajax({
                    url: base_url + '/complete-registration',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(user) {
                        if (user.completed == 'true') {
                            Swal.fire({
                                text: jqXhr.responseJSON.message,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                confirmButtonClass: "btn btn-danger",
                            })

                            setTimeout(() => {
                                window.location.href=base_url+"/login";
                            }, 2000);

                        }
                        var result = `
                        <!--begin::Section-->
                        <h4 class="font-weight-bolder mb-3">Account Settings:</h4>
                        <div class="text-dark-50 font-weight-bold line-height-lg mb-8">
                            <div>Your Name: ${user.name}</div>
                            <div>${user.phone}</div>
                            <div>${user.email}</div>
                        </div>
                        <!--end::Section-->
                        <!--begin::Section-->
                        <h4 class="font-weight-bolder mb-3">Address Details:</h4>
                        <div class="text-dark-50 font-weight-bold line-height-lg mb-8">
                            <div>${user.address_1}</div>
                            ${user.address_2  ? ('<div>' +user.address_2 +'</div>') :''}
                            <div>${user.city} ${user.postcode}, ${user.state}, ${user.country_name}</div>
                        </div>
                        <!--end::Section-->
                        <!--begin::Section-->
                        <h4 class="font-weight-bolder mb-3">Other Info: </h4>
                        <div class="text-dark-50 font-weight-bold line-height-lg mb-8">
                            <div>Your Role: ${user.role}</div>
                        </div>
                        <!--end::Section-->
                        `;

                        if (user.role == 'individual') {
                            $(document).find('.individual').show();
                            $(document).find('.others').hide();
                            $(document).find('.company_files').hide();
                            $(document).find('.business_name_div').hide();

                        } else {
                            $(document).find('.individual').hide();
                            $(document).find('.others').show();

                            $(document).find('.business_name_div').show();

                            $(document).find('.role_display').html(user.role);
                            if (user.role == 'Company') {
                                $(document).find('.company_files').show();
                            } else {
                                $(document).find('.company_files').hide();
                            }
                        }
                        $('#wizard_result').html(result);
                        stepper.goNext(); // go next step
                    },
                    error: function(jqXhr) {
                        Swal.fire({
                            text: jqXhr.responseJSON.message,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-light-primary"
                            }
                        })
                    },
                });
            }

            stepper.on("kt.stepper.previous", function(stepper) {
                stepper.goPrevious(); // go previous step
            });
        });
    </script>
    @endpush
</x-app-layout>
