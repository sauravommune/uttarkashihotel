"use strict";

/**
 * Function to Server Key.
 * Genrated Random Key
 */

function generateUUID() {
    var d = new Date().getTime();

    if (window.performance && typeof window.performance.now === "function") {
        d += performance.now();
    }

    var uuid = "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(
        /[xy]/g,
        function (c) {
            var r = (d + Math.random() * 16) % 16 | 0;
            d = Math.floor(d / 16);
            return (c == "x" ? r : (r & 0x3) | 0x8).toString(16);
        }
    );

    return uuid;
}

$("#keygen").on("click", function () {
    $("#apikey").val(generateUUID());
});

// Delete button handler
$("body").on("click", ".delete_keyForm", function (e) {
    // Prevent default button action
    e.preventDefault();
    var id = $(this).data("id");

    // Validate form before delete
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .post(BASE_URL + "/serverKey-delete/" + id)
                .then(function (response) {
                    if (response) {
                        location.reload();
                    }
                })
                .catch(function (error) {
                    Swal.fire({
                        text: error.response.data.msg,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });
                });
        }
    });
});

$(document).on("click", ".copy-button", function() {
    let inputElement = $(this).siblings("input")[0];
    inputElement.select();
    document.execCommand("copy");
    inputElement.setSelectionRange(0, 0);
});

