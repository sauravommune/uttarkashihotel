<div class="tab-pane px-7" id="taxes" role="tabpanel">
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12 my-2">
            <!--begin::Row-->
            <div class="row">
                <div class="col-12">

                    <!--Taxes Table-->
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-toolbar float-right">
                            <!--begin::Button-->
                            <a href="javascript:;" id="add_tax_btn" class="btn btn-primary font-weight-bolder">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo2\dist/../src/media/svg/icons\Code\Plus.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                            <path
                                                d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                    <!--end::Svg Icon-->
                                </span>New Tax</a>
                            <!--end::Button-->
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <div class="datatable datatable-bordered 
datatable-head-custom datatable-default 
datatable-primary datatable-loaded" id="kt_datatable" style="">
                            <table class="datatable-table" style="display: block;">
                                <thead class="datatable-head">
                                    <tr class="datatable-row" style="left: 0px;">
                                        <th class="datatable-cell datatable-cell-sort">
                                            <span style="width: 105px;" class="text-left">Tax Name</span></th>
                                        <th class="datatable-cell datatable-cell-sort">
                                            <span style="width: 95px;" class="text-left">Tax %</span></th>
                                        <th class="datatable-cell datatable-cell datatable-cell-sort">
                                            <span style="width: 118px;" class="text-left">Actions</span></th>
                                    </tr>
                                </thead>
                                <tbody class="datatable-body" id="taxes_table_body">

                                </tbody>
                            </table>


                        </div>

                        <!--end: Datatable-->

                    </div>
                    <!--Taxes Table Ends-->

                </div>
            </div>
            <!--end::Row-->
        </div>
    </div>
    <!--end::Row-->
</div>


<div class="modal fade" id="taxModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="taxModal"
    >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="tax_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="taxModalLabel">Create Tax</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i  class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tax_name" class="col-form-label">Tax Name:</label>
                        <input type="text" class="form-control" name="tax_name">
                    </div>
                    <div class="form-group">
                        <label for="tax_percent" class="col-form-label">Tax %:</label>
                        <input type="number" step="0.01" class="form-control" name="tax_percent">
                    </div>
                    <input type="hidden" class="form-control" name="tax_order">
                </div>
                <div class="modal-footer">
                    <button type="submit" id="tax_form_submit" class="btn btn-primary" form="tax_form">
                        Create Tax
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>