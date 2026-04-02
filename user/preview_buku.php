<?php
include '../config.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$id_buku = isset($_GET['id_buku']) ? $_GET['id_buku'] : null;

if (!$id_buku) {
    header("Location: daftar_buku.php");
    exit;
}

// Query data buku dari database
$query = "SELECT * FROM buku WHERE id_buku = ?";
$stmt = $config->prepare($query);
$stmt->bind_param("i", $id_buku);
$stmt->execute();
$result = $stmt->get_result();
$buku = $result->fetch_assoc();

//ambi
if (!$buku) {
    header("Location: daftar_buku.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Buku - <?php echo htmlspecialchars($buku['judul']); ?></title>
    <link href="../src/output.css" rel="stylesheet"> 
</head>

<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">
    <?php include 'partials/sidebar.php'; ?>

    <main class="flex-1 ml-64 p-8 mt-20">
        <h2 class="text-xl font-bold text-gray-700 mb-4">Preview Buku</h2>

        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Book Cover -->
                <div class="flex justify-center">
                    <img src="<?php echo htmlspecialchars($buku['cover']); ?>" alt="Cover Buku" class="rounded-lg shadow-md w-full max-w-xs">
                </div>

                <!-- Book Details -->
                <div class="md:col-span-2">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($buku['judul']); ?></h1>
                    <p class="text-lg text-teal-600 font-semibold mb-4"><?php echo htmlspecialchars($buku['pengarang']); ?></p>
                    
                    <div class="space-y-4 mb-6">
                        <div class="border-b pb-3">
                            <p class="text-sm text-gray-600 font-semibold">Penerbit</p>
                            <p class="text-gray-800"><?php echo htmlspecialchars($buku['penerbit']); ?></p>
                        </div>
                        <div class="border-b pb-3">
                            <p class="text-sm text-gray-600 font-semibold">Tahun Terbit</p>
                            <p class="text-gray-800"><?php echo $buku['tahun_terbit']; ?></p>
                        </div>
                        <div class="border-b pb-3">
                            <p class="text-sm text-gray-600 font-semibold">Kategori</p>

                            <p class="text-gray-800"><?php echo htmlspecialchars($buku['id_kategori']); ?></p>
                        </div>
                        <div class="border-b pb-3">
                            <p class="text-sm text-gray-600 font-semibold">stok</p>
                            <p class="text-gray-800"><?php echo htmlspecialchars($buku['stok']); ?></p>
                        </div>
                    </div>

                    <a href="baca_buku.php?id_buku=<?php echo $id_buku; ?>" class="inline-block bg-teal-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-teal-700 transition">Baca Sekarang</a>
            <?php echo htmlspecialchars($buku['file_pdf'] ?? ''); ?>
            </div>

            <!-- Description Section -->
            <div class="mt-8 pt-8 border-t">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Deskripsi</h2>
                <p class="text-gray-700 leading-relaxed">
                    <?php echo nl2br(htmlspecialchars($buku['deskripsi'])); ?>
                </p>
            </div>
        </div>
    </main>

    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
