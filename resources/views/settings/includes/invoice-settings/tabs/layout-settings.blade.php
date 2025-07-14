<style>
    .radio .underline-input {
        outline: none;
        opacity: 1;
        position: relative;
        z-index: 1;
    }
</style>
<div class="tab-pane show active px-7" id="layout_settings" role="tabpanel">
    <form id="layout_settings_form">
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-7 my-2">
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">{{ "Client's Company Info & Logo Position"}}</label>
                    <div class="col-lg-8">

                        <div class="form-group row">
                            <label class="col-3 col-form-label text-right">Left</label>
                            <span class="switch switch-success">
                                <label>
                                    <input type="checkbox"
                                        @if(isset($adminsetting->invoice_settings['company_info_position'])
                                    && $adminsetting->invoice_settings['company_info_position'] == 'right')
                                    checked="checked"
                                    @endif
                                    name="company_info_position" />
                                    <span></span>
                                </label>
                            </span>
                            <label class="col-3 col-form-label">Right</label>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-4 text-lg-right text-left">
                        <label class="col-form-label text-lg-right text-left">
                            Default
                        </label>
                        <i class="flaticon2-pen"></i>
                        <input class="col-6 pr-0 pl-0 sac_text border-0 col-form-label" name="sac_text"
                            style="outline: none" type="text" value="{{ $adminsetting->sac_text ?? 'SAC Code' }}">
                    </div>

                    <div class="col-8">
                        <div class="input-group">
                            <input name="sac_code" class="form-control form-control-lg form-control-solid" type="text"
                                value="{{$adminsetting->sac_code ?? ''}}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <label class="checkbox checkbox-single checkbox-primary">
                                        <input type="checkbox" name="show_sac"
                                            {{ $adminsetting->show_sac ? 'checked' : '' }} />
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                        <span class="form-text text-muted">This you can change item-wise on every invoice.</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-4 text-left">Invoice Number</label>
                    <div class="col-8">

                        <div class="form-group">
                            <div class="radio-list">
                                <label class="radio">
                                    <input type="radio" name="invoice_number_format" value="monthly"
                                        @if(($adminsetting->invoice_settings['invoice_number_format']['format'] ??
                                    false)
                                    == 'monthly')
                                    checked
                                    @endif
                                    />
                                    Every month from 1st day, start invoicing with <b>mmyyyy-001</b> & increment by 1
                                    number.
                                    <span></span>
                                </label>

                                <label class="radio">
                                    <input type="radio" name="invoice_number_format" value="random_number"
                                        @if(($adminsetting->invoice_settings['invoice_number_format']['format'] ??
                                    false)
                                    == 'random_number')
                                    checked
                                    @endif
                                    /> Random
                                    <input class="underline-input border-top-0 border-left-0 border-right-0"
                                        name="number_length" min="6" max="15"
                                        value="{{$adminsetting->invoice_settings['invoice_number_format']['number_length'] ?? 8}}"
                                        type="number" style="width: 60px"> Digit Number
                                    <span></span>
                                </label>
                                <label class="radio">
                                    <input type="radio" name="invoice_number_format" value="random_string"
                                        @if(($adminsetting->invoice_settings['invoice_number_format']['format'] ??
                                    false)
                                    == 'random_string')
                                    checked
                                    @endif
                                    /> Random
                                    <input class="underline-input border-top-0 border-left-0 border-right-0"
                                        name="str_length" min="6" max="15"
                                        value="{{$adminsetting->invoice_settings['invoice_number_format']['str_length'] ?? 8}}"
                                        type="number" style="width: 60px">
                                    Character String
                                    <span></span>
                                </label>
                                <label class="radio">
                                    <input type="radio" name="invoice_number_format" value="custom"
                                        @if(($adminsetting->invoice_settings['invoice_number_format']['format'] ??
                                    false)
                                    == 'custom')
                                    checked
                                    @endif
                                    />
                                    Number
                                    Starting with
                                    <input class="underline-input border-top-0 border-left-0 border-right-0"
                                        name="str_number" type="text"
                                        value="{{$adminsetting->invoice_settings['invoice_number_format']['str_number'] ?? 'abc001'}}"
                                        style="width: 153px"> & Increment
                                    by <input class="underline-input border-top-0 border-left-0 border-right-0"
                                        name="str_number_increment" min="1"
                                        value="{{$adminsetting->invoice_settings['invoice_number_format']['str_number_increment'] ?? '5'}}"
                                        type="number" style="width: 60px">
                                    numbers
                                    <span></span>
                                </label>
                            </div>
                            <span class="form-text text-muted">In above case, first invoice number will be ABC1001, next
                                will be ABC1006 and then ABC1011 and so on.</span>
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-4 text-left">Upload stamp image</label>
                    <div class="col-8">


                        <div class="image-input {{empty($adminsetting->stemp_image) ? 'image-input-empty' : ''}} image-input-outline"
                            id="stemp_logo">
                            <div style="background-image: {{!empty($adminsetting->stemp_image) ? 'url('.$adminsetting->stemp_image.')':'none'}}"
                                class="image-input-wrapper"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title="" data-original-title="Select Logo">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="stemp_image" accept=".png, .jpg, .jpeg">
                                <input type="hidden" name="logo_remove" />
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="cancel" data-toggle="tooltip" title="Cancel logo">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="remove" data-toggle="tooltip" title="Remove logo">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            
                        </div>
                        <p class="mt-3">Recommended Size: 400px x 400px</p>
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
                    <button type="save" id="layout_settings_form_submit" class="btn btn-light-primary font-weight-bold">
                        Save</a></h6>
            </div>
        </div>
        <!--end::Row-->
    </form>
</div>