<?php
include '../config.php';

ob_clean();
header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nama = mysqli_real_escape_string($config, $_POST['nama'] ?? '');
        $email = mysqli_real_escape_string($config, $_POST['email'] ?? '');
        $pesan = mysqli_real_escape_string($config, $_POST['pesan'] ?? '');

        if (!$nama || !$email || !$pesan) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Semua field wajib diisi'
            ]);
            exit;
        }

        $query = mysqli_query($config, "INSERT INTO pesan (nama, email, pesan) 
            VALUES ('$nama', '$email', '$pesan')");

        if ($query) {
            echo json_encode([
                'status' => 'success'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => mysqli_error($config)
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid request'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
