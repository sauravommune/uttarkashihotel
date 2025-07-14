$.validator.addMethod("arrayRequired", function (value, element) {
    var isValid = true;
    $(element).each(function () {
        if ($(this).val() === "" || $(this).val() == 0) {
            isValid = false;
            return false;
        }
    });

    return isValid;
});

$("#step1form").validate({
    rules: {
        hotel: {
            required: true,
        },
        room_type: {
            required: true,
            remote: {
                url: base_url + "/rooms/room-type/unique",
                type: "get",
                data: {
                    room_type: function () {
                        return $("select[name='room_type']").val();
                    },
                    id: function () {
                        return $("input[name='id']").val();
                    },
                    hotel_id: function () {
                        // return $("select[name='hotel']").val();
                        return $("input[name='hotel']").val();

                    },
                },
            },
        },
        room_desc: {
            required: true,
        },

        total_rooms: {
            required: true,
            min: 1,
        },
        children_bed_price: {
            required: true,
            min: 1,
        },
        adult_bed_price: {
            required: true,
            min: 1,
        },
        gest_stay: {
            required: true,
            min: 1,
        },
        room_size: {
            required: true,
        },
        measure: {
            required: true,
        },
        smoking_option: {
            required: true,
        },
        "bed_type[]": {
            arrayRequired: true,
        },
        "bed[]": {
            arrayRequired: true,
            min: 1,
        },
    },
    errorPlacement: function (error, element) {
        if (element.attr("name") === "bed_type[]") {
            error.insertAfter(element);
        } else {
            error.insertAfter(element);
        }
    },

    messages: {
        total_rooms: {
            required: "Total rooms are required.",
            min: "Total rooms must be greater than 0.",
        },
        children_bed_price: {
            required: "Children bed price are required.",
            min: "Children bed price must be greater than 0.",
        },
        adult_bed_price: {
            required: "Adult bed price are required.",
            min: "Adult bed price must be greater than 0.",
        },
        room_type: {
            remote: "This type room already exists.",
        },

        gest_stay: {
            required: "Guest stay field required.",
            min: "Total Guest stay must be greater than 0.",
        },
    },
});

// $("select[name='room_type']").on('change', function() {

//     var id = $("input[name='id']").val();
//     var hotelId = $("select[name='hotel']").val();
//     $("input[name='id']").val(id);
//     $("select[name='hotel']").val(hotelId);
//     $("#step1form").validate().element($(this));

// });

// $("#step2form").validate({
//     rules: {
//         "general_amenities[]": {
//             required: true,
//         },
//         "outdoor_views[]": {
//             required: true,
//         },
//         "food_and_drinks[]": {
//             required: true,
//         },

//         "bathroom_facilities[]": {
//             required: true,
//         },
//     },
// });

$("#step3form").validate({
    rules: {
        guest_cancel: {
            required: true,
        },
        cancellation_period: {
            required: true,
        },
        measure_day: {
            required: true,
        },
    },
});

$("#step4form").validate({
    rules: {
        "images[]": {
            required: true,
        },
    },
    messages: {
        images: {
            required: "Please upload an room image.",
        },
    },
});

$(function () {
    $('select[name = "measure"]').select2({
        minimumResultsForSearch: Infinity,
    });
});
