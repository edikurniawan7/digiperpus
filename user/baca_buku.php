<?php
include '../config.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id_buku = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id_buku) {
    header("Location: daftar_buku.php");
    exit;
}

// ambil data buku
$query = "SELECT * FROM buku WHERE id_buku = ?";
$stmt = $config->prepare($query);
$stmt->bind_param("i", $id_buku);
$stmt->execute();
$result = $stmt->get_result();
$buku = $result->fetch_assoc();

if (!$buku) {
    header("Location: daftar_buku.php");
    exit;
}

// path file PDF
$file = "../uploads/e-book/" . $buku['file_buku'];

// Cek apakah file ada
if (!file_exists($file) || empty($buku['file_buku'])) {
    $file = null; 
}

// Jika file belum diunggah, kita akan menampilkan pesan di dalam iframe nanti
if (!file_exists($file)) {
    echo "File belum diunggah!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Baca Buku - <?= htmlspecialchars($buku['judul']); ?></title>
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <link href="../src/output.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

<!-- HEADER -->
<div class="bg-white shadow px-6 py-4 flex items-center justify-between">
    <h1 class="text-lg font-semibold text-gray-800">
        <?= htmlspecialchars($buku['judul']); ?>
    </h1>

    <a href="preview_buku.php?id_buku=<?= $buku['id_buku']; ?>" 
       class="text-sm px-3 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
        ← Kembali
    </a>
</div>

<!-- PDF VIEWER -->
<div class="w-full h-[calc(100vh-70px)]">
    <iframe 
        src="<?= $file; ?>" 
        class="w-full h-full"
        frameborder="0">
    </iframe>
</div>

<!-- Jika file belum diunggah -->
<div id="file-not-found" class="hidden w-full h-[calc(100vh-70px)] flex items-center justify-center bg-white">
    <p class="text-gray-500 text-lg">File buku belum diunggah.</p>
</div>
<script>
    const iframe = document.querySelector('iframe');
    const fileNotFound = document.getElementById('file-not-found');

    iframe.addEventListener('error', () => {
        iframe.style.display = 'none';
        fileNotFound.classList.remove('hidden');
    });
</script>


</body>
</html>