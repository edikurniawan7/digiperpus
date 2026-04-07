<?php
include '../config.php';

$id = $_GET['id'];

mysqli_query($config, "
    UPDATE transaksi 
    SET status = 'menunggu konfirmasi'
    WHERE id_transaksi = '$id'
");

header("Location: ../user/daftar_peminjaman.php");
exit;