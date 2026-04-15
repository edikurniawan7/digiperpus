<?php
include '../config.php';

// Query hanya status dipinjam
$query = mysqli_query($config, "
    SELECT transaksi.*, users.nama, buku.judul 
    FROM transaksi
    JOIN users ON transaksi.id_user = users.id_user
    JOIN buku ON transaksi.id_buku = buku.id_buku
    WHERE transaksi.status = 'dikembalikan'
    ORDER BY id_transaksi DESC
");

// Total data
$total = mysqli_num_rows($query);

// Tanggal sekarang
$tanggal = date('d M Y');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan Riwayat Peminjaman</title>
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .header p {
            margin: 2px 0;
        }

        .info {
            margin-bottom: 15px;
        }

        .info p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
            text-align: center;
        }

        td {
            text-align: center;
        }

        .footer {
            margin-top: 50px;
            width: 100%;
        }

        .ttd {
            float: right;
            text-align: center;
        }
    </style>
</head>

<body onload="window.print()">

    <!-- HEADER -->
    <div class="header">
        <h2>Digiperpus</h2>
        <p><b>Laporan Riwayat Peminjaman</b></p>
    </div>

    <!-- INFO -->
    <div class="info">
        <p>Tanggal Cetak: <?= $tanggal; ?></p>
        <p>Status: <b>Dikembalikan</b></p>
        <p>Total Data: <b><?= $total; ?></b></p>
    </div>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama</th>
                <th>Judul Buku</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <?php if ($total > 0): ?>
                <?php $no = 1; ?>
                <?php while ($t = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $t['id_transaksi']; ?></td>
                        <td><?= $t['nama']; ?></td>
                        <td><?= $t['judul']; ?></td>
                        <td><?= $t['jumlah']; ?></td>
                        <td><?= date('d M Y', strtotime($t['tanggal_pinjam'])); ?></td>
                        <td><?= date('d M Y', strtotime($t['tanggal_kembali'])); ?></td>
                        <td><b>Dikembalikan</b></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        <div class="ttd">
            <p>Mengetahui,</p>
            <br><br><br>
            <p><b>Admin Digiperpus</b></p>
        </div>
    </div>

</body>

</html>