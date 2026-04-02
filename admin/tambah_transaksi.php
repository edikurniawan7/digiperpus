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
    <title>Tambah Peminjaman</title>

    <!-- Tailwind CSS -->
    <link href="../src/output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">
    <!-- Sidebar -->
    <?php include 'partials/sidebar.php'; ?>
    
    <!-- Konten Utama -->
    <main class="flex-1  ml-64 p-8 mt-20">
        <div class="max-w-2xl">
            <h1 class="text-2xl font-bold text-blue-600 mb-4">Tambah Peminjaman</h1>
            
            <!-- Form Tambah Transaksi -->
            <div class="bg-white p-5 rounded-lg shadow-md">
                <form action="aksi_tambah_transaksi.php" method="POST" class="space-y-4">
                    <div>
                        <label for="id_user" class="block text-sm font-medium text-gray-700 mb-1">Nama User</label>
                        <input type="text" name="id_user" id="id_user" required class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label for="id_buku" class="block text-sm font-medium text-gray-700 mb-1">ID Buku</label>
                        <input type="text" name="id_buku" id="id_buku" required class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Buku</label>
                            <input type="number" name="jumlah" id="jumlah" min="1" required class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="tanggal_pinjam" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" required class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    
                    <div>
                        <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" required class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div class="flex gap-2 pt-2">
                        <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">Simpan</button>
                        <button type="reset" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-50 transition">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>