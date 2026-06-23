<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>PT Link Pangestu Utama</title>
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
    html { scroll-behavior: smooth; }
    body { font-family: 'Inter', sans-serif; background: var(--navy); color: #fff; line-height: 1.6; }

    /* ===== NAVBAR ===== */
    nav {
      position: fixed; top: 0; left: 0; right: 0; z-index: 100;
      background: rgba(10,22,40,0.96); backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(255,255,255,0.07);
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 5%; height: 70px;
    }
    .logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
    .logo-icon { width: 40px; height: 40px; background: linear-gradient(135deg, var(--blue-accent), var(--gold)); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 16px; color: white; }
    .logo-text { font-size: 15px; font-weight: 700; color: white; line-height: 1.2; }
    .logo-sub { font-size: 10px; color: var(--text-light); letter-spacing: 1.5px; text-transform: uppercase; }
    .nav-links { display: flex; gap: 32px; list-style: none; margin: 0; padding: 0; }
    .nav-links a { text-decoration: none; color: var(--text-light); font-size: 13px; font-weight: 500; transition: color 0.2s; }
    .nav-links a:hover { color: var(--gold); }
    .nav-cta { background: linear-gradient(135deg, var(--blue-accent), #1a5faa); color: white; padding: 9px 22px; border-radius: 6px; font-size: 13px; font-weight: 600; text-decoration: none; }
    .logo-img {
      width: 50px;
      height: 50px;
      object-fit: contain;
      border-radius: 50%; /* hapus jika logo tidak ingin bulat */
    }
    /* ===== HERO ===== */
    #hero { min-height: 100vh; display: flex; align-items: center; position: relative; overflow: hidden; padding: 100px 5% 60px; }
    .hero-bg { position: absolute; inset: 0; background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 50%, var(--blue) 100%); }
    .hero-grid { position: absolute; inset: 0; background-image: linear-gradient(rgba(30,107,196,0.07) 1px, transparent 1px), linear-gradient(90deg, rgba(30,107,196,0.07) 1px, transparent 1px); background-size: 50px 50px; }
    .hero-glow { position: absolute; width: 600px; height: 600px; background: radial-gradient(circle, rgba(30,107,196,0.15) 0%, transparent 70%); top: -100px; right: -100px; pointer-events: none; }
    .hero-inner { position: relative; width: 100%; }
    .hero-badge { display: inline-flex; align-items: center; gap: 8px; background: rgba(201,168,76,0.12); border: 1px solid rgba(201,168,76,0.3); padding: 6px 16px; border-radius: 30px; font-size: 12px; font-weight: 600; color: var(--gold); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 28px; }
    .hero-inner h1 { font-size: clamp(30px, 4vw, 54px); font-weight: 800; line-height: 1.1; margin-bottom: 24px; letter-spacing: -1px; }
    .hero-inner h1 span { color: var(--gold); }
    .hero-desc { font-size: 16px; color: var(--text-light); margin-bottom: 40px; line-height: 1.8; }
    .hero-stats { display: flex; gap: 48px; margin-top: 48px; padding-top: 36px; border-top: 1px solid rgba(255,255,255,0.08); }
    .stat-num { font-size: 36px; font-weight: 800; color: var(--gold); line-height: 1; }
    .stat-label { font-size: 12px; color: var(--text-light); margin-top: 6px; text-transform: uppercase; letter-spacing: 0.8px; }
    .hero-photo-main { width: 100%; height: 420px; border-radius: 20px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 30px 80px rgba(0,0,0,0.4); }
    .hero-photo-main img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .hero-photo-secondary { position: absolute; bottom: -24px; left: -24px; width: 160px; height: 130px; border-radius: 14px; overflow: hidden; border: 3px solid var(--navy-mid); box-shadow: 0 10px 30px rgba(0,0,0,0.4); z-index: 2; }
    .hero-photo-secondary img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .photo-placeholder { width: 100%; height: 100%; background: linear-gradient(135deg, var(--navy-light), var(--blue)); display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 10px; color: var(--text-light); font-size: 12px; text-align: center; }
    .photo-placeholder span { font-size: 48px; }

    /* Buttons */
    .btn-primary-custom { background: linear-gradient(135deg, var(--blue-accent), #1a5faa); color: white; padding: 14px 32px; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: transform 0.2s, box-shadow 0.2s; box-shadow: 0 4px 20px rgba(30,107,196,0.35); border: none; }
    .btn-primary-custom:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(30,107,196,0.5); color: white; }
    .btn-secondary-custom { background: transparent; color: white; padding: 14px 32px; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none; border: 1px solid rgba(255,255,255,0.2); display: inline-flex; align-items: center; gap: 8px; transition: border-color 0.2s; }
    .btn-secondary-custom:hover { border-color: var(--gold); color: white; }

    /* ===== SECTIONS ===== */
    section { padding: 100px 5%; }
    .section-tag { font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--gold); margin-bottom: 12px; }
    .section-title { font-size: clamp(26px, 3.5vw, 40px); font-weight: 800; line-height: 1.2; margin-bottom: 16px; }
    .section-desc { font-size: 16px; color: var(--text-light); line-height: 1.8; }
    .section-header { margin-bottom: 60px; }

    /* ===== ABOUT ===== */
    #about { background: var(--navy-mid); }
    .about-visual { position: relative; padding-bottom: 40px; padding-right: 40px; }
    .about-photo-main { width: 100%; height: 700px; border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.08); box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
    .about-photo-main img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .about-photo-main .photo-placeholder span { font-size: 64px; }
    .about-badge-float { position: absolute; bottom: 0; right: 0; background: linear-gradient(135deg, var(--gold), var(--gold-light)); color: var(--navy); padding: 16px 24px; border-radius: 12px; font-weight: 800; text-align: center; box-shadow: 0 8px 30px rgba(201,168,76,0.3); }
    .about-badge-float .num { font-size: 28px; line-height: 1; }
    .about-badge-float .lbl { font-size: 11px; margin-top: 2px; }
    .about-text .section-desc { max-width: 100%; margin-bottom: 16px; font-size: 14px; }
    .about-points { list-style: none; margin-top: 24px; padding: 0; }
    .about-points li { display: flex; align-items: flex-start; gap: 12px; padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,0.06); font-size: 14px; color: var(--text-light); }
    .about-points li:last-child { border-bottom: none; }
    .check { background: rgba(30,107,196,0.2); color: var(--blue-accent); width: 22px; height: 22px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; flex-shrink: 0; margin-top: 1px; }

    /* ===== SERVICES ===== */
    #layanan { background: var(--navy); }
    .layanan-flex { display: flex; flex-wrap: wrap; gap: 24px; justify-content: center; }
    .layanan-card { background: var(--navy-mid); border: 1px solid rgba(255,255,255,0.07); border-radius: 16px; overflow: hidden; transition: transform 0.3s, box-shadow 0.3s; position: relative; width: calc(33.333% - 16px); min-width: 280px; display: flex; flex-direction: column; }
    .layanan-card::after { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--blue-accent), var(--gold)); opacity: 0; transition: opacity 0.3s; }
    .layanan-card:hover { transform: translateY(-6px); box-shadow: 0 20px 50px rgba(0,0,0,0.3); }
    .layanan-card:hover::after { opacity: 1; }
    .layanan-card-img { height: 180px; overflow: hidden; position: relative; flex-shrink: 0; }
    .layanan-card-img img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.4s ease; }
    .layanan-card:hover .layanan-card-img img { transform: scale(1.05); }
    .layanan-card-img .photo-placeholder { font-size: 12px; }
    .layanan-card-img .photo-placeholder span { font-size: 52px; }
    .layanan-card-body { padding: 28px; flex: 1; }
    .layanan-card-body h3 { font-size: 18px; font-weight: 700; margin-bottom: 14px; }
    .layanan-card-body ul { list-style: none; padding: 0; margin: 0; }
    .layanan-card-body ul li { font-size: 13px; color: var(--text-light); line-height: 1.7; padding: 3px 0 3px 14px; position: relative; }
    .layanan-card-body ul li::before { content: '–'; position: absolute; left: 0; color: var(--gold); }

    /* ===== ADVANTAGES ===== */
    #keunggulan { background: var(--navy-mid); }
    .keunggulan-card { text-align: center; padding: 36px 20px; background: var(--navy); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; transition: transform 0.3s; height: 100%; }
    .keunggulan-card:hover { transform: translateY(-4px); }
    .keunggulan-icon { width: 64px; height: 64px; background: linear-gradient(135deg, rgba(30,107,196,0.2), rgba(201,168,76,0.1)); border: 1px solid rgba(30,107,196,0.3); border-radius: 16px; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; font-size: 28px; }
    .keunggulan-card h3 { font-size: 15px; font-weight: 700; margin-bottom: 10px; }
    .keunggulan-card p { font-size: 13px; color: var(--text-light); line-height: 1.6; margin: 0; }

    /* ===== PROJECTS ===== */
    #proyek { background: var(--navy); }
    .proyek-card { background: var(--navy-mid); border: 1px solid rgba(255,255,255,0.07); border-radius: 16px; overflow: hidden; transition: transform 0.3s; height: 100%; }
    .proyek-card:hover { transform: translateY(-4px); }
    .proyek-img { height: 200px; overflow: hidden; position: relative; }
    .proyek-img img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.4s ease; }
    .proyek-card:hover .proyek-img img { transform: scale(1.05); }
    .proyek-img .photo-placeholder { width: 100%; height: 100%; background: linear-gradient(135deg, var(--navy-light), var(--blue)); display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; font-size: 12px; color: var(--text-light); }
    .proyek-img .photo-placeholder span { font-size: 52px; }
    .proyek-body { padding: 24px; }
    .proyek-tag { font-size: 11px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; color: var(--gold); margin-bottom: 8px; }
    .proyek-body h3 { font-size: 16px; font-weight: 700; margin-bottom: 8px; }
    .proyek-body p { font-size: 13px; color: var(--text-light); line-height: 1.6; margin: 0; }

    /* ===== GALLERY ===== */
    #gallery { background: var(--navy-mid); }
    .gallery-grid { display: grid; grid-template-columns: repeat(4, 1fr); grid-auto-rows: 220px; gap: 12px; }
    .gallery-item.big { grid-column: span 2; grid-row: span 2; }
    .gallery-item.wide { grid-column: span 2; }
    .gallery-item { border-radius: 12px; overflow: hidden; position: relative; cursor: pointer; }
    .gallery-item img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.4s ease; }
    .gallery-item:hover img { transform: scale(1.07); }
    .gallery-item .photo-placeholder { width: 100%; height: 100%; background: linear-gradient(135deg, var(--navy-light), var(--blue)); display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; font-size: 12px; color: var(--text-light); }
    .gallery-item .photo-placeholder span { font-size: 36px; }
    .gallery-overlay { position: absolute; inset: 0; background: rgba(10,22,40,0.55); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s; }
    .gallery-item:hover .gallery-overlay { opacity: 1; }
    .gallery-overlay span { font-size: 28px; color: white; background: rgba(255,255,255,0.15); border-radius: 50%; width: 52px; height: 52px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(4px); }

    /* Lightbox */
    .lightbox { display: none; position: fixed; inset: 0; z-index: 999; background: rgba(5,10,20,0.95); align-items: center; justify-content: center; }
    .lightbox.active { display: flex; }
    .lightbox img { max-width: 90vw; max-height: 85vh; border-radius: 12px; box-shadow: 0 30px 80px rgba(0,0,0,0.6); object-fit: contain; }
    .lightbox-close { position: absolute; top: 24px; right: 28px; font-size: 20px; color: white; cursor: pointer; background: rgba(255,255,255,0.1); border: none; width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: background 0.2s; }
    .lightbox-close:hover { background: rgba(255,255,255,0.2); }
    .lightbox-nav { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.1); border: none; color: white; font-size: 22px; cursor: pointer; width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: background 0.2s; }
    .lightbox-nav:hover { background: rgba(255,255,255,0.25); }
    .lightbox-prev { left: 20px; }
    .lightbox-next { right: 20px; }
    .lightbox-caption { position: absolute; bottom: 24px; color: rgba(255,255,255,0.6); font-size: 13px; text-align: center; left: 0; right: 0; }

    /* ===== CONTACT ===== */
    #kontak { background: var(--navy); }
    .kontak-item { display: flex; gap: 16px; margin-bottom: 32px; }
    .kontak-ico { width: 48px; height: 48px; background: rgba(30,107,196,0.15); border: 1px solid rgba(30,107,196,0.3); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
    .kontak-detail h4 { font-size: 13px; font-weight: 600; color: var(--gold); margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.8px; }
    .kontak-detail p { font-size: 15px; color: var(--text-light); line-height: 1.6; margin: 0; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-size: 12px; font-weight: 600; color: var(--text-light); letter-spacing: 0.8px; text-transform: uppercase; margin-bottom: 8px; }
    .form-group input, .form-group textarea { width: 100%; background: var(--navy-mid); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 14px 18px; font-size: 14px; color: white; font-family: 'Inter', sans-serif; outline: none; transition: border-color 0.2s; }
    .form-group input:focus, .form-group textarea:focus { border-color: var(--blue-accent); }
    .form-group textarea { resize: vertical; min-height: 100px; }
    .form-group input::placeholder, .form-group textarea::placeholder { color: rgba(255,255,255,0.2); }

    /* ===== FOOTER ===== */
    footer { background: var(--navy); border-top: 1px solid rgba(255,255,255,0.07); padding: 36px 5%; }
    .footer-copy { font-size: 13px; color: var(--text-light); }
    .footer-links a { font-size: 13px; color: var(--text-light); text-decoration: none; transition: color 0.2s; }
    .footer-links a:hover { color: var(--gold); }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
      .layanan-card { width: calc(50% - 12px); }
      .hero-photo-col { display: none; }
      .gallery-grid { grid-template-columns: repeat(2, 1fr); grid-auto-rows: 160px; }
      .gallery-item.big { grid-column: span 2; grid-row: span 1; }
      .gallery-item.wide { grid-column: span 2; }
    }
    @media (max-width: 600px) {
      .layanan-card { width: 100%; }
      .hero-stats { flex-wrap: wrap; gap: 24px; }
      section { padding: 70px 4%; }
      .gallery-grid { grid-template-columns: 1fr 1fr; grid-auto-rows: 130px; }
    }

    /* ===== JASA CARDS ===== */
    .jasa-card-link { text-decoration: none; display: block; height: 100%; }
      .jasa-card {
  background: var(--navy-mid);
  border: 1px solid rgba(255,255,255,0.07);
  border-radius: 16px;
  padding: 40px 24px;
  text-align: center;
  cursor: pointer;
  transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
  height: 100%;
}
.jasa-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 50px rgba(0,0,0,0.3);
  border-color: rgba(30,107,196,0.4);
}
.jasa-icon { font-size: 48px; margin-bottom: 16px; }
.jasa-card h3 { font-size: 17px; font-weight: 700; margin-bottom: 8px; color: white; }
.jasa-card p { font-size: 13px; color: var(--gold); margin: 0; }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav>
  <a href="#hero" class="logo">
       <img src="assets/logo.png" alt="Logo PT Link Pangestu Utama" class="logo-img">
    <div>
      <div class="logo-text">PT Link Pangestu Utama</div>
      <div class="logo-sub">Trusted Scaffolding Solutions</div>
    </div>
  </a>
 <ul class="nav-links d-flex flex-wrap">
    <li><a href="#about">About Us</a></li>
    <li><a href="#layanan">Products & Services</a></li>
    <li><a href="#keunggulan">Advantages</a></li>
    <li><a href="#proyek">Projects</a></li>
    <li><a href="#gallery">Gallery</a></li>
   <!-- <li><a href="#kontak">Contact</a></li> -->
  </ul>
  <a href="#kontak" class="nav-cta">Contact Us</a>
</nav>

<!-- HERO -->
<section id="hero">
  <div class="hero-bg"></div>
  <div class="hero-grid"></div>
  <div class="hero-glow"></div>
  <div class="hero-inner">
    <div class="container-fluid px-0">
      <div class="row align-items-center g-5">
        <div class="col-lg-6">
          <div class="hero-badge">&#9679; Trusted Since 2004</div>
          <h1>Professional <span>Scaffolding</span> Rental Solutions for Your Project</h1>
          <p class="hero-desc">PT Link Pangestu Utama provides high-quality scaffolding rental services for construction, industrial, and renovation projects across Batam, Bintan, and beyond.</p>
          <div class="d-flex gap-3 flex-wrap">
            <a href="#layanan" class="btn-primary-custom">View Services ↓</a>
          </div>
          <div class="hero-stats">
            <div><div class="stat-num">20+</div><div class="stat-label">Years of Experience</div></div>
            <div><div class="stat-num">20+</div><div class="stat-label">Projects Completed</div></div>
          </div>
        </div>
        <div class="col-lg-6 hero-photo-col">
          <div class="position-relative" style="padding-bottom:30px;">
            <!-- ✏️ Ganti src dengan foto Anda -->
            <div class="hero-photo-main">
              <img src="assets/bikin gudang.jpg" alt="Scaffolding Project"
                   onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
              <div class="photo-placeholder" style="display:none"><span>🏗️</span>Foto Hero Utama</div>
            </div>
            <div class="hero-photo-secondary">
              <img src="assets/alat berat.jpg" alt="Our Team"
                   onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
              <div class="photo-placeholder" style="display:none; font-size:11px;"><span style="font-size:28px">👷</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ABOUT -->
<section id="about">
  <div class="container-fluid px-0">
    <div class="row align-items-center g-5">
      <div class="col-lg-5">
        <div class="about-visual">
          <!-- ✏️ Ganti src dengan foto Anda -->
          <div class="about-photo-main">
            <img src="assets/index1.jpg" alt="PT Link Pangestu Utama"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
            <div class="photo-placeholder" style="display:none"><span style="font-size:64px">🏗️</span>Foto Kantor / Tim</div>
          </div>
          <div class="about-badge-float">
            <div class="num">ISO</div>
            <div class="lbl">9001:2015 & 45001:2018 Certified</div>
          </div>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="about-text">
          <div class="section-tag">About Us</div>
          <h2 class="section-title">Experienced in the Scaffolding Industry</h2>
          <p class="section-desc">PT. Link Pangestu Utama was established in 2004 majoring in renovation, building contractor, ME, general trading, sale and rental of scaffolding.
            Based on experience and performance, we undertake mainly factory renovation works in Pulau Batam and Pulau Bintan. The company has good relationship with Batamindo Industrial Park (Muka Kuning) and several offshore company in Batam and also Bintan Inti Indutrial Estate.</p>
          <p class="section-desc mt-3">The company has the capability to deliver renovation works in masonry & electrical, air-conditioning, interior design, civil engineering works, and installation of certain specialized equipment like water purification system, gas supply system.</p>
          <p class="section-desc mt-3">Our corporate offers high standards and professional works as well as timely completion of works which is essential to many valued customer’s desire to commence factory operations on schedule.
            With a year on year increase of turnover and profits, and with the cooperation and trusts given by our satisfied clients.</p>
            <p class="section-desc mt-3"> PT. LINK PANGESTU UTAMA’s mission is to deliver better service both new and existing customers.</p>
          <ul class="about-points">
            <li><span class="check">✓</span> Scaffolding materials meeting SNI and international standards</li>
            <li><span class="check">✓</span> Certified scaffolding safety (K3) experts</li>
            <li><span class="check">✓</span> Serving projects from small scale to large-scale developments</li>
            <li><span class="check">✓</span> Capable in masonry, electrical, AC, interior design & civil engineering</li>
            <li><span class="check">✓</span> Free technical consultation services</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section id="layanan">
  <div class="section-header">
    <div class="section-tag">Products & Services</div>
    <h2 class="section-title">Complete Construction Solutions</h2>
    <p class="section-desc">A range of services tailored to your project needs — from civil works to scaffolding rental.</p>
  </div>
  <div class="layanan-flex">

    <!-- ✏️ Ganti src tiap kartu dengan foto layanan Anda -->

    <div class="layanan-card">
      <div class="layanan-card-img">
        <img src="assets/civil work.jpg" alt="Civil Work"
             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
        <div class="photo-placeholder" style="display:none"><span>🔧</span></div>
      </div>
      <div class="layanan-card-body">
        <h3>Civil Work</h3>
        <ul>
          <li>Land cut and fill and land reclaim</li>
          <li>Road construction and repair</li>
          <li>Drainage construction</li>
          <li>Workshop fabrication</li>
          <li>Concrete slab</li>
          <li>Jetty construction and dredging</li>
          <li>Warehouse extension and modification</li>
          <li>Racking / storage system</li>
          <li>Material supply (steel plate, bolts & nuts, wood & timber, adhesives, etc.)</li>
        </ul>
      </div>
    </div>

    <div class="layanan-card">
      <div class="layanan-card-img">
        <img src="assets/elektrik.jpg" alt="Electrical Work"
             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
        <div class="photo-placeholder" style="display:none"><span>⚡</span></div>
      </div>
      <div class="layanan-card-body">
        <h3>Electrical Work</h3>
        <ul>
          <li>Layout design for electrical system</li>
          <li>Supply & installation of lighting system</li>
          <li>Smoke and heat detector system</li>
          <li>CCTV security system & security alarm</li>
          <li>Maintenance, reparation & modification</li>
          <li>Electrical knowledge and advice for clients</li>
        </ul>
      </div>
    </div>

    <div class="layanan-card">
      <div class="layanan-card-img">
        <img src="assets/alat berat.jpg" alt="Conveyor Line"
             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
        <div class="photo-placeholder" style="display:none"><span>⚙️</span></div>
      </div>
      <div class="layanan-card-body">
        <h3>Conveyor Line</h3>
        <ul>
          <li>Flat belt & chain conveyor</li>
          <li>Butter conveyor</li>
          <li>Working table</li>
          <li>ESD belt (PVC & PV)</li>
        </ul>
      </div>
    </div>

    <div class="layanan-card">
      <div class="layanan-card-img">
        <img src="assets/renovasi3.jpg" alt="Office Renovation"
             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
        <div class="photo-placeholder" style="display:none"><span>🏢</span></div>
      </div>
      <div class="layanan-card-body">
        <h3>Office Renovation</h3>
        <ul>
          <li>Partition & ceiling works</li>
          <li>Door supply & installation (aluminum, plywood, etc.)</li>
          <li>Vinyl & flooring</li>
          <li>Air conditioner supply, installation & maintenance</li>
          <li>Ducting & exhaust system</li>
          <li>Window supply & installation</li>
          <li>Office layout & interior design</li>
          <li>Painting & wallpaper installation</li>
          <li>Office furniture supply & maintenance</li>
        </ul>
      </div>
    </div>

    <div class="layanan-card">
      <div class="layanan-card-img">
        <img src="assets/scaffolding.jpg" alt="Scaffolding"
             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
        <div class="photo-placeholder" style="display:none"><span>🏗️</span></div>
      </div>
      <div class="layanan-card-body">
        <h3>Scaffolding</h3>
        <ul>
          <li>Japan International Standard & British Standard (Tube and Coupler System)</li>
          <li>Frame Scaffolding</li>
          <li>Sale and rental of scaffolding material</li>
          <li>Skilled scaffolders with certification from accredited authority</li>
        </ul>
      </div>
    </div>

  </div>
</section>

<!-- ADVANTAGES -->
<section id="keunggulan">
  <div class="section-header">
    <div class="section-tag">Why Choose Us</div>
    <h2 class="section-title">Advantages of PT Link Pangestu Utama</h2>
    <p class="section-desc">The trust of hundreds of clients is proof of our commitment to quality and safety.</p>
  </div>
  <div class="row g-4">
    <div class="col-6 col-lg-3">
      <div class="keunggulan-card">
        <div class="keunggulan-icon">🛡️</div>
        <h3>High Safety Standards</h3>
        <p>All operations follow national and international K3 safety standards, aiming for zero accidents on every project.</p>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="keunggulan-card">
        <div class="keunggulan-icon">💎</div>
        <h3>Quality Materials</h3>
        <p>High-grade steel scaffolding meeting SNI standards, regularly inspected to ensure reliability on every site.</p>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="keunggulan-card">
        <div class="keunggulan-icon">⚡</div>
        <h3>Fast Response</h3>
        <p>Our team is ready to respond to requests within 24 hours with express delivery to your project location.</p>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="keunggulan-card">
        <div class="keunggulan-icon">💰</div>
        <h3>Competitive Pricing</h3>
        <p>Best-value pricing without compromising quality, with flexible rental schemes suited to your project timeline.</p>
      </div>
    </div>
  </div>
</section>

<!-- PROJECTS -->
<section id="proyek">
  <div class="section-header">
    <div class="section-tag">Project</div>
    <h2 class="section-title">Projects We Have Completed</h2>
    <p class="section-desc">Select a service category to view our completed projects.</p>
  </div>
  <div class="row g-4">
    <div class="col-6 col-md-4">
      <a href="civil.php" class="jasa-card-link">
        <div class="jasa-card">
          <div class="jasa-icon">🔧</div>
          <h3>Civil Work</h3>
          <p>View completed projects →</p>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-4">
      <a href="electrical.php" class="jasa-card-link">
        <div class="jasa-card">
          <div class="jasa-icon">⚡</div>
          <h3>Electrical Work</h3>
          <p>View completed projects →</p>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-4">
      <a href="conveyor.php" class="jasa-card-link">
        <div class="jasa-card">
          <div class="jasa-icon">⚙️</div>
          <h3>Conveyor Line</h3>
          <p>View completed projects →</p>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-4">
      <a href="renovation.php" class="jasa-card-link">
        <div class="jasa-card">
          <div class="jasa-icon">🏢</div>
          <h3>Office Renovation</h3>
          <p>View completed projects →</p>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-4">
      <a href="scaffolding.php" class="jasa-card-link">
        <div class="jasa-card">
          <div class="jasa-icon">🏗️</div>
          <h3>Scaffolding</h3>
          <p>View completed projects →</p>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-4">
      <a href="others.php" class="jasa-card-link">
        <div class="jasa-card">
          <div class="jasa-icon">📋</div>
          <h3>Other Works</h3>
          <p>View completed projects →</p>
        </div>
      </a>
    </div>
  </div>
</section>

<!-- GALLERY -->
<section id="gallery">
  <div class="section-header">
    <div class="section-tag">Our Work</div>
    <h2 class="section-title">Project Gallery</h2>
    <p class="section-desc">A glimpse of our work across various projects. Click on any image to view full size.</p>
  </div>

  <!-- ✏️ Ganti src setiap gambar dengan foto Anda -->
  <!-- Class: (kosong)=normal | "wide"=lebar 2 kolom | "big"=besar 2x2 -->
  <!-- Mau tambah foto? Duplikat salah satu div gallery-item -->

  <div class="gallery-grid">

    <div class="gallery-item big" onclick="openLightbox(0)">
      <img src="assets/galeri1.jpg" alt="Gallery 1"
           onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
      <div class="photo-placeholder"><span>📸</span>gallery-1.jpg</div>
      <div class="gallery-overlay"><span>🔍</span></div>
    </div>

    <div class="gallery-item" onclick="openLightbox(1)">
      <img src="assets/galeri2.jpg" alt="Gallery 2"
           onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
      <div class="photo-placeholder"><span>📸</span>gallery-2.jpg</div>
      <div class="gallery-overlay"><span>🔍</span></div>
    </div>

    <div class="gallery-item" onclick="openLightbox(2)">
      <img src="assets/galeri3.jpg" alt="Gallery 3"
           onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
      <div class="photo-placeholder"><span>📸</span>gallery-3.jpg</div>
      <div class="gallery-overlay"><span>🔍</span></div>
    </div>

    <div class="gallery-item" onclick="openLightbox(3)">
      <img src="assets/galeri4.jpg" alt="Gallery 4"
           onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
      <div class="photo-placeholder"><span>📸</span>gallery-4.jpg</div>
      <div class="gallery-overlay"><span>🔍</span></div>
    </div>

    <div class="gallery-item" onclick="openLightbox(4)">
      <img src="assets/galeri5.jpg" alt="Gallery 5"
           onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
      <div class="photo-placeholder"><span>📸</span>gallery-5.jpg</div>
      <div class="gallery-overlay"><span>🔍</span></div>
    </div>

    <div class="gallery-item wide" onclick="openLightbox(5)">
      <img src="assets/galeri6.jpg" alt="Gallery 6"
           onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
      <div class="photo-placeholder"><span>📸</span>gallery-6.jpg</div>
      <div class="gallery-overlay"><span>🔍</span></div>
    </div>

    <div class="gallery-item" onclick="openLightbox(6)">
      <img src="assets/galeri7.jpg" alt="Gallery 7"
           onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
      <div class="photo-placeholder"><span>📸</span>gallery-7.jpg</div>
      <div class="gallery-overlay"><span>🔍</span></div>
    </div>

    <div class="gallery-item" onclick="openLightbox(7)">
      <img src="assets/galeri8.jpg" alt="Gallery 8"
           onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"/>
      <div class="photo-placeholder"><span>📸</span>gallery-8.jpg</div>
      <div class="gallery-overlay"><span>🔍</span></div>
    </div>

  </div>
</section>

<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox" onclick="closeLightboxOnBg(event)">
  <button class="lightbox-close" onclick="closeLightbox()">✕</button>
  <button class="lightbox-nav lightbox-prev" onclick="changePhoto(-1)">‹</button>
  <img id="lightbox-img" src="" alt=""/>
  <button class="lightbox-nav lightbox-next" onclick="changePhoto(1)">›</button>
  <div class="lightbox-caption" id="lightbox-caption"></div>
</div>

<!-- CONTACT -->
<section id="kontak">
  <div class="section-header">
    <div class="section-tag">Contact Us</div>
    <h2 class="section-title">Ready to Help with Your Project</h2>
    <p class="section-desc">Have a question or want to discuss your project? Chat with us directly on WhatsApp.</p>
  </div>
  <div class="row g-5">
    <div class="col-lg-5">
      <div class="kontak-item">
        <div class="kontak-ico">📍</div>
        <div class="kontak-detail">
          <h4>Head Office</h4>
          <p>Jl. Pelita I No.15-17, Kp. Pelita<br>Kec. Lubuk Baja, Kota Batam, Kepulauan Riau 29444</p>
        </div>
      </div>
      <div class="kontak-item">
        <div class="kontak-ico">📞</div>
        <div class="kontak-detail">
          <h4>Phone / WhatsApp</h4>
          <p>+62 822 8553 4662</p>
        </div>
      </div>
      <div class="kontak-item">
        <div class="kontak-ico">✉️</div>
        <div class="kontak-detail">
          <h4>Email</h4>
          <p>info@linkpangestututama.co.id<br>marketing@linkpangestututama.co.id</p>
        </div>
      </div>
      <div class="kontak-item">
        <div class="kontak-ico">⏰</div>
        <div class="kontak-detail">
          <h4>Office Hours</h4>
          <p>Monday – Friday: 08:00 – 17:00 WIB<br>Saturday: 08:00 – 13:00 WIB</p>
        </div>
      </div>
    </div>

    <div class="col-lg-7">
      <div style="background: var(--navy-mid); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; overflow: hidden;">

        <!-- Header WA -->
        <div style="background: #075E54; padding: 20px 24px; display: flex; align-items: center; gap: 14px;">
          <div style="width:48px; height:48px; background: linear-gradient(135deg, var(--blue-accent), var(--gold)); border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:18px; flex-shrink:0;">LP</div>
          <div>
            <div style="font-weight:700; font-size:15px;">PT Link Pangestu Utama</div>
            <div style="font-size:12px; color:rgba(255,255,255,0.7);">🟢 Typically replies within an hour</div>
          </div>
          <div style="margin-left:auto; font-size:24px;">💬</div>
        </div>

        <!-- Bubble chat -->
        <div style="padding:24px; background:#0d1f12;">
          <div style="background:#1f2e22; border-radius:0 12px 12px 12px; padding:14px 18px; max-width:85%; font-size:14px; color:rgba(255,255,255,0.85); line-height:1.7; position:relative;">
            <div style="position:absolute; top:0; left:-8px; width:0; height:0; border-top:8px solid #1f2e22; border-left:8px solid transparent;"></div>
            👋 Hi! Thank you for visiting our website.<br><br>
            My name is <strong>Admin LP</strong> from <strong>PT Link Pangestu Utama</strong>.<br><br>
            How can we help you today? Feel free to ask about our services or anything else! 😊
            <div style="text-align:right; font-size:11px; color:rgba(255,255,255,0.4); margin-top:6px;">08:00 ✓✓</div>
          </div>
        </div>

        <!-- Form -->
        <div style="padding: 0 24px 24px;">
          <div class="form-group">
            <label>Your Name</label>
            <input type="text" id="wa-name" placeholder="e.g. Budi Santoso"/>
          </div>
          <div class="form-group">
            <label>Your Message</label>
            <textarea id="wa-message" placeholder="e.g. Hi, I'd like to know more about your scaffolding rental services..."></textarea>
          </div>
          <button onclick="sendToWhatsApp()" style="width:100%; background:#25D366; color:white; border:none; border-radius:10px; padding:14px; font-size:15px; font-weight:700; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:10px; transition:background 0.2s; font-family:'Inter',sans-serif;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="white">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
              <path d="M12 0C5.373 0 0 5.373 0 12c0 2.124.558 4.122 1.532 5.858L.057 23.486a.5.5 0 0 0 .6.628l5.787-1.501A11.954 11.954 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.907 0-3.686-.534-5.198-1.459l-.372-.22-3.853.999 1.025-3.748-.242-.386A9.961 9.961 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
            </svg>
            Start Chat on WhatsApp
          </button>
          <p style="text-align:center; font-size:12px; color:var(--text-light); margin-top:12px; margin-bottom:0;">
            WhatsApp will open automatically with your message ready to send.
          </p>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div class="footer-copy">© 2026 PT Link Pangestu Utama. All rights reserved.</div>
    <div class="footer-links d-flex gap-4">
      <a href="#about">About Us</a>
      <a href="#layanan">Services</a>
      <a href="#proyek">Projects</a>
      <a href="#gallery">Gallery</a>
      <a href="#kontak">Contact</a>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // ===== WHATSAPP =====
  // ✏️ Ganti dengan nomor WA perusahaan (format: 628xxx tanpa + atau spasi)
  const waNumber = '6282285534662';

  function sendToWhatsApp() {
    const name    = document.getElementById('wa-name').value.trim();
    const message = document.getElementById('wa-message').value.trim();
    if (!name) {
      alert('Please enter your name.');
      document.getElementById('wa-name').focus();
      return;
    }
    const text = `Hi, my name is *${name}*. ${message || "I'd like to know more about your services."}`;
    window.open(`https://wa.me/${waNumber}?text=${encodeURIComponent(text)}`, '_blank');
  }

  const waBtn = document.querySelector('[onclick="sendToWhatsApp()"]');
  if (waBtn) {
    waBtn.addEventListener('mouseover', () => waBtn.style.background = '#1ebe5d');
    waBtn.addEventListener('mouseout',  () => waBtn.style.background = '#25D366');
  }

  // ===== LIGHTBOX GALLERY =====
  const galleryItems = document.querySelectorAll('.gallery-item');
  let currentIndex = 0;

  function getGalleryImages() {
    return Array.from(galleryItems).map(item => {
      const img = item.querySelector('img');
      return { src: img ? img.src : '', alt: img ? img.alt : '' };
    });
  }

  function openLightbox(index) {
    const images = getGalleryImages();
    currentIndex = index;
    const lb        = document.getElementById('lightbox');
    const lbImg     = document.getElementById('lightbox-img');
    const lbCaption = document.getElementById('lightbox-caption');
    lbImg.src = images[index].src;
    lbCaption.textContent = `${index + 1} / ${images.length}`;
    lb.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    document.getElementById('lightbox').classList.remove('active');
    document.body.style.overflow = '';
  }

  function closeLightboxOnBg(e) {
    if (e.target === document.getElementById('lightbox')) closeLightbox();
  }

  function changePhoto(dir) {
    const images = getGalleryImages();
    currentIndex = (currentIndex + dir + images.length) % images.length;
    document.getElementById('lightbox-img').src = images[currentIndex].src;
    document.getElementById('lightbox-caption').textContent = `${currentIndex + 1} / ${images.length}`;
  }

  document.addEventListener('keydown', e => {
    if (!document.getElementById('lightbox').classList.contains('active')) return;
    if (e.key === 'ArrowRight') changePhoto(1);
    if (e.key === 'ArrowLeft')  changePhoto(-1);
    if (e.key === 'Escape')     closeLightbox();
  });
</script>
<script>
  // ===== SMOOTH SCROLL =====
  document.querySelectorAll('nav a[href^="#"], .nav-cta[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });
</script>
</body>
</html>