<?php
// Koneksi ke database
include '../config.php';

//Mulai Sesi
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../uploads/logo_title.png" type="image/png">
    <title>Data Buku</title>

    <!-- Tailwind CSS -->
    <link href="../src/output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">
    <!-- Sidebar -->
    <?php include 'partials/sidebar.php'; ?>
    
    <!-- Konten Utama -->
    <main class="flex-1 ml-64 p-8 mt-20">

    <h1 class="text-2xl font-bold text-gray-800">
        Daftar Buku 
    </h1>
    <p class="text-gray-600 mb-6 text-sm">
        Berikut adalah daftar buku yang tersedia di perpustakaan.
    </p>

    <!-- FILTER & SEARCH -->
    <div class="bg-white p-6 rounded-lg mb-6">
        <div class="flex items-center gap-4 flex-wrap">

            <a href="tambah_buku.php"
               class="bg-blue-100 border border-blue-500 rounded-lg px-3 py-2 text-xs text-blue-600 transition">
                + Tambah Buku
            </a>

            <form onsubmit="return false;" class="flex items-center gap-3 flex-1 min-w-max">
            <input 
                name="search"
                placeholder="Cari judul / pengarang..."
                type="text"
                class="flex-1 bg-white px-3 py-2 text-xs border border-gray-400 rounded-full focus:outline-none focus:border-blue-500 transition"
            >

                <select name="kategori"
                        class="text-xs font-semibold text-gray-700 px-3 py-2 border border-gray-400 rounded-full focus:outline-none">

                    <option value="">Semua Kategori</option>

                    <?php
                        $kategori_query = mysqli_query($config, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
                        while($kategori = mysqli_fetch_array($kategori_query)):
                    ?>
                        <option value="<?= $kategori['id_kategori']; ?>">
                            <?= $kategori['nama_kategori']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>

            </form>
        </div>
    </div>

    <!-- GRID BUKU -->
    <div id="buku-container"
         class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

        <?php
            $query = mysqli_query($config, "SELECT * FROM buku ORDER BY judul ASC");
            while ($buku = mysqli_fetch_array($query)):
        ?>

        <div class="buku-item bg-white rounded-lg shadow-lg overflow-hidden flex flex-col"
             data-judul="<?= strtolower($buku['judul']); ?>"
             data-pengarang="<?= strtolower($buku['pengarang']); ?>"
             data-kategori="<?= $buku['id_kategori']; ?>">

            <!-- Cover -->
            <div class="h-40 w-full bg-blue-100 flex items-center justify-center overflow-hidden">
                <img src="../uploads/cover/<?= $buku['cover']; ?>"
                     class="max-h-full max-w-full object-contain">
            </div>

            <!-- Info -->
            <div class="p-4 flex flex-col flex-grow">

                <h3 class="text-sm font-bold text-gray-700 mb-2">
                    <?= $buku['judul']; ?>
                </h3>

                <div class="text-xs text-gray-600 mb-2">
                    <?= $buku['pengarang']; ?>
                </div>

                <div class="text-xs text-gray-600 mb-4">
                    <span class="font-semibold">Stok:</span>
                    <?= $buku['stok']; ?>
                </div>

                <!-- Action -->
                <div class="flex gap-2 mt-auto">

                    <a href="edit_buku.php?id_buku=<?= $buku['id_buku']; ?>"
                       class="flex-1 bg-blue-100 border border-blue-500 rounded-lg px-3 py-1 text-xs text-center text-blue-600 hover:bg-blue-200 transition">
                        Edit
                    </a>

                    <a href="hapus_buku.php?id_buku=<?= $buku['id_buku']; ?>"
                       onclick="return confirm('Hapus buku ini?')"
                       class="flex-1 bg-red-100 border border-red-500 rounded-lg px-3 py-1 text-xs text-center text-red-600 hover:bg-red-200 transition">
                        Hapus
                    </a>

                </div>
            </div>
        </div>

        <?php endwhile; ?>

    </div>

    <!-- PESAN KOSONG -->
    <div id="empty-message"
         class="hidden text-center text-xs text-gray-500 font-medium mt-6">
        Buku tidak ditemukan
    </div>

</main>

<!-- JS FILTER -->
<script src="../assets/js/buku-filter.js"></script>

</body>
</html>
