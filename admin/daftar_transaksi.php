<?php
include '../config.php';
session_start();

<<<<<<< HEAD
// batasan untuk pagination
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;
$page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($limit <= 0) $limit = 5;
if ($page <= 0) $page = 1;

$start = ($page - 1) * $limit;

// Query untuk mengambil data transaksi dengan join ke tabel buku dan users
=======
>>>>>>> 689875abed4c8ff882dfb89705d62e0fa103442f
$query = mysqli_query($config, "
    SELECT 
        transaksi.*, 
        buku.judul, 
        users.nama
    FROM transaksi
    JOIN buku ON transaksi.id_buku = buku.id_buku
    JOIN users ON transaksi.id_user = users.id_user
    ORDER BY transaksi.id_transaksi DESC
<<<<<<< HEAD
    LIMIT $start, $limit
");

// Hitung total data untuk pagination
$total_query = mysqli_query($config, "SELECT COUNT(*) as total FROM transaksi");
$total_data = mysqli_fetch_assoc($total_query)['total'];
$total_pages = ceil($total_data / $limit);

if ($page > $total_pages) {
    $page = $total_pages;
}
=======
");
>>>>>>> 689875abed4c8ff882dfb89705d62e0fa103442f
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

<<<<<<< HEAD
<h1 class="text-2xl font-bold text-gray-800">
        Daftar Peminjaman
    </h1>
    <p class="text-gray-600 mb-6 text-sm">
        Berikut adalah daftar peminjaman buku yang sedang berlangsung.
    </p>

<div class="bg-white p-6 rounded-lg shadow-sm">

    <!-- SEARCH dan PAGINATION -->
    <div class="flex items-center gap-4 flex-wrap mb-6">
         <a href="tambah_transaksi.php" class="bg-blue-100 border border-blue-500 rounded-lg px-3 py-2 text-xs text-blue-600 transition">
=======
<h1 class="text-2xl font-bold text-blue-600 mb-6">Daftar Peminjaman</h1>

<div class="bg-white p-6 rounded-lg shadow-sm">

    <!-- SEARCH -->
    <div class="flex items-center gap-4 flex-wrap mb-6">
        <a href="tambah_transaksi.php" class="bg-blue-100 border border-blue-500 rounded-lg px-3 py-2 text-xs text-blue-600 transition">
>>>>>>> 689875abed4c8ff882dfb89705d62e0fa103442f
            + Tambah Peminjaman
        </a>
        <form onsubmit="return false;" class="flex items-center gap-3 flex-1 min-w-max">
            <input name="search" placeholder="Cari nama anggota..." type="text" class="flex-1 bg-white px-3 py-2 text-xs border border-gray-400 rounded-full focus:outline-none focus:border-blue-500 transition">
        </form>
<<<<<<< HEAD
        <select onchange="changeLimit(this.value)"
            class="text-xs font-semibold">

                <option value="5" <?= $limit == 5 ? 'selected' : '' ?>>5 Data</option>
                <option value="10" <?= $limit == 10 ? 'selected' : '' ?>>10 Data</option>
                <option value="25" <?= $limit == 25 ? 'selected' : '' ?>>25 Data</option>
                <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50 Data</option>
        </select>
    </div>


=======
    </div>

>>>>>>> 689875abed4c8ff882dfb89705d62e0fa103442f
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

<<<<<<< HEAD
    <!-- PAGINATION -->
    <div class="flex justify-between items-center mt-6 text-xs">

    <div class="text-gray-500">
        Halaman <?= $page; ?> dari <?= $total_pages; ?>
    </div>

    <div class="flex gap-2">

        <!-- PREV -->
        <a href="?page=<?= max(1, $page - 1); ?>&limit=<?= $limit; ?>"
           class="px-3 py-1 rounded 
           <?= ($page == 1) ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-gray-200 hover:bg-gray-300'; ?>">
            Prev
        </a>

        <!-- NEXT -->
        <a href="?page=<?= min($total_pages, $page + 1); ?>&limit=<?= $limit; ?>"
           class="px-3 py-1 rounded 
           <?= ($page >= $total_pages) ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-gray-200 hover:bg-gray-300'; ?>">
            Next
        </a>

    </div>

</div>

</div>
</main>
<!--js filter-->
<script src="../assets/js/transaksi-filter.js"></script>
<script>
    function hapusTransaksi(id) {
        if (confirm('Hapus transaksi ini?')) {
            window.location.href = `hapus_transaksi.php?id=${id}`;
        }
    }

    function changePage(page) {
        const urlParams = new URLSearchParams(window.location.search);
        const limit = urlParams.get('limit') || 5;
        window.location.href = `?page=${page}&limit=${limit}`;
    }

    function changeLimit(limit) {
        window.location.href = `?page=1&limit=${limit}`;
    }
</script>
=======
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

>>>>>>> 689875abed4c8ff882dfb89705d62e0fa103442f
</body>
</html>