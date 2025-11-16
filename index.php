<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Manajemen Arsip Surat KOFIPINDO">
    <meta name="author" content="Fuad, Hanum, Ayu">
    <title>Arsip Surat KOFIPINDO - LOGIN</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #0056b3 0%, #003d82 50%, #002554 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
      }

      .login-container {
        width: 100%;
        max-width: 450px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        animation: slideUp 0.5s ease-out;
      }

      .login-header {
        background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
        color: white;
        padding: 40px 20px;
        text-align: center;
      }

      .login-header img {
        width: 80px;
        height: 80px;
        margin-bottom: 15px;
        filter: brightness(0) invert(1) drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
      }

      .login-header h1 {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: 0.5px;
      }

      .login-header p {
        font-size: 0.95rem;
        opacity: 0.95;
        margin: 0;
        line-height: 1.4;
      }

      .login-body {
        padding: 40px 30px;
      }

      .form-group {
        margin-bottom: 20px;
      }

      .form-group label {
        display: block;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        font-size: 0.95rem;
      }

      .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
      }

      .form-group input:focus {
        outline: none;
        border-color: #0056b3;
        background-color: white;
        box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.1);
      }

      .form-group.input-group-icon {
        position: relative;
      }

      .form-group.input-group-icon i {
        position: absolute;
        right: 15px;
        top: 43px;
        color: #999;
      }

      .checkbox-group {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
      }

      .checkbox-group input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        margin-right: 8px;
      }

      .checkbox-group label {
        margin-bottom: 0;
        font-weight: 500;
        font-size: 0.9rem;
        color: #666;
        cursor: pointer;
      }

      .btn-login {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
      }

      .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(0, 86, 179, 0.3);
      }

      .btn-login:active {
        transform: translateY(0);
      }

      .login-footer {
        text-align: center;
        color: #999;
        font-size: 0.85rem;
        padding: 0 30px 30px;
      }

      .login-footer p {
        margin: 0;
      }

      @keyframes slideUp {
        from {
          opacity: 0;
          transform: translateY(30px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      @media (max-width: 576px) {
        .login-container {
          max-width: 100%;
        }

        .login-header {
          padding: 30px 20px;
        }

        .login-header h1 {
          font-size: 1.5rem;
        }

        .login-body {
          padding: 30px 20px;
        }

        .login-footer {
          padding: 0 20px 20px;
        }
      }
    </style>
  </head>
  <body>
    <div class="login-container">
      <div class="login-header">
        <img src="assets/logo_hukum.png" alt="Logo Arsip Surat">
        <h1>Arsip Surat KOFIPINDO</h1>
        <p>Sistem Manajemen Arsip Surat</p>
      </div>

      <form class="login-body" method="post" action="cek_login.php">
        <div class="form-group input-group-icon">
          <label for="username">
            <i class="fas fa-user"></i> Username
          </label>
          <input type="text" id="username" name="username" placeholder="Masukkan username Anda" required autofocus>
        </div>

        <div class="form-group input-group-icon">
          <label for="password">
            <i class="fas fa-lock"></i> Password
          </label>
          <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
        </div>

        <div class="checkbox-group">
          <input type="checkbox" id="remember" name="remember" value="on">
          <label for="remember">Ingat saya</label>
        </div>

        <button type="submit" class="btn-login">
          <i class="fas fa-sign-in-alt"></i> Masuk
        </button>
      </form>

      <div class="login-footer">
        <p>&copy; 2025 Arsip Surat KOFIPINDO. All rights reserved.</p>
        <p style="margin-top: 8px; font-size: 0.8rem;">Dikembangkan oleh: Fuad, Hanum, Ayu</p>
      </div>
    </div>
  </body>
</html>
