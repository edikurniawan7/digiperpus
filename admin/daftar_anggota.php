<?php
// Koneksi ke database
include '../config.php';

// Mulai Sesi
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <title>Data Anggota</title>
    <link href="../src/output.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">
    <!-- Sidebar -->
    <?php include 'partials/sidebar.php'; ?>
    
    <!-- Konten Utama -->
    <main class="flex-1 ml-64 p-8 mt-20">
        <h1 class="text-2xl font-bold text-gray-800">
        Daftar Anggota
    </h1>
    <p class="text-gray-600 mb-6 text-sm">
        Berikut adalah daftar anggota yang terdaftar dalam sistem.
    </p>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <!-- Filter & Search -->
            <div class="flex items-center gap-4 flex-wrap mb-6">
                <a href="tambah_anggota.php" class="bg-blue-100 border border-blue-500 rounded-lg px-3 py-2 text-xs text-blue-600 transition">
                    + Tambah Anggota
                </a>
                <form onsubmit="return false;" class="flex items-center gap-3 flex-1 min-w-max">
                    <input name="search" placeholder="Cari nama anggota..." type="text" class="flex-1 bg-white px-3 py-2 text-xs border border-gray-400 rounded-full focus:outline-none focus:border-blue-500 transition">
                </form>
            </div>

            <!-- Tabel -->
            <div class="overflow-x-auto">
                <table class="w-full text-xs border-collapse">
                    <thead>
                        <tr class="bg-gray-100 rounded-lg text-gray-700 uppercase text-left border border-gray-300">
                            <th class="px-4 py-3">ID Anggota</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Username</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="anggota-body">
                        <?php
                        $query = "SELECT id_user, nama, username FROM users WHERE role='user' ORDER BY nama ASC";
                        $result = mysqli_query($config, $query);

                        if(mysqli_num_rows($result) > 0):
                            while ($row = mysqli_fetch_assoc($result)):
                        ?>
                            <tr class="anggota-item border border-gray-300 hover:bg-slate-50 transition"
                                data-id="<?= strtolower($row['id_user']); ?>"
                                data-nama="<?= strtolower($row['nama']); ?>"
                                data-username="<?= strtolower($row['username']); ?>">
                                <td class="px-4 py-3 text-gray-700"><?= $row['id_user']; ?></td>
                                <td class="px-4 py-3 text-gray-700"><?= $row['nama']; ?></td>
                                <td class="px-4 py-3 text-gray-700"><?= $row['username']; ?></td>
                                <td class="px-4 py-3 text-center">
                                    <a href="edit_anggota.php?id=<?= $row['id_user']; ?>" class="mr-2 bg-blue-100 border border-blue-500 rounded-lg px-3 py-1 text-blue-600 hover:bg-blue-200 transition">
                                        Edit
                                    </a>
                                    <button onclick="hapusAnggota('<?= $row['id_user']; ?>')" class="bg-red-100 border border-red-500 rounded-lg px-2 py-1 text-red-600 hover:bg-red-200 transition">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        <?php 
                            endwhile;
                        else:
                        ?>
                            <tr>
                                <td colspan="4" class="py-4 text-center text-gray-500">
                                    Belum ada anggota.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pesan Kosong Saat Search -->
            <div id="empty-anggota" class="hidden text-center text-gray-500 text-xs font-medium mt-6">
                Anggota tidak ditemukan
            </div>
        </div>
    </main>
    
    <script src="../assets/js/anggota-filter.js"></script>
    <script>
        function hapusAnggota(id) {
            if(confirm('Apakah Anda yakin ingin menghapus anggota ini?')) {
                window.location.href = 'hapus_anggota.php?id=' + id;
            }
        }
    </script>
</body>
</html>
