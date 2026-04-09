<!-- Aksi Tambah Anggota -->
<?php
session_start();
include '../config.php';
// Ambil data dari form
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password']; 

// Validasi data
if (!$nama || !$username || !$password || !$confirm_password) {
    echo "Data tidak lengkap!";
    exit;
}

if ($password !== $confirm_password) {
    echo "Konfirmasi password tidak cocok!";
    exit;
}

// Cek username sudah ada atau belum
$query_check = mysqli_query($config, "SELECT * FROM users WHERE username='$username'");
if (mysqli_num_rows($query_check) > 0) {
    echo "Username sudah digunakan!";
    exit;
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
// Simpan ke database
$insert = mysqli_query($config, "INSERT INTO users (nama, username, password, role) VALUES ('$nama', '$username', '$hashed_password', 'user')");
if ($insert) {
    echo "Anggota berhasil ditambahkan!";
} else {
    echo "Error: " . mysqli_error($config);
}
// Redirect ke daftar anggota
echo "<script>
    alert('Anggota berhasil ditambahkan!');
    window.location.href='../admin/daftar_anggota.php';
</script>";

?>  
