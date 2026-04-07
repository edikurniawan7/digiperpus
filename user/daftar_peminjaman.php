<?php
include '../config.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// HITUNG BUKU YANG MASIH DI TANGAN USER
$total_pinjam_query = mysqli_query($config, "
    SELECT COUNT(*) as total 
    FROM transaksi 
    WHERE id_user = '$id_user' 
    AND (status = 'dipinjam' OR status = 'menunggu konfirmasi')
");
$total_pinjam = mysqli_fetch_assoc($total_pinjam_query)['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <title>Peminjaman Saya - Digiperpus</title>
    <link href="../src/output.css" rel="stylesheet"> 
</head>

<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">

<?php include 'partials/sidebar.php'; ?>

<main class="flex-1 ml-64 p-8 mt-20">

    <h1 class="text-2xl font-bold text-gray-800">
        Daftar Peminjaman
    </h1>
    <p class="text-gray-600 mb-6 text-sm">
        Berikut adalah daftar peminjaman buku yang sedang dipinjam.
    </p>

    <!-- RINGKASAN -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">
            Ringkasan Peminjaman
        </h3>

        <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-cyan-50 to-cyan-100 rounded-lg border-l-4 border-cyan-accent">
            <div class="bg-cyan-accent/20 p-3 rounded-lg">
                <img src="../assets/img/pinjam.png" class="w-6 h-6">
            </div>

            <div>
                <p class="text-sm text-gray-500">Sedang dipinjam</p>
                <p class="text-xl font-bold text-gray-800">
                    <?= $total_pinjam; ?> Buku
                </p>
            </div>
        </div>
    </div>

    <!-- GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php
        $query = mysqli_query($config, "
            SELECT transaksi.*, buku.judul 
            FROM transaksi
            JOIN buku ON transaksi.id_buku = buku.id_buku
            WHERE transaksi.id_user = '$id_user'
            AND transaksi.status != 'dikembalikan'
            ORDER BY transaksi.id_transaksi DESC
        ");

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {

                $status = $row['status'];

                // WARNA STATUS
                if ($status == 'dipinjam') {
                    $statusColor = 'bg-yellow-100 text-yellow-700';
                } elseif ($status == 'menunggu konfirmasi') {
                    $statusColor = 'bg-blue-100 text-blue-700';
                } else {
                    $statusColor = 'bg-green-100 text-green-700';
                }

                $tanggalPinjam = date('d M Y', strtotime($row['tanggal_pinjam']));
                $tanggalKembali = date('d M Y', strtotime($row['tanggal_kembali']));
        ?>

        <div class="bg-white rounded-lg shadow-md border border-gray-100 hover:shadow-lg transition group overflow-hidden">

            <!-- HEADER -->
            <div class="p-4 border-b bg-gradient-to-r from-gray-50 to-gray-100">
                <h2 class="text-sm font-semibold text-gray-800 line-clamp-2 group-hover:text-blue-secondary transition">
                    <?= $row['judul'] ?>
                </h2>
            </div>

            <!-- BODY -->
            <div class="p-4 space-y-2 text-xs text-gray-600">

                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Jumlah dipinjam</span>
                    <span><?= $row['jumlah'] ?></span>
                </div>

                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Pinjam</span>
                    <span><?= $tanggalPinjam ?></span>
                </div>

                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Kembali</span>
                    <span><?= $tanggalKembali ?></span>
                </div>

                <div class="flex justify-between items-center mt-3">

                    <!-- STATUS -->
                    <span class="px-2 py-1 text-[10px] font-semibold rounded-full <?= $statusColor ?>">
                        <?= ucfirst($status) ?>
                    </span>

                    <!-- AKSI -->
                    <?php if ($status == 'dipinjam') { ?>
                        <a href="../aksi/request_kembali.php?id=<?= $row['id_transaksi']; ?>" 
                           class="text-[10px] bg-blue-100 border border-blue-500 px-2 py-1 rounded hover:bg-blue-200 transition"
                           onclick="return confirm('Ajukan pengembalian buku ini?');">
                            Ajukan Pengembalian
                        </a>

                    <?php } elseif ($status == 'menunggu konfirmasi') { ?>

                        <!-- MINI INDICATOR (lebih elegan dari text panjang) -->
                        <div class="flex items-center gap-1 text-[10px] text-blue-500">
                            <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                            <span>Diproses</span>
                        </div>

                    <?php } ?>

                </div>

            </div>
        </div>

        <?php 
            }
        } else {
        ?>
            <p class="text-gray-500 text-sm">Tidak ada data peminjaman.</p>
        <?php } ?>

    </div>

</main>

</body>
</html>