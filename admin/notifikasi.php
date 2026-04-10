<?php
// Koneksi ke database
include '../config.php';

session_start();

// Jika belum login
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Jika role BUKAN admin tendang
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php?akses=ditolak");
    exit;
}


// Ambil semua notifikasi (terbaru dulu)
$query = mysqli_query($config, "
    SELECT transaksi.*, users.nama, buku.judul 
    FROM transaksi
    JOIN users ON transaksi.id_user = users.id_user
    JOIN buku ON transaksi.id_buku = buku.id_buku
    WHERE transaksi.status = 'menunggu konfirmasi' 
       OR transaksi.status = 'dipinjam'
    ORDER BY transaksi.id_transaksi DESC
");

// Tandai semua notifikasi sebagai sudah dibaca
mysqli_query($config, "
    UPDATE transaksi 
    SET is_read = 1 
    WHERE is_read = 0
    AND (status = 'menunggu konfirmasi' OR status = 'dipinjam')
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <title>Notifikasi - Digiperpus</title>
    <!-- Tailwind CSS -->
    <link href="../src/output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">
    <!-- Sidebar -->
    <?php include 'partials/sidebar.php'; ?>

    <!-- Konten Utama -->
    <main class="flex-1 ml-64 p-8 mt-20">
        <h1 class="text-2xl font-bold text-gray-800">
            Notifikasi
        </h1>
        <p class="text-gray-600 mb-6 text-sm">
            Berikut adalah notifikasi terbaru untuk admin.
        </p>
        <div class="bg-white p-6 rounded-lg shadow-md">

    <div class="space-y-3">
    <?php while ($data = mysqli_fetch_assoc($query)): ?>
        
        <?php
            $isUnread = $data['is_read'] == 0;

            if ($data['status'] == 'dipinjam') {
                $color = 'blue';
                $text = 'meminjam buku';
                $icon = 'logobook.png';
            } else {
                $color = 'teal';
                $text = 'mengajukan pengembalian';
                $icon = 'pinjam.png';
            }
        ?>

        <div class="flex items-center gap-3 p-3 rounded-lg border-l-4 
            <?= $isUnread ? "bg-{$color}-50 border-{$color}-500" : "bg-gray-50 border-gray-300" ?> 
            hover:shadow-md transition-all group">

            <div class="p-2 rounded-lg 
                <?= $isUnread ? "bg-{$color}-200/50" : "bg-gray-200" ?>">
                <img src="../assets/img/<?= $icon; ?>" class="w-5 h-5">
            </div>

            <div class="flex-1">
                <p class="text-sm <?= $isUnread ? 'font-semibold text-gray-800' : 'text-gray-600' ?>">
                    <?= $data['nama']; ?> <?= $text; ?>
                </p>
                <p class="text-xs text-gray-500">
                    Buku: <?= $data['judul']; ?>
                </p>
            </div>

            <div class="flex gap-2">
                <a href="detail_transaksi.php?id=<?= $data['id_transaksi']; ?>" 
                   class="text-xs px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">
                   Detail
                </a>

                <?php if ($data['status'] == 'menunggu konfirmasi'): ?>
                    <a href="daftar_transaksi.php?id=<?= $data['id_transaksi']; ?>" 
                       class="text-xs px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                       Konfirmasi
                    </a>
                <?php endif; ?>
            </div>

        </div>

    <?php endwhile; ?>
    </div>
</div>

    </main>
</body>
</html>