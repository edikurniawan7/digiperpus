<?php
include '../config.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
<<<<<<< HEAD

// HITUNG JUMLAH BUKU YANG SEDANG DIPINJAM
$total_pinjam_query = mysqli_query($config, "
    SELECT COUNT(*) as total 
    FROM transaksi 
    WHERE id_user = '$id_user' AND status = 'dipinjam'
");
$total_pinjam = mysqli_fetch_assoc($total_pinjam_query)['total'];
=======
>>>>>>> 689875abed4c8ff882dfb89705d62e0fa103442f
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digiperpus | Peminjaman Saya</title>
    <link href="../src/output.css" rel="stylesheet"> 
</head>

<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">
<<<<<<< HEAD

<?php include 'partials/sidebar.php'; ?>

<main class="flex-1 ml-64 p-8 mt-20">

    <!-- TITLE -->
    <h1 class="text-2xl font-bold text-gray-800">
            Riwayat Peminjaman
        </h1>
        <p class="text-gray-600 mb-6 text-sm">
            Berikut adalah riwayat peminjaman buku yang telah dilakukan oleh anggota.
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
                <p class="text-sm text-gray-500">Sedang Dipinjam</p>
                <p class="text-xl font-bold text-gray-800">
                    <?= $total_pinjam; ?> Buku
                </p>
            </div>
        </div>
    </div>

    <!-- GRID CARD -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php
        $query = mysqli_query($config, "
            SELECT transaksi.*, buku.judul 
            FROM transaksi
            JOIN buku ON transaksi.id_buku = buku.id_buku
            WHERE transaksi.id_user = '$id_user'
            ORDER BY transaksi.id_transaksi DESC
        ");

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {

                $statusColor = $row['status'] == 'dipinjam'
                    ? 'bg-yellow-100 text-yellow-700'
                    : 'bg-green-100 text-green-700';

                $tanggalPinjam = date('d M Y', strtotime($row['tanggal_pinjam']));
                $tanggalKembali = date('d M Y', strtotime($row['tanggal_kembali']));
        ?>

        <!-- CARD -->
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
                    <span class="font-medium text-gray-500">Jumlah Dipinjam</span>
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

                    <span class="px-2 py-1 text-[10px] font-semibold rounded-full <?= $statusColor ?>">
                        <?= ucfirst($row['status']) ?>
                    </span>

                    <?php if ($row['status'] == 'dipinjam') { ?>
                        <a href="../aksi/aksi_kembalikan.php?id=<?= $row['id_transaksi']; ?>" 
                           class="text-[10px] bg-blue-100 border border-blue-500 px-2 py-1 rounded hover:bg-blue-200 transition"
                           onclick="return confirm('Yakin ingin mengembalikan buku ini?');">
                            Kembalikan
                        </a>
                    <?php } ?>

                </div>

            </div>
        </div>

        <?php 
            }
        } else {
        ?>

        <!-- EMPTY STATE -->
        <div class="col-span-full flex flex-col items-center justify-center py-20 text-gray-500">
            <p class="text-lg font-medium">Belum ada peminjaman</p>
            <p class="text-sm">Silakan melakukan peminjaman buku terlebih dahulu</p>
        </div>

        <?php } ?>

    </div>

</main>

</body>
</html>
=======
    <?php include 'partials/sidebar.php'; ?>

    <main class="flex-1 ml-64 p-8 mt-20">
        <h2 class="text-xl font-bold text-blue-secondary mb-4">Peminjaman Saya</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            $query = mysqli_query($config, "
                SELECT transaksi.*, buku.judul 
                FROM transaksi
                JOIN buku ON transaksi.id_buku = buku.id_buku
                WHERE transaksi.id_user = '$id_user'
                ORDER BY transaksi.id_transaksi DESC
            ");

            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $statusColor = $row['status'] == 'dipinjam'
                        ? 'bg-yellow-100 text-yellow-700'
                        : 'bg-green-100 text-green-700';
                    
                    $tanggalPinjam = date('d M Y', strtotime($row['tanggal_pinjam']));
                    $tanggalKembali = date('d M Y', strtotime($row['tanggal_kembali']));
                    ?>
                    <div class="bg-white rounded-xl shadow-md p-5 border border-gray-100 hover:shadow-lg transition">
                        <h2 class="text-lg font-semibold text-gray-800 mb-3 line-clamp-2">
                            <?= $row['judul'] ?>
                        </h2>

                        <div class="space-y-2 text-sm text-gray-600">
                            <p>
                                <span class="font-semibold text-gray-700">Tanggal Pinjam:</span>
                                <?= $tanggalPinjam ?>
                            </p>
                            <p>
                                <span class="font-semibold text-gray-700">Tanggal Kembali:</span>
                                <?= $tanggalKembali ?>
                            </p>
                        </div>

                        <div class="mt-4 flex items-center gap-2">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full <?= $statusColor ?>">
                                <?= ucfirst($row['status']) ?>
                            </span>

                            <?php if ($row['status'] == 'dipinjam') { ?>
                                <form action="../aksi/aksi_kembalikan.php" method="POST" class="ml-auto">
                                    <a href="../aksi/aksi_kembalikan.php?id=<?= $row['id_transaksi']; ?>" 
                                       class="bg-blue-100 border border-blue-500 rounded-lg px-3 py-1 text-xs text-blue-600 transition"
                                       onclick="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?');">
                                        Kembalikan
                                    </a>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="col-span-full flex flex-col items-center justify-center py-20 text-gray-500">
                    <p class="text-lg font-medium">Belum ada peminjaman</p>
                    <p class="text-sm">Silakan melakukan peminjaman buku terlebih dahulu</p>
                </div>
                <?php
            }
            ?>
        </div>
    </main>
</body>
</html>
>>>>>>> 689875abed4c8ff882dfb89705d62e0fa103442f
