<!-- Konfigurasi Database -->
<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "digiperpus-app";

    $config = mysqli_connect($host, $user, $pass, $dbname);

    // Cek Koneksi
    if (!$config) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

?>





