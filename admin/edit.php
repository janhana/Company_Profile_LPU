<?php
session_start();
if (!isset($_SESSION['admin'])) { header('Location: login.php'); exit; }
require_once '../koneksi.php';

$id = intval($_GET['id'] ?? 0);
if (!$id) { header('Location: customers.php'); exit; }

// Ambil data existing
$result = mysqli_query($koneksi, "SELECT * FROM customers WHERE id=$id");
$row    = mysqli_fetch_assoc($result);
if (!$row) { header('Location: customers.php'); exit; }

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pt   = mysqli_real_escape_string($koneksi, trim($_POST['nama_pt']));
    $tahun     = mysqli_real_escape_string($koneksi, trim($_POST['tahun']));
    $deskripsi = mysqli_real_escape_string($koneksi, trim($_POST['deskripsi']));
    $kategori  = $_POST['kategori'];
    $foto      = $row['foto']; // default pakai foto lama

    // Kalau ada upload foto baru
    if (!empty($_FILES['foto']['name'])) {
        $ext     = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg','jpeg','png','webp'];
        if (!in_array(strtolower($ext), $allowed)) {
            $error = 'Format foto harus JPG, PNG, atau WEBP.';
        } else {
            $nama_file = time() . '_' . preg_replace('/\s+/', '_', $_FILES['foto']['name']);
            $tujuan    = '../assets/' . $nama_file;
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $tujuan)) {
                // Hapus foto lama kalau ada
                if (!empty($row['foto']) && file_exists('../assets/' . $row['foto'])) {
                    unlink('../assets/' . $row['foto']);
                }
                $foto = $nama_file;
            } else {
                $error = 'Gagal upload foto baru.';
            }
        }
    }

    if (!$error) {
        $sql = "UPDATE customers SET
                    nama_pt='$nama_pt', tahun='$tahun',
                    deskripsi='$deskripsi', foto='$foto', kategori='$kategori'
                WHERE id=$id";
        if (mysqli_query($koneksi, $sql)) {
            header('Location: customers.php?success=Customer berhasil diupdate!');
            exit;
        } else {
            $error = 'Gagal menyimpan perubahan.';
        }
    }
}

$kategori_label = ['civil'=>'Civil Work','electrical'=>'Electrical Work','conveyor'=>'Conveyor Line','renovation'=>'Office Renovation','scaffolding'=>'Scaffolding','others'=>'Other Works'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Customer – Admin</title>
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
    .form-card { background: var(--navy-mid); border: 1px solid rgba(255,255,255,0.07); border-radius: 16px; padding: 36px; max-width: 640px; }
    .form-group { margin-bottom: 24px; }
    .form-group label { display: block; font-size: 11px; font-weight: 700; color: var(--text-light); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 8px; }
    .form-group input, .form-group select, .form-group textarea { width: 100%; background: var(--navy); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 13px 16px; font-size: 14px; color: white; font-family: 'Inter', sans-serif; outline: none; transition: border-color 0.2s; }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: var(--blue-accent); }
    .form-group textarea { min-height: 100px; resize: vertical; }
    .form-group input::placeholder, .form-group textarea::placeholder { color: rgba(255,255,255,0.2); }
    .form-group select option { background: var(--navy-mid); }
    .form-hint { font-size: 11px; color: var(--text-light); margin-top: 6px; }
    .btn-simpan { background: linear-gradient(135deg, var(--blue-accent), #1a5faa); color: white; border: none; border-radius: 10px; padding: 13px 32px; font-size: 14px; font-weight: 700; cursor: pointer; font-family: 'Inter', sans-serif; }
    .btn-simpan:hover { opacity: 0.85; }
    .btn-batal { background: transparent; color: var(--text-light); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 13px 24px; font-size: 14px; font-weight: 600; text-decoration: none; margin-left: 12px; display: inline-block; }
    .btn-batal:hover { border-color: var(--gold); color: var(--gold); }
    .error-msg { background: rgba(220,53,69,0.15); border: 1px solid rgba(220,53,69,0.3); border-radius: 8px; padding: 12px 16px; font-size: 13px; color: #ff6b7a; margin-bottom: 20px; }
    .foto-existing { display: flex; align-items: center; gap: 12px; margin-top: 10px; }
    .foto-existing img { width: 80px; height: 64px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); }
    .foto-existing span { font-size: 12px; color: var(--text-light); }
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
    <a href="customers.php" class="menu-item active">👥 Kelola Customer</a>
    <a href="tambah.php" class="menu-item">➕ Tambah Customer</a>
    <div class="menu-label">Website</div>
    <a href="../index.php" class="menu-item" target="_blank">🌐 Lihat Website</a>
  </nav>
  <div class="sidebar-footer">
    <a href="logout.php" class="btn-logout">🚪 Logout</a>
  </div>
</div>

<div class="main">
  <div class="page-header">
    <h1>✏️ Edit Customer</h1>
  </div>

  <?php if ($error): ?>
    <div class="error-msg">⚠️ <?= $error ?></div>
  <?php endif; ?>

  <div class="form-card">
    <form method="POST" enctype="multipart/form-data">

      <div class="form-group">
        <label>Nama PT / Customer *</label>
        <input type="text" name="nama_pt" required value="<?= htmlspecialchars($row['nama_pt']) ?>"/>
      </div>

      <div class="form-group">
        <label>Tahun *</label>
        <input type="text" name="tahun" required value="<?= htmlspecialchars($row['tahun']) ?>"/>
      </div>

      <div class="form-group">
        <label>Kategori Jasa *</label>
        <select name="kategori" required>
          <?php foreach ($kategori_label as $key => $label): ?>
            <option value="<?= $key ?>" <?= $row['kategori'] === $key ? 'selected' : '' ?>><?= $label ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Deskripsi Pekerjaan</label>
        <textarea name="deskripsi"><?= htmlspecialchars($row['deskripsi']) ?></textarea>
      </div>

      <div class="form-group">
        <label>Foto Proyek</label>
        <?php if (!empty($row['foto']) && file_exists('../assets/' . $row['foto'])): ?>
          <div class="foto-existing">
            <img src="../assets/<?= htmlspecialchars($row['foto']) ?>" alt="Foto saat ini"/>
            <span>Foto saat ini. Upload baru untuk mengganti.</span>
          </div>
        <?php endif; ?>
        <input type="file" name="foto" accept="image/*" style="margin-top:10px;"/>
        <p class="form-hint">Kosongkan jika tidak ingin mengganti foto.</p>
      </div>

      <div style="margin-top:8px;">
        <button type="submit" class="btn-simpan">💾 Simpan Perubahan</button>
        <a href="customers.php" class="btn-batal">Batal</a>
      </div>

    </form>
  </div>
</div>

</body>
</html>