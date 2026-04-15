<?php
include '../config.php';
session_start();

// (opsional) validasi role admin di sini

// HITUNG TOTAL REQUEST
$total_query = mysqli_query($config, "
    SELECT COUNT(*) as total 
    FROM transaksi 
    WHERE status = 'menunggu konfirmasi'
");
$total = mysqli_fetch_assoc($total_query)['total'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Pengembalian</title>
    <link href="../src/output.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">

    <?php include 'partials/sidebar.php'; ?>

    <main class="flex-1 ml-64 p-8 mt-20">

        <!-- HEADER -->
        <h1 class="text-2xl font-bold text-gray-800">
            Permintaan Pengembalian
        </h1>
        <p class="text-gray-600 mb-6 text-sm">
            Kelola permintaan pengembalian buku dari pengguna.
        </p>

        <!-- RINGKASAN -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg border-l-4 border-blue-400">
                <div class="p-3 bg-blue-200 rounded-lg">
                    📥
                </div>
                <div>
                    <p class="text-sm text-gray-500">Permintaan Masuk</p>
                    <p class="text-xl font-bold text-gray-800">
                        <?= $total ?> Request
                    </p>
                </div>
            </div>
        </div>

        <!-- GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <?php
            $query = mysqli_query($config, "
            SELECT t.*, b.judul, u.nama 
            FROM transaksi t
            JOIN buku b ON t.id_buku = b.id_buku
            JOIN users u ON t.id_user = u.id_user
            WHERE t.status = 'menunggu konfirmasi'
            ORDER BY t.id_transaksi DESC
        ");

            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {

                    $tanggalPinjam = date('d M Y', strtotime($row['tanggal_pinjam']));
                    $tanggalKembali = date('d M Y', strtotime($row['tanggal_kembali']));
            ?>

                    <!-- CARD -->
                    <div class="bg-white rounded-lg shadow-md border border-gray-100 hover:shadow-lg transition overflow-hidden">

                        <!-- HEADER -->
                        <div class="p-4 border-b bg-gradient-to-r from-gray-50 to-gray-100">
                            <h2 class="text-sm font-semibold text-gray-800">
                                <?= $row['judul'] ?>
                            </h2>
                            <p class="text-[11px] text-gray-500 mt-1">
                                oleh <?= $row['nama'] ?>
                            </p>
                        </div>

                        <!-- BODY -->
                        <div class="p-4 text-xs text-gray-600 space-y-2">

                            <div class="flex justify-between">
                                <span>Jumlah</span>
                                <span><?= $row['jumlah'] ?></span>
                            </div>

                            <div class="flex justify-between">
                                <span>Pinjam</span>
                                <span><?= $tanggalPinjam ?></span>
                            </div>

                            <div class="flex justify-between">
                                <span>Batas</span>
                                <span><?= $tanggalKembali ?></span>
                            </div>

                            <!-- STATUS -->
                            <div class="mt-3 flex items-center gap-2 text-blue-500 text-[11px]">
                                <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                                <span>Menunggu Konfirmasi</span>
                            </div>

                            <!-- AKSI -->
                            <div class="flex gap-2 mt-4">

                                <!-- SETUJUI -->
                                <a href="../aksi/approve_kembali.php?id=<?= $row['id_transaksi']; ?>"
                                    onclick="return confirm('Setujui pengembalian buku ini?')"
                                    class="flex-1 text-center bg-green-500 text-white py-1 rounded text-xs hover:bg-green-600 transition">
                                    Setujui
                                </a>

                                <!-- TOLAK -->
                                <a href="../aksi/tolak_kembali.php?id=<?= $row['id_transaksi']; ?>"
                                    onclick="return confirm('Tolak pengembalian ini?')"
                                    class="flex-1 text-center bg-red-500 text-white py-1 rounded text-xs hover:bg-red-600 transition">
                                    Tolak
                                </a>

                            </div>

                        </div>

                    </div>

                <?php
                }
            } else {
                ?>
                <p class="text-gray-500 text-sm">Tidak ada permintaan saat ini.</p>
            <?php } ?>

        </div>

    </main>

</body>

</html>