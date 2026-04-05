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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <title>Admin | Digiperpus</title>

    <!-- Tailwind CSS -->
    <link href="../src/output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">
    <!-- Sidebar -->
    <?php include 'partials/sidebar.php'; ?>

    <!-- Konten Utama -->
    <main class="flex-1 ml-64 p-8 mt-20">
        <!-- Card Admin -->
        <div class="mb-6">
            <div class="bg-blue-secondary p-8 rounded-lg shadow-xl relative overflow-hidden">
                <div class="absolute inset-0 opacity-15">
                    <img src="../assets/img/yow.png" alt="background" class="w-full h-full object-cover" />
                </div>
                <div class="relative z-10">
                    <h1 class="text-3xl text-white font-bold mb-4">
                        Hai <?php echo $_SESSION['nama']; ?> !
                    </h1>
                    <h2 class="text-2xl font-bold text-white mb-2">
                        Selamat datang sebagai Admin
                    </h2>
                    <p class="text-blue-100">
                        Kelola sistem peminjaman buku anda dengan mudah dan efisien.
                    </p>
                </div>
            </div>
        </div>

        <!-- Statistik Card -->
        <div class="grid grid-cols-1 mt-10 md:grid-cols-4 gap-4">
            <!-- Total Buku -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-lg shadow-md border-l-4 border-blue-secondary hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">
                            Total Buku
                        </h3>
                        <?php
                        $query = "SELECT COUNT(*) AS total_buku FROM buku";
                        $result = mysqli_query($config, $query);
                        $data = mysqli_fetch_assoc($result);
                        $total_buku = $data['total_buku'];
                        ?>
                        <p class="text-3xl font-bold text-blue-600">
                            <?php echo $total_buku; ?>
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Tersedia di sistem</p>
                    </div>
                    <div class="bg-blue-secondary/20 p-3 rounded-full">
                        <img src="../assets/img/logobook.png" alt="Book Icon" class="w-8 h-8">
                    </div>
                </div>
            </div>

            <!-- Total Anggota -->
            <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-4 rounded-lg shadow-md border-l-4 border-teal-primary hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">
                            Total Anggota
                        </h3>
                        <?php
                        $query = "SELECT COUNT(*) AS total_anggota FROM users WHERE role != 'admin'";
                        $result = mysqli_query($config, $query);
                        $data = mysqli_fetch_assoc($result);
                        $total_anggota = $data['total_anggota'];
                        ?>
                        <p class="text-3xl font-bold text-teal-600">
                            <?php echo $total_anggota; ?>
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Member aktif</p>
                    </div>
                    <div class="bg-teal-primary/20 p-3 rounded-full">
                        <img src="../assets/img/groupusers.png" alt="Members Icon" class="w-8 h-8">
                    </div>
                </div>
            </div>

            <!-- Peminjaman Aktif -->
            <div class="bg-gradient-to-br from-cyan-50 to-cyan-100 p-4 rounded-lg shadow-md border-l-4 border-cyan-accent hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">
                            Peminjaman Aktif
                        </h3>
                        <?php
                        $query = "SELECT COUNT(*) AS total_peminjaman FROM transaksi WHERE status = 'dipinjam'";
                        $result = mysqli_query($config, $query);
                        $data = mysqli_fetch_assoc($result);
                        $total_peminjaman = $data['total_peminjaman'];
                        ?>
                        <p class="text-3xl font-bold text-cyan-600">
                            <?php echo $total_peminjaman; ?>
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Sedang dipinjam</p>
                    </div>
                    <div class="bg-cyan-accent/20 p-3 rounded-full">
                        <img src="../assets/img/pinjam.png" alt="Borrow Icon" class="w-8 h-8">
                    </div>
                </div>
            </div>

            <!-- Pengembalian Selesai -->
            <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 p-4 rounded-lg shadow-md border-l-4 border-emerald-accent hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">
                            Selesai
                        </h3>
                        <?php
                        $query = "SELECT COUNT(*) AS total_dikembalikan FROM transaksi WHERE status = 'dikembalikan'";
                        $result = mysqli_query($config, $query);
                        $data = mysqli_fetch_assoc($result);
                        $total_dikembalikan = $data['total_dikembalikan'];
                        ?>
                        <p class="text-3xl font-bold text-emerald-600">
                            <?php echo $total_dikembalikan; ?>
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Sudah dikembalikan</p>
                    </div>
                    <div class="bg-emerald-accent/20 p-3 rounded-full">
                        <img src="../assets/img/file.png" alt="Return Icon" class="w-8 h-8">
                    </div>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru dan Akses Cepat -->
        <div class="grid grid-cols-1 mt-10 md:grid-cols-2 gap-6">
            <!-- Aktivitas Terbaru -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    Aktivitas Terbaru
                </h3>

                <!-- LIST AKTIVITAS -->
                <div class="space-y-3">
                    <?php
                    $query = "
                        SELECT u.nama, t.status, t.tanggal_pinjam
                        FROM transaksi t
                        JOIN users u ON t.id_user = u.id_user
                        ORDER BY t.tanggal_pinjam DESC
                        LIMIT 3
                    ";
                    $result = mysqli_query($config, $query);

                    if (mysqli_num_rows($result) > 0):
                        while ($row = mysqli_fetch_assoc($result)):
                            $status_class = $row['status'] === 'dipinjam'
                                ? 'bg-cyan-50 text-cyan-600'
                                : 'bg-emerald-50 text-emerald-600';

                            $icon = $row['status'] === 'dipinjam'
                                ? '../assets/img/pinjam.png'
                                : '../assets/img/file.png';
                    ?>
                    <div class="flex items-center justify-between p-3 <?php echo $status_class; ?> rounded-lg">
                        <div class="flex items-center gap-3">
                            <img src="<?php echo $icon; ?>" class="w-5 h-5" alt="">
                            <div>
                                <p class="text-sm font-medium text-gray-800">
                                    <?php echo $row['nama']; ?>
                                </p>
                                <p class="text-xs text-gray-500">
                                    <?php echo date('d M Y', strtotime($row['tanggal_pinjam'])); ?>
                                </p>
                            </div>
                        </div>
                        <span class="text-xs font-semibold uppercase">
                            <?php echo ucfirst($row['status']); ?>
                        </span>
                    </div>
                    <?php
                        endwhile;
                    else:
                    ?>
                    <p class="text-sm text-gray-500 text-center">
                        Belum ada aktivitas
                    </p>
                    <?php endif; ?>
                </div>

                <div class="mt-4 text-right">
                    <a href="daftar_transaksi.php" class="text-sm font-italic font-medium text-teal-600 hover:text-teal-800 hover:underline">
                        Lihat Semua
                    </a>
                </div>
            </div>

            <!-- Akses Cepat -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    Akses Cepat
                </h3>
                <div class="space-y-3">
                    <a href="daftar_buku.php" class="flex items-center gap-3 p-3 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg border-l-4 border-blue-secondary hover:shadow-md transition-all group">
                        <div class="bg-blue-secondary/20 p-2 rounded-lg group-hover:bg-blue-secondary/30">
                            <img src="../assets/img/logobook.png" alt="Book" class="w-5 h-5">
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-blue-secondary">
                            Kelola Buku
                        </span>
                        <svg class="w-4 h-4 ml-auto text-gray-400 group-hover:text-blue-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <a href="daftar_anggota.php" class="flex items-center gap-3 p-3 bg-gradient-to-r from-teal-50 to-teal-100 rounded-lg border-l-4 border-teal-primary hover:shadow-md transition-all group">
                        <div class="bg-teal-primary/20 p-2 rounded-lg group-hover:bg-teal-primary/30">
                            <img src="../assets/img/groupusers.png" alt="Members" class="w-5 h-5">
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-teal-primary">
                            Kelola Anggota
                        </span>
                        <svg class="w-4 h-4 ml-auto text-gray-400 group-hover:text-teal-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <a href="daftar_transaksi.php" class="flex items-center gap-3 p-3 bg-gradient-to-r from-cyan-50 to-cyan-100 rounded-lg border-l-4 border-cyan-accent hover:shadow-md transition-all group">
                        <div class="bg-cyan-accent/20 p-2 rounded-lg group-hover:bg-cyan-accent/30">
                            <img src="../assets/img/pinjam.png" alt="Borrow" class="w-5 h-5">
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-cyan-accent">
                            Kelola Peminjaman
                        </span>
                        <svg class="w-4 h-4 ml-auto text-gray-400 group-hover:text-cyan-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>