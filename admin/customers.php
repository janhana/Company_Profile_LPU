<?php
session_start();
if (!isset($_SESSION['admin'])) { header('Location: login.php'); exit; }
require_once '../koneksi.php';

$filter = isset($_GET['kategori']) ? $_GET['kategori'] : '';
$sql = $filter
    ? "SELECT * FROM customers WHERE kategori='$filter' ORDER BY tahun DESC"
    : "SELECT * FROM customers ORDER BY kategori ASC, tahun DESC";
$result = mysqli_query($koneksi, $sql);
$data   = mysqli_fetch_all($result, MYSQLI_ASSOC);

$kategori_label = [
    'civil'       => 'Civil Work',
    'electrical'  => 'Electrical Work',
    'conveyor'    => 'Conveyor Line',
    'renovation'  => 'Office Renovation',
    'scaffolding' => 'Scaffolding',
    'others'      => 'Other Works',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Kelola Customer – Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    :root { --navy: #0a1628; --navy-mid: #0d2044; --navy-light: #132952; --blue-accent: #1e6bc4; --gold: #c9a84c; --text-light: #8fa3c0; --sidebar-w: 240px; }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Inter', sans-serif; background: var(--navy); color: white; display: flex; min-height: 100vh; }
    .sidebar { width: var(--sidebar-w); background: var(--navy-mid); border-right: 1px solid rgba(255,255,255,0.07); display: flex; flex-direction: column; position: fixed; top: 0; left: 0; height: 100vh; z-index: 10; }
    .sidebar-logo { padding: 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.07); display: flex; align-items: center; gap: 10px; }
    .logo-icon { width: 36px; height: 36px; background: linear-gradient(135deg, var(--blue-accent), var(--gold)); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px; color: white; flex-shrink: 0; }
    .logo-text { font-size: 12px; font-weight: 700; line-height: 1.3; }
    .logo-sub { font-size: 9px; color: var(--text-light); letter-spacing: 1px; text-transform: uppercase; }
    .sidebar-menu { flex: 1; padding: 20px 0; }
    .menu-label { font-size: 10px; font-weight: 700; color: var(--text-light); letter-spacing: 1.5px; text-transform: uppercase; padding: 0 20px; margin-bottom: 8px; margin-top: 16px; }
    .menu-item { display: flex; align-items: center; gap: 10px; padding: 10px 20px; font-size: 13px; font-weight: 500; color: var(--text-light); text-decoration: none; transition: background 0.2s, color 0.2s; }
    .menu-item:hover, .menu-item.active { background: rgba(30,107,196,0.15); color: white; border-right: 3px solid var(--blue-accent); }
    .sidebar-footer { padding: 20px; border-top: 1px solid rgba(255,255,255,0.07); }
    .btn-logout { display: block; text-align: center; padding: 10px; background: rgba(220,53,69,0.15); border: 1px solid rgba(220,53,69,0.3); border-radius: 8px; color: #ff6b7a; font-size: 13px; font-weight: 600; text-decoration: none; }
    .btn-logout:hover { background: rgba(220,53,69,0.25); color: #ff6b7a; }
    .main { margin-left: var(--sidebar-w); flex: 1; padding: 40px; }
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; flex-wrap: wrap; gap: 16px; }
    .page-header h1 { font-size: 24px; font-weight: 800; }
    .btn-tambah { background: linear-gradient(135deg, var(--blue-accent), #1a5faa); color: white; padding: 10px 24px; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none; }
    .btn-tambah:hover { opacity: 0.85; color: white; }
    .logo-img {
    width: 50px;
    height: 50px;
    object-fit: contain;
    border-radius: 50%; /* hapus jika logo tidak ingin bulat */
  }

    /* Filter tabs */
    .filter-tabs { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 24px; }
    .filter-tab { padding: 6px 16px; border-radius: 20px; font-size: 12px; font-weight: 600; text-decoration: none; border: 1px solid rgba(255,255,255,0.1); color: var(--text-light); transition: all 0.2s; }
    .filter-tab:hover, .filter-tab.active { background: var(--blue-accent); border-color: var(--blue-accent); color: white; }

    /* Table */
    .table-wrap { background: var(--navy-mid); border: 1px solid rgba(255,255,255,0.07); border-radius: 16px; overflow: hidden; }
    table { width: 100%; border-collapse: collapse; }
    thead { background: rgba(255,255,255,0.04); }
    th { padding: 14px 16px; font-size: 11px; font-weight: 700; color: var(--text-light); text-transform: uppercase; letter-spacing: 1px; text-align: left; }
    td { padding: 14px 16px; font-size: 13px; border-top: 1px solid rgba(255,255,255,0.05); vertical-align: middle; }
    tr:hover td { background: rgba(255,255,255,0.02); }
    .badge-kat { padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; background: rgba(30,107,196,0.2); color: var(--blue-accent); }
    .thumb { width: 60px; height: 48px; object-fit: cover; border-radius: 6px; }
    .thumb-placeholder { width: 60px; height: 48px; background: var(--navy-light); border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
    .btn-edit { padding: 5px 12px; font-size: 12px; font-weight: 600; border-radius: 6px; background: rgba(30,107,196,0.2); color: var(--blue-accent); text-decoration: none; border: 1px solid rgba(30,107,196,0.3); transition: background 0.2s; }
    .btn-edit:hover { background: rgba(30,107,196,0.4); color: white; }
    .btn-hapus { padding: 5px 12px; font-size: 12px; font-weight: 600; border-radius: 6px; background: rgba(220,53,69,0.15); color: #ff6b7a; text-decoration: none; border: 1px solid rgba(220,53,69,0.3); transition: background 0.2s; margin-left: 6px; }
    .btn-hapus:hover { background: rgba(220,53,69,0.3); color: white; }
    .empty-row td { text-align: center; padding: 48px; color: var(--text-light); }

    .alert-success { background: rgba(25,135,84,0.15); border: 1px solid rgba(25,135,84,0.3); border-radius: 10px; padding: 12px 16px; font-size: 13px; color: #75d6a1; margin-bottom: 20px; }
  </style>
</head>
<body>

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
    <a href="dashboard.php" class="menu-item">🏠 Dashboard</a>
    <a href="customers.php" class="menu-item active">👥 Kelola Customer</a>
    <div class="menu-label">Website</div>
    <a href="../index.php" class="menu-item" target="_blank">🌐 Lihat Website</a>
  </nav>
  <div class="sidebar-footer">
    <a href="logout.php" class="btn-logout">🚪 Logout</a>
  </div>
</div>

<div class="main">
  <div class="page-header">
    <h1>👥 Kelola Customer</h1>
    <a href="tambah.php" class="btn-tambah">+ Tambah Customer</a>
  </div>

  <?php if (isset($_GET['success'])): ?>
    <div class="alert-success">✅ <?= htmlspecialchars($_GET['success']) ?></div>
  <?php endif; ?>

  <!-- Filter -->
  <div class="filter-tabs">
    <a href="customers.php" class="filter-tab <?= !$filter ? 'active' : '' ?>">Semua</a>
    <?php foreach ($kategori_label as $key => $label): ?>
      <a href="customers.php?kategori=<?= $key ?>" class="filter-tab <?= $filter === $key ? 'active' : '' ?>"><?= $label ?></a>
    <?php endforeach; ?>
  </div>

  <!-- Table -->
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Foto</th>
          <th>Nama PT</th>
          <th>Tahun</th>
          <th>Kategori</th>
          <th>Deskripsi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($data) > 0): ?>
          <?php foreach ($data as $row): ?>
            <tr>
              <td>
                <?php if (!empty($row['foto']) && file_exists('../assets/' . $row['foto'])): ?>
                  <img src="../assets/<?= htmlspecialchars($row['foto']) ?>" class="thumb"/>
                <?php else: ?>
                  <div class="thumb-placeholder">🏗️</div>
                <?php endif; ?>
              </td>
              <td><strong><?= htmlspecialchars($row['nama_pt']) ?></strong></td>
              <td><?= htmlspecialchars($row['tahun']) ?></td>
              <td><span class="badge-kat"><?= $kategori_label[$row['kategori']] ?? $row['kategori'] ?></span></td>
              <td style="color:var(--text-light); max-width:220px;"><?= htmlspecialchars(substr($row['deskripsi'], 0, 80)) ?>...</td>
              <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn-edit">✏️ Edit</a>
                <a href="hapus.php?id=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Yakin hapus customer ini?')">🗑️ Hapus</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr class="empty-row">
            <td colspan="6">📋 Belum ada data customer.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>