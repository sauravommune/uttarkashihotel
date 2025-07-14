<x-app-layout>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                        {{ $title }}
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superAdmin.dashboard') }}" class="text-muted text-hover-success">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('settings.index') }}" class="text-muted text-hover-success">Settings</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ $title }}</li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Form-->
            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-success pb-4 active" data-bs-toggle="tab" href="#FinancialInfo">Financial Info
                        </a>
                    </li>
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-success pb-4" data-bs-toggle="tab" href="#Address">
                            Address</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-active-success pb-4" data-bs-toggle="tab" href="#BankDetails">
                            Bank Details</a>
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="FinancialInfo" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <form action="{{ route('settings.financial-info-update') }}" id="business_info_form" class="global-ajax-form" enctype="multipart/form-data">
                                <!--begin::Card body-->
                                <div class="card-body border-top p-9">
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6 my-auto">Logo</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 file-error">
                                            <!--begin::Image input-->
                                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{asset('assets/media/avatars/blank.png')}})">
                                                <!--begin::Preview existing avatar-->
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ (isset(Auth::user()->business_logo) && is_file(public_storage_path(Auth::user()->business_logo))) ? storage_asset(Auth::user()->business_logo) : 'none' }}">
                                                </div>
                                                <!--end::Preview existing avatar-->
                                                <!--begin::Label-->
                                                <label class="btn btn-icon btn-circle btn-active-color-success w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                    <i class="ki-outline ki-pencil fs-7"></i>
                                                    <!--begin::Inputs-->
                                                    <input type="file" name="business_logo" accept=".png, .jpg, .jpeg">
                                                    <input type="hidden" name="avatar_remove">
                                                    <!--end::Inputs-->
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Cancel-->
                                                <span class="btn btn-icon btn-circle btn-active-color-success w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                    <i class="ki-outline ki-cross fs-2"></i>
                                                </span>
                                                <!--end::Cancel-->
                                                @if(is_file(public_storage_path(Auth::user()->business_logo)))
                                                <!--begin::Remove-->
                                                <span class="btn btn-icon btn-circle btn-active-color-success w-25px h-25px bg-body shadow remove-file" data-kt-image-input-action="remove" data-id="{{auth()->user()->id}}" data-col="business_logo" data-table="users" data-file="{{Auth::user()->business_logo}}" data-bs-toggle="tooltip" title="Remove avatar">
                                                    <i class="ki-outline ki-cross fs-2"></i>
                                                </span>
                                                <!--end::Remove-->
                                                @endif
                                            </div>
                                            <!--end::Image input-->

                                            <!--begin::Hint-->
                                            <div class="form-text error-file">Recommended Size: 400px x 400px</div>

                                            <!--end::Hint-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Business Name
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-plugins-icon-container">
                                                    <input name="business_name" class="form-control form-control-lg" type="text" value="{{ Auth::user()->business_name }}">
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span>Contact Phone</span>
                                            <span class="ms-1" data-bs-toggle="tooltip" title="Phone number must be active">
                                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                            </span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-plugins-icon-container">
                                                    <input type="text" name="phone" class="form-control form-control-lg" value="{{ Auth::user()->phone }}" placeholder="Phone">
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <div class="row">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <input class="col-10 pan_text border-0 col-form-label" name="pan_text" style="outline: none" type="text" value="{{ Auth::user()->pan_text ?? 'PAN Number' }}">
                                        </label>
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-plugins-icon-container">
                                                    <div class="input-group mb-5">
                                                        <input type="text" class="form-control " name="pan_number" placeholder="PAN Number" value="{{ Auth::user()->pan_number ?? '' }}" />

                                                        <span class="input-group-text" id="basic-addon3" style="border: 1px solid #E5EAEE;">
                                                            <input class="form-check-input " type="checkbox" name="show_pan" {{ Auth::user()->show_pan ? 'checked' : '' }} />
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <input class="col-10 gst_text border-0 col-form-label" name="gst_text" style="outline: none" type="text" value="{{ Auth::user()->gst_text ?? 'GST Number' }}">
                                        </label>
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-plugins-icon-container">
                                                    <div class="input-group mb-5">
                                                        <input type="text" class="form-control " name="gst_number" placeholder="GST Number" value="{{ Auth::user()->gst_number ?? '' }}" />

                                                        <span class="input-group-text" id="basic-addon3" style="border: 1px solid #E5EAEE;">
                                                            <input class="form-check-input " type="checkbox" name="show_gst" {{ Auth::user()->show_gst ? 'checked' : '' }} />
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <input class="col-10 cin_text border-0 col-form-label" name="cin_text" style="outline: none" type="text" value="{{ Auth::user()->cin_text ?? 'CIN Number' }}">
                                        </label>
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-plugins-icon-container">
                                                    <div class="input-group mb-5">
                                                        <input type="text" class="form-control " name="cin_number" placeholder="CIN Number" value="{{ Auth::user()->cin_number ?? '' }}" />

                                                        <span class="input-group-text" style="border: 1px solid #E5EAEE;">
                                                            <input class="form-check-input " type="checkbox" name="show_cin" {{ Auth::user()->show_cin ? 'checked' : '' }} />
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Company Website

                                        </label>
                                        <div class="col-lg-8">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-plugins-icon-container">
                                                    <input name="business_site" class="form-control form-control-lg" type="text" value="{{ Auth::user()->business_site }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if(Auth::user()->role == 'broker')
                                    <div class="my-5 broker_info">
                                        <div class="separator separator-dashed my-10"></div>
                                        <h3 class="text-dark font-weight-bold mb-10">Broker Info</h3>

                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Upload Scanned Pancard Copy</label>
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input type="file" class="form-control" id="broker_pancard_document" accept=".pdf, .png, .jpeg, .jpg" name="broker_pancard_document">
                                                        <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if (isset($user->broker_pancard_document))
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">File</label>
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <a href="{{ storage_asset('/broker_pancard_document/'.$user->broker_pancard_document) }}" data-fancybox data-caption="Upload Scanned pancard Copy">
                                                            <i class="fa fa-file fa-4x fs-1 " ></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Upload Scanned CMR Copy</label>
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input type="file" class="form-control" id="broker_crm_document" accept=".pdf, .png, .jpeg, .jpg" name="broker_crm_document">
                                                        <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if (isset($user->broker_crm_document))
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">File</label>
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <a href="{{ storage_asset('/broker_crm_document/'.$user->broker_crm_document) }}" data-fancybox data-caption="Upload Scanned CMR Copy">
                                                            <i class="fa fa-file fa-4x fs-1 " ></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Broker Cancelled Cheque</label>
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input type="file" class="form-control" id="broker_cancelled_cheque" name="broker_cancelled_cheque">
                                                        <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if (isset($user->broker_cancelled_cheque))
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">File</label>
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <a href="{{ storage_asset('/broker_cancelled_cheque/'.$user->broker_cancelled_cheque) }}" data-fancybox data-caption="Broker Cancelled Cheque">
                                                            <i class="fa fa-file fa-4x fs-1 " ></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Franchise Agreement</label>
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input type="file" class="form-control" id="broker_agreement" name="broker_agreement">
                                                        <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if (isset($user->broker_agreement))
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">File</label>
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <a href="{{ storage_asset('/broker_agreement/'.$user->broker_agreement) }}" data-fancybox data-caption="Franchise Agreement">
                                                            <i class="fa fa-file fa-4x fs-1 " ></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Business</label>
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <select name="broker_business" id="broker_business" class="form-control ">
                                                            @foreach (config('data.business_of_broker') as $business)
                                                            <option value="{{ $business }}" @if (isset($user->broker_business) && $user->broker_business == $business) selected @endif> {{ $business }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6 upload_certificate_div" @if((isset($user) && $user->role == 'broker' && $user->broker_business == 'Individual') || !isset($user->role)) style="display:none" @endif>
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Upload Certificate Copy</label>
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input type="file" class="form-control" id="broker_upload_certificate_copy" name="broker_upload_certificate_copy">
                                                        <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if (isset($user->broker_upload_certificate_copy))
                                        <div class="row mb-6 upload_certificate_div" @if(isset($user) && $user->role == 'broker' && $user->broker_business == 'Individual') style="display:none" @endif>
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">File</label>
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <a href="{{ storage_asset('/broker_upload_certificate_copy/'.$user->broker_upload_certificate_copy) }}" data-fancybox data-caption="Upload Certificate Copy">
                                                            <i class="fa fa-file fa-4x fs-1 " ></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">GST Compliant</label>
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <select name="broker_gst_compliant" id="broker_gst_compliant" class="form-control ">
                                                            @foreach (config('data.gst_compliant') as $gst_compliant)
                                                            <option value="{{ $gst_compliant }}" @if (isset($user->broker_gst_compliant) && $user->broker_gst_compliant == $gst_compliant) selected @endif>
                                                                {{ $gst_compliant }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6 broker_gst_compliant_div" @if(isset($user) && $user->role == 'broker' && $user->broker_gst_compliant == 'No') style="display:none" @endif>
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Upload Declaration</label>
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input type="file" class="form-control" id="broker_upload_declaration" accept=".pdf, .png, .jpeg, .jpg" name="broker_upload_declaration">
                                                        <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if (isset($user->broker_upload_declaration))
                                        <div class="row mb-6 broker_gst_compliant_div" @if(isset($user) && $user->role == 'broker' && $user->broker_gst_compliant == 'No') style="display:none" @endif>
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">File</label>
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <a href="{{ storage_asset('/broker_upload_declaration/'.$user->broker_upload_declaration) }}" data-fancybox data-caption="Upload Declaration">
                                                            <i class="fa fa-file fa-4x fs-1 " ></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif


                                        <div class="row mb-6 broker_stamp_div" @if(isset($user) && $user->role == 'broker' && $user->broker_gst_compliant !== 'No') style="display:none" @endif>
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Upload Stamp</label>
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input type="file" class="form-control" id="broker_stamp" accept=".png, .jpeg, .jpg" name="broker_stamp">
                                                        <div>Allowed (.png, .jpeg, .jpg) file-types only</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if (isset($user->broker_stamp))
                                        <div class="row mb-6 broker_stamp_div" @if(isset($user) && $user->role == 'broker' && $user->broker_gst_compliant !== 'No') style="display:none" @endif>
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">File</label>
                                            <div class="col-lg-8">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <a href="{{ storage_asset('/broker_stamp/'.$user->broker_stamp) }}" data-fancybox data-caption="Upload Declaration">
                                                            <i class="fa fa-file fa-4x fs-1 " ></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                    @endif

                                    <!--begin::Actions-->
                                    <div class="card-footer d-flex justify-content-end mt-10 pe-0">
                                        <!--begin::Button-->
                                        <button type="submit" id="business_info_form_submit" class="btn btn-primary">
                                            <span class="indicator-label">Save Changes</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade" id="Address" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::Inventory-->
                            <div class="card card-flush py-4">
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <form id="business_address_form" action="{{ route('settings.updateBusinessAddress') }}" class="global-ajax-form">

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                Address Line 1
                                            </label>
                                            <div class="col-lg-8 my-auto">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input name="address_1" class="form-control form-control-lg form-control-solid" type="text" value="{{Auth::user()->address_1??''}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                Address Line 2
                                            </label>
                                            <div class="col-lg-8 my-auto">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input name="address_2" class="form-control form-control-lg form-control-solid" type="text" value="{{Auth::user()->address_2??''}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                Country
                                            </label>
                                            <div class="col-lg-8 my-auto">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <select name="country" id="country" class="form-control form-control-lg form-control-solid">
                                                            @foreach($countries as $key => $country)
                                                            @if(Auth::user()->country == $key)
                                                            <option value="{{ $key }}" selected>
                                                                {{ $country }}
                                                            </option>
                                                            @else
                                                            <option value="{{ $key }}">
                                                                {{ $country }}
                                                            </option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                State
                                            </label>
                                            <div class="col-lg-8 my-auto">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        @if(isset(config('data.states')[Auth::user()->country]))
                                                        <select name="state" id="state" class="form-control form-control-lg form-control-solid">
                                                            @foreach(config('data.states')[Auth::user()->country]
                                                            as $state)
                                                            @if(Auth::user()->state == $state)
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
                                                        <input name="state" id="state" class="form-control form-control-lg form-control-solid" type="text" value="{{Auth::user()->state??''}}">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                City
                                            </label>
                                            <div class="col-lg-8 my-auto">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input name="city" class="form-control form-control-lg form-control-solid" type="text" value="{{Auth::user()->city??''}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                Postcode
                                            </label>
                                            <div class="col-lg-8 my-auto">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input name="postcode" value="{{Auth::user()->postcode??''}}" class="form-control form-control-lg form-control-solid" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--begin::Actions-->
                                        <div class="card-footer d-flex justify-content-end mt-10 pe-0">
                                            <!--begin::Button-->
                                            <button type="submit" id="business_address_form_submit" class="btn btn-primary">
                                                <span class="indicator-label">Save Changes</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                        <!--end::Actions-->

                                    </form>
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Inventory-->
                        </div>
                    </div>

                    <div class="tab-pane fade" id="BankDetails" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::Inventory-->
                            <div class="card card-flush py-4">
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <form action="{{ route('settings.bank_details') }}" class="global-ajax-form">

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                Bank Account Name
                                            </label>
                                            <div class="col-lg-8 my-auto">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input name="account_name" class="form-control form-control-lg form-control-solid" type="text" value="{{ Auth::user()->bank_details['account_name']  ?? ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                Bank Account Number
                                            </label>
                                            <div class="col-lg-8 my-auto">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input name="account_number" class="form-control form-control-lg form-control-solid" type="text" value="{{ Auth::user()->bank_details['account_number']  ?? ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                Account Type
                                            </label>
                                            <div class="col-lg-8 my-auto">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <select name="account_type" class="form-control form-control-lg form-control-solid">
                                                            @php
                                                            if(!empty(Auth::user()->bank_details['account_type'])){
                                                            $account_type = Auth::user()->bank_details['account_type'];
                                                            }else{
                                                            $account_type = '';
                                                            }
                                                            @endphp
                                                            <option value="current" @selected($account_type=='current' )>
                                                                Current
                                                            </option>
                                                            <option value="saving" @selected($account_type=='saving' )>
                                                                Savings
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                Bank Name
                                            </label>
                                            <div class="col-lg-8 my-auto">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input name="bank_name" class="form-control form-control-lg form-control-solid" type="text" value="{{ Auth::user()->bank_details['bank_name']  ?? ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                <i class="bi bi-pencil"></i> <input class="cin_text border-0" name="neft_code_text" style="outline: none" type="text" value="{{ Auth::user()->bank_details['neft_code_text'] ?? 'NEFT Code' }}">
                                            </label>
                                            <div class="col-lg-8 my-auto">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input name="neft_code" class="form-control form-control-lg form-control-solid" type="text" value="{{ Auth::user()->bank_details['neft_code']  ?? ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                Swift Code
                                            </label>
                                            <div class="col-lg-8 my-auto">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input name="swift_code" class="form-control form-control-lg form-control-solid" type="text" value="{{ Auth::user()->bank_details['swift_code']  ?? ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                MICR Code
                                            </label>
                                            <div class="col-lg-8 my-auto">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input name="micr_code" class="form-control form-control-lg form-control-solid" type="text" value="{{ Auth::user()->bank_details['micr_code']  ?? ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                Your Bank Branch's Address
                                            </label>
                                            <div class="col-lg-8 my-auto">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-plugins-icon-container">
                                                        <input name="branch_address" class="form-control form-control-lg form-control-solid" type="text" value="{{ Auth::user()->bank_details['branch_address']  ?? ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row align-items-center">
                                            <label class="col-form-label col-4 text-lg-right text-left">Show
                                                on Invoice</label>
                                            <div class="col-8">
                                                <div class="checkbox-list bank-details-show">
                                                    <label class="form-check form-check-success form-check-inline form-check-solid m-2">
                                                        @php
                                                        $show = Auth::user()->bank_details['show']??[];
                                                        @endphp
                                                        <input type="checkbox" name="show[account_name]" class="form-check-input" {{(!empty($show['account_name']) && $show['account_name'] == true) ? 'checked' : '' }} data-type='account_name'> Bank Account Name
                                                        <span></span></label>
                                                    <label class="form-check form-check-success form-check-inline form-check-solid m-2">
                                                        <input type="checkbox" class="form-check-input" name="show[bank_name]" {{(!empty($show['bank_name']) && $show['bank_name'] == true) ? 'checked' : '' }} data-type='bank_name'> Bank Name
                                                        <span></span></label>
                                                    <label class="form-check form-check-success form-check-inline form-check-solid m-2">
                                                        <input type="checkbox" class="form-check-input" name="show[account_number]" {{(!empty($show['account_number']) && $show['account_number'] == true) ? 'checked' : '' }} data-type='account_number'> Bank Account
                                                        Number
                                                        <span></span></label>
                                                    <label class="form-check form-check-success form-check-inline form-check-solid m-2">
                                                        <input type="checkbox" class="form-check-input" name="show[account_type]" {{(!empty($show['account_type']) && $show['account_type'] == true) ? 'checked' : '' }} data-type='account_number'> Account Type
                                                        <span></span></label>
                                                    <label class="form-check form-check-success form-check-inline form-check-solid m-2">
                                                        <input type="checkbox" class="form-check-input" name="show[neft_code]" {{(!empty($show['neft_code']) && $show['neft_code'] == true) ? 'checked' : '' }} data-type='neft_code'> NEFT Code
                                                        <span></span></label>
                                                    <label class="form-check form-check-success form-check-inline form-check-solid m-2">
                                                        <input type="checkbox" class="form-check-input" name="show[micr_code]" {{(!empty($show['micr_code']) && $show['micr_code'] == true) ? 'checked' : '' }} data-type='micr_code'> MICR Code
                                                        <span></span></label>
                                                    <label class="form-check form-check-success form-check-inline form-check-solid m-2">
                                                        <input type="checkbox" class="form-check-input" name="show[swift_code]" {{(!empty($show['swift_code']) && $show['swift_code'] == true) ? 'checked' : '' }} data-type='swift_code'> SWIFT Code
                                                        <span></span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <!--begin::Actions-->
                                        <div class="card-footer d-flex justify-content-end mt-10 pe-0">
                                            <!--begin::Button-->
                                            <button type="submit" id="bank_details_form_submit" class="btn btn-primary">
                                                <span class="indicator-label">Save Changes</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                        <!--end::Actions-->
                                    </form>

                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Inventory-->
                        </div>
                    </div>
                    <!--end::Tab pane-->
                </div>
            </div>
            <!--end::Main column-->
            <!--end::Form-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</x-app-layout>
