<?php
    include '../config.php';

    // Ambil ID buku dari parameter URL
    if (isset($_GET['id_buku'])) {
        $id_buku = $_GET['id_buku'];

        // Hapus buku dari database
        $query = "DELETE FROM buku WHERE id_buku='$id_buku'";
        if (mysqli_query($config, $query)) {
            // Redirect 
            header("Location: daftar_buku.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($config);
        }
    } else {
        echo "ID buku tidak ditemukan.";
    }

    mysqli_close($config);