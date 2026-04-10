<?php
include '../config.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// ambil data user
$query = mysqli_query($config, "SELECT * FROM users WHERE id_user='$id_user'");
$user = mysqli_fetch_assoc($query);

// default foto
$foto = !empty($user['foto']) ? $user['foto'] : 'default.png';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil - Digiperpus</title>
    <link href="../src/output.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">

<?php include 'partials/sidebar.php'; ?>

<main class="flex-1 ml-64 p-8 mt-20">
<div class="max-w-xl mx-auto">

<div class="bg-white/70 backdrop-blur-xl rounded-3xl shadow-xl border p-8">

<!-- FOTO -->
<div class="flex flex-col items-center text-center">
    <div class="relative group w-28 h-28">

    <img id="previewFoto"
         src="../uploads/<?= $foto ?>"
         class="w-28 h-28 rounded-full object-cover shadow-md">

    <!-- Overlay -->
    <label class="absolute inset-0 bg-black/40 rounded-full opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-sm cursor-pointer transition">
        Ganti
        <input type="file" id="inputFoto" class="hidden" accept="image/*">
    </label>

    <!-- ICON EDIT -->
    <div class="absolute bottom-0 right-0 bg-cyan-500 text-white p-2 rounded-full shadow-md text-xs">
        
    </div>

</div>

    <h2 class="mt-4 text-2xl font-semibold text-gray-800">
        <?= htmlspecialchars($user['nama']); ?>
    </h2>

    <p class="text-gray-400 text-sm">Anggota • Digiperpus</p>
</div>

<div class="my-6 border-t"></div>

<form id="formProfil">

<div class="space-y-5">

<!-- USERNAME -->
<div>
    <p class="text-xs text-gray-400 mb-1">Username</p>

    <span id="textUsername" class="text-lg">
        <?= htmlspecialchars($user['username']); ?>
    </span>

    <input type="text" id="inputUsername"
        value="<?= htmlspecialchars($user['username']); ?>"
        class="hidden w-full border-b focus:border-cyan-400 outline-none bg-transparent">
</div>

<!-- PASSWORD -->
<div>
    <p class="text-xs text-gray-400 mb-1">Password</p>

    <span id="textPassword">•••••••</span>

    <input type="password" id="inputPassword"
        placeholder="Password baru"
        class="hidden w-full border-b focus:border-cyan-400 outline-none bg-transparent">
</div>

</div>

<!-- BUTTON -->
<div class="mt-8 flex justify-between">

<button type="button" id="btnEdit" class="text-cyan-600">
    Edit Profil
</button>

<div class="space-x-2">
<button type="button" id="btnCancel"
    class="hidden px-4 py-2 bg-gray-200 rounded-lg">
    Batal
</button>

<button type="button" id="btnSave"
    class="hidden px-5 py-2 bg-cyan-500 text-white rounded-lg">
    Simpan
</button>
</div>

</div>
</form>

</div>
</div>
</main>

<!-- NOTIF -->
<div id="notif"
class="fixed top-6 right-6 bg-green-500 text-white px-6 py-3 rounded-xl hidden">
Berhasil update profil
</div>

<script>
// ambil elemen
const btnEdit = document.getElementById('btnEdit');
const btnCancel = document.getElementById('btnCancel');
const btnSave = document.getElementById('btnSave');

const textUsername = document.getElementById('textUsername');
const inputUsername = document.getElementById('inputUsername');

const textPassword = document.getElementById('textPassword');
const inputPassword = document.getElementById('inputPassword');

const inputFoto = document.getElementById('inputFoto');
const previewFoto = document.getElementById('previewFoto');

// EDIT
btnEdit.onclick = () => {
    textUsername.classList.add('hidden');
    inputUsername.classList.remove('hidden');

    textPassword.classList.add('hidden');
    inputPassword.classList.remove('hidden');

    btnEdit.classList.add('hidden');
    btnCancel.classList.remove('hidden');
    btnSave.classList.remove('hidden');
};

// CANCEL
btnCancel.onclick = () => {
    location.reload();
};

// PREVIEW FOTO
inputFoto.onchange = () => {
    const file = inputFoto.files[0];
    if (file) {
        previewFoto.src = URL.createObjectURL(file);
    }
};

// SAVE
btnSave.onclick = async () => {
    const formData = new FormData();

    formData.append('username', inputUsername.value);
    formData.append('password', inputPassword.value);

    // CEGAH ERROR kalau foto kosong
    if (inputFoto.files.length > 0) {
        formData.append('foto', inputFoto.files[0]);
    }

    try {
        const res = await fetch('../aksi/aksi_edit_profil.php', {
            method: 'POST',
            body: formData
        });

        const result = await res.text();
        console.log(result); // debug

        if (result.trim() === 'success') {
            const notif = document.getElementById('notif');
            notif.classList.remove('hidden');

            setTimeout(() => location.reload(), 1200);
        } else {
            alert('Gagal update: ' + result);
        }

    } catch (err) {
        console.error(err);
        alert('Terjadi error!');
    }
};
</script>

</body>
</html>