<?php
include '../config.php';
session_start();

$id_user = $_SESSION['id_user'];

// Ambil hanya notif penting
$query = mysqli_query($config, "
    SELECT t.*, b.judul 
    FROM transaksi t
    JOIN buku b ON t.id_buku = b.id_buku
    WHERE t.id_user = '$id_user'
    AND (t.status = 'dipinjam' OR t.status = 'dikembalikan')
    ORDER BY t.id_transaksi DESC
    LIMIT 10
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
    <title>Notifikasi</title>
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <link href="../src/output.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-r from-cyan-100 to-teal-50 min-h-screen">

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

    <?php while($data = mysqli_fetch_assoc($query)): ?>

        <?php
            if ($data['status'] == 'dipinjam') {
                $warna = 'blue';
                $pesan = "Kamu berhasil meminjam buku";
            } else {
                $warna = 'green';
                $pesan = "Buku sudah dikonfirmasi pengembaliannya";
            }
        ?>

        <div class="flex items-center gap-3 p-3 rounded-lg border-l-4 
            bg-<?= $warna ?>-50 border-<?= $warna ?>-500">

            <!-- Text -->
            <div>
                <p class="text-sm text-gray-800">
                    <?= $pesan ?> <b><?= $data['judul'] ?></b>
                </p>

                <p class="text-xs text-gray-500">
                    <?= date('d M Y', strtotime($data['tanggal_pinjam'])) ?>
                </p>
            </div>

        </div>

    <?php endwhile; ?>

    </div>
</div>

</main>
</body>
</html>