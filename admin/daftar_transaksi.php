<?php
include '../config.php';
session_start();

$query = mysqli_query($config, "
    SELECT 
        transaksi.*, 
        buku.judul, 
        users.nama
    FROM transaksi
    JOIN buku ON transaksi.id_buku = buku.id_buku
    JOIN users ON transaksi.id_user = users.id_user
    ORDER BY transaksi.id_transaksi DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <title>Daftar Transaksi</title>
    <link href="../src/output.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">

<?php include 'partials/sidebar.php'; ?>

<main class="flex-1 ml-64 p-8 mt-20">

<h1 class="text-2xl font-bold text-blue-600 mb-6">Daftar Peminjaman</h1>

<div class="bg-white p-6 rounded-lg shadow-sm">

    <!-- SEARCH -->
    <div class="flex items-center gap-4 flex-wrap mb-6">
        <a href="tambah_transaksi.php" class="bg-blue-100 border border-blue-500 rounded-lg px-3 py-2 text-xs text-blue-600 transition">
            + Tambah Peminjaman
        </a>
        <form onsubmit="return false;" class="flex items-center gap-3 flex-1 min-w-max">
            <input name="search" placeholder="Cari nama anggota..." type="text" class="flex-1 bg-white px-3 py-2 text-xs border border-gray-400 rounded-full focus:outline-none focus:border-blue-500 transition">
        </form>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">
        <table class="w-full text-xs border-collapse">
            <thead>
                <tr class="bg-gray-100 rounded-lg text-gray-700 uppercase text-left border border-gray-300">
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">Jumlah</th>
                    <th class="px-4 py-3">Tgl Pinjam</th>
                    <th class="px-4 py-3">Tgl Kembali</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody id="transaksi-body">
            <?php if(mysqli_num_rows($query) > 0){ ?>
                <?php while($t = mysqli_fetch_array($query)){ ?>
                
                <tr class="transaksi-item border border-gray-300 hover:bg-slate-50 transition"
                    data-id="<?= strtolower($t['id_transaksi']); ?>"
                    data-nama="<?= strtolower($t['nama']); ?>"
                    data-judul="<?= strtolower($t['judul']); ?>"
                    data-status="<?= strtolower($t['status']); ?>">

                    <td class="px-4 py-3 text-gray-700"><?= $t['id_transaksi']; ?></td>
                    <td class="px-4 py-3 text-gray-700"><?= $t['nama']; ?></td>
                    <td class="px-4 py-3 text-gray-700"><?= $t['judul']; ?></td>
                    <td class="px-4 py-3 text-gray-700"><?= $t['jumlah']; ?></td>
                    <td class="px-4 py-3 text-gray-700"><?= $t['tanggal_pinjam']; ?></td>
                    <td class="px-4 py-3 text-gray-700"><?= $t['tanggal_kembali']; ?></td>

                    <td class="px-4 py-3">
                        <?php if($t['status'] == 'dipinjam'): ?>
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Dipinjam</span>
                        <?php else: ?>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Dikembalikan</span>
                        <?php endif; ?>
                    </td>

                    <td class="px-4 py-3 text-center">
                        <a href="detail_transaksi.php?id=<?= $t['id_transaksi']; ?>" class="mr-2 bg-blue-100 border border-blue-500 rounded-lg px-3 py-1 text-blue-600 hover:bg-blue-200 transition">
                            Detail
                        </a>
                        <button onclick="hapusTransaksi('<?= $t['id_transaksi']; ?>')" class="bg-red-100 border border-red-500 rounded-lg px-2 py-1 text-red-600 hover:bg-red-200 transition">
                            Hapus
                        </button>
                    </td>
                </tr>

                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div id="empty-transaksi" class="hidden text-center text-xs text-gray-500 font-medium mt-6">
        Transaksi tidak ditemukan
    </div>

</div>
</main>

<script>
    function hapusTransaksi(id) {
        if(confirm('Yakin ingin menghapus transaksi ini?')) {
            window.location.href = 'hapus_transaksi.php?id=' + id;
        }
    }
</script>

<!-- JS FILTER -->
<script src="../assets/js/peminjaman-filter.js"></script>

</body>
</html>