<?php
    // Koneksi ke database
    include '../config.php';

    session_start();
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <title>Riwayat Peminjaman - Digiperpus</title>

    <!-- Tailwind CSS CDN -->
    <link href="../src/output.css" rel="stylesheet">        
</head>
<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">
    <!-- Sidebar -->
        <?php include 'partials/sidebar.php'; ?>
    
    
    <!-- Konten Utama -->
    <main class="flex-1 ml-64 p-8 mt-20 ">
        <!-- JUDUL -->
        <h1 class="text-2xl font-bold text-gray-800">
            Riwayat Peminjaman
        </h1>
        <p class="text-gray-600 mb-6 text-sm">
            Berikut adalah riwayat peminjaman buku yang telah dilakukan oleh anggota.
        </p>

        <!-- Riwayat Peminjaman --> 
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Ringkasan Peminjaman
            </h3>

        <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-cyan-50 to-cyan-100 rounded-lg border-l-4 border-cyan-accent">
            <div class="bg-cyan-accent/20 p-3 rounded-lg">
                <img src="../assets/img/pinjam.png" class="w-6 h-6">
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Peminjaman</p>
                <p class="text-xl font-bold text-gray-800">
                    <?php
                    $id_user = $_SESSION['id_user'];
                    $total_pinjam_query = mysqli_query($config, "
                        SELECT COUNT(*) as total 
                        FROM transaksi 
                        WHERE id_user = '$id_user' AND status = 'dipinjam'
                    ");
                    $total_pinjam = mysqli_fetch_assoc($total_pinjam_query)['total'];
                    echo $total_pinjam . " Buku";
                    ?>
                </p>
            </div>
        </div>

    </main>
</body>
</html>