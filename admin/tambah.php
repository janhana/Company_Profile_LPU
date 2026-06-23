<?php
session_start();
if (!isset($_SESSION['admin'])) { header('Location: login.php'); exit; }
require_once '../koneksi.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pt   = trim($_POST['nama_pt']);
    $tahun     = trim($_POST['tahun']);
    $deskripsi = trim($_POST['deskripsi']);
    $kategori  = $_POST['kategori'];
    $foto      = '';

    // Upload foto
    if (!empty($_FILES['foto']['name'])) {
        $ext       = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $allowed   = ['jpg','jpeg','png','webp'];
        if (!in_array(strtolower($ext), $allowed)) {
            $error = 'Format foto harus JPG, PNG, atau WEBP.';
        } else {
            $nama_file = time() . '_' . preg_replace('/\s+/', '_', $_FILES['foto']['name']);
            $tujuan    = '../assets/' . $nama_file;
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $tujuan)) {
                $foto = $nama_file;
            } else {
                $error = 'Gagal upload foto.';
            }
        }
    }

    if (!$error) {
        $nama_pt   = mysqli_real_escape_string($koneksi, $nama_pt);
        $tahun     = mysqli_real_escape_string($koneksi, $tahun);
        $deskripsi = mysqli_real_escape_string($koneksi, $deskripsi);
        $foto      = mysqli_real_escape_string($koneksi, $foto);

        $sql = "INSERT INTO customers (nama_pt, tahun, deskripsi, foto, kategori)
                VALUES ('$nama_pt', '$tahun', '$deskripsi', '$foto', '$kategori')";

        if (mysqli_query($koneksi, $sql)) {
            header('Location: customers.php?success=Customer berhasil ditambahkan!');
            exit;
        } else {
            $error = 'Gagal menyimpan data.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Customer – Admin</title>
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
    .page-header { margin-bottom: 32px; }
    .page-header h1 { font-size: 24px; font-weight: 800; }

    /* Form */
    .form-card { background: var(--navy-mid); border: 1px solid rgba(255,255,255,0.07); border-radius: 16px; padding: 36px; max-width: 640px; }
    .form-group { margin-bottom: 24px; }
    .form-group label { display: block; font-size: 11px; font-weight: 700; color: var(--text-light); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 8px; }
    .form-group input, .form-group select, .form-group textarea {
      width: 100%; background: var(--navy); border: 1px solid rgba(255,255,255,0.1);
      border-radius: 10px; padding: 13px 16px; font-size: 14px; color: white;
      font-family: 'Inter', sans-serif; outline: none; transition: border-color 0.2s;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: var(--blue-accent); }
    .form-group textarea { min-height: 100px; resize: vertical; }
    .form-group input::placeholder, .form-group textarea::placeholder { color: rgba(255,255,255,0.2); }
    .form-group select option { background: var(--navy-mid); }
    .form-hint { font-size: 11px; color: var(--text-light); margin-top: 6px; }
    .btn-simpan { background: linear-gradient(135deg, var(--blue-accent), #1a5faa); color: white; border: none; border-radius: 10px; padding: 13px 32px; font-size: 14px; font-weight: 700; cursor: pointer; font-family: 'Inter', sans-serif; transition: opacity 0.2s; }
    .btn-simpan:hover { opacity: 0.85; }
    .btn-batal { background: transparent; color: var(--text-light); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 13px 24px; font-size: 14px; font-weight: 600; cursor: pointer; font-family: 'Inter', sans-serif; text-decoration: none; margin-left: 12px; transition: border-color 0.2s; display: inline-block; }
    .btn-batal:hover { border-color: var(--gold); color: var(--gold); }
    .error-msg { background: rgba(220,53,69,0.15); border: 1px solid rgba(220,53,69,0.3); border-radius: 8px; padding: 12px 16px; font-size: 13px; color: #ff6b7a; margin-bottom: 20px; }

    /* Preview foto */
    #preview-wrap { margin-top: 12px; display: none; }
    #preview-img { width: 120px; height: 96px; object-fit: cover; border-radius: 10px; border: 1px solid rgba(255,255,255,0.1); }
  .logo-img {
    width: 50px;
    height: 50px;
    object-fit: contain;
    border-radius: 50%; /* hapus jika logo tidak ingin bulat */
  }
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
    <a href="customers.php" class="menu-item">👥 Kelola Customer</a>
    <div class="menu-label">Website</div>
    <a href="../index.php" class="menu-item" target="_blank">🌐 Lihat Website</a>
  </nav>
  <div class="sidebar-footer">
    <a href="logout.php" class="btn-logout">🚪 Logout</a>
  </div>
</div>

<div class="main">
  <div class="page-header">
    <h1>➕ Tambah Customer</h1>
  </div>

  <?php if ($error): ?>
    <div class="error-msg">⚠️ <?= $error ?></div>
  <?php endif; ?>

  <div class="form-card">
    <form method="POST" enctype="multipart/form-data">

      <div class="form-group">
        <label>Nama PT / Customer *</label>
        <input type="text" name="nama_pt" placeholder="contoh: PT Surya Teknologi" required value="<?= isset($_POST['nama_pt']) ? htmlspecialchars($_POST['nama_pt']) : '' ?>"/>
      </div>

      <div class="form-group">
        <label>Tahun *</label>
        <input type="text" name="tahun" placeholder="contoh: 2023 atau 2022-2023" required value="<?= isset($_POST['tahun']) ? htmlspecialchars($_POST['tahun']) : '' ?>"/>
      </div>

      <div class="form-group">
        <label>Kategori Jasa *</label>
        <select name="kategori" required>
          <option value="" disabled selected>Pilih kategori...</option>
          <option value="civil"       <?= (isset($_POST['kategori']) && $_POST['kategori']==='civil')       ? 'selected' : '' ?>>Civil Work</option>
          <option value="electrical"  <?= (isset($_POST['kategori']) && $_POST['kategori']==='electrical')  ? 'selected' : '' ?>>Electrical Work</option>
          <option value="conveyor"    <?= (isset($_POST['kategori']) && $_POST['kategori']==='conveyor')    ? 'selected' : '' ?>>Conveyor Line</option>
          <option value="renovation"  <?= (isset($_POST['kategori']) && $_POST['kategori']==='renovation')  ? 'selected' : '' ?>>Office Renovation</option>
          <option value="scaffolding" <?= (isset($_POST['kategori']) && $_POST['kategori']==='scaffolding') ? 'selected' : '' ?>>Scaffolding</option>
          <option value="others"      <?= (isset($_POST['kategori']) && $_POST['kategori']==='others')      ? 'selected' : '' ?>>Other Works</option>
        </select>
      </div>

      <div class="form-group">
        <label>Deskripsi Pekerjaan</label>
        <textarea name="deskripsi" placeholder="Jelaskan pekerjaan yang dilakukan untuk customer ini..."><?= isset($_POST['deskripsi']) ? htmlspecialchars($_POST['deskripsi']) : '' ?></textarea>
      </div>

      <div class="form-group">
        <label>Foto Proyek</label>
        <input type="file" name="foto" accept="image/*" onchange="previewFoto(this)"/>
        <p class="form-hint">Format: JPG, PNG, WEBP. Foto akan tersimpan di folder assets/.</p>
        <div id="preview-wrap">
          <img id="preview-img" src="" alt="Preview"/>
        </div>
      </div>

      <div style="margin-top:8px;">
        <button type="submit" class="btn-simpan">💾 Simpan Customer</button>
        <a href="customers.php" class="btn-batal">Batal</a>
      </div>

    </form>
  </div>
</div>

<script>
function previewFoto(input) {
  const wrap = document.getElementById('preview-wrap');
  const img  = document.getElementById('preview-img');
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => { img.src = e.target.result; wrap.style.display = 'block'; };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
</body>
</html>