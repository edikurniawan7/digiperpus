<?php
include '../config.php';
session_start();

// Cek login
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$id_transaksi = $_GET['id'] ?? null;

if (!$id_transaksi) {
    header("Location: daftar_transaksi.php");
    exit;
}

// Ambil data transaksi + relasi
$query = "SELECT t.*, b.judul, b.pengarang, b.stok, u.nama
          FROM transaksi t 
          JOIN buku b ON t.id_buku = b.id_buku 
          JOIN users u ON t.id_user = u.id_user 
          WHERE t.id_transaksi = ?";

$stmt = $config->prepare($query);
$stmt->bind_param("i", $id_transaksi);
$stmt->execute();
$result = $stmt->get_result();
$transaksi = $result->fetch_assoc();

if (!$transaksi) {
    header("Location: daftar_transaksi.php");
    exit;
}

// ==================
// PROSES UPDATE STATUS
// ==================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $status_baru = $_POST['status'] ?? '';

    // Ambil status lama dari DB (biar aman)
    $cek = mysqli_fetch_assoc(mysqli_query($config, "
        SELECT status, id_buku FROM transaksi WHERE id_transaksi = '$id_transaksi'
    "));

    // Kalau berubah jadi DIKEMBALIKAN & sebelumnya belum
    if ($status_baru == 'Dikembalikan' && $cek['status'] != 'Dikembalikan') {

        mysqli_query($config, "
            UPDATE buku 
            SET stok = stok + 1 
            WHERE id_buku = '{$cek['id_buku']}'
        ");
    }

    // Update status transaksi
    $update = $config->prepare("UPDATE transaksi SET status = ? WHERE id_transaksi = ?");
    $update->bind_param("si", $status_baru, $id_transaksi);

    if ($update->execute()) {
        $transaksi['status'] = $status_baru;
        $success_msg = "Status berhasil diperbarui!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peminjaman</title>
    <link rel="icon" href="../assets/img/logo_title.png">
    <link href="../src/output.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-r from-cyan-100 to-teal-50 min-h-screen">

    <?php include 'partials/sidebar.php'; ?>

    <main class="flex-1 ml-64 p-8 mt-20">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Detail Peminjaman</h1>
            <p class="text-sm text-gray-600">Informasi lengkap transaksi peminjaman buku</p>
        </div>

        <!-- Card -->
        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">

            <!-- Alert -->
            <?php if (isset($success_msg)): ?>
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded text-sm">
                    <?= $success_msg ?>
                </div>
            <?php endif; ?>

            <!-- Header Card -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Informasi Transaksi</h2>
                    <p class="text-xs text-gray-500">Detail peminjaman user</p>
                </div>

                <span class="px-3 py-1 text-xs rounded-full 
                <?= $transaksi['status'] == 'Dipinjam' ? 'bg-green-100 text-green-800' : ($transaksi['status'] == 'Menunggu Konfirmasi' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') ?>">
                    <?= $transaksi['status'] ?>
                </span>
            </div>

            <!-- Detail Grid -->
            <div class="grid grid-cols-2 gap-6 mb-6">

                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-xs text-gray-500">Nama User</p>
                    <p class="text-sm font-semibold text-gray-800">
                        <?= htmlspecialchars($transaksi['nama']) ?>
                    </p>
                </div>

                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-xs text-gray-500">ID Transaksi</p>
                    <p class="text-sm font-semibold text-gray-800">
                        <?= $transaksi['id_transaksi'] ?>
                    </p>
                </div>

                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-xs text-gray-500">Judul Buku</p>
                    <p class="text-sm font-semibold text-gray-800">
                        <?= htmlspecialchars($transaksi['judul']) ?>
                    </p>
                </div>

                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-xs text-gray-500">Pengarang</p>
                    <p class="text-sm font-semibold text-gray-800">
                        <?= htmlspecialchars($transaksi['pengarang']) ?>
                    </p>
                </div>

                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-xs text-gray-500">Tanggal Pinjam</p>
                    <p class="text-sm font-semibold text-gray-800">
                        <?= date('d M Y', strtotime($transaksi['tanggal_pinjam'])) ?>
                    </p>
                </div>

                <div class="bg-gray-50 p-3 rounded-lg ">
                    <p class="text-xs text-gray-500">Tanggal Kembali</p>
                    <p class="text-sm font-semibold text-gray-800">
                        <?= date('d M Y', strtotime($transaksi['tanggal_kembali'])) ?>
                    </p>
                </div>

            </div>

            <!-- Status Update Form -->
            <form method="POST" class="mb-4 border-t pt-4">
                <div class="flex items-end gap-3">
                    <div>
                        <p class="text-gray-600 font-semibold mb-2 text-xs">Status</p>
                        <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-xs">
                            <option value="Dipinjam" <?= $transaksi['status'] == 'Dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
                            <option value="Menunggu Konfirmasi" <?= $transaksi['status'] == 'menunggu konfirmasi' ? 'selected' : '' ?>>Menunggu Konfirmasi</option>
                            <option value="Dikembalikan" <?= $transaksi['status'] == 'Dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-500 rounded-lg  text-white px-3 py-2 text-xs hover:bg-blue-600">
                        Simpan
                    </button>
                </div>
            </form>

            <!-- Back -->
            <a href="daftar_transaksi.php"
                class="inline-block mt-4 text-sm text-gray-500 hover:text-blue-primary hover:underline">
                ← Kembali ke daftar
            </a>

        </div>

    </main>
</body>

</html>