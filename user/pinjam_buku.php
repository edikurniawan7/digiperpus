<?php
    // Koneksi ke database
    include '../config.php';

    // Mulai Sesi
    session_start();

    if (!isset($_SESSION['id_user'])) {
        header("Location: ../auth/login.php");
        exit;
    }

    // Ambil data buku
    if (!isset($_GET['id'])) {
        echo "ID buku tidak ditemukan.";
        exit;
    }
    
    $id_buku = $_GET['id'];
    $buku_query = mysqli_query($config, "SELECT * FROM buku WHERE id_buku='$id_buku'");
    $buku = mysqli_fetch_assoc($buku_query);

    if (!$buku) {
        echo "Data buku tidak ditemukan.";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku | Sistem Peminjaman Buku</title>
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <link href="../src/output.css" rel="stylesheet">    
</head>

<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">
    <?php include 'partials/sidebar.php'; ?>
    
    <main class="flex-1 ml-64 p-8 mt-20">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Pinjam Buku</h1>

            <div class="bg-white rounded-lg shadow p-6">
                <!-- Detail Buku Ringkas -->
                <div class="flex gap-4 mb-6 pb-6 border-b">
                    <div class="w-24 flex-shrink-1">
                        <img src="../uploads/cover/<?= $buku['cover']; ?>" 
                             alt="<?= $buku['judul']; ?>" 
                             class="w-full rounded shadow-sm">
                    </div>
                    <div class="flex-1 text-sm">
                        <h3 class="font-semibold text-gray-900 mb-1"><?= $buku['judul']; ?></h3>
                        <p class="text-gray-600 mb-1"><?= $buku['pengarang']; ?></p>
                        <p class="text-teal-600 font-medium">Stok: <?= $buku['stok']; ?> tersedia</p>
                        <!-- Deskripsi singkat -->
                        <p class="text-gray-700 mt-2 text-xs justify"><?= $buku['deskripsi']; ?></p>
                    </div>
                </div>

                <!-- Form -->
                <form id="formPinjamBuku" action="../aksi/aksi_pinjam_buku.php" method="POST" class="space-y-4">
                    <input type="hidden" name="id_buku" value="<?= $buku['id_buku']; ?>">

                    <!-- Jumlah Dipinjam -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Buku Yang Ingin Dipinjam</label>
                        <input type="number" 
                               id="jumlahDipinjam"
                               name="jumlah" 
                               min="1" 
                               max="<?= $buku['stok']; ?>" 
                               value="1"
                               onchange="if(this.value > <?= $buku['stok']; ?>) { alert('Jumlah melebihi stok tersedia!'); this.value = <?= $buku['stok']; ?>; }"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500"
                               required>
                    </div>

                    <!-- Nama Peminjam -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Peminjam</label>
                        <input type="text"
                               value="<?= $_SESSION['nama']; ?>"
                               class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:outline-none"
                               readonly>
                    </div>

                    <!-- Tanggal Pinjam -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pinjam</label>
                        <input type="date"
                               name="tanggal_pinjam"
                               value="<?= date('Y-m-d'); ?>"
                               class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:outline-none"
                               readonly>
                    </div>

                    <!-- Tanggal Kembali -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kembali</label>
                        <input type="date"
                               id="tanggalKembali"
                               name="tanggal_kembali"
                               min="<?= date('Y-m-d', strtotime('+1 day')); ?>"
                               max="<?= date('Y-m-d', strtotime('+10 days')); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500"
                               required>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center gap-3 pt-4">
                        <button type="button" 
                                onclick="window.history.back()" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            Batal
                        </button>
                        <button type="submit" 
                                class="ml-auto px-4 py-2 text-sm font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700 transition">
                            Pinjam Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('formPinjamBuku').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!document.getElementById('tanggalKembali').value) {
                alert('Pilih tanggal pengembalian terlebih dahulu!');
                return;
            }

            this.submit();
        });
    </script>
</body>
</html>
