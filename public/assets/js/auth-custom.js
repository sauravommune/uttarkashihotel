document.getElementById('toggle_password').addEventListener('click', function () {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggle_password');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.textContent = 'visibility';
    } else {
        passwordInput.type = 'password';
        toggleIcon.textContent = 'visibility_off';
    }
});
