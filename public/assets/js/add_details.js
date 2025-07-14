$(document).ready(function() {

    const initialTime = 3600;
    let countdown = localStorage.getItem('countdown') ?
        parseInt(localStorage.getItem('countdown')) :
        initialTime;

    function updateTimer() {
        const minutes = Math.floor(countdown / 60);
        const seconds = countdown % 60;
        $('#timer').text(`${minutes}:${seconds < 10 ? '0' : ''}${seconds}`);
    }

    function startCountdown() {
        setInterval(function() {
            if (countdown > 0) {
                countdown--;
                updateTimer();
                localStorage.setItem('countdown', countdown);
            }
        }, 1000);
    }
    updateTimer();
    startCountdown();
});
$(document).ready(function() {
    $('input[name="mailGest"]').on('click', function() {
        if ($('input[name="mailGest"]:checked').val()) {
            var selectedValue = $('input[name="mailGest"]:checked').val();
            var authUserName = "{{ auth()->user()->name ?? '' }}";
            var authUserEmail = "{{ auth()->user()->email ?? '' }}";
            var authUserDob = "{{ auth()->user()->dob ?? '' }}";
            var authUserGender = "{{ auth()->user()->gender ?? '' }}";
            $('#full_name_0').val(authUserName);
            $('#email_0').val(authUserEmail);
            $('#dob_0').val(authUserDob);
            $('#gender_0').val(authUserGender);

        } else {
            $('#full_name_0').val('');
            $('#email_0').val('');
            $('#dob_0').val('');
            $('#gender_0').val('');

        }

    });
});

$(document).ready(function() {
    // When a checkbox is clicked
    $('.traveler-checkbox').on('change', function() {
        var travelerIndex = $(this).attr('id').split('_')[1]; // Extract the index from checkbox id

        // Get the data from the checkbox
        var name = $(this).data('name');
        var email = $(this).data('email');
        var gender = $(this).data('gender');
        var dob = $(this).data('dob');

        // If checkbox is checked, populate the form
        if ($(this).is(':checked')) {
            $('#full_name_' + travelerIndex).val(name);
            $('#email_' + travelerIndex).val(email);
            $('#gender_' + travelerIndex).val(gender);
            $('#dob_' + travelerIndex).val(dob);
        } else {
            // If unchecked, clear the fields
            $('#full_name_' + travelerIndex).val('');
            $('#email_' + travelerIndex).val('');
            $('#gender_' + travelerIndex).val('');
            $('#dob_' + travelerIndex).val('');
        }
    });
});