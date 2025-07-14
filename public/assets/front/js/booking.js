$("body").on("submit", ".booking-ajax-form", function (e) {

    e.preventDefault();
    let _this = $(this);
    if (_this.valid()) {
        let _button = _this.find("[type=submit]");
        let formData = new FormData(_this[0]);
        let url = _this.attr("action");
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
                if (data.message == 'Please login') {
                    // alert('testing');
                    $("#login").removeClass("d-none");
                    $("#dropdownMenuLink").addClass("d-none");
                    $("#loginModel").modal("show");
                } else if (data.status == 200) {
                    window.location.href = data.redirect;
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
                                errorElement.parents("div.file-error").length >
                                0
                            ) {
                                errorElement
                                    .parents("div.file-error")
                                    .find(".error-file")
                                    .after(
                                        `<small id="postcode-error" class="text-danger error-level">${value[0]}</small>`
                                    );
                            } else if (
                                errorElement.parents("div.input-group").length >
                                0
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
                                errorElement.parents("div.file-error").length >
                                0
                            ) {
                                errorElement
                                    .parents("div.file-error")
                                    .find(".error-file")
                                    .after(
                                        `<span id="postcode-error" class="text-danger error-level">${value[0]}</span>`
                                    );
                            } else if (
                                errorElement.parents("div.input-group").length >
                                0
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
                            }
                        }
                    });
                }
            },
            complete: function () {
                _button.attr("disabled", false);
                _button.find(".indicator-label").show();
                _button.find(".indicator-progress").hide();
            },
        });
    }
    return false;
});

// $('body').on('submit', '.addcotraveler-ajax-form', function (e) {
//     e.preventDefault();
//     let _this = $(this);
//     if (_this.valid()) {
//         let _button = _this.find('[type=submit]');
//         let formData = new FormData(_this[0]);
//         let url = _this.attr('action');
//         $.ajax({
//             url: url,
//             method: "POST",
//             data: formData,
//             dataType: 'json',
//             contentType: false,
//             cache: false,
//             processData: false,
//             beforeSend: function () {
//                 _button.attr('disabled', true);
//                 _button.find('.indicator-label').hide();
//                 _button.find('.indicator-progress').show();
//             },
//             success: function (data) {
//                 if (data.message == "Details save successfully") {
//                     $("#no-card").addClass("d-none");
//                     $("#add-card").addClass("d-none");
//                     $("#show-card-list").removeClass("d-none");
//                     var travelers = data.data;
//                     $('#tableBody').html('');
//                     travelers.forEach(function (traveler) {

//                         var url = '{{route("cotraveler.destroy", ":id") }}';
//                         var newurl = url.replace(':id', traveler.id);

//                         var newRow = `
//                             <tr>
//                                 <td>
//                                     <div class="d-flex align-items-center">
//                                         <div class="img">
//                                             <span class="icon">${traveler.name.charAt().toUpperCase()}</span>
//                                         </div>
//                                         <div class="ps-3">
//                                             <div class="card-name">
//                                                 ${traveler.name.charAt().toUpperCase() + traveler.name.slice(1)}
//                                                 ${traveler.age > 12 ? '<span class="badge ms-2 rounded-pill badge bg-primary">Adult</span>' : '<span class="badge ms-2 rounded-pill badge bg-primary">Child</span>'}
//                                             </div>
//                                         </div>
//                                     </div>
//                                 </td>
//                                 <td>
//                                     <div class="card-name">${traveler.dob}</div>
//                                 </td>
//                                 <td>
//                                     <div class="card-name">${traveler.gender}</div>
//                                 </td>
//                                 <td>
//                              <div class="d-flex">
//                                         <div>
//                              <a href="javascript:void(0);" class="btn btn-transparent p-1 px-2 edit-item" data-id="${traveler.id}">
//                              <div class="d-flex">
//                                 <div class="icon pe-1">
//                                    <span class="icon-edit"></span>
//                                   </div>
//                                     </div>
//                                     </a>
//                                     </div>
//                                         <div>
//                                             <a href="javascript:void(0);" class="btn btn-transparent p-1 px-2 ms-3 delete-traveler" data-id="${traveler.id}">
//                                                 <div class="d-flex">
//                                                     <div class="icon">
//                                                         <span class="icon-trash"></span>
//                                                     </div>
//                                                 </div>
//                                             </a>
//                                         </div>
//                                     </div>
//                                 </td>
//                             </tr>`;
//                         $('#travelerTable tbody').append(newRow);
//                     });
//                 }
//                 $('#editModal').modal('hide');
//             },
//             error: function (xhr) {
//                 $('.error-level').remove();
//                 if (xhr.responseJSON.errors) {
//                     var i = 1;
//                     $.each(xhr.responseJSON.errors, function (key, value) {
//                         let errorElement = $(`[name="${key}"]`);
//                         if (key.includes('.')) {
//                             let parts = key.split('.');
//                             let result = parts.reduce((acc, part) => {
//                                 return acc ? acc + `[${part}]` : `${part}`;
//                             }, '');
//                             errorElement = $(`[name="${result}"]`);
//                             if (i == 1) {
//                                 errorElement.focus();
//                                 i++;
//                             }
//                             if ((errorElement.parents('div.file-error').length > 0)) {
//                                 errorElement.parents('div.file-error').find('.error-file').after(`<small id="postcode-error" class="text-danger error-level">${value[0]}</small>`);
//                             } else if (errorElement.parents('div.input-group').length > 0) {
//                                 errorElement.parents('div.input-group').after(`<small id="postcode-error" class="text-danger error-level">${value[0]}</small>`);
//                             } else if (errorElement.length > 0) {
//                                 errorElement.after(`<small id="${key}-error" class="text-danger error-level">${value[0]}</small>`);
//                             } else {
//                                 Swal.fire({
//                                     text: value[0],
//                                     icon: "error",
//                                     buttonsStyling: !1,
//                                     confirmButtonText: "Ok, got it!",
//                                     customClass: {
//                                         confirmButton: "btn btn-primary"
//                                     }
//                                 });
//                                 return false;
//                             }
//                         } else {
//                             if (i == 1) {
//                                 errorElement.focus();
//                                 i++;
//                             }
//                             if ((errorElement.parents('div.file-error').length > 0)) {
//                                 errorElement.parents('div.file-error').find('.error-file').after(`<span id="postcode-error" class="text-danger error-level">${value[0]}</span>`);
//                             } else if (errorElement.parents('div.input-group').length > 0) {
//                                 errorElement.parents('div.input-group').after(`<span id="postcode-error" class="text-danger error-level">${value[0]}</span>`);
//                             } else if (errorElement.length > 0) {
//                                 errorElement.after(`<span id="${key}-error" class="text-danger error-level">${value[0]}</span>`);
//                             }
//                         }
//                     });
//                 }
//             },
//             complete: function () {
//                 _button.attr('disabled', false);
//                 _button.find('.indicator-label').show();
//                 _button.find('.indicator-progress').hide();
//             },
//         });
//     }
//     return false;
// });
