<div class="tab-pane show active px-7" id="business_info" role="tabpanel">
    <form id="business_info_form" enctype="multipart/form-data">
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-7 my-2">

                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-4 text-lg-right text-left">Logo</label>
                        <div class="col-8 file-error">
                            <div class="image-input image-input-outline" id="kt_user_edit_logo">
                                <div class="image-input-wrapper"
                                    style="background-image: {{isset(Auth::user()->business_logo) ? 'url('.Auth::user()->business_logo.')':'none'}}">
                                </div>
                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="business_logo" accept=".png, .jpg, .jpeg">
                                    <input type="hidden" name="profile_avatar_remove">
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="cancel" data-toggle="tooltip" title=""
                                    data-original-title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                            <p class="mt-3 error-file">Recommended Size: 400px x 400px</p>
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-4 text-lg-right text-left">Business
                            Name
                        </label>
                        <div class="col-8">
                            <input name="business_name" class="form-control form-control-lg form-control-solid"
                                type="text" value="{{Auth::user()->business_name}}">
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-4 text-lg-right text-left">Contact
                            Phone <i class="flaticon2-information mt-1 cursor-pointer info_send_email" data-html="true"
                                data-placement="top" data-toggle="popover"
                                data-content="You can't change your contact number, Please contact Administrator"></i></label>
                        <div class="col-8">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-phone"></i>
                                    </span>
                                </div>
                                <input disabled type="text" name="phone"
                                    class="form-control form-control-lg form-control-solid"
                                    value="{{ Auth::user()->phone }}" placeholder="Phone">
                            </div>
                        </div>
                    </div>
                    <!--end::Group-->



                    <!--begin::Group-->
                    <div class="form-group row">
                        <div class="col-4 text-lg-right text-left">
                            <i class="flaticon2-pen"></i>
                            <input class="col-10 gst_text border-0 col-form-label" name="gst_text" style="outline: none"
                                type="text" value="{{ Auth::user()->gst_text ?? 'GST Number' }}">
                        </div>

                        <div class="col-8">
                            <div class="input-group">
                                <input name="gst_number" class="form-control form-control-lg form-control-solid"
                                    type="text" value="{{Auth::user()->gst_number ?? ''}}">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <label class="checkbox checkbox-single checkbox-primary">
                                            <input type="checkbox" name="show_gst"
                                                {{ Auth::user()->show_gst ? 'checked' : '' }} />
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <div class="col-4 text-lg-right text-left">
                            <i class="flaticon2-pen"></i>
                            <input class="col-10 pan_text border-0 col-form-label" name="pan_text" style="outline: none"
                                type="text" value="{{ Auth::user()->pan_text ?? 'PAN Number' }}">
                        </div>

                        <div class="col-8">
                            <div class="input-group">
                                <input name="pan_number" class="form-control form-control-lg form-control-solid"
                                    type="text" value="{{Auth::user()->pan_number ?? ''}}">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <label class="checkbox checkbox-single checkbox-primary">
                                            <input type="checkbox" name="show_pan"
                                                {{ Auth::user()->show_pan ? 'checked' : '' }} />
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--end::Group-->



                    <!--begin::Group-->
                    <div class="form-group row">
                        <div class="col-4 text-lg-right text-left">
                            <i class="flaticon2-pen"></i>
                            <input class="col-10 cin_text border-0 col-form-label" name="cin_text" style="outline: none"
                                type="text" value="{{ Auth::user()->cin_text ?? 'CIN Number' }}">
                        </div>
                        <div class="col-8">
                            <div class="input-group">
                                <input name="cin_number" class="form-control form-control-lg form-control-solid"
                                    type="text" value="{{Auth::user()->cin_number ?? ''}}">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <label class="checkbox checkbox-single checkbox-primary">
                                            <input type="checkbox" name="show_cin"
                                                {{ Auth::user()->show_cin ? 'checked' : '' }} />
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Group-->


                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-4 text-lg-right text-left">Company
                            Website</label>
                        <div class="col-8">
                            <div class="input-group input-group-solid">
                                <div class="input-group-append">
                                    <span class="input-group-text">www.</span>
                                </div>
                                <input type="text" name="business_site" id="company_site"
                                    class="form-control form-control-solid  form-control-lg "
                                    placeholder="yourwebsite.com" value="{{Auth::user()->business_site}}" />
                            </div>
                        </div>
                    </div>
                    <!--end::Group-->


                    @if(Auth::user()->role == 'broker')
                    <div class="my-5 broker_info" >
                        <div class="separator separator-dashed my-10"></div>
                        <h3 class="text-dark font-weight-bold mb-10">Broker Info</h3>

                        <div class="form-group row">
                            <label class="col-3">
                                Upload Scanned Pancard Copy
                            </label>

                            <div class="col-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        id="broker_pancard_document" name="broker_pancard_document">
                                    <label class="custom-file-label" for="customFile">
                                    </label>
                                </div>
                                <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                            </div>
                        </div>

                        @if (isset($user->broker_pancard_document))
                            <div class="form-group row crm_document_div">
                                <label class="col-3">
                                    File
                                </label>
                                <div></div>
                                <div class="col-9">
                                    <div class="custom-file">
                                        <a href="{{ url('storage/broker_pancard_document/' . $user->broker_pancard_document) }}"
                                            data-fancybox
                                            data-caption="Upload Scanned pancard Copy">
                                            <i class="fa fa-file fa-4x " ></i>
                                        </a>
                                    </div>
                                </div>

                                <a href="image.jpg" data-fancybox
                                    data-caption="Caption for single image">
                                    <img src="thumbnail.jpg" alt="" />
                                </a>

                            </div>
                        @endif

                        <div class="form-group row">
                            <label class="col-3">
                                Upload Scanned CMR Copy
                            </label>

                            <div class="col-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        id="broker_crm_document" name="broker_crm_document">
                                    <label class="custom-file-label" for="customFile">
                                    </label>
                                </div>
                                <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                            </div>
                        </div>

                        @if (isset($user->broker_crm_document))
                            <div class="form-group row crm_document_div">
                                <label class="col-3">
                                    File
                                </label>
                                <div></div>
                                <div class="col-9">
                                    <div class="custom-file">
                                        <a href="{{ url('storage/broker_crm_document/' . $user->broker_crm_document) }}"
                                            data-fancybox
                                            data-caption="Upload Scanned CMR Copy">
                                            <i class="fa fa-file fa-4x " ></i>
                                        </a>
                                    </div>
                                </div>

                                <a href="image.jpg" data-fancybox
                                    data-caption="Caption for single image">
                                    <img src="thumbnail.jpg" alt="" />
                                </a>

                            </div>
                        @endif

                        <div class="form-group row">
                            <label class="col-3">
                                Broker Cancelled Cheque
                            </label>

                            <div class="col-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        id="broker_cancelled_cheque"
                                        name="broker_cancelled_cheque">
                                    <label class="custom-file-label" for="customFile">
                                    </label>
                                </div>
                                <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                            </div>
                        </div>

                        @if (isset($user->broker_cancelled_cheque))
                            <div class="form-group row crm_document_div">
                                <label class="col-3">
                                    File
                                </label>
                                <div></div>
                                <div class="col-9">
                                    <div class="custom-file">
                                        <a href="{{ url('storage/broker_cancelled_cheque/' . $user->broker_cancelled_cheque) }}"
                                            data-fancybox
                                            data-caption="Broker Cancelled Cheque">
                                            <i class="fa fa-file fa-4x " ></i>
                                        </a>
                                    </div>
                                </div>

                                <a href="image.jpg" data-fancybox
                                    data-caption="Caption for single image">
                                    <img src="thumbnail.jpg" alt="" />
                                </a>

                            </div>
                        @endif

                        <div class="form-group row">
                            <label class="col-3">
                                Franchise Agreement
                            </label>

                            <div class="col-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        id="broker_agreement"
                                        name="broker_agreement">
                                    <label class="custom-file-label" for="customFile">
                                    </label>
                                </div>
                                <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                            </div>
                        </div>

                        @if (isset($user->broker_agreement))
                            <div class="form-group row broker_agreement_div">
                                <label class="col-3">
                                    File
                                </label>
                                <div></div>
                                <div class="col-9">
                                    <div class="custom-file">
                                        <a href="{{ url('storage/broker_agreement/' . $user->broker_agreement) }}"
                                            data-fancybox data-caption=" Franchise Agreement">
                                            <i class="fa fa-file fa-4x " ></i>
                                        </a>
                                    </div>
                                </div>

                                <a href="image.jpg" data-fancybox
                                    data-caption="Caption for single image">
                                    <img src="thumbnail.jpg" alt="" />
                                </a>

                            </div>
                        @endif

                        <div class="form-group row">
                            <label class="col-3">Business </label>
                            <div class="col-9">
                                <select name="broker_business" id="broker_business"
                                    class="form-control "> 
                                    @foreach (config('data.business_of_broker') as $business)
                                        <option value="{{ $business }}" @if (isset($user->broker_business) && $user->broker_business == $business) selected  @endif> {{ $business }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row upload_certificate_div" @if((isset($user) && $user->role == 'broker' && $user->broker_business == 'Individual') || !isset($user->role)) style="display:none" @endif>
                            <label class="col-3">
                                Upload Certificate Copy
                            </label>

                            <div class="col-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        id="broker_upload_certificate_copy"
                                        name="broker_upload_certificate_copy">
                                    <label class="custom-file-label" for="customFile">
                                    </label>
                                </div>
                                <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                            </div>
                        </div>

                        @if (isset($user->broker_upload_certificate_copy))
                        <div class="form-group row upload_certificate_div" @if(isset($user) && $user->role == 'broker' && $user->broker_business == 'Individual') style="display:none" @endif>
                                <label class="col-3">
                                    File
                                </label>
                                <div></div>
                                <div class="col-9">
                                    <div class="custom-file">
                                        <a href="{{ url('storage/broker_upload_certificate_copy/' . $user->broker_upload_certificate_copy) }}"
                                            data-fancybox
                                            data-caption=" Upload Certificate Copy">
                                            <i class="fa fa-file fa-4x " ></i>
                                        </a>
                                    </div>
                                </div>

                                <a href="image.jpg" data-fancybox
                                    data-caption="Caption for single image">
                                    <img src="thumbnail.jpg" alt="" />
                                </a>

                            </div>
                        @endif

                        <div class="form-group row">
                            <label class="col-3">GST Compliant</label>
                            <div class="col-9">
                                <select name="broker_gst_compliant" id="broker_gst_compliant"
                                    class="form-control ">
                                    @foreach (config('data.gst_compliant') as $gst_compliant)
                                        <option value="{{ $gst_compliant }}" @if (isset($user->broker_gst_compliant) && $user->broker_gst_compliant == $gst_compliant) selected  @endif>
                                            {{ $gst_compliant }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row broker_gst_compliant_div" @if(isset($user) && $user->role == 'broker' && $user->broker_gst_compliant == 'No') style="display:none" @endif>
                            <label class="col-3">
                                Upload Declaration
                            </label>

                            <div class="col-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        id="broker_upload_declaration"
                                        name="broker_upload_declaration">
                                    <label class="custom-file-label" for="customFile">
                                    </label>
                                </div>
                                <div>Allowed (.pdf, .png, .jpeg, .jpg) file-types only</div>
                            </div>
                        </div>

                        @if (isset($user->broker_upload_declaration))
                        <div class="form-group row broker_gst_compliant_div" @if(isset($user) && $user->role == 'broker' && $user->broker_gst_compliant == 'No') style="display:none" @endif>
                                <label class="col-3">
                                    File
                                </label>
                                <div></div>
                                <div class="col-9">
                                    <div class="custom-file">
                                        <a href="{{ url('storage/broker_upload_declaration/' . $user->broker_upload_declaration) }}"
                                            data-fancybox data-caption=" Upload Declaration">
                                            <i class="fa fa-file fa-4x " ></i>
                                        </a>
                                    </div>
                                </div>

                                <a href="image.jpg" data-fancybox
                                    data-caption="Caption for single image">
                                    <img src="thumbnail.jpg" alt="" />
                                </a>

                            </div>
                        @endif
                    </div>
                    @endif

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
                            <button id="business_info_form_submit" class="btn btn-light-primary font-weight-bold">
                                Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Footer-->
    </form>
</div>

