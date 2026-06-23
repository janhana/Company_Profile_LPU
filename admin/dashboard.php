<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
require_once '../koneksi.php';

// Hitung total per kategori
$kategori_list = ['civil','electrical','conveyor','renovation','scaffolding','others'];
$stats = [];
foreach ($kategori_list as $kat) {
    $r = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM customers WHERE kategori='$kat'");
    $stats[$kat] = mysqli_fetch_assoc($r)['total'];
}
$total_all = array_sum($stats);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard – Admin PT Link Pangestu Utama</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    :root {
      --navy: #0a1628; --navy-mid: #0d2044; --navy-light: #132952;
      --blue-accent: #1e6bc4; --gold: #c9a84c; --gold-light: #e4c76b;
      --text-light: #8fa3c0; --sidebar-w: 240px;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Inter', sans-serif; background: var(--navy); color: white; display: flex; min-height: 100vh; }

    /* SIDEBAR */
    .sidebar {
      width: var(--sidebar-w); background: var(--navy-mid);
      border-right: 1px solid rgba(255,255,255,0.07);
      display: flex; flex-direction: column;
      position: fixed; top: 0; left: 0; height: 100vh;
      z-index: 10;
    }
    .sidebar-logo {
      padding: 24px 20px;
      border-bottom: 1px solid rgba(255,255,255,0.07);
      display: flex; align-items: center; gap: 10px;
    }
    .logo-icon { width: 36px; height: 36px; background: linear-gradient(135deg, var(--blue-accent), var(--gold)); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px; color: white; flex-shrink: 0; }
    .logo-text { font-size: 12px; font-weight: 700; line-height: 1.3; }
    .logo-sub { font-size: 9px; color: var(--text-light); letter-spacing: 1px; text-transform: uppercase; }
    .sidebar-menu { flex: 1; padding: 20px 0; }
    .menu-label { font-size: 10px; font-weight: 700; color: var(--text-light); letter-spacing: 1.5px; text-transform: uppercase; padding: 0 20px; margin-bottom: 8px; margin-top: 16px; }
    .menu-item {
      display: flex; align-items: center; gap: 10px;
      padding: 10px 20px; font-size: 13px; font-weight: 500;
      color: var(--text-light); text-decoration: none;
      transition: background 0.2s, color 0.2s; border-radius: 0;
    }
    .menu-item:hover, .menu-item.active {
      background: rgba(30,107,196,0.15); color: white;
      border-right: 3px solid var(--blue-accent);
    }
    .sidebar-footer { padding: 20px; border-top: 1px solid rgba(255,255,255,0.07); }
    .btn-logout {
      display: block; text-align: center; padding: 10px;
      background: rgba(220,53,69,0.15); border: 1px solid rgba(220,53,69,0.3);
      border-radius: 8px; color: #ff6b7a; font-size: 13px; font-weight: 600;
      text-decoration: none; transition: background 0.2s;
    }
    .btn-logout:hover { background: rgba(220,53,69,0.25); color: #ff6b7a; }

    /* MAIN */
    .main { margin-left: var(--sidebar-w); flex: 1; padding: 40px; }
    .page-header { margin-bottom: 32px; }
    .page-header h1 { font-size: 26px; font-weight: 800; }
    .page-header p { font-size: 14px; color: var(--text-light); margin-top: 4px; }

    /* STAT CARDS */
    .stat-card {
      background: var(--navy-mid); border: 1px solid rgba(255,255,255,0.07);
      border-radius: 16px; padding: 24px; text-align: center;
      transition: transform 0.2s;
    }
    .stat-card:hover { transform: translateY(-3px); }
    .stat-card .num { font-size: 36px; font-weight: 800; color: var(--gold); }
    .stat-card .label { font-size: 12px; color: var(--text-light); margin-top: 4px; text-transform: uppercase; letter-spacing: 0.8px; }

    /* QUICK ACTION */
    .quick-card {
      background: var(--navy-mid); border: 1px solid rgba(255,255,255,0.07);
      border-radius: 16px; padding: 24px; text-decoration: none; color: white;
      display: block; transition: transform 0.2s, border-color 0.2s;
    }
    .quick-card:hover { transform: translateY(-3px); border-color: rgba(30,107,196,0.4); color: white; }
    .quick-card .icon { font-size: 32px; margin-bottom: 12px; }
    .quick-card h3 { font-size: 15px; font-weight: 700; margin-bottom: 4px; }
    .quick-card p { font-size: 12px; color: var(--text-light); margin: 0; }
    .logo-img {
    width: 50px;
    height: 50px;
    object-fit: contain;
    border-radius: 50%; /* hapus jika logo tidak ingin bulat */
  }
  </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <div class="sidebar-logo">
    <img src="../assets/logo.png" alt="Logo PT Link Pangestu Utama" class="logo-img">
    <div>
      <div class="logo-text">PT Link Pangestu Utama</div>
      <div class="logo-sub">Admin Panel</div>
    </div>
  </div>
  <nav class="sidebar-menu">
    <div class="menu-label">Menu</div>
    <a href="dashboard.php" class="menu-item active">🏠 Dashboard</a>
    <a href="customers.php" class="menu-item">👥 Kelola Customer</a>
    <div class="menu-label">Website</div>
    <a href="../index.php" class="menu-item" target="_blank">🌐 Lihat Website</a>
  </nav>
  <div class="sidebar-footer">
    <a href="logout.php" class="btn-logout">🚪 Logout</a>
  </div>
</div>

<!-- MAIN -->
<div class="main">
  <div class="page-header">
    <h1>Dashboard 👋</h1>
    <p>Selamat datang, <strong><?= $_SESSION['admin'] ?></strong>. Kelola data customer PT Link Pangestu Utama.</p>
  </div>

  <!-- Stats -->
  <div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
      <div class="stat-card">
        <div class="num"><?= $total_all ?></div>
        <div class="label">Total Customer</div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="stat-card">
        <div class="num"><?= $stats['scaffolding'] ?></div>
        <div class="label">Scaffolding</div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="stat-card">
        <div class="num"><?= $stats['civil'] ?></div>
        <div class="label">Civil Work</div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="stat-card">
        <div class="num"><?= $stats['renovation'] ?></div>
        <div class="label">Office Renovation</div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="stat-card">
        <div class="num"><?= $stats['conveyor'] ?></div>
        <div class="label">Conveyor Line</div>
      </div>
    </div>  
    <div class="col-6 col-lg-3">
      <div class="stat-card">
        <div class="num"><?= $stats['electrical'] ?></div>
        <div class="label">Electrical Work</div>
      </div>
  </div>
  <div class="col-6 col-lg-3">
      <div class="stat-card">
        <div class="num"><?= $stats['others'] ?></div>
        <div class="label">Others Work</div>
      </div>
    </div>
  <div class="row g-3">
  <!-- Quick Actions -->
  <h2 style="font-size:16px; font-weight:700; margin-bottom:16px; color:var(--text-light); text-transform:uppercase; letter-spacing:1px;">Core Features</h2>
    <div class="col-6 col-lg-3">
      <a class="quick-card">
        <div class="icon">➕</div>
        <h3>Tambah Customer</h3>
        <p>Tambah data customer baru</p>
      </a>
    </div>
    <div class="col-6 col-lg-3">
      <a class="quick-card">
        <div class="icon">👥</div>
        <h3>Kelola Customer</h3>
        <p>Lihat, edit, hapus customer</p>
      </a>
    </div>
    <div class="col-6 col-lg-3">
      <a class="quick-card" target="_blank">
        <div class="icon">🌐</div>
        <h3>Lihat Website</h3>
        <p>Buka halaman publik</p>
      </a>
    </div>
    <div class="col-6 col-lg-3">
      <a class="quick-card" style="border-color:rgba(220,53,69,0.2);">
        <div class="icon">🚪</div>
        <h3>Logout</h3>
        <p>Keluar dari admin panel</p>
      </a>
    </div>
  </div>
</div>

</body>
</html>
