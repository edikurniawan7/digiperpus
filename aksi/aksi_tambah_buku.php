<?php
include '../config.php';

// Ambil data dari form
$judul         = $_POST['judul'];
$pengarang     = $_POST['pengarang'];
$penerbit      = $_POST['penerbit'];
$tahun_terbit  = $_POST['tahun_terbit'];
$id_kategori   = $_POST['id_kategori']; // Ambil langsung id_kategori dari form
$stok          = $_POST['stok'];
$deskripsi     = $_POST['deskripsi'];

$cover     = $_FILES['cover']['name'];
$cover_tmp = $_FILES['cover']['tmp_name'];
$folder    = '../uploads/cover/' . $cover;

// Upload cover
move_uploaded_file($cover_tmp, $folder);

// Insert ke tabel buku 
$query = "INSERT INTO buku 
(judul, pengarang, penerbit, tahun_terbit, id_kategori, stok, deskripsi, cover)
VALUES 
('$judul', '$pengarang', '$penerbit', '$tahun_terbit', '$id_kategori', '$stok', '$deskripsi', '$cover')";

$result = mysqli_query($config, $query);

if ($result) {
    header("Location: ../admin/daftar_buku.php?pesan=berhasil_tambah");
} else {
    header("Location: ../admin/daftar_buku.php?pesan=gagal_tambah");
}
exit();
