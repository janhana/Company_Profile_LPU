<?php
session_start();
require_once '../koneksi.php';

// Kalau sudah login, langsung ke dashboard
if (isset($_SESSION['admin'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = MD5(trim($_POST['password']));

    $sql    = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['admin'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Username atau password salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login – PT Link Pangestu Utama</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --navy: #0a1628; --navy-mid: #0d2044; --navy-light: #132952;
      --blue-accent: #1e6bc4; --gold: #c9a84c; --gold-light: #e4c76b;
      --text-light: #8fa3c0;
    }
    body {
      font-family: 'Inter', sans-serif;
      background: var(--navy);
      min-height: 100vh;
      display: flex; align-items: center; justify-content: center;
    }
    .login-box {
      background: var(--navy-mid);
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 20px;
      padding: 48px 40px;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 30px 80px rgba(0,0,0,0.4);
    }
    .login-logo {
      display: flex; align-items: center; gap: 12px;
      justify-content: center; margin-bottom: 32px;
    }
    .logo-icon {
      width: 44px; height: 44px;
      background: linear-gradient(135deg, var(--blue-accent), var(--gold));
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-weight: 800; font-size: 18px; color: white;
    }
    .logo-img {
    width: 50px;
    height: 50px;
    object-fit: contain;
    border-radius: 50%; /* hapus jika logo tidak ingin bulat */
  }
    .login-title { font-size: 13px; font-weight: 700; color: white; line-height: 1.2; }
    .login-sub { font-size: 10px; color: var(--text-light); letter-spacing: 1.5px; text-transform: uppercase; }
    h2 { font-size: 22px; font-weight: 800; color: white; margin-bottom: 8px; }
    .login-desc { font-size: 13px; color: var(--text-light); margin-bottom: 32px; }
    label { display: block; font-size: 11px; font-weight: 600; color: var(--text-light); letter-spacing: 0.8px; text-transform: uppercase; margin-bottom: 8px; }
    input {
      width: 100%; background: var(--navy); border: 1px solid rgba(255,255,255,0.1);
      border-radius: 10px; padding: 13px 16px; font-size: 14px; color: white;
      font-family: 'Inter', sans-serif; outline: none; transition: border-color 0.2s;
      margin-bottom: 20px;
    }
    input:focus { border-color: var(--blue-accent); }
    input::placeholder { color: rgba(255,255,255,0.2); }
    .btn-login {
      width: 100%; background: linear-gradient(135deg, var(--blue-accent), #1a5faa);
      color: white; border: none; border-radius: 10px; padding: 14px;
      font-size: 15px; font-weight: 700; cursor: pointer;
      font-family: 'Inter', sans-serif; transition: opacity 0.2s;
    }
    .btn-login:hover { opacity: 0.85; }
    .error-msg {
      background: rgba(220,53,69,0.15); border: 1px solid rgba(220,53,69,0.3);
      border-radius: 8px; padding: 12px 16px; font-size: 13px; color: #ff6b7a;
      margin-bottom: 20px;
    }
    .back-link {
      display: block; text-align: center; margin-top: 20px;
      font-size: 13px; color: var(--text-light); text-decoration: none;
      transition: color 0.2s;
    }
    .back-link:hover { color: var(--gold); }
    .logo-img {
    width: 50px;
    height: 50px;
    object-fit: contain;
    border-radius: 50%; /* hapus jika logo tidak ingin bulat */
  }
  </style>
</head>
<body>
  <div class="login-box">
    <div class="login-logo">
      <img src="../assets/logo.png" alt="Logo PT Link Pangestu Utama" class="logo-img">
      <div>
        <div class="login-title">PT Link Pangestu Utama</div>
        <div class="login-sub">Admin Panel</div>
      </div>
    </div>
    <h2>Welcome Back 👋</h2>
    <p class="login-desc">Login untuk mengelola data customer dan proyek.</p>

    <?php if ($error): ?>
      <div class="error-msg">⚠️ <?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <label>Username</label>
      <input type="text" name="username" placeholder="Masukkan username" required/>
      <label>Password</label>
      <input type="password" name="password" placeholder="Masukkan password" required/>
      <button type="submit" class="btn-login">Login →</button>
    </form>
    <a href="../index.php" class="back-link">← Kembali ke Website</a>
  </div>
</body>
</html>