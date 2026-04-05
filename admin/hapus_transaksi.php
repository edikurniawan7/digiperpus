<!-- Hapus Transalksi -->
<?php
include '../config.php';

$id = $_GET['id'];
$query = "DELETE FROM transaksi WHERE id_transaksi='$id'";
$result = mysqli_query($config, $query);

if ($result) {
    echo "<script>alert('Data berhasil dihapus'); window.location.href='daftar_transaksi.php';</script>";
} else {
    echo "<script>alert('Data gagal dihapus'); window
.location.href='daftar_transaksi.php';</script>";
}
?>