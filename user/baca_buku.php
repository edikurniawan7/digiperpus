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

if (!$buku) {
    header("Location: daftar_buku.php");
    exit;
}

// Asumsikan file PDF disimpan di folder 'uploads/' atau sesuai dengan path di database
$file_pdf = $buku['file_pdf'];
if (!$file_pdf || !file_exists('../' . $file_pdf)) {
    echo "File PDF belum diunggah.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baca Buku - <?php echo htmlspecialchars($buku['judul']); ?></title>
    <link href="../src/output.css" rel="stylesheet"> 
</head>

<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen">
    <?php include 'partials/sidebar.php'; ?>

    <main class="flex-1 ml-64 p-8 mt-20">
        <h2 class="text-xl font-bold text-gray-700 mb-4">Baca Buku: <?php echo htmlspecialchars($buku['judul']); ?></h2>

        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <embed src="<?php echo htmlspecialchars('../' . $file_pdf); ?>" type="application/pdf" width="100%" height="600px" />
        </div>
    </main>

    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>