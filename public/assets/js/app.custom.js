"use strict";

let btnSpinner = `<div class="spinner-border spinner-border-sm text-white" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>`;

const globalToast = (data) => {
    Swal.fire({
        text: data.message,
        toast: true,
        position: "top-right",
        timer: 2000,
        timerProgressBar: true,
        icon: data.icon,
        showConfirmButton: false,
    });
};

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

const delete_record = (url, name) => {
    var deleteMessage = "Record has been deleted.";
    if (name) {
        deleteMessage = "Record : " + name + " has been deleted.";
    }
    Swal.fire({
        title: "Are you sure?",
        text: "You want to Delete Record?",
        icon: "warning",
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonText: "Yes, delete it!",
        customClass: {
            confirmButton: "btn-danger",
        },
        preConfirm: function () {
            return $.ajax({
                url: url,
                type: "DELETE",
            }).done(function (data) {
                return data;
            });
        },
    }).then(function (result) {
        if (result.isConfirmed) {
            Swal.fire("Deleted!", deleteMessage, "success");
            if (typeof table !== "undefined") {
                table.ajax.reload(null, false);
            }
        }
    });
};

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    },
});

$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    // Set default headers for all AJAX requests
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
    });

    if ($(".modal-tiny-editor").length > 0) {
        var options = {
            selector: ".modal-tiny-editor",
            height: "300",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste code help",
                "image code",
            ],
            menubar: false,
        };
        tinymce.init(options);
    }

    if ($(".kt_date_range_flatpickr").length > 0) {
        $(".kt_date_range_flatpickr").flatpickr({
            dateFormat: "Y-m-d",
            mode: "range",
            altInput: true,
            altFormat: "d/m/Y",
        });
    }

    if ($(".kt_range_flatpickr").length > 0) {
        $(".kt_range_flatpickr").flatpickr({
            dateFormat: "Y-m-d",
            mode: "range",
            altInput: true,
            altFormat: "d/m/Y",
        });
    }

    if ($(".kt_date_flatpickr").length > 0) {
        $(".kt_date_flatpickr").flatpickr({
            dateFormat: "d/m/Y",
        });
    }

    if ($(".kt_date_time_flatpickr").length > 0) {
        $(".kt_date_time_flatpickr").flatpickr({
            enableTime: true,
            dateFormat: "d/m/Y H:i:S",
        });
    }
    if ($(".kt_time_flatpickr").length > 0) {
        $(".kt_time_flatpickr").flatpickr({
            enableTime: true,
            dateFormat: "H:i",
            noCalendar: true,
            time_24hr: true,
        });
    }

    $("body").on("click", "#kt_ecommerce_sales_flatpickr_clear", function (e) {
        e.preventDefault();
        $("input.kt_date_range_flatpickr").val("");
    });

    $("body").on("submit", ".global-ajax-form", function (e) {
        e.preventDefault();
        let _this = $(this);
        if (_this.valid()) {
            let _target = _this.attr("data-target");
            let _button = _this.find("[type=submit]");
            let formData = new FormData(_this[0]);
            let url = _this.attr("action");
            let type = _button.data("type"); // Retrieve the data-type attribute

            if (type == "mail") {
                $(".loader").removeClass("d-none");
            }

            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    _button.attr("disabled", true);
                    _button.find(".indicator-label").hide();
                    _button.find(".indicator-progress").show();
                },
                success: function (data) {
                    if (data.redirect) {
                        if (_this.attr("data-modal-form")) {
                            $(_this.attr("data-modal-form")).modal("hide");
                        }
                        Swal.fire({
                            text: data.message,
                            toast: true,
                            position: "top-right",
                            timer: 1500,
                            timerProgressBar: true,
                            icon: "success",
                            showConfirmButton: false,
                        });
                        setTimeout(function () {
                            window.location.href = data.redirect;
                            let route = _this.attr("data-route");
                            $.post(route, formData);
                        }, 2000);
                    } else {
                        if (data.status == 200) {
                            console.log(_this.attr("data-modal-form"));
                            if (_this.attr("data-modal-form")) {
                                $(_this.attr("data-modal-form")).modal("hide");
                            }
                            Swal.fire({
                                text: data.message,
                                toast: true,
                                position: "top-right",
                                timer: 1500,
                                timerProgressBar: true,
                                icon: "success",
                                showConfirmButton: false,
                            });
                        }

                        if (_this.attr("data-redirect-url")) {
                            setTimeout(() => {
                                window.location.href =
                                    _this.attr("data-redirect-url");
                            }, 2000);
                        }

                        if (_this.attr("data-modal-form")) {
                            $(_this.attr("data-modal-form")).modal("hide");
                            if (typeof table !== "undefined")
                                table.table().draw();
                        }
                    }
                },
                error: function (xhr) {
                    $(".error-level").remove();
                    if (xhr.responseJSON.errors) {
                        var i = 1;
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            let errorElement = $(`[name="${key}"]`);
                            if (key.includes(".")) {
                                let parts = key.split(".");
                                let result = parts.reduce((acc, part) => {
                                    return acc ? acc + `[${part}]` : `${part}`;
                                }, "");
                                errorElement = $(`[name="${result}"]`);
                                if (i == 1) {
                                    errorElement.focus();
                                    i++;
                                }
                                if (
                                    errorElement.parents("div.file-error")
                                        .length > 0
                                ) {
                                    errorElement
                                        .parents("div.file-error")
                                        .find(".error-file")
                                        .after(
                                            `<small id="postcode-error" class="text-danger error-level">${value[0]}</small>`
                                        );
                                } else if (
                                    errorElement.parents("div.input-group")
                                        .length > 0
                                ) {
                                    errorElement
                                        .parents("div.input-group")
                                        .after(
                                            `<small id="postcode-error" class="text-danger error-level">${value[0]}</small>`
                                        );
                                } else if (errorElement.length > 0) {
                                    errorElement.after(
                                        `<small id="${key}-error" class="text-danger error-level">${value[0]}</small>`
                                    );
                                } else {
                                    Swal.fire({
                                        text: value[0],
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary",
                                        },
                                    });
                                    return false;
                                }
                            } else {
                                if (i == 1) {
                                    errorElement.focus();
                                    i++;
                                }
                                if (
                                    errorElement.parents("div.file-error")
                                        .length > 0
                                ) {
                                    errorElement
                                        .parents("div.file-error")
                                        .find(".error-file")
                                        .after(
                                            `<span id="postcode-error" class="text-danger error-level">${value[0]}</span>`
                                        );
                                } else if (
                                    errorElement.parents("div.input-group")
                                        .length > 0
                                ) {
                                    errorElement
                                        .parents("div.input-group")
                                        .after(
                                            `<span id="postcode-error" class="text-danger error-level">${value[0]}</span>`
                                        );
                                } else if (errorElement.length > 0) {
                                    errorElement.after(
                                        `<span id="${key}-error" class="text-danger error-level">${value[0]}</span>`
                                    );
                                } else {
                                    Swal.fire({
                                        text: value[0],
                                        toast: true,
                                        position: "top-right",
                                        timer: 1500,
                                        timerProgressBar: true,
                                        icon: "error",
                                        showConfirmButton: false,
                                    });
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            text: xhr.responseJSON.message,
                            toast: true,
                            position: "top-right",
                            timer: 1500,
                            timerProgressBar: true,
                            icon: "error",
                            showConfirmButton: false,
                        });
                    }
                },
                complete: function () {
                    _button.attr("disabled", false);
                    _button.find(".indicator-label").show();
                    _button.find(".indicator-progress").hide();
                    if (type == "mail") {
                        $(".loader").addClass("d-none");
                    }
                },
            });
        }
        return false;
    });

    $("body").on("change", ".changeStatus", function () {
        var id = $(this).attr("data_id");
        var url = $(this).attr("data-url");
        var status = $(this).is(":checked") ? "active" : "inactive";
        $.ajax({
            type: "POST",
            url: url,
            data: { id, status },
            success: function (data) {
                Swal.fire({
                    text: data.message,
                    toast: true,
                    position: "top-right",
                    timer: 1500,
                    timerProgressBar: true,
                    icon: "success",
                    showConfirmButton: false,
                });
            },
            error: function (error) {
                Swal.fire({
                    text: error.message,
                    toast: true,
                    position: "top-right",
                    timer: 1500,
                    timerProgressBar: true,
                    icon: "error",
                    showConfirmButton: false,
                });
            },
        });
    });

    $("body").on("click", `[data-bs-toggle="modal"]`, function (event) {
        event.preventDefault();
        let button = $(this);
        let recipient = button.attr("data-bs-whatever");
        let dataUrl = button.attr("href");
        if (dataUrl == "javascript:void(0);" || !dataUrl) {
            return;
        }
        let modal = $(button.attr("data-bs-target"));
        let modalSize = button.attr("data-bs-modal-dialog");
        modal.find(".modal-title").text(recipient);
        modal.find(".modal-body").html("");
        $.get(dataUrl, function (response) {
            if (response.success == 200) {
                modal.find(".modal-body").html(response.html);
                if (modalSize != undefined) {
                    modal.find(".modal-dialog").addClass(modalSize);
                } else {
                    modal.find(".modal-dialog").removeClass("modal-xl");
                }
                modal.modal("show");
                setTimeout(() => {
                    if (modal.find(".modal-tiny-editor").length > 0) {
                        var options = {
                            selector: ".modal-tiny-editor",
                            height: "250",
                            plugins: [
                                "advlist autolink lists link image charmap print preview anchor",
                                "searchreplace visualblocks code fullscreen",
                                "insertdatetime media table paste code help",
                                "image code",
                            ],
                            menubar: false,
                        };
                        tinymce.init(options);
                    }

                    if (modal.find(".modal-date-picker").length > 0) {
                        $(".modal-date-picker").flatpickr({
                            dateFormat: "Y-m-d",
                            altInput: true,
                            altFormat: "d M,Y",
                        });
                    }

                    if (modal.find(".kt_date_range_flatpickr").length > 0) {
                        $(".kt_date_range_flatpickr").flatpickr({
                            altInput: true,
                            altFormat: "d/m/Y",
                            dateFormat: "Y-m-d",
                            mode: "range",
                        });
                    }
                    if (
                        modal.find(".available_from").length > 0 ||
                        modal.find(".available_to").length > 0
                    ) {
                        var date1Value;
                        const date2 = flatpickr(".available_to", {
                            minDate: new Date(date1Value ?? null),
                            dateFormat: "Y-m-d",
                            altInput: true,
                            altFormat: "d M,Y",
                        });
                        flatpickr(".available_from", {
                            onChange: function (selectedDates) {
                                date1Value = selectedDates[0];
                                date2.set("minDate", date1Value);
                            },
                            dateFormat: "Y-m-d",
                            altInput: true,
                            altFormat: "d M,Y",
                        });
                    }
                }, 100);
            }
        });
    });

    $("body").on("click", `[data-load]`, function (event) {
        event.preventDefault();
        let button = $(this);
        let dataUrl = button.attr("href");
        let target = $(button.attr("data-target"));
        let modalSize = button.attr("data-modal-dialog");
        let recipient = button.attr("data-bs-whatever");
        target.find(".modal-title").text(recipient);
        if (modalSize != undefined) {
            target.find(".modal-dialog").addClass(modalSize);
        } else {
            target.find(".modal-dialog").removeClass("modal-xl");
        }
        if (!target.hasClass("show")) {
            target.modal("show");
        }
        target.find(".modal-body").load(dataUrl);
    });

    $("body").on("change", '[name="country"]', function (e) {
        let _this = $(this);
        let _form = _this.parents("form");
        if (_form.find('[name="state"]')) {
            let id = _this.val();
            _form.find('[name="state"]').load(base_url + "/get-states/" + id);
        }
    });

    $("body").on("click", ".remove-file", function () {
        var _this = $(this);
        var col = _this.attr("data-col");
        var id = _this.attr("data-id");
        var table = _this.attr("data-table");
        var file = _this.attr("data-file");

        Swal.fire({
            title: "Are you sure?",
            text: "Want to delete this?",
            icon: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Yes, delete it!",
            customClass: {
                confirmButton: "btn-danger",
            },
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: base_url + "/settings/remove-file",
                    data: {
                        id,
                        col,
                        table,
                        file,
                    },
                    success: function (response) {
                        $(`div.${col}_div`).remove();
                        Swal.fire({
                            text: "File deleted successfully",
                            icon: "success",
                            timer: "2000",
                        });

                        if (table) {
                            table.ajax.reload(null, false);
                        }
                    },
                    error: function (error) {
                        Swal.fire({
                            text: error.responseJSON.message,
                            toast: true,
                            position: "top-right",
                            timer: 1500,
                            timerProgressBar: true,
                            icon: "error",
                            showConfirmButton: false,
                        });
                    },
                });
            }
        });
    });

    $("body").on("click", ".delete-item", function (e) {
        e.preventDefault();
        let _this = $(this);
        var url = _this.attr("data-url");
        var tableId = _this.data("datatable"); // Get table ID from data attribute
        var table = $("#" + tableId).DataTable(); // Locate the DataTable instance

        let btnText = _this.data("title"),
            warningMessage =
                _this.attr("data-warningMessage") ??
                "You won't be able to revert this!";

        Swal.fire({
            title: "Are you sure?",
            text: warningMessage,
            icon: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: `Yes, ${btnText ?? "delete"} it!`,
            customClass: {
                confirmButton: "btn-danger",
            },
            preConfirm: function () {
                return $.ajax({
                    url: url,
                    type: "DELETE",
                })
                    .done(function (data) {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            Swal.fire({
                                text: "Deleted successfully!",
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            });
                        }
                    })
                    .catch(function (error) {
                        Swal.fire({
                            text: error.responseJSON.message,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        });
                    });
            },
        }).then(function (result) {
            if (result.isConfirmed) {
                // Reload DataTable after deletion
                if (table) {
                    table.ajax.reload(null, false); // Reload without resetting pagination
                }
                if (window.LaravelDataTables["global-datatable"]) {
                    window.LaravelDataTables["global-datatable"].ajax.reload(
                        null,
                        false
                    );
                }
                if (window.LaravelDataTables["tax-calculator-datatable"]) {
                    window.LaravelDataTables[
                        "tax-calculator-datatable"
                    ].ajax.reload(null, false);
                }
            }
        });
    });
});

$("body").on("submit", ".change-booking-status", function (e) {
    e.preventDefault();
    let _this = $(this);
    var url = _this.attr("action");
    let modal = _this.data("modal");
    let text = _this.data("icon-text") ?? "Want to change this?";

    // Clear previous errors before submitting
    $(".is-invalid").removeClass("is-invalid");
    $(".invalid-feedback").remove();
    $(modal).hide();
    Swal.fire({
        title: "Are you sure?",
        text: text,
        icon: "warning",
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonText: "Yes, update it!",
        customClass: {
            confirmButton: "btn-danger",
        },
        preConfirm: function () {
            return $.ajax({
                url: url,
                type: "POST",
                data: _this.serialize(),
            })
                .done(function (data) {
                    if (data.status == 200) {
                        // Check if modal is defined, then hide it
                        if (modal !== undefined || modal !== "") {
                            $(modal).hide();
                        }
                        // Show success SweetAlert after validation pass
                        Swal.fire({
                            text: data.message,
                            toast: true,
                            position: "top-right",
                            timer: 1500,
                            timerProgressBar: true,
                            icon: "success",
                            showConfirmButton: false,
                        });
                        if (data.redirect) {
                            setTimeout(() => {
                                window.location.href = data.redirect; // Redirect after success
                            }, 1500);
                        }
                    }
                })
                .fail(function (xhr) {
                    // Handle validation errors if status code is 422
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;

                        $.each(errors, function (field, messages) {
                            var inputField = _this.find(
                                '[name="' + field + '"]'
                            );
                            if (inputField.length) {
                                // Add the error class and display the error message
                                inputField.addClass("is-invalid"); // Add Bootstrap invalid class
                                inputField.after(
                                    '<div class="invalid-feedback">' +
                                        messages.join(", ") +
                                        "</div>"
                                );
                            }
                        });
                        // Optionally, you can show a generic error message as well
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Please fix the errors below!",
                        });
                    }
                });
        },
    }).then(function (result) {
        if (result.isConfirmed) {
            // Optionally, reload the table or any other logic after confirmation
        } else {
            $(modal).show();
        }
    });
});

$(".filterDate").flatpickr({
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    defaultDate: "today",
});
