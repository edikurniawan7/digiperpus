<?php
include '../config.php';
session_start();

$id_user         = $_POST['id_user'];
$nama            = $_POST['nama'];
$username        = $_POST['username'];
$password        = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

if (empty($nama) || empty($username)) {
    echo "<script>alert('Nama dan Username wajib diisi!'); window.history.back();</script>";
    exit;
}

if (!empty($password)) {

    if ($password !== $confirmPassword) {
        echo "<script>alert('Konfirmasi password tidak cocok!'); window.history.back();</script>";
        exit;
    }

    // TANPA HASH
    $query = mysqli_query($config, "UPDATE users SET 
        nama='$nama',
        username='$username',
        password='$password'
        WHERE id_user='$id_user'
    ");
} else {

    $query = mysqli_query($config, "UPDATE users SET 
        nama='$nama',
        username='$username'
        WHERE id_user='$id_user'
    ");
}

if ($query) {
    echo "<script>alert('Data anggota berhasil diperbarui!'); window.location='../admin/daftar_anggota.php';</script>";
} else {
    echo "<script>alert('Gagal memperbarui data!'); window.history.back();</script>";
}
