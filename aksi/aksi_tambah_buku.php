<?php
include '../config.php';

// Ambil data dari form
$judul         = $_POST['judul'];
$pengarang     = $_POST['pengarang'];
$penerbit      = $_POST['penerbit'];
$tahun_terbit  = $_POST['tahun_terbit'];
$id_kategori   = $_POST['id_kategori'];
$stok          = $_POST['stok'];
$deskripsi     = $_POST['deskripsi'];


// ====================
// UPLOAD COVER
// ====================
$cover = $_FILES['cover']['name'];
$cover_tmp = $_FILES['cover']['tmp_name'];

$cover_name = time() . '_' . $cover;
$folder_cover = '../uploads/cover/' . $cover_name;

move_uploaded_file($cover_tmp, $folder_cover);


// UPLOAD FILE PDF
$file_buku = null;

if (isset($_FILES['file_buku']) && $_FILES['file_buku']['error'] === 0) {

    $file_name = $_FILES['file_buku']['name'];
    $tmp_name  = $_FILES['file_buku']['tmp_name'];
    $ext       = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if ($ext === 'pdf') {
        $new_pdf = time() . '_' . $file_name;
        $folder_pdf = '../uploads/buku/' . $new_pdf;

        move_uploaded_file($tmp_name, $folder_pdf);

        $file_buku = $new_pdf;
    }
}

// INSERT KE DATABASE
$query = "INSERT INTO buku 
(judul, pengarang, penerbit, tahun_terbit, id_kategori, stok, deskripsi, cover, file_buku)
VALUES 
('$judul', '$pengarang', '$penerbit', '$tahun_terbit', '$id_kategori', '$stok', '$deskripsi', '$cover_name', '$file_buku')";

$result = mysqli_query($config, $query);

//BATAS UKURAN FILE PDF
if ($_FILES['file_buku']['size'] > 5000000) {
    echo "File terlalu besar!";
    exit;
}

//VALIDASI EKSTENSI FILE PDF
if ($ext !== 'pdf') {
    echo "File harus PDF!";
    exit;
}


// REDIRECT
if ($result) {
    header("Location: ../admin/daftar_buku.php?pesan=berhasil_tambah");
} else {
    header("Location: ../admin/daftar_buku.php?pesan=gagal_tambah");
}
exit();