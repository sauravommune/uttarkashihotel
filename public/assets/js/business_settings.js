$(document).ready(function () {
    $.validator.addMethod(
        "validBusinessSite",
        function (value, element) {

            // Define the regex pattern for the business site
            var pattern = /(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]/i;
            // Test the value against the regex pattern
            return value ? pattern.test(value) : true;
        },
        "Invalid business site"
    );

    $('#business_info_form').validate({
        rules: {
            business_name: {
                required: true,
            },
            business_site: {
                required: false,
                validBusinessSite: true
            },
            phone: {
                required: true,
            },
        },
        messages: {
            business_name: "Business Name is required.",
            business_site: {
                required: "Business site is required.",
            },
            phone: {
                required: "Phone is required.",
            },
        },
        errorPlacement: function (error, element) {
            var placement = $(element).parents('div.input-group');
            if (placement.length > 0) {
                $(placement).after(error);
            } else {
                error.insertAfter(element);
            }
        }
    });

    $('#business_info_form').validate({
        rules: {
            address_1: {
                required: true,
            },
            postcode: {
                required: true,
            },
            city: {
                required: true,
            },
            state: {
                required: true,
            },
            country: {
                required: true,
            },
        },
        messages: {
            address_1: "Address_1 is required.",
            address_2: "Address_2 is required.",
            city: "City is required.",
            state: "State is required.",
            country: "Country is required.",
        },
        errorPlacement: function (error, element) {
            var placement = $(element).parents('div.input-group');
            if (placement.length > 0) {
                $(placement).after(error);
            } else {
                error.insertAfter(element);
            }
        }
    });

    $('#broker_gst_compliant').change(function() {
        if ($(this).val() == 'No') {
            $('.broker_stamp_div').show();
            $('.broker_gst_compliant_div').hide();
        } else {
            $('.broker_stamp_div').hide();
            $('.broker_gst_compliant_div').show();
        }
    });

})
