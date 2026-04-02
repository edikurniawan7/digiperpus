<!-- Aksi Kembalikan Buku -->
<?php

session_start();
include '../config.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Cek apakah id_transaksi sudah dikirim
if (!isset($_GET['id_transaksi'])) {
    echo "ID transaksi tidak ditemukan.";
    exit;
}   

$id_transaksi = intval($_GET['id_transaksi']);

// Update status transaksi menjadi 'dikembalikan'
$update_query = "UPDATE transaksi SET status='dikembalikan' WHERE id_transaksi=?";
$stmt = mysqli_prepare($config, $update_query);
mysqli_stmt_bind_param($stmt, "i", $id_transaksi);
if (mysqli_stmt_execute($stmt)) {
    // Ambil id_buku dan jumlah dari transaksi untuk mengembalikan stok
    $transaksi_query = "SELECT id_buku, jumlah FROM transaksi WHERE id_transaksi=?";
    $stmt2 = mysqli_prepare($config, $transaksi_query);
    mysqli_stmt_bind_param($stmt2, "i", $id_transaksi);
    mysqli_stmt_execute($stmt2);
    $transaksi_result = mysqli_stmt_get_result($stmt2);
    $transaksi = mysqli_fetch_assoc($transaksi_result);
    
    if ($transaksi) {
        $id_buku = intval($transaksi['id_buku']);
        $jumlah = intval($transaksi['jumlah']);

        // Update stok buku
        $update_stok_query = "UPDATE buku SET stok = stok + ? WHERE id_buku=?";
        $stmt3 = mysqli_prepare($config, $update_stok_query);
        mysqli_stmt_bind_param($stmt3, "ii", $jumlah, $id_buku);
        mysqli_stmt_execute($stmt3);

        header("Location: ../admin/daftar_transaksi.php?pesan=sukses_kembalikan");
        exit;
    } else {
        header("Location: ../admin/daftar_transaksi.php?pesan=gagal_kembalikan");
        exit;
    }
} else {
    header("Location: ../admin/daftar_transaksi.php?pesan=gagal_kembalikan");
    exit;
}
    