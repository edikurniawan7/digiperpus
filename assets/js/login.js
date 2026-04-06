document.addEventListener('DOMContentLoaded', () => {
    const toggle = (btn, input, eye, eyeOff) => {
        btn?.addEventListener('click', () => {
            const hidden = input.type === 'password';
            input.type = hidden ? 'text' : 'password';
            eye.classList.toggle('hidden');
            eyeOff.classList.toggle('hidden');
        });
    };

    toggle(
        document.getElementById('togglePassword'),
        document.getElementById('password'),
        document.getElementById('eyeIcon'),
        document.getElementById('eyeOffIcon')
    );

    toggle(
        document.getElementById('toggleConfirmPassword'),
        document.getElementById('confirm_password'),
        document.getElementById('eyeConfirmIcon'),
        document.getElementById('eyeOffConfirmIcon')
    );
});