<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <link href="../src/output.css" rel="stylesheet">
    <title>Detail Buku</title>
</head>
<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">
    <?php 
    include '../config.php';
    session_start();

    $id_buku = isset($_GET['id']) ? $_GET['id'] : null;
    $stmt = $config->prepare("SELECT * FROM buku WHERE id_buku = ?");
    $stmt->bind_param("i", $id_buku);
    $stmt->execute();
    $result = $stmt->get_result();
    $buku = $result->fetch_assoc();
    if (!$buku) {
        header("Location: ../index.php");
        exit;
    }
    ?>

    <main class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6 mt-20">
            <!-- Detail Buku Ringkas -->
            <div class="flex gap-6 mb-6 pb-6 border-b">
                <div class="w-32 flex-shrink-0">
                    <img src="../uploads/cover/<?= $buku['cover']; ?>" alt="<?= $buku['judul']; ?>" 
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
                </div>
            </div>

            <!-- Description Section -->
            <div class="mt-6 ">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Deskripsi</h3>
                <p class="text-gray-700 leading-relaxed text-sm mb-6">
                    <?php echo nl2br(htmlspecialchars($buku['deskripsi'])); ?>
                </p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center gap-3 pt-4 mt-6 border-t">
                <button type="button" onclick="window.history.back()" 
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Kembali
                </button>
                
            </div>
</main>
    



    
</body>
</html>