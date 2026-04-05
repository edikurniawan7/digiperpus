<?php 
session_start();
include '../config.php';

// ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// cek user
$login = mysqli_query($config, 
    "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1"
);
$cek = mysqli_num_rows($login);

if ($cek > 0) {

    $data = mysqli_fetch_assoc($login);

    // simpan data ke session
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama']     = $data['nama'];
    $_SESSION['role']    = $data['role'];

    // ADMIN
    if ($data['role'] == "admin") {
        header("Location: ../admin/dashboard_admin.php");
        exit;
    }


    // user (langsung masuk dashboard)
    else if ($data['role'] == "user") {
        header("Location: ../user/dashboard.php");
        exit;
    }

    else {
        header("Location: ../auth/login.php?pesan=gagal");
        exit;
    }

} else {
    header("Location: ../auth/login.php?pesan=gagal");
    exit;
}
?>