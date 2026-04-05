document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeOffIcon');
    const eyeOffIcon = document.getElementById('eyeIcon');

    if (!togglePassword || !passwordInput || !eyeIcon || !eyeOffIcon) return;

    togglePassword.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';

        eyeIcon.classList.toggle('hidden');
        eyeOffIcon.classList.toggle('hidden');
    });
});
