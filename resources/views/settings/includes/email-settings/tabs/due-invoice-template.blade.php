<div class="tab-pane px-7" id="due_invoice_template" role="tabpanel">
    <form id="due_invoice_email_form">
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-12 my-2">
                <!--begin::Row-->
                <div class="row">
                    <label class="col-3"></label>
                    <div class="col-9">
                        <h6 class="text-dark font-weight-bold mb-10">
                            Due Invoice Template</h6>
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Group-->

                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left">Email Subject</label>
                    <div class="col-9">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="las la-envelope"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control form-control-lg form-control-solid" name="subject"
                                value="{{ $adminsetting->email_settings['mails']['invoice_due']['subject'] }}"
                                placeholder="Your Invoice is Due!">
                        </div>
                    </div>
                </div>
                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left">Email Body</label>
                    <div class="col-9">
                        <div id="due_invoice_email_quil" style="height: 325px">
                            {!! $adminsetting->email_settings['mails']['invoice_due']['message'] !!}
                        </div>
                        <input type="hidden" name="message">

                    </div>
                </div>
                <!--end::Group-->
                <div class="col-12 text-center">
                    <button type="submit" id="due_invoice_email_form_submit"
                        class="btn btn-light-primary font-weight-bold">
                        Save</button>
                </div>
            </div>
        </div>
        <!--end::Row-->
    </form>
</div>