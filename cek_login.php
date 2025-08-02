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
    $_SESSION['role'] = $data['role']; // Menyimpan role di sesi

    // Cek role user dan arahkan ke halaman sesuai
    if ($data['role'] == 'admin') {
        header('location: admin.php');
        exit(); // Menghentikan script setelah redirect
    } elseif ($data['role'] == 'user') {
        header('location: user.php'); // Perbaikan lokasi file
        exit();
    } else {
        echo "<script>
                alert('Role tidak dikenali!');
                document.location='index.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Maaf, Login GAGAL! Pastikan username dan password Anda benar.');
            document.location='index.php';
          </script>";
}
?>
