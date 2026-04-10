document.addEventListener('DOMContentLoaded', () => {

    // ===== TOGGLE PASSWORD =====
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


    // ===== VALIDASI LOGIN =====
   document.addEventListener('DOMContentLoaded', () => {

    console.log("JS jalan");

    const urlParams = new URLSearchParams(window.location.search);
    const pesan = urlParams.get('pesan');

    console.log("Pesan:", pesan);

    const errorBox = document.getElementById('errorMessage');

    if (!errorBox) {
        console.log("errorBox tidak ditemukan!");
        return;
    }

    if (pesan === 'gagal') {
        errorBox.classList.remove('hidden');
        errorBox.innerHTML = `
            <span class="text-sm font-medium">
                Username atau password salah!
            </span>
        `;
    }

});
});