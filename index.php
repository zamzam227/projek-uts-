<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JB GARAGE — Marketplace Kendaraan Bekas Aman</title>
  <!-- Latihan 1: Bootstrap 5 via CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet" />
  <link href="assets/style.css" rel="stylesheet" />
</head>
<body>

  <!-- ===== Latihan 2: Navbar responsif ===== -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-jb sticky-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="#beranda">
        <img src="assets/logo-garasi-jb.jpg" alt="Logo Garasi JB" />
        <span>JB GARAGE</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuUtama"
        aria-controls="menuUtama" aria-expanded="false" aria-label="Buka menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="menuUtama">
        <ul class="navbar-nav ms-auto align-items-lg-center">
          <li class="nav-item"><a class="nav-link active" href="#beranda">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
          <li class="nav-item"><a class="nav-link" href="#listing">Listing</a></li>
          <li class="nav-item"><a class="nav-link" href="#portofolio">Portofolio</a></li>
          <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
        </ul>
        <ul class="navbar-nav ms-lg-3 align-items-lg-center gap-lg-2" id="authNav"></ul>
      </div>
    </div>
  </nav>

  <!-- Semua isi halaman dibungkus .container -->
  <main class="container py-4">

    <!-- ===== BERANDA / HERO ===== -->
    <section id="beranda" class="hero p-4 p-md-5 mb-5">
      <div class="row align-items-center g-4">
        <div class="col-md-7 text-center text-md-start">
          <span class="badge badge-gold mb-3">🔐 Transaksi Aman dengan Escrow</span>
          <h1 class="display-5 fw-bold">Jual Beli Kendaraan Bekas, Tanpa Was-was.</h1>
          <p class="lead my-3">JB GARAGE mempertemukan penjual, pembeli, dan inspector terverifikasi dalam satu dashboard — dana ditahan escrow sampai unit diterima.</p>
          <a href="#portofolio" class="btn btn-primary btn-lg me-2">Lihat Dashboard</a>
          <a href="#kontak" class="btn btn-outline-light btn-lg">Hubungi Kami</a>
        </div>
        <div class="col-md-5 text-center">
          <img src="assets/logo-garasi-jb.jpg" class="img-fluid hero-logo" alt="Logo Garasi JB" />
        </div>
      </div>
    </section>

    <!-- ===== TENTANG ===== -->
    <section id="tentang" class="mb-5">
      <h2 class="section-title">Tentang</h2>
      <div class="row g-4">
        <div class="col-lg-6">
          <div class="card h-100">
            <div class="card-body p-4">
              <!-- Latihan 1: judul dengan tag heading -->
              <h2 class="h3">Profil Mahasiswa Semester 3</h2>
              <p class="text-secondary">Halaman ini dibuat sebagai Tugas Mandiri Praktikum Bootstrap 5.</p>
              <table class="table table-sm mb-0">
                <tbody>
                  <tr><th scope="row" style="width:35%">Nama</th><td>Zamzam Firdaus</td></tr>
                  <tr><th scope="row">NIM</th><td>2500853</td></tr>
                  <tr><th scope="row">Program Studi</th><td>Pendidikan Sistem dan Teknologi Informasi</td></tr>
                  <tr><th scope="row">Semester</th><td>3</td></tr>
                  <tr><th scope="row">Tema Web</th><td>E-commerce — JB GARAGE</td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card h-100">
            <div class="card-body p-4">
              <h3 class="h5">Apa itu JB GARAGE?</h3>
              <p class="text-secondary">Marketplace motor dan mobil bekas dengan empat peran pengguna: <b>Penjual</b>, <b>Pembeli</b>, <b>Inspector</b>, dan <b>Admin</b>. Setiap transaksi dilindungi sistem escrow dan setiap akun memiliki Trust Score.</p>
              <div class="accordion" id="faq">
                <div class="accordion-item">
                  <h2 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#f1">Bagaimana escrow bekerja?</button></h2>
                  <div id="f1" class="accordion-collapse collapse show" data-bs-parent="#faq"><div class="accordion-body small">Pembeli membayar ke JB GARAGE, dana ditahan, lalu dilepas ke penjual setelah pembeli mengonfirmasi unit sesuai.</div></div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f2">Apa fungsi inspector?</button></h2>
                  <div id="f2" class="accordion-collapse collapse" data-bs-parent="#faq"><div class="accordion-body small">Inspector partner memeriksa kondisi unit secara langsung dan memberi laporan sebelum transaksi dilanjutkan.</div></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ===== Latihan 3: Grid System — 3 card col-md-4 ===== -->
    <section id="fitur" class="mb-5">
      <h2 class="section-title">Keunggulan Kami</h2>
      <div class="row g-3">
        <div class="col-md-4">
          <div class="card feature-card h-100">
            <div class="card-body">
              <div class="feature-icon mb-2">🔐</div>
              <h5 class="card-title">Escrow Aman</h5>
              <p class="card-text text-secondary">Dana pembeli ditahan hingga unit diterima, dengan auto-release otomatis setelah 72 jam.</p>
              <a href="#portofolio" class="btn btn-primary btn-sm">Lihat Detail</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card feature-card h-100">
            <div class="card-body">
              <div class="feature-icon mb-2">🔍</div>
              <h5 class="card-title">Inspeksi Terverifikasi</h5>
              <p class="card-text text-secondary">Inspector partner bersertifikat memeriksa kondisi mesin, rangka, dan dokumen kendaraan.</p>
              <a href="#portofolio" class="btn btn-primary btn-sm">Lihat Detail</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card feature-card h-100">
            <div class="card-body">
              <div class="feature-icon mb-2">⭐</div>
              <h5 class="card-title">Trust Score</h5>
              <p class="card-text text-secondary">Skor kepercayaan 0–100 dari transaksi sukses, ulasan, verifikasi KYC, dan usia akun.</p>
              <a href="#portofolio" class="btn btn-primary btn-sm">Lihat Detail</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ===== LISTING: daftar iklan dengan pencarian, filter, dan pagination ===== -->
    <section id="listing" class="mb-5">
      <div class="d-flex flex-wrap justify-content-between align-items-end gap-2 mb-3">
        <h2 class="section-title mb-0">Listing Kendaraan</h2>
        <a href="jual.html" class="btn btn-primary btn-sm">➕ Pasang Iklan</a>
      </div>
      <div class="row g-2 mb-3">
        <div class="col-12 col-md-6"><input type="search" id="cari" class="form-control" placeholder="Cari kendaraan atau kota…" aria-label="Cari" /></div>
        <div class="col-6 col-md-3"><select id="filterJenis" class="form-select" aria-label="Jenis"><option value="">Semua jenis</option><option value="motor">Motor</option><option value="mobil">Mobil</option></select></div>
        <div class="col-6 col-md-3"><select id="urut" class="form-select" aria-label="Urutkan"><option value="baru">Terbaru</option><option value="murah">Harga termurah</option><option value="mahal">Harga termahal</option></select></div>
      </div>
      <div class="row g-3" id="gridListing"></div>
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 mt-4">
        <small class="text-secondary" id="infoListing"></small>
        <nav aria-label="Navigasi halaman listing" id="pagerListing"></nav>
      </div>
    </section>

    <!-- ===== PORTOFOLIO: Dashboard 4 peran ===== -->
    <section id="portofolio" class="mb-5">
      <h2 class="section-title">Portofolio — Dashboard JB GARAGE</h2>

      <ul class="nav nav-pills bg-white border rounded-3 p-1 mb-4 d-inline-flex flex-wrap" id="peran" role="tablist">
        <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#t-seller" type="button" role="tab">Penjual</button></li>
        <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#t-buyer" type="button" role="tab">Pembeli</button></li>
        <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#t-inspector" type="button" role="tab">Inspector</button></li>
        <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#t-admin" type="button" role="tab">Admin</button></li>
      </ul>

      <div class="tab-content">

        <!-- PENJUAL -->
        <div class="tab-pane fade show active" id="t-seller" role="tabpanel">
          <p class="text-secondary mb-3">👤 Reza Kusuma · <span class="badge text-bg-warning">⭐ Verified Seller</span></p>
          <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body"><div class="stat-icon ic-red mb-2">📋</div><div class="small text-secondary">Listing Aktif</div><div class="stat-value">4</div><div class="small text-success">▲ 1 baru minggu ini</div></div></div></div>
            <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body"><div class="stat-icon ic-green mb-2">💰</div><div class="small text-secondary">Total Terjual</div><div class="stat-value">Rp 67jt</div><div class="small text-success">▲ 23% vs bulan lalu</div></div></div></div>
            <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body"><div class="stat-icon ic-gold mb-2">⭐</div><div class="small text-secondary">Trust Score</div><div class="stat-value">87</div><div class="small text-success">▲ +3 poin bulan ini</div></div></div></div>
            <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body"><div class="stat-icon ic-cyan mb-2">👁</div><div class="small text-secondary">Total Views</div><div class="stat-value">1.240</div><div class="small text-success">▲ 18% vs minggu lalu</div></div></div></div>
          </div>

          <!-- Listing Saya -->
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="h5 mb-0">Listing Saya</h3>
            <span class="small text-secondary">4 listing · 1 terjual</span>
          </div>
          <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
              <div class="card listing-card h-100">
                <img src="assets/img/honda-beat-2021.jpg" class="listing-img" style="object-position:50% 62%" alt="Honda Beat 2021" />
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-start gap-1 mb-1">
                    <h5 class="card-title h6 mb-0">Honda Beat <span class="text-secondary small fw-normal">2021</span></h5>
                    <span class="badge text-bg-success">Aktif</span>
                  </div>
                  <div class="fw-bold">Rp 12.500.000</div>
                  <div class="small text-secondary mt-1">👁 324 views</div>
                </div>
              </div>
            </div>
            <div class="col-6 col-lg-3">
              <div class="card listing-card h-100">
                <img src="assets/img/honda-scoopy-2020.jpg" class="listing-img" style="object-position:50% 62%" alt="Honda Scoopy 2020" />
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-start gap-1 mb-1">
                    <h5 class="card-title h6 mb-0">Honda Scoopy <span class="text-secondary small fw-normal">2020</span></h5>
                    <span class="badge text-bg-success">Aktif</span>
                  </div>
                  <div class="fw-bold">Rp 13.500.000</div>
                  <div class="small text-secondary mt-1">👁 187 views</div>
                </div>
              </div>
            </div>
            <div class="col-6 col-lg-3">
              <div class="card listing-card h-100">
                <img src="assets/img/suzuki-gsx-s150-2019.jpg" class="listing-img" style="object-position:50% 50%" alt="Suzuki GSX-S150 2019" />
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-start gap-1 mb-1">
                    <h5 class="card-title h6 mb-0">Suzuki GSX-S150 <span class="text-secondary small fw-normal">2019</span></h5>
                    <span class="badge text-bg-warning">Review</span>
                  </div>
                  <div class="fw-bold">Rp 18.000.000</div>
                  <div class="small text-secondary mt-1">👁 96 views</div>
                </div>
              </div>
            </div>
            <div class="col-6 col-lg-3">
              <div class="card listing-card h-100">
                <img src="assets/img/honda-brio-2018.jpg" class="listing-img" style="object-position:50% 50%" alt="Honda Brio 2018" />
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-start gap-1 mb-1">
                    <h5 class="card-title h6 mb-0">Honda Brio <span class="text-secondary small fw-normal">2018</span></h5>
                    <span class="badge text-bg-secondary">Terjual</span>
                  </div>
                  <div class="fw-bold">Rp 115.000.000</div>
                  <div class="small text-secondary mt-1">👁 633 views</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Escrow Aktif: dua kartu berdampingan -->
          <h3 class="h5 mb-3">Escrow Aktif</h3>
          <div class="row g-3">
            <div class="col-md-6">
              <div class="card h-100"><div class="card-body d-flex align-items-center gap-3">
                <img src="assets/img/honda-beat-2021.jpg" class="escrow-thumb" alt="Honda Beat 2021" />
                <div class="flex-grow-1"><div class="fw-semibold">Honda Beat 2021</div><div class="small text-secondary">Pembeli: Andi W. · 71j 23m</div></div>
                <div class="text-end"><b>Rp 12,5jt</b><div class="small text-warning">🟡 Dana ditahan</div></div>
              </div></div>
            </div>
            <div class="col-md-6">
              <div class="card h-100"><div class="card-body d-flex align-items-center gap-3">
                <img src="assets/img/honda-scoopy-2020.jpg" class="escrow-thumb" alt="Honda Scoopy 2020" />
                <div class="flex-grow-1"><div class="fw-semibold">Honda Scoopy 2020</div><div class="small text-secondary">Pembeli: Siti R. · 22j 10m</div></div>
                <div class="text-end"><b>Rp 13,5jt</b><div class="small text-warning">🟡 Dana ditahan</div></div>
              </div></div>
            </div>
          </div>
        </div>

        <!-- PEMBELI -->
        <div class="tab-pane fade" id="t-buyer" role="tabpanel">
          <p class="text-secondary mb-3">👤 Andi Wijaya · <span class="badge text-bg-success">✅ Verified Buyer</span></p>
          <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body"><div class="stat-icon ic-gold mb-2">🔐</div><div class="small text-secondary">Escrow Aktif</div><div class="stat-value">1</div><div class="small text-warning">Rp 8,5jt ditahan</div></div></div></div>
            <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body"><div class="stat-icon ic-red mb-2">❤️</div><div class="small text-secondary">Favorit</div><div class="stat-value">6</div><div class="small text-success">▲ 2 baru</div></div></div></div>
            <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body"><div class="stat-icon ic-green mb-2">🛒</div><div class="small text-secondary">Pembelian</div><div class="stat-value">3</div><div class="small text-secondary">Sepanjang masa</div></div></div></div>
            <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body"><div class="stat-icon ic-cyan mb-2">💬</div><div class="small text-secondary">Chat Baru</div><div class="stat-value">2</div><div class="small text-secondary">Belum dibaca</div></div></div></div>
          </div>
          <div class="card">
            <div class="card-header bg-white fw-bold">Riwayat Pembelian</div>
            <div class="table-responsive">
              <table class="table table-striped align-middle mb-0">
                <thead><tr><th>Kendaraan</th><th>Penjual</th><th>Harga</th><th>Status</th></tr></thead>
                <tbody>
                  <tr><td>🏍 Honda Beat 2021</td><td>Reza K.</td><td>Rp 8.500.000</td><td><span class="badge text-bg-warning">Escrow</span></td></tr>
                  <tr><td>🛵 Yamaha NMAX 2019</td><td>Dewi L.</td><td>Rp 21.000.000</td><td><span class="badge text-bg-success">Selesai</span></td></tr>
                  <tr><td>🚗 Daihatsu Ayla 2017</td><td>Hadi S.</td><td>Rp 78.000.000</td><td><span class="badge text-bg-success">Selesai</span></td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- INSPECTOR -->
        <div class="tab-pane fade" id="t-inspector" role="tabpanel">
          <p class="text-secondary mb-3">👤 Fauzan Ardiansyah · <span class="badge text-bg-info">🔍 Inspector Partner</span></p>
          <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body"><div class="stat-icon ic-red mb-2">📅</div><div class="small text-secondary">Booking Masuk</div><div class="stat-value">3</div><div class="small text-secondary">Hari ini</div></div></div></div>
            <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body"><div class="stat-icon ic-green mb-2">✔</div><div class="small text-secondary">Inspeksi Selesai</div><div class="stat-value">128</div><div class="small text-success">▲ 9 bulan ini</div></div></div></div>
            <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body"><div class="stat-icon ic-gold mb-2">⭐</div><div class="small text-secondary">Rating</div><div class="stat-value">4,9</div><div class="small text-success">Top 5%</div></div></div></div>
            <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body"><div class="stat-icon ic-cyan mb-2">💰</div><div class="small text-secondary">Komisi Bulan Ini</div><div class="stat-value">Rp 2,4jt</div><div class="small text-success">▲ 12%</div></div></div></div>
          </div>
          <div class="card">
            <div class="card-header bg-white fw-bold">Jadwal Inspeksi Hari Ini</div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between"><span><b>09:00</b> · Honda Vario 125 — Bandung</span><span class="text-success fw-bold">Rp 150rb</span></li>
              <li class="list-group-item d-flex justify-content-between"><span><b>11:30</b> · Toyota Avanza 2016 — Cimahi</span><span class="text-success fw-bold">Rp 250rb</span></li>
              <li class="list-group-item d-flex justify-content-between"><span><b>14:00</b> · Yamaha Aerox 2021 — Lembang</span><span class="text-success fw-bold">Rp 150rb</span></li>
            </ul>
          </div>
        </div>

        <!-- ADMIN -->
        <div class="tab-pane fade" id="t-admin" role="tabpanel">
          <p class="text-secondary mb-3">👤 Admin JB GARAGE · <span class="badge text-bg-dark">🛡 Super Admin</span></p>
          <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body"><div class="stat-icon ic-red mb-2">👥</div><div class="small text-secondary">Total User</div><div class="stat-value">2.481</div><div class="small text-success">▲ 64 minggu ini</div></div></div></div>
            <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body"><div class="stat-icon ic-gold mb-2">🚗</div><div class="small text-secondary">Antrian KYC</div><div class="stat-value">8</div><div class="small text-warning">Perlu ditinjau</div></div></div></div>
            <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body"><div class="stat-icon ic-green mb-2">💰</div><div class="small text-secondary">Revenue</div><div class="stat-value">Rp 48jt</div><div class="small text-success">▲ 15%</div></div></div></div>
            <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body"><div class="stat-icon ic-cyan mb-2">⚠️</div><div class="small text-secondary">Fraud Alerts</div><div class="stat-value">2</div><div class="small text-danger">Prioritas tinggi</div></div></div></div>
          </div>
          <div class="alert alert-danger d-flex align-items-start gap-2" role="alert">
            <span>⚠️</span>
            <div><b>Listing duplikat terdeteksi</b><div class="small">Nomor rangka yang sama dipakai pada 2 akun berbeda. Perlu verifikasi manual.</div></div>
          </div>
          <div class="alert alert-warning d-flex align-items-start gap-2 mb-0" role="alert">
            <span>⚠️</span>
            <div><b>Harga jauh di bawah estimasi AI</b><div class="small">Honda PCX 2022 dijual 40% di bawah kisaran pasar.</div></div>
          </div>
        </div>

      </div>
    </section>

    <!-- ===== Latihan 4 & 5: Form Kontak + Modal Konfirmasi ===== -->
    <section id="kontak" class="mb-4">
      <h2 class="section-title">Kontak</h2>
      <div class="row g-4">
        <div class="col-lg-5">
          <div class="card h-100">
            <div class="card-body p-4">
              <h3 class="h5">Hubungi JB GARAGE</h3>
              <p class="text-secondary">Ada pertanyaan soal listing, escrow, atau ingin jadi inspector partner? Kirim pesan dan tim kami akan membalas.</p>
              <p class="mb-1">📍 Purwakarta, Jawa Barat</p>
              <p class="mb-1">✉️ garasijbmotor@gmail.com</p>
              <p class="mb-0">🕘 Senin–Sabtu, 09.00–17.00 WIB</p>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card">
            <div class="card-body p-4">
              <div id="alertTerkirim" class="alert alert-success d-none" role="alert">✅ Pesan Anda berhasil dikirim. Terima kasih!</div>
              <form id="formKontak" novalidate>
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="nama" placeholder="Masukkan nama" required />
                  <div class="invalid-feedback">Nama wajib diisi.</div>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="nama@email.com" required />
                  <div class="invalid-feedback">Masukkan email yang valid.</div>
                </div>
                <div class="mb-3">
                  <label for="pesan" class="form-label">Pesan</label>
                  <textarea class="form-control" id="pesan" rows="4" placeholder="Tulis pesan Anda" required></textarea>
                  <div class="invalid-feedback">Pesan wajib diisi.</div>
                </div>
                <button type="button" id="btnKirim" class="btn btn-primary">Kirim Pesan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Modal konfirmasi -->
  <div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="judulModal">Konfirmasi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">Apakah Anda yakin ingin mengirim pesan ini?</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" id="btnYa">Ya, Kirim</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal detail listing -->
  <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="detailJudul" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="detailJudul"></h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button></div>
        <div class="modal-body" id="detailBody"></div>
      </div>
    </div>
  </div>

  <footer class="py-4 mt-4">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 small">
      <span>© 2026 JB GARAGE </span>
      <span>Dibuat oleh Zamzam Firdaus · 2500853</span>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/app.js"></script>
  <script>
    const form=document.getElementById('formKontak'),modal=new bootstrap.Modal(document.getElementById('modalKonfirmasi')),alertOk=document.getElementById('alertTerkirim');
    document.getElementById('btnKirim').addEventListener('click',()=>{form.classList.add('was-validated');if(form.checkValidity())modal.show()});
    document.getElementById('btnYa').addEventListener('click',async()=>{const btn=document.getElementById('btnYa');btn.disabled=true;try{await JB.request('api/contact.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({name:document.getElementById('nama').value,email:document.getElementById('email').value,message:document.getElementById('pesan').value})});modal.hide();form.reset();form.classList.remove('was-validated');alertOk.classList.remove('d-none');setTimeout(()=>alertOk.classList.add('d-none'),5000)}catch(e){alert(e.message)}finally{btn.disabled=false}});
    const links=document.querySelectorAll('.navbar-jb .nav-link');if('IntersectionObserver' in window){const spy=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting)links.forEach(l=>l.classList.toggle('active',l.getAttribute('href')==='#'+e.target.id))}),{rootMargin:'-40% 0px -55% 0px'});['beranda','tentang','listing','portofolio','kontak'].forEach(id=>{const el=document.getElementById(id);if(el)spy.observe(el)})}
    (()=>{const PER=6;let page=1;const $=id=>document.getElementById(id),detail=new bootstrap.Modal($('modalDetail'));let all=[];
      async function render(){const q=$('cari').value.trim().toLowerCase(),jenis=$('filterJenis').value,urut=$('urut').value;let items=all.filter(l=>l.status==='Aktif'&&(!jenis||l.type===jenis)&&(!q||(l.title+' '+l.city).toLowerCase().includes(q)));items.sort((a,b)=>urut==='murah'?a.price-b.price:urut==='mahal'?b.price-a.price:b.createdAt-a.createdAt);const pg=JB.paginate(items,page,PER);page=pg.page;$('gridListing').innerHTML=pg.total?pg.slice.map(l=>`<div class="col-12 col-sm-6 col-lg-4">${JB.cardHTML(l)}</div>`).join(''):'<div class="col-12"><div class="alert alert-secondary mb-0">Tidak ada iklan yang cocok.</div></div>';$('infoListing').textContent=pg.total?`Menampilkan ${pg.from}–${pg.to} dari ${pg.total} iklan`:'';JB.renderPager($('pagerListing'),pg,p=>{page=p;render();$('listing').scrollIntoView({behavior:'smooth'})});$('gridListing').querySelectorAll('.listing-card').forEach(c=>c.addEventListener('click',()=>open(c.dataset.id)))}
      async function open(id){try{const result=await JB.request('api/view.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({id})});const l=result.listing,u=await JB.currentUser();const gal=l.images.length?`<div id="gal" class="carousel slide mb-3"><div class="carousel-inner">${l.images.map((s,i)=>`<div class="carousel-item ${i?'':'active'}"><img src="${JB.esc(s)}" alt="Foto ${i+1}"></div>`).join('')}</div>${l.images.length>1?'<button class="carousel-control-prev" type="button" data-bs-target="#gal" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button><button class="carousel-control-next" type="button" data-bs-target="#gal" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>':''}</div>`:'<div class="listing-img ph mb-3" style="aspect-ratio:16/9">'+(l.type==='mobil'?'🚗':'🏍')+'<small>Foto belum tersedia</small></div>';$('detailJudul').textContent=`${l.title} ${l.year}`;$('detailBody').innerHTML=gal+`<div class="h4">${JB.rupiah(l.price)}</div><p class="text-secondary mb-2">📍 ${JB.esc(l.city)} · 👁 ${l.views} views · Penjual: <b>${JB.esc(l.ownerName)}</b></p><p>${JB.esc(l.desc)}</p>${u?'<button class="btn btn-primary" type="button" disabled>Beli via Escrow (segera hadir)</button>':'<a class="btn btn-primary" href="login.html?next=index.php">Masuk untuk menghubungi penjual</a>'}`;detail.show();const ix=all.findIndex(x=>String(x.id)===String(id));if(ix>=0)all[ix]=l;render()}catch(e){alert(e.message)}}
      ['cari','filterJenis','urut'].forEach(id=>$(id).addEventListener('input',()=>{page=1;render()}));JB.listings().then(items=>{all=items;render()}).catch(e=>{$('gridListing').innerHTML=`<div class="col-12"><div class="alert alert-danger">${JB.esc(e.message)}</div></div>`});
    })();
  </script>
</body>
</html>
