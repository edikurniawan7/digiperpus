const btnEdit = document.getElementById('btnEdit');
const btnCancel = document.getElementById('btnCancel');
const btnSave = document.getElementById('btnSave');

const textUsername = document.getElementById('textUsername');
const inputUsername = document.getElementById('inputUsername');

const textPassword = document.getElementById('textPassword');
const inputPassword = document.getElementById('inputPassword');

const notif = document.getElementById('notif');

// MODE EDIT
btnEdit.onclick = () => {
    textUsername.classList.add('hidden');
    inputUsername.classList.remove('hidden');

    textPassword.classList.add('hidden');
    inputPassword.classList.remove('hidden');

    btnEdit.classList.add('hidden');
    btnSave.classList.remove('hidden');
    btnCancel.classList.remove('hidden');
};

// BATAL
btnCancel.onclick = () => {
    textUsername.classList.remove('hidden');
    inputUsername.classList.add('hidden');

    textPassword.classList.remove('hidden');
    inputPassword.classList.add('hidden');

    btnEdit.classList.remove('hidden');
    btnSave.classList.add('hidden');
    btnCancel.classList.add('hidden');

    inputPassword.value = "";
};

// SIMPAN (AJAX)
btnSave.onclick = async () => {

    const username = inputUsername.value;
    const password = inputPassword.value;

    if (!username) {
        alert("Username tidak boleh kosong");
        return;
    }

    const formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);

    try {
        const response = await fetch('aksi_edit_profil.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.text();

        if (result === 'success') {

            // update tampilan
            textUsername.innerText = username;

            // balik ke mode awal
            btnCancel.click();

            // notif
            notif.classList.remove('hidden');
            setTimeout(() => notif.classList.add('hidden'), 2000);

        } else {
            alert(result);
        }

    } catch (error) {
        alert("Error koneksi");
    }
};