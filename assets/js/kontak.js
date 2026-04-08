const form = document.getElementById('contactForm');
const messageBox = document.getElementById('formMessage');
const submitBtn = document.getElementById('submitBtn');

form.addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(form);

    submitBtn.disabled = true;
    submitBtn.innerText = "Mengirim...";

    messageBox.innerText = "";
    messageBox.className = "text-sm text-center mt-2";

    try {
        const res = await fetch('public/kirim_pesan.php', {
            method: 'POST',
            body: formData
        });

        const text = await res.text();
        console.log("RAW RESPONSE:", text);

        let data;
        try {
            data = JSON.parse(text);
        } catch {
            throw new Error("Response bukan JSON");
        }

        if (data.status === 'success') {
            messageBox.innerText = "Pesan berhasil dikirim!";
            messageBox.classList.add("text-green-600");
            form.reset();
        } else {
            messageBox.innerText = data.message || "Gagal mengirim pesan.";
            messageBox.classList.add("text-red-600");
        }

    } catch (error) {
        console.error(error);
        messageBox.innerText = "Server error / response tidak valid.";
        messageBox.classList.add("text-red-600");
    }

    submitBtn.disabled = false;
    submitBtn.innerText = "Kirim Pesan";
});