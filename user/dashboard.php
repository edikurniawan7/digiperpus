<?php
    // Koneksi ke database
    include '../config.php';

    //Nulai Sesi
    session_start();

    // Cek apakah user sudah login
    if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
        header('Location: ../auth/login.php');
        exit();
    }

?>
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digiperpus | Sistem Peminjaman Buku</title>
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <title>Digiperpus | Sistem Peminjaman Buku</title>
    <!-- Tailwind CSS CDN -->
    <link href="../src/output.css" rel="stylesheet">


</head>
<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">
    <!-- Sidebar -->
        <?php include 'partials/sidebar.php'; ?>
    
    
    <!-- Konten Utama -->
    <main class="flex-1 ml-64 p-8 mt-20 ">

        <div class="mb-6">
            <div class="bg-blue-secondary p-8 rounded-lg shadow-sm relative overflow-hidden">
            <div class="absolute inset-0 opacity-15">
                <img src="../assets/img/yow.png" alt="background" class="w-full h-full object-cover"/>
            </div>
            <div class="relative z-10">
                <h1 class="text-3xl text-white font-bold mb-4">Hai <?php echo $_SESSION['nama']; ?> !</h1>
                <h2 class="text-2xl font-bold text-white mb-2">Selamat datang di Digiperpus,</h2>
                <p class="text-blue-100">Sistem peminjaman buku yang mudah dan efisien.</p>
            </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Aktivitas Terbaru
            </h3>
            <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-cyan-50 to-cyan-100 rounded-lg border-l-4 border-cyan-accent">
                <div class="bg-cyan-accent/20 p-3 rounded-lg">
                    <img src="../assets/img/book.png" class="w-6 h-6 bg
                </div>
                
                <div>
                    <p class="text-sm text-gray-500">Belum ada aktivitas terbaru</p>
                </div>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-gray-800">
            Daftar Buku 
        </h1>
        <p class="text-gray-600 mb-6 text-sm">
            Berikut adalah daftar buku yang tersedia di perpustakaan.
        </p>

        <!-- FILTER & SEARCH -->
    <div class="bg-white p-6 rounded-lg mb-6">
        <div class="flex items-center gap-4 flex-wrap">
            <form onsubmit="return false;" class="flex items-center gap-3 flex-1 min-w-max">
            <input 
                name="search"
                placeholder="Cari judul / pengarang..."
                type="text"
                class="flex-1 bg-white px-3 py-2 text-xs border border-gray-400 rounded-full focus:outline-none focus:border-blue-500 transition"
            >

                <select name="kategori"
                        class="text-xs font-semibold">

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
        <div id="empty-message"class="hidden text-center text-xs text-gray-500 font-medium mt-6">
            Buku tidak ditemukan
        </div>
    </div>

    <!-- Daftar Buku -->
    <div class="mb-6">
    <div id="buku-container" class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <?php
            $query = mysqli_query($config, "SELECT * FROM buku ORDER BY RAND()");
            while ($buku = mysqli_fetch_array($query)):
        ?>
        <div class="buku-item bg-white rounded-lg shadow-lg overflow-hidden flex flex-col"
             data-judul="<?= strtolower($buku['judul']); ?>"
             data-pengarang="<?= strtolower($buku['pengarang']); ?>"
             data-kategori="<?= $buku['id_kategori']; ?>">

            <div class="h-40 w-full bg-blue-100 flex items-center justify-center overflow-hidden">
                <img src="../uploads/cover/<?= $buku['cover']; ?>"
                     alt="<?= $buku['judul']; ?>"
                     class="max-h-full max-w-full object-contain">
            </div>

            <div class="p-4 flex flex-col flex-grow">
                <h3 class="text-sm font-bold text-gray-700 mb-2"><?= $buku['judul']; ?></h3>
                <div class="text-xs text-gray-600 mb-2"><?= $buku['pengarang']; ?></div>
                <div class="text-xs text-gray-600 mb-4">
                    <span class="font-semibold">Stok:</span> <?= $buku['stok']; ?>
                </div>

                <div class="flex gap-2 mt-auto">
                    <a href="pinjam_buku.php?id=<?= $buku['id_buku']; ?>"
                       class="flex-1 bg-blue-secondary border border-blue-500 rounded-lg px-3 py-1 text-xs text-center text-white hover:bg-blue-primary transition">
                        Pinjam
                    </a>

                    <a href="preview_buku.php?id_buku=<?= $buku['id_buku']; ?>"
                       class="flex-1 bg-teal-primary border border-teal-500 rounded-lg px-3 py-1 text-xs text-center text-white hover:bg-teal-secondary transition">
                        Preview
                    </a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

</main>

<!-- JS FILTER -->
<script src="../assets/js/buku-filter.js"></script>
</body>
</html>