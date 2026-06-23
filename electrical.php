<?php
require_once 'koneksi.php';

$kategori   = 'electrical';
$judul      = 'Electrical Work';
$judul_gold = 'Projects';
$deskripsi  = 'Completed electrical installation and maintenance projects.';
// Ambil data dari database
$sql    = "SELECT * FROM customers WHERE kategori = '$kategori' ORDER BY tahun ASC";
$result = mysqli_query($koneksi, $sql);
$data   = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Hitung statistik
$total    = count($data);
$max_tahun = $total > 0 ? max(array_column($data, 'tahun')) : '-';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= $judul ?> Projects – PT Link Pangestu Utama</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --navy: #0a1628; --navy-mid: #0d2044; --navy-light: #132952;
      --blue: #1a4080; --blue-accent: #1e6bc4;
      --gold: #c9a84c; --gold-light: #e4c76b;
      --text-light: #8fa3c0;
    }
    body { font-family: 'Inter', sans-serif; background: var(--navy); color: #fff; line-height: 1.6; min-height: 100vh; }

    nav {
      background: rgba(10,22,40,0.96); backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(255,255,255,0.07);
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 5%; height: 70px;
    }
    .logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
    .logo-icon { width: 40px; height: 40px; background: linear-gradient(135deg, var(--blue-accent), var(--gold)); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 16px; color: white; }
    .logo-text { font-size: 15px; font-weight: 700; color: white; line-height: 1.2; }
    .logo-sub { font-size: 10px; color: var(--text-light); letter-spacing: 1.5px; text-transform: uppercase; }
    .nav-back { background: transparent; color: var(--text-light); border: 1px solid rgba(255,255,255,0.15); padding: 8px 18px; border-radius: 6px; font-size: 13px; font-weight: 600; text-decoration: none; transition: border-color 0.2s, color 0.2s; }
    .nav-back:hover { border-color: var(--gold); color: var(--gold); }
     .logo-img {
    width: 50px;
    height: 50px;
    object-fit: contain;
    border-radius: 50%; /* hapus jika logo tidak ingin bulat */
  }
    .page-wrapper { padding: 60px 5% 100px; }

    .breadcrumb-custom { display: flex; align-items: center; gap: 8px; margin-bottom: 40px; font-size: 13px; color: var(--text-light); }
    .breadcrumb-custom a { color: var(--text-light); text-decoration: none; transition: color 0.2s; }
    .breadcrumb-custom a:hover { color: var(--gold); }
    .breadcrumb-custom span { color: rgba(255,255,255,0.2); }
    .breadcrumb-custom .current { color: white; font-weight: 600; }

    .page-header { margin-bottom: 60px; }
    .page-tag { font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--gold); margin-bottom: 12px; }
    .page-title { font-size: clamp(28px, 4vw, 48px); font-weight: 800; line-height: 1.1; margin-bottom: 16px; letter-spacing: -1px; }
    .page-title span { color: var(--gold); }
    .page-desc { font-size: 16px; color: var(--text-light); line-height: 1.8; max-width: 600px; }

    .stats-bar { background: var(--navy-mid); border: 1px solid rgba(255,255,255,0.07); border-radius: 16px; padding: 28px 36px; display: flex; gap: 48px; margin-bottom: 48px; flex-wrap: wrap; }
    .stat-item { text-align: center; }
    .stat-num { font-size: 32px; font-weight: 800; color: var(--gold); line-height: 1; }
    .stat-label { font-size: 11px; color: var(--text-light); margin-top: 4px; text-transform: uppercase; letter-spacing: 0.8px; }

    .customer-card { background: var(--navy-mid); border: 1px solid rgba(255,255,255,0.07); border-radius: 16px; padding: 28px; transition: transform 0.3s, border-color 0.3s; height: 100%; position: relative; overflow: hidden; }
    .customer-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--blue-accent), var(--gold)); opacity: 0; transition: opacity 0.3s; }
    .customer-card:hover { transform: translateY(-4px); border-color: rgba(30,107,196,0.3); }
    .customer-card:hover::before { opacity: 1; }
    .customer-img { width: 100%; height: 160px; object-fit: cover; border-radius: 10px; display: block; margin-bottom: 20px; }
    .customer-img-placeholder { width: 100%; height: 160px; background: linear-gradient(135deg, var(--navy-light), var(--blue)); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 40px; margin-bottom: 20px; }
    .customer-year { font-size: 11px; font-weight: 700; color: var(--gold); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 8px; }
    .customer-name { font-size: 17px; font-weight: 700; margin-bottom: 10px; }
    .customer-desc { font-size: 13px; color: var(--text-light); line-height: 1.7; margin: 0; }

    .empty-state { text-align: center; padding: 80px 20px; color: var(--text-light); }
    .empty-state span { font-size: 60px; display: block; margin-bottom: 20px; }

    .page-footer { background: var(--navy); border-top: 1px solid rgba(255,255,255,0.07); padding: 28px 5%; text-align: center; margin-top: 80px; }
    .page-footer p { font-size: 13px; color: var(--text-light); margin: 0; }

    .btn-totop { position: fixed; bottom: 32px; right: 32px; width: 48px; height: 48px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.2); background: var(--navy-mid); color: var(--text-light); font-size: 20px; cursor: pointer; transition: border-color 0.2s, color 0.2s, transform 0.2s; display: flex; align-items: center; justify-content: center; z-index: 99; }
    .btn-totop:hover { border-color: var(--gold); color: var(--gold); transform: translateY(-3px); }
  </style>
</head>
<body>

<nav>
  <a href="index.php" class="logo">
    <img src="assets/logo.png" alt="Logo PT Link Pangestu Utama" class="logo-img">
    <div>
      <div class="logo-text">PT Link Pangestu Utama</div>
      <div class="logo-sub">Trusted Scaffolding Solutions</div>
    </div>
  </a>
  <a href="index.php#proyek" class="nav-back">← Back to Projects</a>
</nav>

<div class="page-wrapper">

  <div class="breadcrumb-custom">
    <a href="index.php">Home</a>
    <span>/</span>
    <a href="index.php#proyek">Projects</a>
    <span>/</span>
    <span class="current"><?= $judul ?></span>
  </div>

  <div class="page-header">
    <div class="page-tag">Project Category</div>
    <h1 class="page-title"><?= $judul ?> <span><?= $judul_gold ?></span></h1>
    <p class="page-desc"><?= $deskripsi ?></p>
  </div>

  <!-- Stats otomatis dari database -->
  <div class="stats-bar">
    <div class="stat-item">
      <div class="stat-num"><?= $total ?></div>
      <div class="stat-label">Completed Projects</div>
    </div>
    <div class="stat-item">
      <div class="stat-num"><?= $max_tahun ?></div>
      <div class="stat-label">Latest Project</div>
    </div>
  </div>

  <!-- Customer cards dari database -->
  <div class="row g-4">
    <?php if ($total > 0): ?>
      <?php foreach ($data as $row): ?>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="customer-card">

            <?php if (!empty($row['foto']) && file_exists('assets/' . $row['foto'])): ?>
              <img src="assets/<?= htmlspecialchars($row['foto']) ?>"
                   alt="<?= htmlspecialchars($row['nama_pt']) ?>"
                   class="customer-img"/>
            <?php else: ?>
              <div class="customer-img-placeholder">🏗️</div>
            <?php endif; ?>

            <div class="customer-year"><?= htmlspecialchars($row['tahun']) ?></div>
            <div class="customer-name"><?= htmlspecialchars($row['nama_pt']) ?></div>
            <p class="customer-desc"><?= htmlspecialchars($row['deskripsi']) ?></p>

          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="empty-state">
        <span>📋</span>
        <p>No projects listed yet for this category.</p>
      </div>
    <?php endif; ?>
  </div>

</div>

<div class="page-footer">
  <p>© 2026 PT Link Pangestu Utama. All rights reserved.</p>
</div>

<button onclick="window.scrollTo({ top: 0, behavior: 'smooth' })" class="btn-totop">↑</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($koneksi); ?>