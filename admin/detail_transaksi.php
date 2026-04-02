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
    <title>Detail</title>
    
    <!-- Tailwind CSS -->
    <link href="../src/output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-cyan-100 to-teal-50 min-h-screen">

<?php include 'partials/sidebar.php'; ?>

    <main class="flex-1 ml-64 p-8 mt-20">

        <?php
        $id_transaksi = $_GET['id'] ?? null;

        if (!$id_transaksi) {
            header("Location: transaksi.php");
            exit;
        }

        // Fetch transaction details from database
        $query = "SELECT t.*, b.judul, b.pengarang, u.nama
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
            header("Location: transaksi.php");
            exit;
        }

        // Handle status update
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $status_baru = $_POST['status'] ?? '';
            
            $update_query = "UPDATE transaksi SET status = ? WHERE id_transaksi = ?";
            $update_stmt = $config->prepare($update_query);
            $update_stmt->bind_param("si", $status_baru, $id_transaksi);
            
            if ($update_stmt->execute()) {
                $transaksi['status'] = $status_baru;
                $success_msg = "Status berhasil diperbarui!";
            }
        }
        ?>

        <!-- Header -->
        <div class="bg-blue-500 rounded-t-2xl shadow p-4 flex justify-center">
            <h1 class="text-2xl font-bold text-white">Detail Peminjaman</h1>
        </div>

        <!-- Content -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <?php if (isset($success_msg)): ?>
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded text-xs">
                <?= $success_msg ?>
            </div>
            <?php endif; ?>
            
            <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-gray-600 font-semibold text-xs">Nama user</p>
                <p class="text-sm text-gray-700"><?= htmlspecialchars($transaksi['nama']) ?></p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold text-xs">ID Transaksi</p>
                <p class="text-sm text-gray-700"><?= $transaksi['id_transaksi'] ?></p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold text-xs">Judul Buku</p>
                <p class="text-sm text-gray-700"><?= htmlspecialchars($transaksi['judul']) ?></p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold text-xs">Pengarang</p>
                <p class="text-sm text-gray-700"><?= htmlspecialchars($transaksi['pengarang']) ?></p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold text-xs">Tanggal Peminjaman</p>
                <p class="text-sm text-gray-700"><?= date('d-m-Y', strtotime($transaksi['tanggal_pinjam'])) ?></p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold text-xs">Tanggal Pengembalian</p>
                <p class="text-sm text-gray-700"><?= date('d-m-Y', strtotime($transaksi['tanggal_kembali'])) ?></p>
            </div>
            </div>
            
            <!-- Status Update Form -->
            <form method="POST" class="mb-4">
            <div class="flex items-end gap-3">
                <div>
                <p class="text-gray-600 font-semibold mb-2 text-xs">Status</p>
                <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-xs">
                    <option value="Dipinjam" <?= $transaksi['status'] == 'Dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
                    <option value="Dikembalikan" <?= $transaksi['status'] == 'Dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
                    <option value="Hilang" <?= $transaksi['status'] == 'Hilang' ? 'selected' : '' ?>>Hilang</option>
                </select>
                </div>
                <button type="submit" class="bg-blue-500 rounded-lg  text-white px-3 py-2 text-xs hover:bg-blue-600">
                Simpan
                </button>
            </div>
            </form>
            
            <a href="daftar_transaksi.php" class="text-blue-500 hover:underline text-xs">← Kembali</a>
        </div>
</body>
</html>