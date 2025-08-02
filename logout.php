<?php
// hapus session yang sudah di set
session_start();
unset($_SESSION['id_user']);
unset($_SESSION['username']);

session_destroy();
echo "<script>
                alert('Anda telah keluar dari Halaman Administrator');
                document.location='index.php';
                </script>";

?>