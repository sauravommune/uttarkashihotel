$(document).ready(function () {
    $("body").on("click", ".delete-btn", function (e) {
        e.preventDefault();
        var url = $(this).attr("data-url");
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
            preConfirm: function () {
                return $.ajax({
                    url: url,
                    type: "GET",
                }).done(function (data) {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                });
            },
        }).then(function (result) {
            if (result.isConfirmed) {
                if (table) {
                    table.ajax.reload(null, false);
                }
            }
        });
    });
});
