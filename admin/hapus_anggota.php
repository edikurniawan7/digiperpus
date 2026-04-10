<!-- Hapus Anggota -->
<?php
    include '../config.php';

    // Ambil ID anggota dari parameter URL
    if (isset($_GET['id_user'])) {
        $id_user = $_GET['id_user'];

        // Hapus anggota dari database
        $query = "DELETE FROM users WHERE id_user='$id_user'";
        if (mysqli_query($config, $query)) {
            // Redirect ke halaman daftar anggota
            header("Location: daftar_anggota.php?pesan=hapus_berhasil");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($config);
        }
    } else {
        echo "ID user tidak ditemukan.";
    }
    mysqli_close($config);

?>