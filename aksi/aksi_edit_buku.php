<?php 
    include '../config.php';

    // Ambil data dari form
    $id_buku = $_POST['id_buku'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $id_kategori = $_POST['id_kategori'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    // Cek apakah ada file cover yang diunggah
    if ($_FILES['cover']['name'] != '') {
        // Hapus cover lama jika ada
        $query_lama = "SELECT cover FROM buku WHERE id_buku='$id_buku'";
        $result_lama = mysqli_query($config, $query_lama);
        $data_lama = mysqli_fetch_assoc($result_lama);
        if ($data_lama && file_exists("../uploads/cover" . $data_lama['cover'])) {
            unlink("../uploads/cover" . $data_lama['cover']);
        }

        // Upload cover baru
        $nama_file = $_FILES['cover']['name'];
        $ukuran_file = $_FILES['cover']['size'];
        $tmp_file = $_FILES['cover']['tmp_name'];

        // Format nama file dengan timestamp untuk menghindari konflik
        $nama_file_baru = "cover_" . time() . "_" . basename($nama_file);

        // Direktori penyimpanan cover
        $dir_upload = "../uploads/cover/";

        // Pindahkan file ke direktori penyimpanan
        if (move_uploaded_file($tmp_file, $dir_upload . $nama_file_baru)) {
            // Update data buku dengan cover baru
            mysqli_query($config, "UPDATE buku SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit', tahun_terbit='$tahun_terbit', id_kategori='$id_kategori', stok='$stok', deskripsi='$deskripsi', cover='$nama_file_baru' WHERE id_buku='$id_buku'");
        } else {
            echo "Gagal mengunggah file.";
            exit;
        }
    } else {
        // Jika tidak ada file cover baru, update data tanpa mengubah cover
        mysqli_query($config, "UPDATE buku SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit', tahun_terbit='$tahun_terbit', id_kategori='$id_kategori', stok='$stok', deskripsi='$deskripsi' WHERE id_buku='$id_buku'");
    }

    header("Location: ../admin/daftar_buku.php");
?>