<?php
include '../config.php';
session_start();

$id_user = $_SESSION['id_user'];
$username = $_POST['username'];
$password = $_POST['password'];

$foto_name = "";

// upload foto
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $foto_name = "user_" . time() . "." . $ext;

    move_uploaded_file($_FILES['foto']['tmp_name'], "../uploads/img/" . $foto_name);

    $query_foto = ", foto='$foto_name'";
} else {
    $query_foto = "";
}

// password opsional
if (!empty($password)) {
    $query_password = ", password='$password'";
} else {
    $query_password = "";
}

// update
$query = "UPDATE users SET username='$username' $query_password $query_foto WHERE id_user='$id_user'";

if (mysqli_query($config, $query)) {
    $_SESSION['username'] = $username;
    echo "success";
} else {
    echo "error";
}
