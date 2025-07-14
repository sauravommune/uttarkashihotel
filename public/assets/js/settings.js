"use strict";

// Class Definition
var UserSettings = function () {
	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	var change_password_form_validation = null;
	var business_address_form_validation = null;
	var business_info_form_validation = null;
	var bank_details_form_validation = null;
	var layout_settings_form_validation = null;
	var stripe_form_validation = null;
	var razorpay_form_validation = null;
	var paypal_form_validation = null;
	var tax_form_validation = null;
	var profile_info_form_validation = null;

	var _handleFormChangePassword = function () {
		// Base elements
		var form = document.getElementById('change_password_form');
		var formSubmitButton = document.getElementById('change_password_form_submit');

		if (!form) {
			return;
		}


		change_password_form_validation = FormValidation
			.formValidation(
				form,
				{
					fields: {
						current_password: {
							validators: {
								notEmpty: {
									message: 'The password is required'
								},
								stringLength: {
									min: 8,
									message: 'Password must be longer than 8 characters'
								}
							}
						},
						password: {
							validators: {
								notEmpty: {
									message: 'The new password is required'
								},
								stringLength: {
									min: 8,
									message: 'New password must be longer than 8 characters'
								}
							}
						},
						password_confirmation: {
							validators: {
								notEmpty: {
									message: 'The password comfirmation is required'
								},
								identical: {
									compare: function () {
										return form.querySelector('[name="password"]').value;
									},
									message: 'Please enter same password in confirmation field'
								}
							}
						}
					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
						//defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
							//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
							//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
					}
				}
			)
			.on('core.form.valid', function () {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				KTApp.blockPage({
					overlayColor: '#000000',
					state: 'primary',
					message: 'Processing...'
				});

				// ajax post
				$.post('/settings/change-password', {
					current_password: $('input[name="current_password"]').val(),
					password: $('input[name="password"]').val(),
					password_confirmation: $('input[name="password_confirmation"]').val()
				}
				).done(function () {
					Swal.fire({
						text: "Password has been changed...",
						icon: "success",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light-primary"
						}
					});
					form.reset();
					KTUtil.btnRelease(formSubmitButton);
				})
					.fail(function (data) {
						Swal.fire({
							text: data.responseText,
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
						})
						KTUtil.btnRelease(formSubmitButton);
					}).always(function () {
						KTApp.unblockPage();
					});
			})
			.on('core.form.invalid', function () {
				Swal.fire({
					text: "Sorry, looks like there are some errors detected, please try again.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function () {
					KTUtil.scrollTop();
				});
			});
	}

	var _handleBusinessInfoForm = function () {
		// Base elements
		var form = document.getElementById('business_info_form');
		var formSubmitButton = document.getElementById('business_info_form_submit');

		if (!form) {
			return;
		}


		// Business logo
		var logo = new KTImageInput('kt_user_edit_logo');

		function setValidators() {
			var type = $(this).attr('name');
			let messages = {
				show_gst: {
					message: $('.gst_text').val() + ' field is required',
					field: 'gst_number'
				},
				show_pan: {
					message: $('.pan_text').val() + ' field is required',
					field: 'pan_number'
				},
				show_cin: {
					message: $('.cin_text').val() + ' field is required',
					field: 'cin_number'
				}
			}

			if (this.checked) {

				business_info_form_validation.addField(messages[type].field, {
					validators: {
						notEmpty: {
							message: messages[type].message
						}
					}
				});
			} else {
				try {
					business_info_form_validation.resetField(messages[type].field).removeField(messages[type].field);
				}
				catch (err) {
					console.log(err.message);
				}

			}


		}


		business_info_form_validation = FormValidation
			.formValidation(
				form,
				{
					fields: {
						business_name: {
							validators: {
								notEmpty: {
									message: 'Business name is required'
								}
							}
						},
						business_site: {
							validators: {
								regexp: {
									regexp: /(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]/i,
									message: 'Please enter valid domain'
								}
							}
						},
						phone: {
							validators: {
								notEmpty: {
									message: 'Phone number is required'
								}
							}
						}
					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
						//defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
							//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
							//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
					}
				}
			)
			.on('core.form.valid', function () {
				if ($('[name="business_site"]').val() == '') {
					$('[name="business_site"]').removeClass('is-valid');
				}
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				KTApp.blockPage({
					overlayColor: '#000000',
					state: 'primary',
					message: 'Processing...'
				});

				var formData = new FormData($('#business_info_form')[0]);

				$.ajax({
					url: '/settings/business-info',
					type: 'POST',
					data: formData,
					success: function (data) {
						Swal.fire({
							text: "Settings have been saved...",
							icon: "success",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
						});
						$('#kt_user_edit_logo [data-action="cancel"]').hide();
						KTUtil.btnRelease(formSubmitButton);
						KTApp.unblockPage();
					},
					error: function (data, status, error) {
						if(data.status == 419 || data.status == 401){
                            handleError(data, status, error);
                        }else{
							KTUtil.btnRelease(formSubmitButton);
							KTApp.unblockPage();
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

							business_info_form_validation.resetForm();
						}

					},
					cache: false,
					contentType: false,
					processData: false
				});

			})
			.on('core.form.invalid', function () {
				if ($('[name="business_site"]').val() == '') {
					$('[name="business_site"]').removeClass('is-valid');
				}
				Swal.fire({
					text: "Sorry, looks like there are some errors detected, please try again.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function () {
					KTUtil.scrollTop();
				});
			});

		$('#business_info_form input[type="checkbox"]').each(setValidators);

		$('#business_info_form input[type="checkbox"]').change(setValidators);

	}

	var _handleBusinessAddressForm = function () {
		// Base elements
		var form = document.getElementById('business_address_form');
		var formSubmitButton = document.getElementById('business_address_form_submit');

		if (!form) {
			return;
		}

		$('#country').on('change', function (e) {
			$.get('/get-states?country=' + $('#country').val()).done(function (data) {
				var html = '';
				if (Array.isArray(data)) {
					html = '<select id="state" name="state" class="form-control form-control-solid">';
					data.forEach(function (state) {
						html += `<option value="${state}">${state}</option>`;
					});
					html += '</select>';
				} else {
					let current_state = $('#state').val();
					html = `<input class="form-control form-control-solid" type="text" name="state"
					value="${current_state}" id="state" />`;
				}
				business_address_form_validation.removeField('state');
				$('#state_div').html(html);
				business_address_form_validation.addField('state', {
					validators: {
						notEmpty: {
							message: 'State is required'
						}
					}
				}).validateField('state');
			});
		});

		business_address_form_validation = FormValidation
			.formValidation(
				form,
				{
					fields: {
						address_1: {
							validators: {
								notEmpty: {
									message: 'Address is required'
								}
							}
						},
						postcode: {
							validators: {
								notEmpty: {
									message: 'Postcode is required'
								}
							}
						},
						city: {
							validators: {
								notEmpty: {
									message: 'City is required'
								}
							}
						},
						state: {
							validators: {
								notEmpty: {
									message: 'State is required'
								}
							}
						},
						country: {
							validators: {
								notEmpty: {
									message: 'Country is required'
								}
							}
						}
					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
						//defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
							//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
							//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
					}
				}
			)
			.on('core.form.valid', function () {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				KTApp.blockPage({
					overlayColor: '#000000',
					state: 'primary',
					message: 'Processing...'
				});



				$.post({
					url: '/settings/business-address',
					type: 'POST',
					data: $('#business_address_form').serialize(),
					success: function (data) {
						Swal.fire({
							text: "Settings have been saved...",
							icon: "success",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
						});

						KTUtil.btnRelease(formSubmitButton);
						KTApp.unblockPage();
					},
					error: function (data, status, error) {
						if(data.status == 419 || data.status == 401){
                            handleError(data, status, error);
                        }else{
						KTUtil.btnRelease(formSubmitButton);
						KTApp.unblockPage();
						}
					}
				});

			})
			.on('core.form.invalid', function () {
				Swal.fire({
					text: "Sorry, looks like there are some errors detected, please try again.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function () {
					KTUtil.scrollTop();
				});
			});
	}

	var _handleBankDetailsForm = function () {
		// Base elements
		var form = document.getElementById('bank_details_form');
		var formSubmitButton = document.getElementById('bank_details_form_submit');

		if (!form) {
			return;
		}

		bank_details_form_validation = FormValidation
			.formValidation(
				form,
				{
					fields: {
						//will be added dynamically
					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
						//defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
							//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
							//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
					}
				}
			)
			.on('core.form.valid', function () {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				KTApp.blockPage({
					overlayColor: '#000000',
					state: 'primary',
					message: 'Processing...'
				});



				$.post({
					url: '/settings/bank-details',
					type: 'POST',
					data: $('#bank_details_form').serialize(),
					success: function (data) {
						Swal.fire({
							text: "Bank Details have been saved...",
							icon: "success",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
						});

						KTUtil.btnRelease(formSubmitButton);
						KTApp.unblockPage();
					},
					error: function (data, status, error) {
						if(data.status == 419 || data.status == 401){
                            handleError(data, status, error);
                        }else{
							KTUtil.btnRelease(formSubmitButton);
							KTApp.unblockPage();
						}
					}
				});

			})
			.on('core.form.invalid', function () {
				Swal.fire({
					text: "Sorry, looks like there are some errors detected, please try again.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function () {
					KTUtil.scrollTop();
				});
			});



		function setValidators() {
			var type = $(this).attr('data-type');
			if (this.checked) {
				let messages = {
					account_name: 'Account Name',
					bank_name: 'Bank Name',
					account_number: 'Account Number',
					neft_code: 'Neft Code',
					micr_code: 'Micr Code',
					swift_code: 'Switf Code'
				};

				bank_details_form_validation.addField(type, {
					validators: {
						notEmpty: {
							message: messages[type] + ' is required'
						}
					}
				});
			} else {
				try {
					bank_details_form_validation.resetField(type).removeField(type);
				}
				catch (err) {
					console.log(err.message);
				}

			}


		}
		$('.bank-details-show input[type="checkbox"]').each(setValidators);

		$('.bank-details-show input[type="checkbox"]').change(setValidators);

	}

	var _handleProfileInfoForm = function () {
		// User profile
		// Base elements
		var form = document.getElementById('profile_info_form');
		var formSubmitButton = document.getElementById('profile_info_form_submit');

		if (!form) {
			return;
		}

		$('#timezone_select').select2();

		profile_info_form_validation = FormValidation
			.formValidation(
				form,
				{
					fields: {
						name: {
							validators: {
								notEmpty: {
									message: 'Name is required'
								}
							}
						}
					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
						//defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
							//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
							//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
					}
				}
			)
			.on('core.form.valid', function () {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				KTApp.blockPage({
					overlayColor: '#000000',
					state: 'primary',
					message: 'Processing...'
				});

				var formData = new FormData($('#profile_info_form')[0]);

				$.ajax({
					url: '/settings/profile-info',
					type: 'POST',
					data: formData,
					success: function (data) {
						Swal.fire({
							text: "Settings have been saved...",
							icon: "success",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
						});
						$('#kt_user_edit_logo [data-action="cancel"]').hide();
						KTUtil.btnRelease(formSubmitButton);
						KTApp.unblockPage();
					},
					error: function (data, status, error) {
						if(data.status == 419 || data.status == 401){
                            handleError(data, status, error);
                        }else{
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
							profile_info_form_validation.resetForm();
							KTUtil.btnRelease(formSubmitButton);
							KTApp.unblockPage();
						}
						
					},
					cache: false,
					contentType: false,
					processData: false
				});

			})
			.on('core.form.invalid', function () {
				Swal.fire({
					text: "Sorry, looks like there are some errors detected, please try again.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function () {
					KTUtil.scrollTop();
				});
			});
	}



	var _handleLayoutSettingsForm = function () {
		// Base elements
		var form = document.getElementById('layout_settings_form');
		var formSubmitButton = document.getElementById('layout_settings_form_submit');
		var logo = new KTImageInput('stemp_logo');
		if (!form) {
			return;
		}


		layout_settings_form_validation = FormValidation
			.formValidation(
				form,
				{
					fields: {

					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
						//defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
							//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
							//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
					}
				}
			)
			.on('core.form.valid', function () {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				KTApp.blockPage({
					overlayColor: '#000000',
					state: 'primary',
					message: 'Processing...'
				});
				
				var layout_settings_form = new FormData($('#layout_settings_form')[0]);

				$.ajax({
					url: '/settings/layout-settings',
					type: 'POST',
					data: layout_settings_form,
					success: function (data) {
						Swal.fire({
							text: "Settings have been saved...",
							icon: "success",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
						});
						$('#kt_user_edit_logo [data-action="cancel"]').hide();
						KTUtil.btnRelease(formSubmitButton);
						KTApp.unblockPage();
					},
					error: function (data, status, error) {
						if(data.status == 419 || data.status == 401){
                            handleError(data, status, error);
                        }else{
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
							profile_info_form_validation.resetForm();
							KTUtil.btnRelease(formSubmitButton);
							KTApp.unblockPage();
						}
						
					},
					cache: false,
					contentType: false,
					processData: false
				});

			})
			.on('core.form.invalid', function () {
				Swal.fire({
					text: "Sorry, looks like there are some errors detected, please try again.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function () {
					KTUtil.scrollTop();
				});
			});

		function setValidators() {
			var type = $(this).attr('value');
			let validators = {
				custom: {
					str_number: {
						notEmpty: {
							message: 'Custom Format field is required'
						}
					},
					str_number_increment: {
						notEmpty: {
							message: 'Increment By field is required'
						},
						between: {
							min: 1,
							max: 99999999999999999999999,
							message: 'Increment By field must be greater than 1'
						}
					},
				},
				random_number: {
					number_length: {
						notEmpty: {
							message: 'Number Length field is required'
						},
						between: {
							min: 6,
							max: 15,
							message: 'Number Length field must be between 6 and 15'
						}
					},
				},
				random_string: {
					str_length: {
						notEmpty: {
							message: 'String Length field is required'
						},
						between: {
							min: 6,
							max: 15,
							message: 'String Length field must be between 6 and 15'
						}
					},
				},
			};
			if (this.checked) {
				for (let field in validators[type]) {
					layout_settings_form_validation.addField(field, {
						validators: validators[type][field]
					});
				}
			} else {
				try {
					for (let field in validators[type]) {
						layout_settings_form_validation.resetField(field).removeField(field);
					}
				}
				catch (err) {
					console.log(err.message);
				}
			}
		}

		$('input[type=radio][name=invoice_number_format]').each(setValidators);
		$('input[type=radio][name=invoice_number_format]').on('change', function () {
			$('input[type=radio][name=invoice_number_format]').each(setValidators);
		});
	}

	var _handleUpdateCurrencyForm = function () {
		// Base elements
		var form = document.getElementById('currency_form');
		var formSubmitButton = document.getElementById('currency_form_submit');

		if (!form) {
			return;
		}

		FormValidation
			.formValidation(
				form,
				{
					fields: {

					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
						//defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
							//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
							//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
					}
				}
			)
			.on('core.form.valid', function () {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				KTApp.blockPage({
					overlayColor: '#000000',
					state: 'primary',
					message: 'Processing...'
				});

				$.post({
					url: '/settings/currency',
					type: 'POST',
					data: $('#currency_form').serialize(),
					success: function (data) {
						Swal.fire({
							text: "Settings have been saved...",
							icon: "success",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
						});

						KTUtil.btnRelease(formSubmitButton);
						KTApp.unblockPage();
					}
				});

			})
	}

	var _handleTaxes = function () {
		var submit_type;
		var tbody = document.getElementById("taxes_table_body");
		var form = document.getElementById('tax_form');
		var formSubmitButton = document.getElementById('tax_form_submit');

		function initSortable() {
			let sortable = Sortable.get(tbody);
			if (sortable) {
				sortable.destroy();
			}
			Sortable.create(tbody, {
				draggable: 'tbody tr',
				// Changed sorting for table row
				onUpdate: function (event) {
					calcuateOrder(true);

				},
			});
		}

		function renderTable(data) {
			var taxes = data;
			tbody.innerHTML = '';

			if (!Array.isArray(data)) {
				taxes = [];
				for(let key in data) {
					taxes.push(data[key]);
				}
			}

			taxes.forEach(function (tax, index) {
				var row = `
				<tr class="datatable-row" style="left: 0px;" data-tax-order="${index}">
					<td class="datatable-cell">
						<span style="width: 112px;" data-tax-name='${tax.name}'>${tax.name}</span></td>
					<td class="datatable-cell"><span data-tax-percent='${tax.percent}'
							style="width: 85px;">${tax.percent}%</span></td>
					<td class="datatable-cell-left datatable-cell">
						<span style="width: 125px;">
							<a href="javascript:;"
								class="edit_tax_btn btn btn-sm btn-clean btn-icon mr-2"
								title="Edit details">
								<span class="svg-icon svg-icon-md">
									<svg xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
										height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none"
											fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24"></rect>
											<path
												d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
												fill="#000000" fill-rule="nonzero"
												transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
											</path>
											<rect fill="#000000" opacity="0.3" x="5" y="20"
												width="15" height="2" rx="1"></rect>
										</g>
									</svg> </span> </a>
							<a href="javascript:;"
								class="delete_tax_btn btn btn-sm btn-clean btn-icon" title="Delete">
								<span class="svg-icon svg-icon-md">
									<svg xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
										height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none"
											fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24"></rect>
											<path
												d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
												fill="#000000" fill-rule="nonzero"></path>
											<path
												d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
												fill="#000000" opacity="0.3">
											</path>
										</g>
									</svg>
								</span>
							</a>
						</span>
					</td>
				</tr>
				`;
				tbody.innerHTML += row;
			});

			calcuateOrder();
			initSortable();
		}

		$.get('/settings/taxes', renderTable);


		function calcuateOrder(updateOnServer) {
			let data = [];

			$(tbody).find("tr").each(function (index) {
				$(this).attr('data-tax-order', index);
				data.push({
					'name': $(this).find('[data-tax-name]').attr('data-tax-name'),
					'percent': $(this).find('[data-tax-percent]').attr('data-tax-percent'),
				});
			});

			if (updateOnServer) {

				$.post('/settings/taxes/set-order', { taxes: data });
			}
			return data.length;
		}


		$('#add_tax_btn').on('click', function (e) {
			e.preventDefault();
			submit_type = 'add';
			$('#taxModalLabel').text('Create Tax');
			$('#tax_form_submit').text('Create Tax');
			$('#taxModal').modal('show');
			$('input[name="tax_name"]').val('');
			$('input[name="tax_percent"]').val('');
			$('input[name="tax_order"]').val(calcuateOrder());
		});

		$('body').on('click', '.edit_tax_btn', function (e) {
			e.preventDefault();
			submit_type = 'edit';
			$('#taxModalLabel').text('Edit Tax');
			$('#tax_form_submit').text('Save Changes');
			var $tr = $(this).closest('tr');
			$('input[name="tax_name"]').val($tr.find('[data-tax-name]').attr('data-tax-name'));
			$('input[name="tax_percent"]').val($tr.find('[data-tax-percent]').attr('data-tax-percent'));
			$('input[name="tax_order"]').val($tr.attr('data-tax-order'));

			$('#taxModal').modal('show');
		});

		$('body').on('click', '.delete_tax_btn', function (e) {
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
				preConfirm: function () {
					return $.ajax(
						{
							url: '/settings/taxes?id=' + $tr.attr('data-tax-order'),
							type: 'DELETE'
						}
					).done(function (data) {
						renderTable(data);
						return data;
					});
				}
			}).then(function (result) {
				if (result.isConfirmed) {
					Swal.fire(
						"Deleted!",
						"Tax: " + name + "  has been deleted.",
						"success"
					)
				}
			});
		})





		tax_form_validation = FormValidation
			.formValidation(
				form,
				{
					fields: {
						tax_percent: {
							validators: {
								between: {
									min: 0,
									max: 100,
									message: 'Tax percent must be between 0 to 100.'
								}
							}
						},
					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
						//defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
							//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
							//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
					}
				}
			)
			.on('core.form.valid', function () {

				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				KTApp.blockPage({
					overlayColor: '#000000',
					state: 'primary',
					message: 'Processing...'
				});
				$.post('/settings/taxes', $('#tax_form').serialize()).done(function (data) {
					$('#taxModal').modal('hide');

					KTUtil.btnRelease(formSubmitButton);
					KTApp.unblockPage();
					Swal.fire({
						text: "Item has been " + (submit_type == 'edit' ? 'updated.' : 'created.'),
						icon: "success",
						buttonsStyling: false,
						confirmButtonText: "Continue",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light-primary"
						}
					});
					renderTable(data);
					tax_form_validation.resetForm();
				});
			})
			.on('core.form.invalid', function () {
				Swal.fire({
					text: "Sorry, looks like there are some errors detected, please try again.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function () {
					KTUtil.scrollTop();
				});
			});

	}

	var _handlePaypalForm = function () {
		// Base elements
		var form = document.getElementById('paypal_form');
		var formSubmitButton = document.getElementById('paypal_form_submit');

		if (!form) {
			return;
		}


		paypal_form_validation = FormValidation
			.formValidation(
				form,
				{
					fields: {
						username: {
							validators: {
								notEmpty: {
									message: 'Username is required'
								}
							}
						},
						password: {
							validators: {
								notEmpty: {
									message: 'Password is required'
								}
							}
						},
						api_signature_key: {
							validators: {
								notEmpty: {
									message: 'Api Signature Key is required'
								}
							}
						}
					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
						//defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
							//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
							//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
					}
				}
			)
			.on('core.form.valid', function () {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				KTApp.blockPage({
					overlayColor: '#000000',
					state: 'primary',
					message: 'Processing...'
				});

				$.post({
					url: '/settings/paypal',
					type: 'POST',
					data: $('#paypal_form').serialize(),
					success: function (data) {
						Swal.fire({
							text: "Settings have been saved...",
							icon: "success",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
						});

						KTUtil.btnRelease(formSubmitButton);
						KTApp.unblockPage();
					},
					error: function (data, status, error) {
						if(data.status == 419 || data.status == 401){
                            handleError(data, status, error);
                        }else{
							KTUtil.btnRelease(formSubmitButton);
							KTApp.unblockPage();
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
							paypal_form_validation.resetForm();
						}
					}
				});
			})
			.on('core.form.invalid', function () {
				Swal.fire({
					text: "Sorry, looks like there are some errors detected, please try again.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function () {
					KTUtil.scrollTop();
				});
			});


	}

	var _handleStripeForm = function () {
		// Base elements
		var form = document.getElementById('stripe_form');
		var formSubmitButton = document.getElementById('stripe_form_submit');

		if (!form) {
			return;
		}


		stripe_form_validation = FormValidation
			.formValidation(
				form,
				{
					fields: {
						secret_key: {
							validators: {
								notEmpty: {
									message: 'Secret Key is required'
								}
							}
						},
						publishable_key: {
							validators: {
								notEmpty: {
									message: 'Publishable Key is required'
								}
							}
						}
					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
						//defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
							//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
							//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
					}
				}
			)
			.on('core.form.valid', function () {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				KTApp.blockPage({
					overlayColor: '#000000',
					state: 'primary',
					message: 'Processing...'
				});



				Stripe.setPublishableKey($('input[name="publishable_key"]').val());
				Stripe.createToken({}, stripeResponseHandler);

				function stripeResponseHandler(status, response) {
					if (status == 401) {
						KTUtil.btnRelease(formSubmitButton);
						KTApp.unblockPage();
						Swal.fire({
							text: 'Invalid publishable key, try again.',
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
						});

						return;

					}

					// public key is valid, continue form submit
					$.post({
						url: '/settings/stripe',
						type: 'POST',
						data: $('#stripe_form').serialize(),
						success: function (data) {
							Swal.fire({
								text: "Settings have been saved...",
								icon: "success",
								buttonsStyling: false,
								confirmButtonText: "Ok, got it!",
								customClass: {
									confirmButton: "btn font-weight-bold btn-light-primary"
								}
							});

							KTUtil.btnRelease(formSubmitButton);
							KTApp.unblockPage();
						},
						error: function (data, status, error) {
							if(data.status == 419 || data.status == 401){
								handleError(data, status, error);
							}else{
								KTUtil.btnRelease(formSubmitButton);
								KTApp.unblockPage();
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
								stripe_form_validation.resetForm();
							}
							
						}
					});
				}
			})
			.on('core.form.invalid', function () {
				Swal.fire({
					text: "Sorry, looks like there are some errors detected, please try again.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function () {
					KTUtil.scrollTop();
				});
			});

		function setValidators() {
			var mode = $(this).val();
			if (mode == 'test') {
				$('#stripe_api_keys_link').attr('href', 'https://dashboard.stripe.com/test/apikeys');
				var validators = {
					'publishable_key': {
						validators: {
							regexp: {
								regexp: /^pk_test_/i,
								message: 'Pulishable key must start with pk_test_ in test mode.'
							},
							notEmpty: {
								message: 'Pulishable key is required'
							}
						}
					},
					'secret_key': {
						validators: {
							regexp: {
								regexp: /^sk_test_/i,
								message: 'Secret key must start with sk_test_ in test mode.'
							},
							notEmpty: {
								message: 'Secret key is required'
							}
						}
					}
				}



			} else {
				$('#stripe_api_keys_link').attr('href', 'https://dashboard.stripe.com/apikeys');
				var validators = {
					'publishable_key': {
						validators: {
							regexp: {
								regexp: /^pk_live_/i,
								message: 'Pulishable key must start with pk_live_ in live mode.'
							},
							notEmpty: {
								message: 'Pulishable key is required'
							}
						}
					},
					'secret_key': {
						validators: {
							regexp: {
								regexp: /^sk_live_/i,
								message: 'Secret key must start with sk_live_ in live mode.'
							},
							notEmpty: {
								message: 'Secret key is required'
							}
						}
					}
				}
			}

			for (let k in validators) {
				try {
					stripe_form_validation.resetField(k).removeField(k);
				}
				catch (err) {
					console.log(err.message);
				}

				stripe_form_validation.addField(k, validators[k]);
			}
		}

		$('#stripe_form select[name="mode"]').each(setValidators);
		$('#stripe_form select[name="mode"]').change(setValidators);
	}

	var _handleRazorPayForm = function () {
		// Base elements
		var form = document.getElementById('razorpay_form');
		var formSubmitButton = document.getElementById('razorpay_form_submit');

		if (!form) {
			return;
		}

		razorpay_form_validation = FormValidation
			.formValidation(
				form,
				{
					fields: {
						key_id: {
							validators: {
								notEmpty: {
									message: 'Key Id is required'
								}
							}
						},
						key_secret: {
							validators: {
								notEmpty: {
									message: 'Key Secret is required'
								}
							}
						}
					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
						//defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
							//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
							//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
					}
				}
			)
			.on('core.form.valid', function () {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				KTApp.blockPage({
					overlayColor: '#000000',
					state: 'primary',
					message: 'Processing...'
				});

				// public key is valid, continue form submit
				$.post({
					url: '/settings/razorpay',
					type: 'POST',
					data: $('#razorpay_form').serialize(),
					success: function (data) {
						Swal.fire({
							text: "Settings have been saved...",
							icon: "success",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
						});

						KTUtil.btnRelease(formSubmitButton);
						KTApp.unblockPage();
					},
					error: function (data, status, error) {
						if(data.status == 419 || data.status == 401){
							handleError(data, status, error);
						}else{
							KTUtil.btnRelease(formSubmitButton);
							KTApp.unblockPage();
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
							razorpay_form_validation.resetForm();
						}
					}
				});

			})
			.on('core.form.invalid', function () {
				Swal.fire({
					text: "Sorry, looks like there are some errors detected, please try again.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function () {
					KTUtil.scrollTop();
				});
			});

		function setValidators() {
			var mode = $(this).val();
			if (mode == 'test') {
				var validators = {
					'key_id': {
						validators: {
							regexp: {
								regexp: /^rzp_test_/i,
								message: 'Key Id must start with rzp_test_ in test mode.'
							},
							notEmpty: {
								message: 'Key Id is required'
							}
						}
					}
				}
			} else {
				var validators = {
					'key_id': {
						validators: {
							regexp: {
								regexp: /^rzp_live_/i,
								message: 'Key Id must start with rzp_live_ in live mode.'
							},
							notEmpty: {
								message: 'Key Id is required'
							}
						}
					},

				}
			}

			
			for (let k in validators) {
				try {
					

					razorpay_form_validation.resetField(k).removeField(k);
				}
				catch (err) {
					throw err;
					console.log(err.message);
				}

				
				razorpay_form_validation.addField(k, validators[k]);
			}
		}

		$('#razorpay_form select[name="mode"]').each(setValidators);
		$('#razorpay_form select[name="mode"]').change(setValidators);
	}

	var _handlePaymentSettings = function () {
		// Base elements
		var form = document.getElementById('payment_settings_form');
		var formSubmitButton = document.getElementById('payment_settings_form_submit');


		if (!form) {
			return;
		}

		$('#payment_settings_form').on('submit', function (e) {
			e.preventDefault();
			// Show loading state on button
			KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
			KTApp.blockPage({
				overlayColor: '#000000',
				state: 'primary',
				message: 'Processing...'
			});
			// public key is valid, continue form submit
			$.post({
				url: '/settings/gateways',
				type: 'POST',
				data: $(this).serialize(),
				success: function (data) {
					Swal.fire({
						text: "Settings have been saved...",
						icon: "success",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light-primary"
						}
					});

					KTUtil.btnRelease(formSubmitButton);
					KTApp.unblockPage();
				},
				error: function (data, status, error) {
					if(data.status == 419 || data.status == 401){
						handleError(data, status, error);
					}else{
						KTUtil.btnRelease(formSubmitButton);
						KTApp.unblockPage();
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
		})

	}


	var _handleNewInvoiceEmailForm = function () {
		// Base elements
		var form = document.getElementById('new_invoice_email_form');
		var formSubmitButton = document.getElementById('new_invoice_email_form_submit');


		if (!form) {
			return;
		}

		var quill = new Quill('#new_invoice_email_quil', {
			modules: {
				toolbar: [
					[{
						header: [1, 2, false]
					}],
					['bold', 'italic', 'underline'],
					['image']
				]
			},
			placeholder: 'Type your message here...',
			theme: 'snow'
		});



		var quillNotEmpty = function () {
			return {
				validate: function (input) {
					const value = input.value;

					return {
						valid: !(quill.getText().trim().length === 0 && quill.container.firstChild.innerHTML.includes("img") === false),
					};
				},
			};
		};

		FormValidation.validators.quillNotEmpty = quillNotEmpty;

		FormValidation
			.formValidation(
				form,
				{
					fields: {
						message: {
							validators: {
								quillNotEmpty: {
									message: 'Message is required'
								}
							}
						},
						subject: {
							validators: {
								notEmpty: {
									message: 'Subject is required'
								}
							}
						}
					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
						//defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
							//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
							//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
					}
				}
			)
			.on('core.form.valid', function () {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				KTApp.blockPage({
					overlayColor: '#000000',
					state: 'primary',
					message: 'Processing...'
				});

				$.post('/settings/emails', {
					subject: $('#new_invoice_email_form input[name="subject"]').val(),
					message: quill.root.innerHTML.split('  ').join(' &nbsp;'),
					type: 'invoice_created'
				}).done(function () {
					Swal.fire({
						text: "Settings have been saved...",
						icon: "success",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light-primary"
						}
					});
				}).fail(function (data) {
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
				}).always(function () {
					KTUtil.btnRelease(formSubmitButton);
					KTApp.unblockPage();
				});

			})
			.on('core.form.invalid', function () {

				Swal.fire({
					text: "Sorry, looks like there are some errors detected, please try again.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function () {
					KTUtil.scrollTop();
				});
			});








	}

	var _handleDueInvoiceEmailForm = function () {
		// Base elements
		var form = document.getElementById('due_invoice_email_form');
		var formSubmitButton = document.getElementById('due_invoice_email_form_submit');


		if (!form) {
			return;
		}

		var quill = new Quill('#due_invoice_email_quil', {
			modules: {
				toolbar: [
					[{
						header: [1, 2, false]
					}],
					['bold', 'italic', 'underline'],
					['image']
				]
			},
			placeholder: 'Type your message here...',
			theme: 'snow'
		});



		var quillNotEmpty = function () {
			return {
				validate: function (input) {
					const value = input.value;

					return {
						valid: !(quill.getText().trim().length === 0 && quill.container.firstChild.innerHTML.includes("img") === false),
					};
				},
			};
		};

		FormValidation.validators.quillNotEmpty = quillNotEmpty;

		FormValidation
			.formValidation(
				form,
				{
					fields: {
						message: {
							validators: {
								quillNotEmpty: {
									message: 'Message is required'
								}
							}
						},
						subject: {
							validators: {
								notEmpty: {
									message: 'Subject is required'
								}
							}
						}
					},
					plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
						//defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
							//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
							//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
					}
				}
			)
			.on('core.form.valid', function () {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				KTApp.blockPage({
					overlayColor: '#000000',
					state: 'primary',
					message: 'Processing...'
				});

				$.post('/settings/emails', {
					subject: $('#due_invoice_email_form input[name="subject"]').val(),
					message: quill.root.innerHTML.split('  ').join(' &nbsp;'),
					type: 'invoice_due'
				}).done(function () {
					Swal.fire({
						text: "Settings have been saved...",
						icon: "success",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light-primary"
						}
					});
				}).fail(function (data) {
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
				}).always(function () {
					KTUtil.btnRelease(formSubmitButton);
					KTApp.unblockPage();
				});

			})
			.on('core.form.invalid', function () {
				Swal.fire({
					text: "Sorry, looks like there are some errors detected, please try again.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function () {
					KTUtil.scrollTop();
				});
			});
	}

	var _handleNavigation = function () {
		function openTab() {
			if (window.location.hash && $('#secondory_tabs ' + window.location.hash).length > 0) {
				//hide old tab and show new according to hash from url
				let $tab = $(window.location.hash);
				let $parent_tab = $tab.parent().closest('[role="tabpanel"]');
				$('.tab-pane').removeClass('active').removeClass('show');
				$('.nav-link').removeClass('active');
				$('[href="' + window.location.hash + '"]').addClass('active');
				$('[href="#' + $parent_tab.attr('id') + '"]').addClass('active');

				$parent_tab.tab('show');
				$tab.tab('show');
			}
            setMenuItemActive();
		}
		openTab();

		$(window).on('hashchange', openTab);

        if(window.location.hash == '') {
            window.location.hash = '#user_profile_tab';
        }

		$('#settingsTabSide .nav-link').on('click', function (e) {
			e.preventDefault()
			$(this).tab('show');
			$($($(this).attr('href') + ' .nav-link')[0]).tab('show'); //activate first tab
			window.location.hash = $($($(this).attr('href') + ' .nav-link')[0]).attr('href');
		});

		$('#secondory_tabs .nav-link').on('click', function (e) {
			window.location.hash = $(this).attr('href');
		});
	}

	// Public Functions
	return {
		init: function () {
			// var sticky = new Sticky('.sticky');

			_handleFormChangePassword();
			_handleBusinessInfoForm();
			_handleBusinessAddressForm();

			_handleProfileInfoForm();
			_handleBankDetailsForm();

			_handleLayoutSettingsForm();
			_handleUpdateCurrencyForm();

			_handleTaxes();

			_handlePaymentSettings();
			_handlePaypalForm();
			_handleStripeForm();
			_handleRazorPayForm();

			_handleNewInvoiceEmailForm();
			_handleDueInvoiceEmailForm();

			_handleNavigation();
		},
		change_password: function () {
			change_password_form_validation.validate();
		}
	};
}();

// Class Initialization
jQuery(document).ready(function () {
	UserSettings.init();
});
