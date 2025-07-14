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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Invoice Settings</h1>
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
                        <li class="breadcrumb-item text-muted">Invoice Settings</li>
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
            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-success pb-4 active" data-bs-toggle="tab" href="#options1">Layout Settings</a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-success pb-4" data-bs-toggle="tab" href="#options2">Taxes</a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-success pb-4" data-bs-toggle="tab" href="#options3">Currency</a>
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="options1" role="tab-panel">
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <form action="{{ route('settings.invoice.layout') }}" enctype="multipart/form-data" class="global-ajax-form">
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Client's Company Info & Logo Position</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 my-auto">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-row">
                                                    <div class=" form-check-solid form-switch form-check-success fv-row">
                                                        <label class="form-check-label" for="allowmarketing" style="margin-left:-54px; margin-right:70px">Left</label>
                                                        <input class="form-check-input w-45px h-30px" type="checkbox" id="allowmarketing" name="company_info_position" @if(isset($adminsetting->invoice_settings['company_info_position'])
                                                        && $adminsetting->invoice_settings['company_info_position'] == 'right')
                                                        checked="checked"
                                                        @endif>
                                                        <label class="form-check-label ms-7" for="allowmarketing">Right</label>
                                                    </div>

                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6"><i class="bi bi-pencil"></i> Default
                                            <input class="sac_text border-0 col-form-label" name="sac_text" style="outline: none" type="text" value="{{ $adminsetting->sac_text ?? 'SAC Code' }}"></label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 my-auto">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-row">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="sac_code" placeholder="{{ $adminsetting->sac_text ?? 'SAC Code' }}" value="{{$adminsetting->sac_code ?? ''}}" />
                                                        <span class="input-group-text" id="basic-addon3" style="border: 1px solid #E5EAEE;">
                                                            <input class="form-check-input" type="checkbox" name="show_sac" {{ ($adminsetting->show_sac ?? '') ? 'checked' : '' }} />
                                                        </span>
                                                    </div>
                                                    <span class="form-text text-muted mb-5">This you can change item-wise on every invoice.</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6 my-auto">Invoice Number</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 my-auto">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-row">
                                                    <div class="form-group">
                                                        <div class="radio-list">
                                                            <label class="radio mb-2">
                                                                <input type="radio" class="form-check-input mb-3"  name="invoice_number_format" value="monthly" @if(($adminsetting->invoice_settings['invoice_number_format']['format'] ?? false) == 'monthly') checked @endif />
                                                                Every month from 1st day, start invoicing with <b>mmyyyy-001</b> & increment by 1
                                                                number.
                                                                <span></span>
                                                            </label> <br>

                                                            <label class="radio mb-2">
                                                                <input type="radio" class="form-check-input mb-3"  name="invoice_number_format" value="random_number" @if(($adminsetting->invoice_settings['invoice_number_format']['format'] ?? false) == 'random_number') checked @endif /> Random
                                                                <input class="underline-input border-top-0 border-left-0 border-right-0" name="number_length" min="6" max="15" value="{{$adminsetting->invoice_settings['invoice_number_format']['number_length'] ?? 8}}" type="number" style="width: 60px"> Digit Number
                                                                <span></span>
                                                            </label><br>
                                                            <label class="radio mb-2">
                                                                <input type="radio" class="form-check-input mb-3"  name="invoice_number_format" value="random_string" @if(($adminsetting->invoice_settings['invoice_number_format']['format'] ?? false) == 'random_string') checked @endif /> Random
                                                                <input class="underline-input border-top-0 border-left-0 border-right-0" name="str_length" min="6" max="15" value="{{$adminsetting->invoice_settings['invoice_number_format']['str_length'] ?? 8}}" type="number" style="width: 60px">
                                                                Character String
                                                                <span></span>
                                                            </label><br>
                                                            <label class="radio mb-2">
                                                                <input type="radio" class="form-check-input mb-3"  name="invoice_number_format" value="custom" @if(($adminsetting->invoice_settings['invoice_number_format']['format'] ?? false) == 'custom') checked @endif />
                                                                Number Starting with
                                                                <input class="underline-input border-top-0 border-left-0 border-right-0" name="str_number" type="text" value="{{$adminsetting->invoice_settings['invoice_number_format']['str_number'] ?? 'abc001'}}" style="width: 153px"> & Increment
                                                                by <input class="underline-input border-top-0 border-left-0 border-right-0" name="str_number_increment" min="1" value="{{$adminsetting->invoice_settings['invoice_number_format']['str_number_increment'] ?? '5'}}" type="number" style="width: 60px"> numbers
                                                                <span></span>
                                                            </label><br>
                                                        </div>
                                                        <span class="form-text text-muted">In above case, first invoice number will be ABC1001, next
                                                            will be ABC1006 and then ABC1011 and so on.</span>
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6 my-auto">Upload stamp image</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 file-error">
                                            <!--begin::Image input-->
                                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{asset('assets/media/avatars/blank.png')}})">
                                                <!--begin::Preview existing avatar-->
                                                <div class="image-input-wrapper w-125px h-125px" id="kt_client_add_logo" style="background-image: {{ (!empty($adminsetting->stemp_image)) ? 'url(' . storage_asset('/stemp_image/'.auth()->user()->id.'/'.$adminsetting->stemp_image) . ')' : 'none' }}">
                                                </div>
                                                <!--end::Preview existing avatar-->
                                                <!--begin::Label-->
                                                <label class="btn btn-icon btn-circle btn-active-color-success w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                    <i class="ki-outline ki-pencil fs-7"></i>
                                                    <!--begin::Inputs-->
                                                    <input type="file" name="stemp_image" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="profile_image" />
                                                    <!--end::Inputs-->
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Cancel-->
                                                <span class="btn btn-icon btn-circle btn-active-color-success w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                    <i class="ki-outline ki-cross fs-2"></i>
                                                </span>
                                                <!--end::Cancel-->
                                                @if(!empty($adminsetting->stemp_image))
                                                <!--begin::Remove-->
                                                <span class="btn btn-icon btn-circle btn-active-color-success w-25px h-25px bg-body shadow remove-file" data-kt-image-input-action="remove" data-id="{{auth()->user()->id}}" data-col="stemp_image" data-table="users" data-file="{{'/stemp_image/'.auth()->user()->id.'/'.$adminsetting->stemp_image}}" data-bs-toggle="tooltip" title="Remove avatar">
                                                    <i class="ki-outline ki-cross fs-2"></i>
                                                </span>
                                                <!--end::Remove-->
                                                @endif
                                            </div>
                                            <!--end::Image input-->
                                            <!--begin::Hint-->
                                            <div class="form-text error-file">Allowed file types: png, jpg, jpeg.</div>
                                            <!--end::Hint-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Actions-->
                                    <div class="card-footer d-flex justify-content-end py-6 px-9 pe-0">
                                        <!--begin::Button-->
                                        <button type="submit" id="layout_settings_form_submit" class="btn btn-primary">
                                            <span class="indicator-label">Save Changes</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Actions-->
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade" id="options2" role="tab-panel">
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <div class="row">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary" data-bs-target="#taxModal" id="add_tax_btn" data-bs-toggle="modal">New Tax</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="taxesSettingsTable" th:fragment="table" width="100%">
                                        <!--begin::Table head-->
                                        <thead>
                                            <!--begin::Table row-->
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                <th>Tax Name</th>
                                                <th>Tax %</th>
                                                <th class="min-w-100px">Actions</th>
                                            </tr>
                                            <!--end::Table row-->
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="text-gray-600 fw-semibold" id="taxes_table_body">

                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade" id="options3" role="tab-panel">
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <form action="{{ route('settings.invoice.currency') }}" class="global-ajax-form">
                                    <!--begin::Input group-->
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Invoice Currency</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 my-auto">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-12 fv-row">
                                                    <select class="form-control" data-control="select2" name="currency">
                                                        @foreach (config('data.currencies') as $key => $value)
                                                        @if(isset($adminsetting->invoice_settings['currency']) &&
                                                        $adminsetting->invoice_settings['currency'] == $key)
                                                        <option value="{{$key}}" selected>{!!$value['code']!!} {{$value['name']}}</option>
                                                        @else
                                                        <option value="{{$key}}">{!!$value['code']!!} {{$value['name']}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Actions-->
                                    <div class="card-footer d-flex justify-content-end py-6 px-9 pe-0">
                                        <!--begin::Button-->
                                        <button type="submit" id="currency_settings_form_submit" class="btn btn-primary">
                                            <span class="indicator-label">Save Changes</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Actions-->
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end::Tab pane-->
                </div>
                <!--end::Tab content-->
            </div>
            <!--end::Main column-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

    <div class="modal fade" id="taxModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-7 d-flex justify-content-between">
                    <h2 id="taxModalLabel">Create Tax</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-success" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y m-5 mt-0">
                    <form id="tax_form" class="global-ajax-form" action="{{ route('settings.invoice.tax') }}" data-redirect-url="{{ url('settings/invoice') }}" method="post">
                        <div class="form-group">
                            <label for="tax_name" class="col-form-label">Tax Name:</label>
                            <input type="text" class="form-control" name="tax_name">
                        </div>
                        <div class="form-group">
                            <label for="tax_percent" class="col-form-label">Tax %:</label>
                            <input type="number" step="0.01" class="form-control" name="tax_percent">
                        </div>
                        <input type="hidden" class="form-control" name="tax_order">
                        <div class="row mt-10">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary" id="tax_form_submit" data-bs-dismiss="modal">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @push('scripts')
        <script>
            var tbody = document.getElementById("taxes_table_body");

            function calcuateOrder(updateOnServer) {
                let data = [];

                $(tbody).find("tr").each(function(index) {
                    $(this).attr('data-tax-order', index);
                    data.push({
                        'name': $(this).find('[data-tax-name]').attr('data-tax-name'),
                        'percent': $(this).find('[data-tax-percent]').attr('data-tax-percent'),
                    });
                });

                if (updateOnServer) {

                    $.post(base_url + '/invoice-settings/taxes/set-order', {
                        taxes: data
                    });
                }
                return data.length;
            }

            var addTaxtModal = document.querySelector('#add_tax_btn');
            addTaxtModal.addEventListener('click', function() {
                $('input[name="tax_name"]').val('');
                $('input[name="tax_percent"]').val('');
                $('#taxModalLabel').text('Create Tax');
                $('input[name="tax_order"]').val(calcuateOrder());
            })

            function renderTable(data) {
                var taxes = data;
                tbody.innerHTML = '';

                if (!Array.isArray(data)) {
                    taxes = [];
                    for (let key in data) {
                        taxes.push(data[key]);
                    }
                }

                taxes.forEach(function(tax, index) {
                    var row = `
				<tr class="datatable-row" style="left: 0px;" data-tax-order="${index}">
					<td class="datatable-cell">
						<span style="width: 112px;" data-tax-name='${tax.name}'>${tax.name}</span></td>
					<td class="datatable-cell"><span data-tax-percent='${tax.percent}'
							style="width: 85px;">${tax.percent}%</span></td>
					<td class="datatable-cell-left datatable-cell">
						<span class="d-flex">
							<a href="javascript:;"
								class="edit_tax_btn btn btn-sm btn-clean btn-icon mr-2"
								title="Edit details">
								<i class="bi bi-pencil"></i> </a>
							<a href="javascript:;"
								class="delete_tax_btn btn btn-sm btn-clean btn-icon" title="Delete">
								<i class="bi bi-trash"></i>
							</a>
						</span>
					</td>
				</tr>
				`;
                    tbody.innerHTML += row;
                });
                calcuateOrder();
            }

            $(function() {
                $.get(base_url + '/settings/getTaxes', renderTable);
            });

            $('body').on('click', '.edit_tax_btn', function(e) {
                e.preventDefault();
                $('#taxModal').modal('show');
                $('#taxModalLabel').text('Edit Tax');
                var $tr = $(this).closest('tr');
                $('input[name="tax_name"]').val($tr.find('[data-tax-name]').attr('data-tax-name'));
                $('input[name="tax_percent"]').val($tr.find('[data-tax-percent]').attr('data-tax-percent'));
                $('input[name="tax_order"]').val($tr.attr('data-tax-order'));
                $('#addtaxModal').modal('show');
            });

            $('body').on('click', '.delete_tax_btn', function(e) {
                e.preventDefault();

                var $tr = $(this).closest('tr');
                var name = $tr.find('[data-tax-name]').attr('data-tax-name');
                Swal.fire({
                    title: "Are you sure?",
                    text: "Delete tax: " + name + "?",
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
                            url: base_url + '/settings/deleteTaxes?id=' + $tr.attr('data-tax-order'),
                            type: 'DELETE'
                        }).done(function(data) {
                            renderTable(data);
                            return data;
                        });
                    }
                });
            })
        </script>
        @endpush
</x-app-layout>
