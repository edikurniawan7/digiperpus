<?php
include '../config.php';
session_start();


// Ambil data dari form
$id_user = $_SESSION['id_user'];
$id_buku = $_POST['id_buku'];
$jumlah = $_POST['jumlah'];
$tanggal_pinjam = $_POST['tanggal_pinjam'];
$tanggal_kembali = $_POST['tanggal_kembali'];

// Validasi basic
if (!$id_buku || !$jumlah || !$tanggal_pinjam || !$tanggal_kembali) {
    echo "Data tidak lengkap!";
    exit;
}

// Ambil stok buku
$query_buku = mysqli_query($config, "SELECT stok FROM buku WHERE id_buku='$id_buku'");
$data_buku = mysqli_fetch_assoc($query_buku);

if (!$data_buku) {
    echo "Buku tidak ditemukan!";
    exit;
}

$stok = $data_buku['stok'];

// Validasi stok
if ($jumlah > $stok) {
    echo "Stok tidak mencukupi!";
    exit;
}

// Simpan transaksi
$insert = mysqli_query($config, "INSERT INTO transaksi 
(id_user, id_buku, jumlah, tanggal_pinjam, tanggal_kembali, status)
VALUES 
('$id_user', '$id_buku', '$jumlah', '$tanggal_pinjam', '$tanggal_kembali', 'dipinjam')");

if (!$insert) {
    echo "Gagal menyimpan transaksi: " . mysqli_error($config);
    exit;
}

// Kurangi stok
$sisa_stok = $stok - $jumlah;

$update = mysqli_query($config, "UPDATE buku SET stok='$sisa_stok' WHERE id_buku='$id_buku'");

if (!$update) {
    echo "Gagal update stok!";
    exit;
}

// Redirect
echo "<script>
    alert('Buku berhasil dipinjam!');
    window.location.href='../user/daftar_peminjaman.php';
</script>";
?>