<?php
// Koneksi ke database
include '../config.php';

//Mulai Sesi
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header('Location: ../auth/login.php');
    exit();
}

// Ambil ID user dari sesi
$id_user = $_SESSION['id_user'];

// Ambil 5 aktivitas terbaru dari tabel transaksi
$query = mysqli_query($config, "
        SELECT t.*, b.judul 
        FROM transaksi t
        JOIN buku b ON t.id_buku = b.id_buku
        WHERE t.id_user = '$id_user'
        ORDER BY t.tanggal_pinjam DESC
        LIMIT 3
    ");
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
                    <img src="../assets/img/yow.png" alt="background" class="w-full h-full object-cover" />
                </div>
                <div class="relative z-10">
                    <h1 class="text-3xl text-white font-bold mb-4">Hai <?php echo $_SESSION['nama']; ?> !</h1>
                    <h2 class="text-2xl font-bold text-white mb-2">Selamat datang di Digiperpus,</h2>
                    <p class="text-blue-100">Sistem peminjaman buku yang mudah dan efisien.</p>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <h3 class="text-base font-semibold text-gray-700 mb-3">
                Aktivitas Terbaru
            </h3>

            <?php if (mysqli_num_rows($query) > 0): ?>
                <div class="space-y-2 max-h-64 overflow-y-auto pr-1">

                    <?php while ($data = mysqli_fetch_assoc($query)): ?>
                        <?php
                        $status = $data['status'];
                        $judul  = $data['judul'];

                        $text = "";
                        $color = "";
                        $bg = "";
                        $icon = "";

                        if ($status == 'dipinjam') {
                            $text  = "Kamu meminjam buku \"$judul\"";
                            $color = "border-cyan-400";
                            $bg    = "bg-cyan-50";
                            $icon  = "../assets/img/pinjam.png";
                        } elseif ($status == 'menunggu konfirmasi') {
                            $text  = "Kamu mengajukan pengembalian buku \"$judul\"";
                            $color = "border-yellow-400";
                            $bg    = "bg-yellow-50";
                            $icon  = "../assets/img/request.png";
                        } elseif ($status == 'dikembalikan') {
                            $text  = "Kamu telah mengembalikan buku \"$judul\"";
                            $color = "border-green-400";
                            $bg    = "bg-green-50";
                            $icon  = "../assets/img/file.png";
                        }
                        ?>

                        <div class="flex items-center gap-3 p-3 rounded-md border-l-4 <?= $bg ?> <?= $color ?> hover:shadow-sm transition">

                            <div class="p-1.5 bg-white rounded-md shadow-sm">
                                <img src="<?= $icon ?>" class="w-4 h-4">
                            </div>

                            <div class="flex-1 leading-tight">
                                <p class="text-sm text-gray-700 font-medium">
                                    <?= $text ?>
                                </p>
                                <p class="text-[11px] text-gray-500 mt-0.5">
                                    <?= date('d M Y, H:i', strtotime($data['tanggal_pinjam'])) ?>
                                </p>
                            </div>

                        </div>

                    <?php endwhile; ?>

                </div>

            <?php else: ?>
                <!-- Kosong -->
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-md border-l-4 border-gray-300">
                    <div class="p-1.5 bg-white rounded-md shadow-sm">
                        <img src="../assets/img/null.png" class="w-4 h-4">
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">
                            Belum ada aktivitas terbaru
                        </p>
                    </div>
                </div>
            <?php endif; ?>
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
                        class="flex-1 bg-white px-3 py-2 text-xs border border-gray-400 rounded-full focus:outline-none focus:border-blue-500 transition">

                    <select name="kategori"
                        class="text-xs font-semibold">

                        <option value="">Semua Kategori</option>

                        <?php
                        $kategori_query = mysqli_query($config, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
                        while ($kategori = mysqli_fetch_array($kategori_query)):
                        ?>
                            <option value="<?= $kategori['id_kategori']; ?>">
                                <?= $kategori['nama_kategori']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>

                </form>
            </div>
            <div id="empty-message" class="hidden text-center text-xs text-gray-500 font-medium mt-6">
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
        <!-- Footer -->
        <div class="mt-10 text-center text-xs text-gray-500">
            &copy; 2024 Digiperpus. All rights reserved.
        </div>

    </main>

    <!-- JS FILTER -->
    <script src="../assets/js/buku-filter.js"></script>
</body>

</html>