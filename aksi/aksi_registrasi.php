<!-- Aksi Registrasi -->
<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($config, $_POST['nama']);
    $username = mysqli_real_escape_string($config, $_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi konfirmasi password
    if ($password !== $confirm_password) {
        header("Location: ../auth/registrasi.php?error=3");
        exit();
    }

    // Cek username sudah ada atau belum
    $checkQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkResult = mysqli_query($config, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        header("Location: ../auth/registrasi.php?error=1");
        exit();
    }

    // Default role user
    $role = 'user';

    // Simpan ke database
    $insertQuery = "INSERT INTO users (nama, username, password, role) 
                    VALUES ('$nama', '$username', '$password', '$role')";
    
    if (mysqli_query($config, $insertQuery)) {
        header("Location: ../auth/login.php?success=1");
        exit();
    } else {
        header("Location: ../auth/registrasi.php?error=2");
        exit();
    }
} else {
    header("Location: ../auth/registrasi.php");
    exit();
}