"use strict";
var KTCreateAccount = function () {
    var e, t, i, o, a, r, s = [];
    var formdata;
    return {
        init: function () {
            (e = document.querySelector("#kt_modal_create_account")) && new bootstrap.Modal(e), (t = document.querySelector("#kt_create_account_stepper")) && (i = t.querySelector("#kt_create_account_form"), o = t.querySelector('[data-kt-stepper-action="submit"]'), a = t.querySelector('[data-kt-stepper-action="next"]'), (r = new KTStepper(t)).on("kt.stepper.changed", (function (e) {
                4 === r.getCurrentStepIndex() ? ($('.signout').addClass('d-none'), o.classList.remove("d-none"), o.classList.add("d-inline-block"), a.classList.add("d-none")) : 5 === r.getCurrentStepIndex() ? ($('.signout').removeClass('d-none'), o.classList.add("d-none"), a.classList.add("d-none")) : (o.classList.remove("d-inline-block"), o.classList.remove("d-none"), a.classList.remove("d-none"))
            })), r.on("kt.stepper.next", (function (e) {
                console.log("stepper.next");
                var t = s[e.getCurrentStepIndex() - 1];
                if ($('input[name=account_type]:checked').val() == 1) {
                    $('.account_info').html('Account Info');
                    $('.setup_account_info').html('Setup your account settings');
                    $('.individual_account').show();
                    $('.corporate_account').hide();
                    $('.corporate_account input, .corporate_account select, .corporate_account textarea').attr('disabled', 'disabled');
                    $('.individual_account input, .individual_account select, .individual_account textarea').removeAttr('disabled');
                } else {
                    $('.account_info').html('Business Details');
                    $('.setup_account_info').html('Setup your business details');
                    $('.individual_account').hide();
                    $('.corporate_account').show();
                    $('.individual_account input, .individual_account select, .individual_account textarea').attr('disabled', 'disabled');
                    $('.corporate_account input, .corporate_account select, .corporate_account textarea').removeAttr('disabled');

                }


                if ($('input[name=gst_registration]').is(":checked")) {
                    $('.gst_registration_file_div').show();
                } else {
                    $('.gst_registration_file_div').hide();
                }

                t ? t.validate().then((function (t) {
                    console.log("validated!"), "Valid" == t ? (KTUtil.scrollTop(),
                        formdata = new FormData($(document).find('#kt_create_account_form')[0]),
                        formdata.append('step', e.getCurrentStepIndex() - 1),

                        $.ajax({
                            type: "POST",
                            url: $(document).find('#kt_create_account_form').attr('action'),
                            data: formdata,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                // r.goNext()
                                e.goNext()
                            },
                            error: function (jqXhr, status, error) {
                                if (jqXhr.status == 419 || jqXhr.status == 401) {
                                    // handleError(jqXhr, status, error);
                                } else {
                                    Swal.fire({
                                        text: jqXhr.responseJSON.message,
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn font-weight-bold btn-light-primary"
                                        }
                                    });
                                }
                            }
                        })) : Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-light"
                        }
                    }).then((function () {
                        KTUtil.scrollTop()
                    }))
                })) : (e.goNext(), KTUtil.scrollTop())
            })), r.on("kt.stepper.previous", (function (e) {
                console.log("stepper.previous"), e.goPrevious(), KTUtil.scrollTop()
            })), s.push(FormValidation.formValidation(i, {
                fields: {
                    account_type: {
                        validators: {
                            notEmpty: {
                                message: "Account type is required"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), s.push(FormValidation.formValidation(i, {
                excluded: [':disabled', ':not(:visible)'],
                fields: {
                    name_of_partner: {
                        validators: {
                            notEmpty: {
                                message: "Partner name is required"
                            }
                        }
                    },
                    state_of_operation: {
                        validators: {
                            notEmpty: {
                                message: "State of Operation is required"
                            }
                        }
                    },
                    aadhar_card: {
                        validators: {
                            notEmpty: {
                                message: "Aadhar card number is required"
                            },
                            integer: {
                                message: 'The value is not a valid integer number',
                            },
                            stringLength: {
                                min: 12,
                                max: 12,
                                message: 'The Aadhar card must be 12 characters',
                            },
                        }
                    },
                    pan_card: {
                        validators: {
                            notEmpty: {
                                message: "PAN card is required"
                            },
                            stringLength: {
                                min: 10,
                                max: 10,
                                message: 'The PAN card must be 10 characters',
                            },
                        }
                    },
                    account_email: {
                        validators: {
                            notEmpty: {
                                message: "Contact email is required"
                            },
                            emailAddress: {
                                message: "The value is not a valid email address"
                            }
                        }
                    },
                    mobile: {
                        validators: {
                            notEmpty: {
                                message: "Mobile No is required"
                            },
                            integer: {
                                message: 'The value is not a valid integer number',
                            },
                            stringLength: {
                                min: 10,
                                max: 10,
                                message: 'The Mobile must be 10 characters',
                            },
                        }
                    },
                    authorised_person: {
                        validators: {
                            notEmpty: {
                                message: "Authorized Person is required"
                            }
                        }
                    },
                    business_name: {
                        validators: {
                            notEmpty: {
                                message: "Business name is required"
                            }
                        }
                    },

                    business_description: {
                        validators: {
                            notEmpty: {
                                message: "Business description is required"
                            }
                        }
                    },
                    business_type: {
                        validators: {
                            notEmpty: {
                                message: "Business type is required"
                            }
                        }
                    },
                    gst_number: {
                        validators: {
                            callback: {
                                message: 'GST Number is required',
                                callback: function (input) {
                                    const selectedCheckbox = $('input[name="gst_registration"]:checked');
                                    const gst_registration = selectedCheckbox ? selectedCheckbox.val() : '';
                                    console.log(gst_registration);

                                    return (gst_registration !== '1')
                                        // The field is valid if user picks
                                        // a given framework from the list
                                        ?
                                        true
                                        // Otherwise, the field value is required
                                        :
                                        (input.value !== '');
                                }
                            }
                        }
                    },


                    business_email: {
                        validators: {
                            notEmpty: {
                                message: "Business email is required"
                            },
                            emailAddress: {
                                message: "The value is not a valid email address"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    excluded: new FormValidation.plugins.Excluded(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), s.push(FormValidation.formValidation(i, {
                excluded: [':disabled', ':not(:visible)'],
                fields: {
                    cml_copy: {
                        validators: {
                            // notEmpty: {
                            //     message: 'Please select cml copy',
                            // },
                            file: {
                                extension: 'jpeg,jpg,png,pdf',
                                type: 'image/jpeg,image/png,application/pdf',
                                maxSize: 2097152, // 2048 * 1024
                                message: 'The selected file is not valid',
                            },
                        },
                    },
                    pan_card_file: {
                        validators: {
                            // notEmpty: {
                            //     message: 'Please select pan card',
                            // },
                            file: {
                                extension: 'jpeg,jpg,png,pdf',
                                type: 'image/jpeg,image/png,application/pdf',
                                maxSize: 2097152, // 2048 * 1024
                                message: 'The selected file is not valid',
                            },
                        },
                    },
                    cancel_cheque: {
                        validators: {
                            // notEmpty: {
                            //     message: 'Please select cancel cheque',
                            // },
                            file: {
                                extension: 'jpeg,jpg,png,pdf',
                                type: 'image/jpeg,image/png,application/pdf',
                                maxSize: 2097152, // 2048 * 1024
                                message: 'The selected file is not valid',
                            },
                        },
                    },
                    gst_registration_file: {
                        validators: {
                            // notEmpty: {
                            //     message: 'Please select GST Registration',
                            // },
                            file: {
                                extension: 'jpeg,jpg,png,pdf',
                                type: 'image/jpeg,image/png,application/pdf',
                                maxSize: 2097152, // 2048 * 1024
                                message: 'The selected file is not valid',
                            },
                        },
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    excluded: new FormValidation.plugins.Excluded(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), s.push(FormValidation.formValidation(i, {
                fields: {

                    upload_signed_document: {
                        validators: {
                            // notEmpty: {
                            //     message: 'Please upload signed document',
                            // },
                            file: {
                                extension: 'jpeg,jpg,png,pdf',
                                type: 'image/jpeg,image/png,application/pdf',
                                maxSize: 2097152, // 2048 * 1024
                                message: 'The selected file is not valid',
                            },
                        },
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), o.addEventListener("click", (function (e) {
                s[3].validate().then((function (t) {
                    console.log("validated!"), "Valid" == t ? (e.preventDefault(), o.disabled = !0, o.setAttribute("data-kt-indicator", "on"), setTimeout((function () {
                        o.removeAttribute("data-kt-indicator"), o.disabled = !1,
                            formdata = new FormData($(document).find('#kt_create_account_form')[0]),
                            formdata.append('step', 3),

                            $.ajax({
                                type: "POST",
                                url: $(document).find('#kt_create_account_form').attr('action'),
                                data: formdata,
                                processData: false,
                                contentType: false,
                                success: function (data) {

                                    r.goNext()
                                },
                                error: function (jqXhr, status, error) {
                                    if (jqXhr.status == 419 || jqXhr.status == 401) {
                                        // handleError(jqXhr, status, error);
                                    } else {
                                        Swal.fire({
                                            text: jqXhr.responseJSON.message,
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
                    }), 2e3)) : Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-light"
                        }
                    }).then((function () {
                        KTUtil.scrollTop()
                    }))


                }))
            })), $(i.querySelector('[name="card_expiry_month"]')).on("change", (function () {
                s[3].revalidateField("card_expiry_month")
            })), $(i.querySelector('[name="card_expiry_year"]')).on("change", (function () {
                s[3].revalidateField("card_expiry_year")
            })), $(i.querySelector('[name="business_type"]')).on("change", (function () {
                s[2].revalidateField("business_type")
            })))
        },
        submitformpartner: function () {



        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTCreateAccount.init()
}));