<?php
// Koneksi ke database
include '../config.php';

// Mulai Sesi
session_start();

// Ambil data kategori untuk dropdown
$data_kategori = mysqli_query($config, "SELECT * FROM kategori ORDER BY nama_kategori ASC");

// Ambil data buku berdasarkan ID
$id = $_GET['id_buku'];
$data = mysqli_query($config, "SELECT * FROM buku WHERE id_buku='$id'");
$d = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <title>Edit Buku</title>
    
    <!-- Tailwind CSS -->
    <link href="../src/output.css" rel="stylesheet">
    
    <!-- JS Preview Cover -->
    <script src="../assets/js/cover-preview.js"></script>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Sidebar -->
    <?php include 'partials/sidebar.php'; ?>
    
    <!-- Main Content -->
    <main class="ml-64 p-6 mt-16">  
        <div class="max-w-2xl mx-auto">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Edit Buku</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui informasi buku di bawah ini</p>
            </div>

            <!-- Form Edit Buku -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <form action="../aksi/aksi_edit_buku.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_buku" value="<?= $d['id_buku']; ?>">
                    
                    <!-- Cover Upload Section -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Cover Buku</label>
                        <div class="flex gap-4">
                            <div id="cover-preview" class="w-32 h-40 border-2 border-dashed border-gray-300 rounded-lg flex-shrink-0 bg-gray-50 flex items-center justify-center overflow-hidden">
                                <img id="cover-img" src="../assets/img/cover/<?= $d['cover']; ?>" alt="Cover" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 flex flex-col justify-center">
                                <input type="file" name="cover" id="cover" accept="image/*" class="text-sm text-gray-600 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG (Maks: 5MB)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Judul & Pengarang -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="judul" class="block text-sm font-semibold text-gray-700 mb-1">Judul Buku</label>
                            <input type="text" name="judul" id="judul" value="<?= $d['judul']; ?>" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="pengarang" class="block text-sm font-semibold text-gray-700 mb-1">Pengarang</label>
                            <input type="text" name="pengarang" id="pengarang" value="<?= $d['pengarang']; ?>" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>

                    <!-- Penerbit & Tahun Terbit -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="penerbit" class="block text-sm font-semibold text-gray-700 mb-1">Penerbit</label>
                            <input type="text" name="penerbit" id="penerbit" value="<?= $d['penerbit']; ?>" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="tahun_terbit" class="block text-sm font-semibold text-gray-700 mb-1">Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" id="tahun_terbit" value="<?= $d['tahun_terbit']; ?>" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>

                    <!-- Kategori & Stok -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="id_kategori" class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                            <select name="id_kategori" id="id_kategori" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">Pilih Kategori</option>
                                <?php mysqli_data_seek($data_kategori, 0); while ($kategori = mysqli_fetch_array($data_kategori)) { ?>
                                    <option value="<?= $kategori['id_kategori']; ?>" <?= ($kategori['id_kategori'] == $d['id_kategori']) ? 'selected' : ''; ?>>
                                        <?= $kategori['nama_kategori']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div>
                            <label for="stok" class="block text-sm font-semibold text-gray-700 mb-1">Stok</label>
                            <input type="number" name="stok" id="stok" value="<?= $d['stok']; ?>" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" min="0">
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-6">
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"><?= $d['deskripsi']; ?></textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 justify-end pt-4 border-t border-gray-200">
                        <button type="button" onclick="window.history.back()" class="px-3 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-3 py-1 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('cover').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('cover-img').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
