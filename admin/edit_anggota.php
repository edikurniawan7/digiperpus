<?php
// Koneksi ke database
include '../config.php';

// Mulai Sesi
session_start();

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

// Ambil data anggota
$query = mysqli_query($config, "SELECT * FROM users WHERE id_user='$id'");
$data = mysqli_fetch_assoc($query);

// Cek jika data tidak ada
if (!$data) {
    echo "Data anggota tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <title>Edit Anggota - Digiperpus</title>
    <link href="../src/output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">
    <!-- Sidebar -->
    <?php include 'partials/sidebar.php'; ?>
    
    <!-- Main Content -->
    <main class="ml-64 p-6 mt-16">  
        <div class="max-w-2xl mx-auto">
            <div class="mt-6 mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Edit Anggota</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui informasi anggota di bawah ini</p>
            </div>
            <!-- Form Edit Anggota -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <form action="../aksi/aksi_edit_anggota.php" method="POST">
    <input type="hidden" name="id_user" value="<?= $data['id_user']; ?>">

    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" required
                   value="<?= $data['nama']; ?>"
                   class="w-full bg-white px-3 py-2 text-sm border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500 transition">
        </div>
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
            <input type="password" name="password" id="password"
                   class="w-full bg-white px-3 py-2 text-sm border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500 transition">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
            <input type="text" name="username" id="username" required
                   value="<?= $data['username']; ?>"
                   class="w-full bg-white px-3 py-2 text-sm border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500 transition">
        </div>
        <div>
            <label for="confirm_password" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
            <input type="password" name="confirm_password" id="confirm_password"
                   class="w-full bg-white px-3 py-2 text-sm border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500 transition">
        </div>
    </div>
    <!-- Tombol Simpan -->
    <div class="flex justify-end gap-3">
        <button type="button" onclick="window.history.back()"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
            Batal
        </button>
        <button type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-secondary rounded-lg hover:bg-blue-primary transition">
            Simpan
        </button>
        
        </div>
    </main> 
    
</body>
</html>