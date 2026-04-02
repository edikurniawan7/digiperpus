<?php
include '../config.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
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
