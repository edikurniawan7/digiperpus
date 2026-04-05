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

<<<<<<< HEAD
=======
//ambi
>>>>>>> 689875abed4c8ff882dfb89705d62e0fa103442f
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
<<<<<<< HEAD
         <h1 class="text-2xl font-bold text-gray-800 mb-6">Pinjam Buku</h1>


        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
            <!-- Detail Buku Ringkas -->
            <div class="flex gap-6 mb-6 pb-6 border-b">
                <div class="w-32 flex-shrink-0">
                    <img src="<?php echo htmlspecialchars($buku['cover']); ?>" 
                         alt="Cover Buku" 
                         class="w-full rounded shadow-sm object-cover">
                </div>
                <div class="flex-1 text-sm">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2"><?php echo htmlspecialchars($buku['judul']); ?></h3>
                    <p class="text-gray-600 mb-1"><?php echo htmlspecialchars($buku['pengarang']); ?></p>
                    <p class="text-teal-600 font-medium mb-2">Stok: <?php echo htmlspecialchars($buku['stok']); ?> tersedia</p>
                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div>
                            <p class="text-gray-600 font-semibold">Penerbit</p>
                            <p class="text-gray-800"><?php echo htmlspecialchars($buku['penerbit']); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Tahun Terbit</p>
                            <p class="text-gray-800"><?php echo htmlspecialchars($buku['tahun_terbit']); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Kategori</p>
                            <p class="text-gray-800"><?php echo htmlspecialchars($buku['id_kategori']); // Consider fetching category name if needed ?></p>
                        </div>
                    </div>
                    <div class="pt-4">
                        <a href="baca_buku.php?id_buku=<?php echo $id_buku; ?>" class="inline-flex items-center bg-teal-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-teal-700 transition duration-300 shadow-md text-sm">
                            Baca Sekarang
                        </a>
                    </div>
                </div>
            </div>

            <!-- Description Section -->
            <div class="mt-6">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Deskripsi</h3>
                <p class="text-gray-700 leading-relaxed text-sm">
=======
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
>>>>>>> 689875abed4c8ff882dfb89705d62e0fa103442f
                    <?php echo nl2br(htmlspecialchars($buku['deskripsi'])); ?>
                </p>
            </div>
        </div>
    </main>

    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
