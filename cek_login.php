<?php
session_start();
include "config/koneksi.php";

// Pastikan koneksi ke database berhasil
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengamankan input dari SQL Injection
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = md5($_POST['password']); // Enkripsi password tetap menggunakan md5

// Query untuk mendapatkan data user berdasarkan username dan password
$query = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";
$login = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($login);

if ($data) {
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];

    // Redirect langsung ke halaman admin (arsip surat)
    header('location: admin.php');
    exit(); // Menghentikan script setelah redirect
} else {
    echo "<script>
            alert('Maaf, Login GAGAL! Pastikan username dan password Anda benar.');
            document.location='index.php';
          </script>";
}
?>
