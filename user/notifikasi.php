<?php
// Koneksi ke database
include '../config.php';

session_start();

// Jika belum login
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit;
}

if ($_SESSION['role'] !== 'user') {
    header("Location: ../auth/login.php?akses=ditolak");
    exit;
}


// Ambil semua notifikasi (terbaru dulu)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <title>Notifikasi - Digiperpus</title>
    <!-- Tailwind CSS -->
    <link href="../src/output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">
    <!-- Sidebar -->
    <?php include 'partials/sidebar.php'; ?>

    <!-- Konten Utama -->
    <main class="flex-1 ml-64 p-8 mt-20">
        <h1 class="text-2xl font-bold text-gray-800">
            Notifikasi
        </h1>
        <p class="text-gray-600 mb-6 text-sm">
            Berikut adalah notifikasi terbaru untuk admin.
        </p>
        <div class="bg-white p-6 rounded-lg shadow-md">

    <div class="space-y-3">
    
    </div>
</div>

    </main>
</body>
</html>