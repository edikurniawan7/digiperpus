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
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <title>Riwayat Peminjaman</title>

    <!-- Tailwind CSS -->
    <link href="../src/output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">
    <!-- Sidebar -->
     <?php include 'partials/sidebar.php'; ?>
    
    <!-- Konten Utama -->
    <main class="flex-1 ml-64 p-8 mt-20 ">
<<<<<<< HEAD
        <h1 class="text-2xl font-bold text-gray-800">
            Riwayat Peminjaman
        </h1>
        <p class="text-gray-600 mb-6 text-sm">
            Berikut adalah riwayat peminjaman buku yang telah dilakukan oleh anggota.
        </p>
=======
        <h1 class="text-2xl font-bold text-blue-600 mb-6">
            Daftar Peminjaman
        </h1>
>>>>>>> 689875abed4c8ff882dfb89705d62e0fa103442f
        <!-- Tabel Data  -->
        
    </main>
        
</body>
</html>
