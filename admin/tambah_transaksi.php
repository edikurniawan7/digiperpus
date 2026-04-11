<?php
include '../config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <title>Tambah Peminjaman</title>
    <link href="../src/output.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">

<?php include 'partials/sidebar.php'; ?>

<main class="flex-1 ml-64 p-8 mt-20">
    <h1 class="text-2xl font-bold text-gray-800">
        Tambah Peminjaman
    </h1>
    <p class="text-gray-600 mb-6 text-sm">
        Tambahkan peminjaman buku baru.
    </p>

    <div class="bg-white p-6 rounded-lg shadow-sm">

        <?php
// PROSES SIMPAN DATA
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_user = $_POST['id_user'];
    $id_buku = $_POST['id_buku'];
    $tanggal_pinjam = date('Y-m-d');
    $tanggal_kembali = date('Y-m-d', strtotime('+10 days'));
    $jumlah = $_POST['jumlah'];
    $status = 'dipinjam';

    // Ambil stok buku sekarang
    $cek_stok = mysqli_query($config, "SELECT stok FROM buku WHERE id_buku='$id_buku'");
    $data_stok = mysqli_fetch_assoc($cek_stok);
    $stok_sekarang = $data_stok['stok'];

    // Validasi stok cukup
    if ($stok_sekarang < $jumlah) {
        echo '<div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">Stok buku tidak mencukupi.</div>';
    } else {

        // Insert transaksi
        $insert_query = mysqli_query($config, "
            INSERT INTO transaksi (id_user, id_buku, tanggal_pinjam, tanggal_kembali, status, jumlah) 
            VALUES ('$id_user', '$id_buku', '$tanggal_pinjam', '$tanggal_kembali', '$status', '$jumlah')
        ");

        if ($insert_query) {

            // Kurangi stok
            $update_stok = mysqli_query($config, "
                UPDATE buku 
                SET stok = stok - $jumlah 
                WHERE id_buku = '$id_buku'
            ");

            echo '<div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">Peminjaman berhasil ditambahkan.</div>';
            echo '<script>setTimeout(() => { window.location.href = "daftar_transaksi.php"; }, 1500);</script>';

        } else {
            echo '<div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">Gagal menambahkan peminjaman.</div>';
        }
    }
}
?>

        <!-- FORM -->
        <form method="POST" class="mt-6">

            <!-- PILIH USER -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Pilih Anggota</label>
                <select name="id_user" class="border border-gray-300 rounded-lg px-3 py-2 text-xs w-full">
                    <?php
                    $users_query = mysqli_query($config, "SELECT id_user, nama FROM users WHERE role = 'user'");
                    while ($user = mysqli_fetch_assoc($users_query)) {
                        echo "<option value='{$user['id_user']}'>{$user['nama']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- PILIH BUKU -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Pilih Buku</label>
                <select name="id_buku" class="border border-gray-300 rounded-lg px-3 py-2 text-xs w-full">
                    <?php
                    $buku_query = mysqli_query($config, "SELECT id_buku, judul FROM buku");
                    while ($buku = mysqli_fetch_assoc($buku_query)) {
                        echo "<option value='{$buku['id_buku']}'>{$buku['judul']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- PILIH TANGGAL KEMBALI -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" 
                    min="<?= date('Y-m-d', strtotime('+1 day')); ?>"
                    max="<?= date('Y-m-d', strtotime('+10 days')); ?>"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-xs w-full">
            </div>

            <!-- TAMBAH JUMLAH BUKU YANG DIPINJAM -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Jumlah Buku</label>
                <input type="number" name="jumlah" value="1" min="1" class="border border-gray-300 rounded-lg px-3 py-2 text-xs w-full">
            </div>


            <!-- BUTTON -->
            <div class="flex gap-3 justify-end pt-4 border-t border-gray-200">
                <button type="button" onclick="window.history.back()" class="px-3 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-3 py-1 text-sm font-medium text-white bg-blue-secondary rounded-lg hover:bg-blue-primary transition-colors">
                    Tambah Peminjaman
                </button>
            </div>

        </form>

    </div>
</main>

</body>
</html>