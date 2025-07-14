var invoices_table = function() {
    var table = null;
    var manual_payment_fv = null;
    var manual_payment_id = null;

    var _handleDataTable = function() {
        //server side
        if ($('#invoices_datatable').length == 0) {
            return;
        }

        $.fn.dataTable.Api.register('column().title()', function() {
            return $(this.header()).text().trim();
        });

        table = $('#invoices_datatable').DataTable({
            responsive: true,
            "aaSorting": [],
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html

            language: {
                'lengthMenu': 'Display _MENU_',
            },
            searchDelay: 500,
            processing: true,
            serverSide: true,

            ajax: {
                url: base_url+'/invoices/datatables',
                type: 'GET',
                data: {
                    // parameters for custom backend script demo
                    columnsDef: [
                        'id', 'client_name', 'email', 'created_at', 'due_date', 'amount', 'payment_date', 'payment_method', 'status', 'actions'
                    ],
                },
				error: function (x, status, error) {
					handleError(x, status, error);
				},
            },
            buttons: [
                'print',
                'postExcel',
                'postCsv',
                'postPdf',
            ],

            columns: [
                { data: 'generated_id', name: 'invoices.generated_id' },
                { data: 'client_name', name: 'client_name' },
                { data: 'email', name: 'clients.email' },
                { data: 'issue_date', name: 'invoices.issue_date' },
                { data: 'due_date', name: 'invoices.due_date' },
                { data: 'amount', name: 'invoices.amount' },
                { data: 'status', name: 'invoices.status' },
                { data: 'payment_date', name: 'invoices.payment_date' },
                { data: 'payment_method', name: 'invoices.payment_method' },
                { data: 'invoice_type', name: 'invoices.invoice_type' },
                { data: 'actions', name: 'actions', responsivePriority: -1 }
            ],

            columnDefs: [{
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var remind_html = '';
                        var cancel_html = '';
                        var edit_invoice_html = '';
                        var make_payment_html = '';
                        var refund_html = '';

                        if (full.status == 'pending' || full.status == 'overdue') {
                            cancel_html = `<div class="menu-item px-3">
                                        <a href="javascript:void(0);" onclick="invoices_table.cancel(${data})" class="menu-link px-3"><i class="nav-icon la la-warning fs-2 me-2"></i> Cancel</a>
                                    </div>`;
                        }

                        if (full.status == 'pending' || full.status == 'overdue' || full.status == 'partially_paid' || full.status == 'draft') {
                            remind_html = `<div class="menu-item px-3">
                                            <a href="javascript:void(0);" onclick="invoices_table.remind(${data})" class="menu-link px-3"><i class="nav-icon la la-envelope fs-2 me-2"></i> Remind</a>
                                        </div>`;
                            edit_invoice_html = `<div class="menu-item px-3">
                                        <a href="${base_url}/invoices/${data}/edit" class="menu-link px-3"><i class="nav-icon la la-edit fs-2 me-2"></i> Edit Invoice</a>
                                    </div>`;
                            make_payment_html = `<div class="menu-item px-3">
                                    <a href="javascript:void(0);" onclick="invoices_table.makePayment(${data})" class="menu-link px-3"><i class="nav-icon la la-money-bill fs-2 me-2"></i> Make Payment</a>
                                </div>`;
                        }

                        if (full.status == 'partially_paid' || full.status == 'paid') {
                            cancel_html = '';
                            edit_invoice_html = '';
                            refund_html = `<div class="menu-item px-3">
                                            <a href="javascript:void(0);" onclick="invoices_table.refund(${data})" class="menu-link px-3"><i class="nav-icon la la-money-bill-wave fs-2 me-2"></i> Refund</a>
                                        </div>`;
                        }

                        if (full.status == 'draft') {
                            remind_html = '';
                            make_payment_html = '';
                        }
                        return `
                            <button type="button" class="btn btn-sm btn-clean btn-icon" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="la la-cog fs-2"></i>
                            </button>

                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                ${edit_invoice_html}
                                <div class="menu-item px-3">
                                    <a href="${base_url}/invoices/${data}" class="menu-link px-3"> <i class="nav-icon la la-eye fs-2 me-2"></i> View</a>
                                </div>

                                <div class="menu-item px-3">
                                    <a href="${base_url}/invoices/public/${full.public_id}" class="menu-link px-3"><i class="nav-icon la la-globe fs-2 me-2"></i> View Public</a>
                                </div>

                                <div class="menu-item px-3">
                                    <a href="${base_url}/invoices/${data}/history" class="menu-link px-3"><i class="nav-icon la la-history fs-2 me-2"></i> History</a>
                                </div>

                                ${refund_html}
                                ${make_payment_html}
                                ${remind_html}
                                ${cancel_html}

                                <div class="menu-item px-3">
                                    <a href="javascript:void(0);" onclick="invoices_table.duplicate('${full.generated_id}')" class="menu-link px-3"><i class="nav-icon la la-copy fs-2 me-2"></i> Duplicate</a>
                                </div>

                            </div>

                            <a href="javascript:void(0);" style="display: inline" onclick="invoices_table.delete(${data})" class="btn btn-sm btn-clean btn-icon" title="Delete">
                                <i class="la la-trash fs-2"></i>
                            </a>
                        `;
                    },
                },
                {
                    targets: 6,
                    render: function(data, type, full, meta) {
                        var status = {
                            'overdue': { 'class': ' badge-light-danger' },
                            'refunded': { 'class': ' badge-light-info' },
                            'partially_paid': { 'class': 'badge-light-primary' },
                            'paid': { 'class': ' badge-light-success' },
                            'cancelled': { 'class': ' badge-light-danger' },
                            'pending': { 'class': ' badge-light-warning' },
                            'draft': { 'class': ' badge-light-warning' },
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="badge badge-lg font-weight-bold' + status[data].class + '">' + data + '</span>';
                    },
                },
                {
                    "targets": [2, 9],
                    "visible": false,
                    orderable: false
                }
            ],
            "drawCallback": function( settings ) {
                KTMenu.createInstances();
            },
            "order": [
                [0, "desc"]
            ]
        });

        $('body').on('click', '[data-export]', function(e) {
            let type = $(this).attr('data-export');
            e.preventDefault();
            if (type == 'print') {
                table.button(0).trigger();
            }
            if (type == 'excel') {
                table.button(1).trigger();
            }
            if (type == 'csv') {
                table.button(2).trigger();
            }
            if (type == 'pdf') {
                table.button(3).trigger();
            }
        });

        $('.ajax-filter-btn').on('click', function(e) {
            e.preventDefault();
            var params = {};
            $('.datatable-input').each(function() {
                var i = $(this).data('col-index');
                if (params[i]) {
                    params[i] += '|' + $(this).val();
                } else {
                    params[i] = $(this).val();
                }
            });
            $.each(params, function(i, val) {
                // apply search params to datatable
                table.column(i).search(val ? val : '', false, false);
            });
            table.table().draw();
        });

        $('.ajax-reset-btn').on('click', function(e) {
            e.preventDefault();
            $('.datatable-input').each(function() {
                $(this).val('');
                table.column($(this).data('col-index')).search('', false, false);
            });
            $('.invoiceTypes').val(' ').trigger('change');
            $('.statusFilter').val(' ').trigger('change');
            table.table().draw();
        });

    }

    var _handleManualPayment = function() {
        var form = $('#manual_payment_form');

        if (!form) {
            return;
        }

        manual_payment_fv = form.validate({
            rules: {
                amount: {
                    required: true,
                    min: 1,
                    max: 99999999999999999999999,
                }
            },
            messages: {
                amount:{
                    required: "Amount is required.",
                    min: "Amount should be greater than 0",
                    max: "Amount should be less than 0"
                }
            },
            errorPlacement: function(error, element) {
                var placement = $(element).parents('div.input-group');
                if (placement.length > 0) {
                    $(placement).after(error);
                } else if( $(element).hasClass('form-select') ) {
                    $(element).parent().append(error);
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $('body').on('submit', '#manual_payment_form', function(e){
            e.preventDefault();
            if( form.valid() ){
                $.post({
                    url: base_url+'/invoices/' + manual_payment_id + '/manual-payment',
                    type: 'POST',
                    data: $('#manual_payment_form').serialize(),
                    success: function(data) {
                        table.ajax.reload(null, false);

                        Swal.fire({
                            text: "Payment has been recorded.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-light-primary"
                            }
                        });
                        form.trigger('reset');;
                        $('#manualPaymentModal').modal('hide');
                    },
                    error: function(data, status, error) {
                        if(data.status == 419 || data.status == 401){
                            handleError(data, status, error);
                        }
                        else{
                            var error = '';
                            for (let k in data.responseJSON.errors) {
                                error += data.responseJSON.errors[k][0];
                            }
                            Swal.fire({
                                text: error,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            });
                        }
                    }
                });
            }
        })
            
    }

    var deleteInvoice = function(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Delete invoice: #" + id + "?",
            icon: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Yes, delete it!",
            customClass: {
                confirmButton: 'btn-danger'
            },
            preConfirm: function() {
                return $.ajax({
                    url: base_url+'/invoices/' + id,
                    type: 'DELETE'
                }).done(function(data) {
                    return data;
                });
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                table.ajax.reload(null, false);
                Swal.fire(
                    "Deleted!",
                    "Invoice: #" + id + "  has been deleted.",
                    "success"
                )
            }
        });
    }


    var cancelInvoice = function(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Cancel invoice: #" + id + "?",
            icon: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Yes, cancel it!",
            customClass: {
                confirmButton: 'btn-danger'
            },
            preConfirm: function() {
                return $.ajax({
                    url: base_url+'/invoices/' + id + '/cancel',
                    type: 'POST'
                }).done(function(data) {
                    return data;
                });
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                table.ajax.reload(null, false);
                Swal.fire(
                    "Cancelled!",
                    "Invoice: #" + id + "  has been cancelled.",
                    "success"
                )
            }
        });
    }


    var sendReminder = function(id) {
        Swal.fire({
            title: "Send reminder?",
            text: "Send invoice due reminder email for invoice: #" + id + "?",
            icon: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Send",
            customClass: {
                confirmButton: 'btn-primary'
            },
            preConfirm: function() {
                return $.ajax({
                    url: base_url+'/invoices/' + id + '/remind',
                    type: 'POST'
                }).done(function(data) {
                    return data;
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    Swal.fire(
                        "Reminder Sent!",
                        "Reminder not sent for Invoice: #" + id + ".",
                        "error"
                    )
                });
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                table.ajax.reload(null, false);
                Swal.fire(
                    "Reminder Sent!",
                    "Reminder sent for Invoice: #" + id + ".",
                    "success"
                )
            }
        });
    }

    var manualPayment = function(id) {
        manual_payment_id = id;
        $.get(base_url+'/invoices/' + id, function(invoice) {
            $('#manualPaymentModal input[name="amount"]').val(invoice.total_remaining_amount);
            $('#manualPaymentModal [name="details"]').val('');
            $('#manualPaymentModal .title').text('Manual Payment for invoice #' + invoice.generated_id);
            $('#manualPaymentModal .currency').html(invoice.snapshot.currency_info.code);
            $('#manualPaymentModal').modal('show');
        });
    }

    var refundInvoice = function(id) {

        $.get(`${base_url}/invoices/${id}/refund`).done(function(data) {
            Swal.fire({
                title: "Refund invoice?",
                text: data,
                icon: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: "Make refund!",
                customClass: {
                    confirmButton: 'btn-danger'
                },
                preConfirm: function() {
                    return $.ajax({
                        url: `${base_url}/invoices/${id}/refund`,
                        type: 'POST'
                    }).done(function(data) {
                        return data;
                    });
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    table.ajax.reload(null, false);
                    Swal.fire(
                        "Refuned!",
                        "Invoice: #" + id + " has been refunded.",
                        "success"
                    );
                }
            });
        }).always(function() {
        });
    }

    var duplicateInvoice = function(generated_id) {
        Swal.fire({
            title: "Duplicate invoice",
            text: 'Do you want to duplicate Invoice#' + generated_id + '?',
            icon: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonText: "Duplicate!",
            customClass: {
                confirmButton: 'btn-success'
            },
            preConfirm: function() {
                return $.ajax({
                    url: base_url+'/invoices/' + generated_id + '/duplicate',
                    type: 'POST'
                }).done(function(data) {
                    return data;
                });
            }
        }).then(function(result) {
            if (result.isConfirmed) {
                table.ajax.reload(null, false);
                Swal.fire(
                    "Duplicated!",
                    "New invoice: #" + result.value.generated_id + " has been created.",
                    "success"
                );
            }
        });
    }

    return {
        init: function() {
            _handleDataTable();
            _handleManualPayment();
        },
        cancel: function(id) {
            cancelInvoice(id);
        },
        delete: function(id) {
            deleteInvoice(id);
        },
        remind: function(id) {
            sendReminder(id);
        },
        makePayment: function(id) {
            manualPayment(id);
        },
        refund: function(id) {
            refundInvoice(id);
        },
        duplicate: function(generated_id) {
            duplicateInvoice(generated_id);
        }

    }
}();




var Invoice = function() {
    var $table = null;
    var items = [];
    var taxes = [];
    var total = 0;
    var taxable_value = 0;
    var total_tax = 0;
    var show_quantity_and_rate;
    var show_sac_code;
    var show_tax;
    var currency_code = $('select[name="currency"]').find(":selected").attr('data-code');
    var currency = $('select[name="currency"]').find(":selected").val();
    var client_select2 = null;

    function formatNumberAsAmount(number) {
        return number.toLocaleString(undefined, { maximumFractionDigits: 2, minimumFractionDigits: 2 })
    }

    function getItemDataFromRow($tr) {
        var rate = Number($tr.find('[name="rate[]"]').val());
        var discount = Number($tr.find('[name="discount[]"]').val());
        var quantity = Number($tr.find('[name="quantity[]"]').val());
        var isinnumber = $tr.find('[name="isinnumber[]"]').val();
        if (show_quantity_and_rate) {
            var amount = rate * quantity;
        } else {
            var amount = Number($tr.find('[name="amount[]"]').val());
        }

        var item_taxes = [];
        let total_tax = 0; //total tax for this item
        if (show_tax && taxes.length) {
            taxes.forEach(function(tax, index) {
                var tax_amount = amount * Number(tax.percent) / 100;
                var enabled = $tr.find(`.tax-picker option[value='${index}']`).is(':selected');
                item_taxes.push({
                    name: tax.name,
                    percent: tax.percent,
                    tax_amount: +tax_amount.toFixed(2),
                    enabled: enabled
                });
                if (enabled) {
                    total_tax += tax_amount;
                }
            })
        }
        let grand_total = amount + total_tax - discount;
        return {
            rate: rate,
            quantity: quantity,
            isinnumber: isinnumber,
            discount: discount,
            amount: +amount.toFixed(2),
            description: $tr.find('input[name="description[]"]').val(),
            taxes: item_taxes,
            total_tax: +total_tax.toFixed(2),
            grand_total: +grand_total.toFixed(2),
            sac_code: $tr.find('input[name="sac_code[]"]').val(),
        };
    }

    function doCalculation() {
        items = [];
        total = 0;
        taxable_value = 0;
        currency_code = $('select[name="currency"]').find(":selected").attr('data-code');
        currency = $('select[name="currency"]').find(":selected").val();
        total_tax = 0; //total tax for entire invoice
        $.each($table.find('tbody tr'), function() {
            var item_data = getItemDataFromRow($(this));
            if (show_quantity_and_rate) {
                $(this).find('[name="amount[]"]').val(item_data.amount.toFixed(2));
            }
            items.push({
                description: item_data.description,
                isinnumber: item_data.isinnumber,
                discount: +item_data.discount,
                rate: +item_data.rate,
                quantity: +item_data.quantity,
                sac_code: $(this).find('[name="sac_code[]"]').val(),
                amount: +item_data.amount,
                grand_total: +item_data.grand_total,
                id: $(this).attr('id'),
                taxes: item_data.taxes,
                total_tax: +item_data.total_tax
            });
            $(this).find('p.grand-total').html(currency_code + formatNumberAsAmount(item_data.grand_total));
            
            if (show_tax) {
                let taxes_html = '<option data-hidden="true"></option>';
                
                item_data.taxes.forEach(function(tax, index) {
                    let content = `${tax.name} @${tax.percent}% : ${currency_code + formatNumberAsAmount(tax.tax_amount)}`;
                    taxes_html += `<option value="${index}" title="${content}" ${tax.enabled ? 'selected' : ''}>${content}</option>`;
                });
                $(this).find('.taxes select').html(taxes_html);
                $(this).find('.taxes select').select2('destroy');
                $(this).find('.taxes select').select2();
                $(this).find('.taxes .filter-option-inner-inner').html(`Total Tax: ${currency_code + formatNumberAsAmount(item_data.total_tax)}`);
            }
            total += item_data.grand_total;
            taxable_value += item_data.amount;
            total_tax += item_data.total_tax;
        });
        $('#total_amount').html(currency_code + formatNumberAsAmount(total) + ' ' + currency);
        $('#total_tax').html(currency_code + formatNumberAsAmount(total_tax));
    }
    
    function initDescriptionInput($tr) {
        $(`#change_item_btn_${$tr.attr('id')}`).on('click', function(e) {
            $('#select_' + $tr.attr('id')).val(null).trigger('change'); //empty select box
            $('#' + $tr.attr('id')).find('.description_input').find('input').val('');
            $('#' + $tr.attr('id')).find('.description_input').hide();
            $('#' + $tr.attr('id')).find('.description_box').show();
        });
    }

    function initAddItemSelect2(id) {
        function formatItem(item) {
            if (item.loading) return item.text;

            if (!item.description) {
                return "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'>Create New</div></div></div>";
            }

            var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + item.description + "</div>";

            markup += "<div class='select2-result-repository__statistics'>" +
                "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i>SAC CODE: " + item.sac_code + "</div>" +
                "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i>RATE: " + item.rate + "</div>" +
                "</div>" +
                "</div></div>";
            return markup;
        }

        function formatItemSelection(client) {
            return client.description || client.text;
        }
        $("#"+id).select2({
            tags: true,
            placeholder: "Create/Select item",
            ajax: {
                url: base_url+"/items/select2",
                dataType: 'JSON',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                cache: false
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            width: '100%',
            templateResult: formatItem,
            templateSelection: formatItemSelection, // omitted for brevity, see the source of this page
        });

        $('#' + id).on('select2:select', function(e) {
            $(this).removeClass('is-invalid');
            $('[aria-labelledby="select2-' + id + '-container"]').removeClass('is-invalid');
            var data = e.params.data;
            var $tr = $(e.target.closest('tr'));

            //if creating new item then take search value as input text
            if (!data.description) {
                data.description = data.text;
            } else {
                //only update data if taken from items table & data is available for perticular field
                if (data.sac_code) {
                    $tr.find('input[name="sac_code[]"]').val(data.sac_code).trigger('change');
                }

                if (data.rate) {
                    data.rate ? $tr.find('input[name="rate[]"]').val(data.rate).trigger('change') : '';
                }
            }

            $tr.find('.description_box').hide();

            $tr.find('.description_input').html(`
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm description" name="description[]" value="${data.description}" />
                    <div class="input-group-append">
                        <button class="btn btn-secondary btn-sm" id="change_item_btn_${$tr.attr('id')}" type="button">Change</button>
                    </div>
                </div>
            `).show();
            initDescriptionInput($tr);

            doCalculation();
        });
    }

    function printClientDetails(data) {
        $('[aria-labelledby="select2-select_client-container"]').removeClass('is-invalid');
        $('.select_client').hide();
        var html = ``;

        if (data.logo) {
            html += `<a href="#" class="mb-5 text-left w-50">
                        <img src="${data.logo}" alt="" width="200px">
                    </a><br>`;
        }

        html += `<span>${data.first_name} ${data.last_name}</span><br><span>${data.company_name}</span><br><span> ${data.address_1}</span><br>`;

        if (data.address_2) {
            html += `<span> ${data.address_2}</span><br>`;
        }

        html += `<span>${data.city}, ${data.state}, ${data.country}</span><br>`;
        html += `<span>Post Code: ${data.postcode}<span><br>`;
        if (data.phone) {
            html += `<span>Phone: ${data.phone}<span><br>`;
        }
        if(data.company_site){
            html += `<span>Website: ${data.company_site}<span><br>`;
        }

        if (data.show_gst) {
            html += `<span>${data.gst_text}: ${data.gst_number}</span><br>`;
        }
        if (data.show_pan) {
            html += `<span>${data.pan_text}: ${data.pan_number}</span><br>`;
        }

        if (data.show_invoice_dp_id) {
            html += `<span>DP ID: ${data.dp_id}</span><br>`;
        }

        if (data.show_invoice_clientid) {
            html += `<span>Client ID: ${data.clientid}</span><br>`;
        }

        $('#selected_client_details').html(html).show().removeClass('d-none');
        if (data.email) {
            $('input[name=send_email]').removeAttr('disabled').prop('checked',true);
            $('.info_send_email').hide();
        }else{
            $('input[name=send_email]').attr('disabled','disabled').prop('checked',false);
            $('.info_send_email').show();
        }
    }

    return {
        _handleClientSelect2: function() {
            function formatClient(client) {
                if (client.loading) return client.text;

                var markup = "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'>Name: " + client.first_name + " " + client.last_name + "</div>";

                markup += "<div class='select2-result-repository__description'><i class='fa fa-at'></i> " + client.email + "</div>";

                markup += "<div class='select2-result-repository__statistics'>" +
                    "<div class='select2-result-repository__forks'><i class='fa fa-phone'></i> " + client.phone + "</div>" +
                    "<div class='select2-result-repository__stargazers'><i class='fa fa-building'></i> " + client.company_name + "</div>" +
                    "<div class='select2-result-repository__watchers'><i class='fa fa-flag'></i> " + client.country + "</div>" +
                    "</div>" +
                    "</div></div>";
                return markup;
            }

            function formatClientSelection(client) {
                if (client.first_name) {
                    return client.first_name + ' ' + client.last_name;
                }
                return client.text;
            }

            client_select2 = $("#select_client").select2({
                placeholder: "Search for clients",
                ajax: {
                    url: base_url+"/clients/select2",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    cache: false
                },
                "language": {
                   "noResults": function(){
                       return "No Results Found <a target='_blank' class='closeselect2'  href='/clients/create'>Add new client</a>";
                   }
               },
                escapeMarkup: function(markup) {
                    return markup;
                },
                minimumInputLength: 1,
                width: '300px',
                templateResult: formatClient,
                templateSelection: formatClientSelection // omitted for brevity, see the source of this page
            });

            $('#select_client').on('select2:select', function(e) {
                printClientDetails(e.params.data);
            });

            $('body').on('click','.closeselect2',function(){
                client_select2.select2('close');
             });
        },
        printClientDetails: function(data) {
            printClientDetails(data);
        },
        _handleSwitches: function() {
            function setWidth() {
                if (show_quantity_and_rate && show_sac_code && show_tax) {
                    description_width = 200;
                } else if (show_sac_code && show_tax) {
                    description_width = 200;
                } else if (show_quantity_and_rate && show_tax) {
                    description_width = 300;
                } else {
                    description_width = 400;
                }
                $('#create_invoice_table th:first').width(description_width);
            }

            $('body').on('change', '#show_quantity_switch', function(){
                show_quantity_and_rate = $(this).is(':checked') ? true : false;
                if (show_quantity_and_rate) {
                    $('.amount').attr('readonly', 'true');
                    //show rate & quantity column
                    $table.removeClass('hide-quantity');
                    doCalculation();
                } else {
                    // make amount editable
                    $('.amount').removeAttr('readonly');
                    // hide rate & quantity column,
                    $table.addClass('hide-quantity');
                }
                setWidth();
            });

            $('body').on('change', '#show_sac_switch', function(){
                show_sac_code = $(this).is(':checked') ? true : false;
                if (show_sac_code) {
                    //show SAC column
                    $table.removeClass('hide-sac-code');
                } else {
                    // hide sac column,
                    $table.addClass('hide-sac-code');
                }
                setWidth();
            });

            $('body').on('change', '#show_tax_switch', function(){
                show_tax = $(this).is(':checked') ? true : false;
                if (show_tax) {
                    if (taxes.length) {
                        //show TAX column
                        $table.removeClass('hide-tax');
                    } else {
                        $('#show_tax_switch').prop('checked', false);
                        Swal.fire({
                            text: 'Please add taxes in settings page before enabling it.',
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-light-primary"
                            }
                        });
                    }
                } else {
                    // hide tax column,
                    $table.addClass('hide-tax');
                }
                setWidth();
                doCalculation();
            });
 
            show_tax = $('#show_tax_switch').is(':checked');
            if (!show_tax) {
                $table.addClass('hide-tax');
            }

            show_sac_code = $('#show_sac_switch').is(':checked');
            if (!show_sac_code) {
                $table.addClass('hide-sac-code');
            }

            show_quantity_and_rate = $('#show_quantity_switch').is(':checked');
            if (!show_quantity_and_rate) {
                $table.addClass('hide-quantity');
            }
            setWidth();

        },
        initAddItemSelect2: function(id) {
            initAddItemSelect2(id);
        },
        _handleAddItem: function() {
            var item_count = Number($table.find('tr:last').attr('id').replace('item_', '')); //doesn't account for deleted rows
            $('#add_item').on('click', function(e) {
                item_count++;
                var id = 'item_' + item_count;
                var sac_code = $('#sac_code_db').val();
                $table.find('tbody').append(`
                    <tr id='${id}'>
                    <td>
                        <a href="javascript:void(0);" class="save_as_item">
                        <i class="ki-outline ki-check fs-2 pt-2" style="position: absolute;margin-left: -30px;"></i></a>
                        <div class="description_box">
                            <select name="description[]" id="select_item_${item_count}" aria-label="Select Description" class="form-select form-select-sm" required>
                                <option value=""></option>
                            </select>
                            </div>
                            <div class="description_input"></div>
                        </td>
                        <td><input class="form-control form-control-sm sac_code" type="text" value="${sac_code}" name="sac_code[]"
                                placeholder="SAC CODE" /></td>
                        <td><input class="form-control form-control-sm isinnumber" type="text"  name="isinnumber[]"
                        placeholder="ISIN Number"  /></td>
                        <td><input class="form-control form-control-sm quantity" type="number" min="1" name="quantity[]"
                                placeholder="Quantity"  /></td>
                        <td><input class="form-control form-control-sm rate" type="number" min="0.00" step="0.01" name="rate[]"
                                placeholder="Rate" /></td>

                        <td><input class="form-control form-control-sm amount" type="number" step="0.01"
                                ${show_quantity_and_rate ? 'readonly' : ''} name="amount[]" min="0.00"
                                placeholder="Amount" />
                        </td>
                        <td><input class="form-control form-control-sm discount" type="number"
                            name="discount[]" value="0" min="0"
                            placeholder="discount" />
                        </td>
                        <td class="text-right taxes">
                            <div class="taxes-div">
                                <select class="form-select form-select-sm tax-picker" multiple data-selected-text-format="count" data-size="false" id="taxes_select_${item_count}" placeholder="Select taxes" name="taxes[]">
                                    <option data-hidden="true"></option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <p style="width: 100%;display:inline-block;" class="col-form-label text-danger grand-total text-right font-weight-boldest"></p>
                            <a href="javascript:;" class="delete_item">
                            <i class="fa fa-trash-alt col-form-label" style="position: absolute;margin-left: 20px;"></i></a>
                        </td>
                    </tr>
                `);
                setTimeout(()=>{
                    initializeValidation();
                    initAddItemSelect2('select_' + id);
                    $('#taxes_select_' + item_count).select2();
    
                    doCalculation();
                }, 100);
            });
        },
        validateInvoiceData: function() {
            let selected_payment_methods = [];
            $('[name="payment_methods"] option:selected').each(function(index, brand) {
                selected_payment_methods.push($(this).val());
            });
            doCalculation();
           
            let data = {
                items: items,
                client_id: $('#select_client').val(),
                total: total,
                due_date: $('#due_date').val(),
                created_date: $('#created_date').val(),
                total_tax: total_tax,
                taxable_value: taxable_value,
                show_quantity_and_rate: show_quantity_and_rate,
                show_sac_code: show_sac_code,
                show_tax: show_tax,
                currency_code: currency_code,
                currency: currency,
                quantity_text: $('[name="quantity_text"]').val(),
                customer_notes: $('[name="customer_notes"]').val(),
                terms: $('[name="terms"]').val(),
                payment_methods: selected_payment_methods,
                show_user_name: $('input[name="show_user_name"]').is(':checked'),
                send_email: $('input[name="send_email"]').is(':checked'),
                invoice_type: $('select[name="invoice_type"]').val(),
            };
           
            let has_error = false;
            if (!data.client_id) {
                $('[aria-labelledby="select2-select_client-container"]').addClass('is-invalid');
                has_error = true;
            }

            items.forEach(function(item) {
                if (!item.description) {
                    $('[aria-labelledby="select2-select_' + item.id + '-container"]').addClass('is-invalid');
                    has_error = true;
                }

                if (show_sac_code) {
                    if (!item.sac_code) {
                        $('#' + item.id).find('.sac_code').addClass('is-invalid');
                        has_error = true;
                    }
                }

                if (show_quantity_and_rate) {
                    if (!item.quantity) {
                        $('#' + item.id).find('.quantity').addClass('is-invalid');
                        has_error = true;
                    }

                    if (!item.rate) {
                        $('#' + item.id).find('.rate').addClass('is-invalid');
                        has_error = true;
                    }

                } else {
                    if (!item.amount) {
                        $('#' + item.id).find('.amount').addClass('is-invalid');
                        has_error = true;
                    }
                }
                $('#' + item.id).on('change keyup', 'input', function(e) {
                    if ($(this).val()) {
                        $(this).removeClass('is-invalid');
                    }
                });
            });

            if (has_error) {
                Swal.fire({
                    text: "Please fill all required fields and try again.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                }).then(function() {
                    KTUtil.scrollTop();
                });

                return false;
            } else if (total_tax == 0 && show_tax) {
                Swal.fire({
                    text: "You must set at least one tax when taxes are enabled",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }

                });
                return false;
            } else {
                return data;
            }
        },
        _handleSaveAsItem: function() {
            $('body').on('click', '.save_as_item', function(e) {

                var $tr = $(this).closest('tr');
                var item_data = getItemDataFromRow($tr);

                if (item_data.description) {
                    //ajax to save item and check if already exist in db. swal

                    $.post('/items', item_data).done(function(data) {
                        Swal.fire({
                            text: data.message,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Continue",
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-light-primary"
                            }
                        });
                    }).fail(function(data) {
                        var error = data.responseText;

                        Swal.fire({
                            text: 'Something went wrong',
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-light-primary"
                            }
                        });
                    }).always(function() {
                    });
                } else {
                    Swal.fire({
                        text: "You must enter item description before saving.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    })
                }
            });
        },
        _handleDeleteItem: function() {
            $('body').on('click', '.delete_item', function(e) {
                var $tr = $(this).closest('tr');

                $tr.remove();

                doCalculation();

            });
        },
        _handleCalculations: function() {
            $('body').on('change keyup', '.rate', doCalculation);
            $('body').on('change keyup', '.discount', doCalculation);
            $('body').on('change keyup', '.quantity', doCalculation);
            $('body').on('change keyup', '.amount', doCalculation);
            $('body').on('select2:select select2:unselect', '.tax-picker', function(event, clickedIndex, isSelected) {
                doCalculation();
            });
        },
        _handleDueDatePicker: function() {
            $('#due_date').flatpickr({
                dateFormat: "d/m/Y",
                minDate: "today"
            });
            $('#created_date').flatpickr({
                dateFormat: "d/m/Y",
                minDate: "today"
            });
        },
        setTaxes: function(data) {
            taxes = data;
            doCalculation();
        },
        setTable: function(el) {
            $table = el;
        },
        initDescriptionInput: function($tr) {
            initDescriptionInput($tr);
        },
        doCalculation: function() {
            doCalculation();
        },
        getClientSelect2: function() {
            return client_select2;
        }
    }
}();


var invoices_create = function() {
    var _handleCreateInvoice = function() {
        $table = $('#create_invoice_table');

        if ($table.length < 1) {
            return;
        }
        Invoice.setTable($table);
        $.get(base_url+'/settings/getTaxes', Invoice.setTaxes);

        Invoice._handleSwitches();
        Invoice._handleClientSelect2();
        Invoice.initAddItemSelect2('select_item_1');
        $('#taxes_select_1').select2();

        Invoice._handleAddItem();
        Invoice._handleDeleteItem();
        Invoice._handleSaveAsItem();
        Invoice._handleCalculations();
        Invoice._handleDueDatePicker();


        $('#create_invoice_submit').on('click', function(e) {
            e.preventDefault();
            let data = Invoice.validateInvoiceData();
            if (!data) {
                return;
            }
            $.post('/invoices', data).done(function(data) {
                window.location.href = '/invoices?added=true';

            }).fail(function(data, status, error) {
                if(data.status == 419 || data.status == 401){
                    handleError(data, status, error);
                }else{
                    Swal.fire({
                        text: 'Something went wrong!',
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    });
                }
            });
        });

    }

    return {
        init: function() {
            _handleCreateInvoice();
        }
    }
}();



var invoices_edit = function() {
    var invoice_id = $('#invoice_id').val();

    var _handleEditInvoice = function() {
        $table = $('#edit_invoice_table');

        if ($table.length < 1) {
            return;
        }

        Invoice.setTable($table);
        (function initTaxes() {
            var taxes = [];
            $table.find('tbody tr:first .tax-picker option[value]').each(function(index, el) {
                var $option = $(el);
                taxes.push({
                    'name': $option.attr('data-name'),
                    'percent': $option.attr('data-percent'),
                    'enabled': $option.is(':selected')
                });
            });
            Invoice.setTaxes(taxes);
        })();
        Invoice._handleSwitches();
        var client = JSON.parse($('#selected_client_details').html()).snapshot.client;
        Invoice._handleClientSelect2();
        Invoice.printClientDetails(client);

        var client_select2 = Invoice.getClientSelect2();
        
        var option = new Option(client.first_name, client.id, true, true);
        client_select2.append(option).trigger('change');



        $table.find('tbody tr').each(function(index, $tr) {
            $tr = $($tr);
            Invoice.initAddItemSelect2('select_' + $tr.attr('id'));
            // $('.tax-picker').selectpicker();
            Invoice.initDescriptionInput($tr);
        });

        Invoice._handleAddItem();
        Invoice._handleDeleteItem();
        Invoice._handleSaveAsItem();
        Invoice._handleCalculations();
        Invoice._handleDueDatePicker();
        Invoice.doCalculation();

        $('#edit_invoice_submit').on('click', function(e) {
            e.preventDefault();

            let data = Invoice.validateInvoiceData();
            if (!data) {
                return;
            }

            $.post(base_url+'/invoices/' + invoice_id, data).done(function(data) {

                Swal.fire({
                    text: "Invoice has been updated.",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                }).then(function(result) {
                    if (result.isConfirmed) {
                        return window.location.href = '/invoices';
                    }
                });
            }).fail(function(data, status, error) {
                if(data.status == 419 || data.status == 401){
                    handleError(data, status, error);
                }else{
                    Swal.fire({
                        text: 'Something went wrong!',
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    });
                }
            });
        });

    }

    return {
        init: function() {
            _handleEditInvoice();
        }
    }
}();

// Class Initialization
jQuery(document).ready(function() {
    invoices_table.init();
    invoices_create.init();
    invoices_edit.init();
});