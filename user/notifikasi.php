<?php
include '../config.php';
session_start();

// Cek login user
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// Ambil semua notifikasi penting (tanpa limit biar tidak hilang)
$query = mysqli_query($config, "
    SELECT t.*, b.judul 
    FROM transaksi t
    JOIN buku b ON t.id_buku = b.id_buku
    WHERE t.id_user = '$id_user'
    AND (t.status = 'dipinjam' OR t.status = 'dikembalikan')
    ORDER BY t.id_transaksi DESC
");

// Hitung total sekarang
$total_now = mysqli_num_rows($query);

// Simpan ke session (anggap sudah dibaca)
$_SESSION['last_notif_user'] = $total_now;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Notifikasi - Digiperpus</title>
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <link href="../src/output.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">

    <?php include 'partials/sidebar.php'; ?>

    <!-- Konten Utama -->
    <main class="flex-1 ml-64 p-8 mt-20">

        <h1 class="text-2xl font-bold text-gray-800">
            Notifikasi
        </h1>
        <p class="text-gray-600 mb-6 text-sm">
            Berikut adalah notifikasi terbaru untuk kamu terkait peminjaman buku.
        </p>

        <div class="bg-white p-6 rounded-lg shadow-md">

            <div class="space-y-3">

                <?php if (mysqli_num_rows($query) > 0): ?>

                    <?php while ($data = mysqli_fetch_assoc($query)): ?>

                        <?php
                        // Tentukan warna, icon, dan pesan
                        if ($data['status'] == 'dipinjam') {
                            $warna = 'blue';
                            $pesan = "Kamu berhasil meminjam buku: ";
                            $icon  = 'logobook.png';
                        } else {
                            $warna = 'green';
                            $pesan = "Buku sudah dikonfirmasi pengembaliannya: ";
                            $icon  = 'file.png';
                        }
                        ?>

                        <div class="flex items-center gap-3 p-3 rounded-lg border-l-4 
                    bg-<?= $warna ?>-50 border-<?= $warna ?>-500 
                    hover:shadow-md transition-all group">

                            <!-- Icon -->
                            <div class="p-2 rounded-lg bg-<?= $warna ?>-200/50">
                                <img src="../assets/img/<?= $icon; ?>" class="w-5 h-5">
                            </div>

                            <!-- Text -->
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-800">
                                    <?= $pesan ?> <b><?= $data['judul']; ?></b>
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    <?= date('d M Y, H:i', strtotime($data['tanggal_pinjam'])) ?>
                                </p>
                            </div>

                        </div>

                    <?php endwhile; ?>

                <?php else: ?>

                    <!-- Jika tidak ada notif -->
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-md border-l-4 border-gray-300">
                        <div class="p-2 bg-white rounded-md shadow-sm">
                            <img src="../assets/img/null.png" class="w-5 h-5">
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">
                                Belum ada notifikasi
                            </p>
                        </div>
                    </div>

                <?php endif; ?>

            </div>

        </div>

    </main>
</body>

</html>