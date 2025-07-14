<div class="tab-pane px-7" id="taxation_info" role="tabpanel">
    <form id="business_tax_form">
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-7">
                    <!--begin::Row-->
                    <div class="row">
                        <label class="col-3"></label>
                        <div class="col-9">
                            <h6 class="text-dark font-weight-bold mb-10">
                                Taxation Info</h6>
                        </div>
                    </div>
                    <!--end::Row-->

                    <!--begin::Group-->
                    <div class="form-group row">
                        <div class="col-4 text-lg-right text-left">
                            <i class="flaticon2-pen"></i>
                            <input class="col-10 gst_text border-0 col-form-label" name="gst_text"
                                style="outline: none" type="text"
                                value="{{ Auth::user()->gst_text ?? 'GST Number' }}">
                        </div>
                        
                        <div class="col-8">
                            <div class="input-group">
                                <input name="gst_number"
                                class="form-control form-control-lg form-control-solid"
                                type="text" value="{{Auth::user()->gst_number ?? ''}}">                                                                            <div class="input-group-append">
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
                            <input class="col-10 pan_text border-0 col-form-label" name="pan_text"
                                style="outline: none" type="text"
                                value="{{ Auth::user()->pan_text ?? 'PAN Number' }}">
                        </div>
                        
                        <div class="col-8">
                            <div class="input-group">
                                <input name="pan_number"
                                class="form-control form-control-lg form-control-solid"
                                type="text" value="{{Auth::user()->pan_number ?? ''}}">                                                                            <div class="input-group-append">
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
                    <!--begin::Group
                <div class="form-group row">
                    <label
                        class="col-form-label col-3 text-lg-right text-left">Default
                        SAC Code</label>
                    <div class="col-9">
                        <input
                            class="form-control form-control-lg form-control-solid"
                            type="text" value="00440452">
                        <span class="form-text text-muted">This you can
                            change item-wise on every invoice.</span>
                    </div>
                </div>
                end::Group-->
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
                        <div class="col-3"></div>
                        <div class="col-9">
                            <button type="submit" id="business_tax_form_submit"
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