$(document).ready(function(){

    $.validator.addMethod('regex', function (value, element, regexp) {
        var response = grecaptcha.getResponse();
        return this.optional(element) || regexp.test(value) || response.length > 0;

    }, 'Invalid format.');

    if( $('#sign_up_form').length > 0 ){
        $('#sign_up_form').validate({
            rules:{
                username:{
                    required: true,
                    regex: /^[a-zA-Z0-9]+$/
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation:{
                    required: true,
                    equalTo: "#mainpassword"
                },
                toc: {
                    required: true
                },
                'g-recaptcha-response': {
                    recaptcha: true
                }
            },
            messages:{
                first_name: "First name is required.",
                last_name: "Last Name is required.",
                username: {
                    required: "Username is required.",
                    regex: "No spaces or special characters allowed."
                },
                email: "Email is required.",
                password: {
                    required: "Password is required.",
                    minlength: "Password must be a minimum of 8 characters."
                },
                password_confirmation: {
                    required: "Confirm password is required.",
                    equalTo: "Password & Confirm Password should be same."
                },
                toc: "You must accept the Terms of Service.",
                'g-recaptcha-response': "Please complete the reCAPTCHA."
            }
        });
    }

    if( $('#sign_in_form').length > 0 ){
        $('#sign_in_form').validate();
    }
    $('body').on('submit', '#sign_in_form, #sign_up_form', function(e){
        e.preventDefault();
        let _this = $(this);
        if( _this.valid() ){
            let _button = _this.find('[type=submit]');
            let formData = _this.serializeArray();
            let url = _this.attr('action');

            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                beforeSend: function() {
                    var recaptchaResponse = grecaptcha.getResponse();
                    if (recaptchaResponse.length === 0) {
                        alert('Please complete the reCAPTCHA.');
                    }
                    _button.find('.indicator-label').hide();
                    _button.find('.indicator-progress').show();
                },
                success: function(data) {
                    if(data.status == '200' && data.redirect){
                        window.location.href = data.redirect;
                    }else{
                        Swal.fire({
                            text: data.message,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                },
                error: function(xhr) { // if error occured
                    Swal.fire({
                        text: xhr.responseJSON.message,
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                },
                complete: function() {
                    _button.find('.indicator-label').show();
                    _button.find('.indicator-progress').hide();
                },
            });

        }
        return false;
    });
});