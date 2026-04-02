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
    <title>Profil Anggota</title>
    <link href="../src/output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">
    <!-- Sidebar -->
    <?php include 'partials/sidebar.php'; ?>
    
    <!-- Konten Utama -->
    <main class="flex-1 ml-64 p-8 mt-20">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="bg-blue-secondary rounded-t-2xl shadow p-4 flex justify-center">
                <h1 class="text-2xl font-bold text-white">Profil Anggota</h1>
            </div>
            
            <!-- Konten Profil -->
            <div class="bg-white p-6 rounded-b-2xl shadow">
                <div class="flex flex-col items-center">
                    <img src="../assets/img/profil.webp" alt="Foto Profil" class="w-32 h-32 rounded-full mb-4">
                    
                    <h2 class="text-xl font-bold text-blue-600 mb-4">
                        <?= htmlspecialchars($_SESSION['nama']); ?>
                    </h2>
                    
                    <!-- Tabel Informasi -->
                    <table class="w-full max-w-xs border-collapse text-left">
                        <tbody>
                            <tr class="border-b">
                                <th class="py-2 px-4 text-gray-600">Username</th>
                                <td class="py-2 px-4 text-gray-800"><?= htmlspecialchars($_SESSION['username']); ?></td>
                            </tr>
                            <tr class="border-b">
                                <th class="py-2 px-4 text-gray-600">Password</th>
                                <td class="py-2 px-4 text-gray-800">********</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- Tombol Edit -->
                    <div class="mt-6">
                        <a href="edit_profil.php" class="bg-blue-secondary text-white px-6 py-2 rounded-xl hover:bg-blue-primary transition">
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
