<?php
session_start();
// mengatasi user langsung masuk tanpa log
if(empty($_SESSION['id_user']) or empty($_SESSION['username']))
{
    echo"<script>
                alert('Harap Login terlebih dahulu!!');
                document.location='index.php';
                </script>";
}
?>

<!doctype html>
<html lang="id">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa3IW2lEnf3lG6i7IeJCN7fcExXuhq+accesswqZ+20UblT+y23I5LvW12KL6DMLA51a+R1mk/PT0iNbFF0Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <title>E-Arsip KOFIPINDO | Sistem Manajemen Surat</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <button class="sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar">
                <img src="assets/menu.png" alt="Menu" style="width: 24px; height: 24px; filter: brightness(0) invert(1);">
            </button>
            <a class="navbar-brand" href="#" style="display: flex; align-items: center; gap: 12px; margin-left: 10px;">
                <img src="assets/logo_hukum.png" alt="Logo" style="width: 40px; height: 40px; filter: brightness(0) invert(1);">
                <span style="font-weight: 800; font-size: 1.2rem; letter-spacing: 0.5px; color: white;">ARSIP SURAT KOFIPINDO</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-bell"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> <?php echo $_SESSION['username']; ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu">
    
                                
                            </a>

                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="logout.php">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar collapsed" id="sidebar">
        <div class="sidebar-brand">
            <div style="display: flex; align-items: center; justify-content: center; gap: 12px; margin-bottom: 10px;">
                <img src="assets/logo_hukum.png" alt="Logo" style="width: 50px; height: 50px; filter: brightness(0) invert(1);">
            </div>
            <h5 style="color: white; font-size: 1rem; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;">
                <i class="fas fa-envelope"></i> ARSIP SURAT
            </h5>
        </div>

        <ul class="sidebar-menu">
            <li class="sidebar-menu-item">
                <a class="sidebar-menu-link active" href="?">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a class="sidebar-menu-link" href="?halaman=arsip_surat">
                    <i class="fas fa-envelope"></i>
                    <span>Data Surat</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a class="sidebar-menu-link" href="?halaman=departemen">
                    <i class="fas fa-building"></i>
                    <span>Data Departemen</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a class="sidebar-menu-link" href="?halaman=pengirim_surat">
                    <i class="fas fa-user-tie"></i>
                    <span>Data Pengirim Surat</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-divider"></div>

        <div class="sidebar-user">
            <div class="sidebar-user-name">
                <i class="fas fa-user"></i> <?php echo $_SESSION['username']; ?>
            </div>
            <div class="sidebar-user-role">Operator Arsip</div>
        </div>

        <div style="padding: 1rem; text-align: center; margin-top: auto;">
            <a href="logout.php" class="btn btn-danger btn-sm btn-block">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">