<?php
// Persiapan identitas server
$server     = "localhost"; // Nama server
$user       = "root"; // Username database server
$pass       = ""; // Password database server
$database   = "dbarsip"; // Nama database

// Koneksi ke database
$koneksi = mysqli_connect($server, $user, $pass, $database);

// Cek koneksi
// if (!$koneksi) {
//     die("Koneksi gagal: " . mysqli_connect_error());
// } else {
//     echo "Koneksi berhasil!";
// }
// ?>
