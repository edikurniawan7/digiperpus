<!-- Aksi Registrasi -->
<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username sudah ada
    $checkQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkResult = mysqli_query($config, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Username sudah ada, redirect kembali dengan pesan error
        header("Location: ../auth/registrasi.php?error=1");
        exit();
    }

    // Simpan data ke database
    $insertQuery = "INSERT INTO users (nama, username, password) VALUES ('$nama', '$username', '$password')";
    
    if (mysqli_query($config, $insertQuery)) {
        // Registrasi berhasil, redirect ke halaman login
        header("Location: ../auth/login.php?success=1");
        exit();
    } else {
        // Terjadi kesalahan saat menyimpan data
        header("Location: ../auth/registrasi.php?error=2");
        exit();
    }
} else {
    // Jika bukan POST request, redirect kembali ke halaman registrasi
    header("Location: ../auth/registrasi.php");
    exit();
}
