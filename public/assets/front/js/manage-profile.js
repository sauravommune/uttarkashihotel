$('body').on('click', '.update-profile', function (e) {

    $('#updateBtn').show();
    $('.update-profile').hide();    
    $('#email').val(email);
    $('#name').val(username);
    $('#mobile_no').val(phone);
    $('#address').val(address);
    $('#dob').val(dob);
    $('#gender').val(gender);
    $('#email, #name, #mobile_no, #address, #gender').removeAttr('disabled');
    $('#dob').removeAttr('readonly');
    $('label').removeClass('mail-disabled');

});
$('body').on('click', '.update-password', function (e) {
    $('#updatePasswordBtn').show();
    $('.update-password').hide();
    $('#password,#new_password ,#confirm_password').removeAttr('disabled');
    $('label').removeClass('mail-disabled');

});
    
