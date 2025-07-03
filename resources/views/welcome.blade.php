<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BANK SAMPAH BAJERA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    .hero {
      position: relative;
      background: url('assets/img/kaiadmin/try.jpeg') no-repeat center center/cover;
      color: white;
      padding: 400px 0;
      text-align: center;
      z-index: 1;
    }
    .hero::before {
      content: "";
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: -1;
    }
    .hero .container {
      position: relative;
      z-index: 2;
    }
    .program-img, .prestasi-img {
      max-height: 200px;
      object-fit: cover;
      width: 100%;
    }
    .text-custom {
      color: #498536 !important;
    }
    .contact-box {
      background: white;
      border-radius: 10px;
      padding: 30px;
      height: 100%;
    }
    .contact-info {
      background-color: #b32c2c;
      color: white;
      border-radius: 10px;
      padding: 30px;
      height: 100%;
    }
    .contact-info h6 {
      font-size: 14px;
      opacity: 0.8;
    }
    .contact-info p {
      font-weight: bold;
      margin-bottom: 20px;
    }
    iframe {
      border: none;
      border-radius: 10px;
      width: 100%;
      height: 100%;
      min-height: 350px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="welcome">
      <img src="assets/img/kaiadmin/login.png" alt="Logo Bank Sampah" height="40">
      <span class="fw-bold text-custom">Bank Sampah Bajera Bersemi</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link text-custom" href="#">
            <i class="bi bi-house-door-fill me-1"></i> Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-custom" href="#">
            <i class="bi bi-info-circle-fill me-1"></i> Tentang
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-custom" href="#">
            <i class="bi bi-calendar-event-fill me-1"></i> Kegiatan
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-custom" href="login">
            <i class="bi bi-box-arrow-in-right me-1"></i> Login
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero">
  <div class="container">
    <h1 class="fw-bold">Selamat Datang di Bank Sampah Bajera Bersemi!</h1>
    <p>Bersama kami wujudkan Kebersihan</p>
  </div>
</section>

<!-- Tentang -->
<section class="py-5">
  <div class="container">
    <h3 class="fw-bold text-center mb-6">About</h3>
    <h3 class="fw-bold text-center mb-4 text-success">BANK SAMPAH BAJERA BERSEMI</h3>
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0 text-center">
        <img src="assets/img/kaiadmin/login.png" alt="Foto tentang kami" style="max-width: 70%; height: auto;">
      </div>
      <div class="col-md-6">
        <p class="lead text-center" style="text-align: justify;">
          Bank Sampah Bajera Bersemi merupakan lembaga lingkungan berbasis masyarakat yang bertujuan untuk menciptakan lingkungan bersih, sehat, dan bernilai ekonomi melalui pengelolaan sampah secara terstruktur dan terpilah.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Visi Misi -->
<section class="py-5" style="background-color: #498536;">
  <div class="container">
    <div class="row text-center mb-4 g-4">
      <div class="col-md-6 d-flex">
        <div class="p-4 bg-white shadow rounded w-100">
          <h4 class="fw-bold mb-3">Visi</h4>
          <p>
            "Menjadi lembaga pengelola sampah berbasis masyarakat yang berdaya saing, mandiri, dan berwawasan lingkungan."
          </p>
        </div>
      </div>
      <div class="col-md-6 d-flex">
        <div class="p-4 bg-white shadow rounded w-100">
          <h4 class="fw-bold mb-3">Misi</h4>
          <ul class="text-start">
            <li>Edukasi dan sosialisasi tentang pengelolaan sampah.</li>
            <li>Pengelolaan sampah terpilah dan bernilai guna.</li>
            <li>Pemberdayaan ekonomi masyarakat dari sampah.</li>
            <li>Kerja sama lintas sektor.</li>
            <li>Digitalisasi bank sampah.</li>
          </ul>
        </div>
      </div>
    </div>
    <blockquote class="blockquote text-center mt-4 text-white">
      <p class="fst-italic">"Kebersihan adalah bagian dari iman..."</p>
      <footer class="blockquote-footer text-white">Bank Sampah Bajera Bersemi</footer>
    </blockquote>
  </div>
</section>

<!-- Foto Kegiatan -->
<section class="py-5 bg-light">
  <div class="container">
    <h3 class="fw-bold text-center mb-4">Foto Kegiatan</h3>
    <div class="row">
      <!-- Ulangi div col-md-3 sesuai jumlah gambar -->
      <!-- Contoh salah satu gambar -->
      <div class="col-md-3">
        <div class="card border-0 shadow-sm mb-4">
          <img src="assets/img/kaiadmin/1.jpg" class="card-img-top program-img" alt="Kegiatan">
          <div class="card-body">
            <h5 class="card-title">Penyuluhan</h5>
            <p class="card-text">Edukasi tentang pemilahan sampah kepada warga.</p>
          </div>
        </div>
      </div>

       <div class="col-md-3">
        <div class="card border-0 shadow-sm mb-4">
          <img src="assets/img/kaiadmin/1.jpg" class="card-img-top program-img" alt="Kegiatan">
          <div class="card-body">
            <h5 class="card-title">Penyuluhan</h5>
            <p class="card-text">Edukasi tentang pemilahan sampah kepada warga.</p>
          </div>
        </div>
      </div>

       <div class="col-md-3">
        <div class="card border-0 shadow-sm mb-4">
          <img src="assets/img/kaiadmin/1.jpg" class="card-img-top program-img" alt="Kegiatan">
          <div class="card-body">
            <h5 class="card-title">Penyuluhan</h5>
            <p class="card-text">Edukasi tentang pemilahan sampah kepada warga.</p>
          </div>
        </div>
      </div>

       <div class="col-md-3">
        <div class="card border-0 shadow-sm mb-4">
          <img src="assets/img/kaiadmin/1.jpg" class="card-img-top program-img" alt="Kegiatan">
          <div class="card-body">
            <h5 class="card-title">Penyuluhan</h5>
            <p class="card-text">Edukasi tentang pemilahan sampah kepada warga.</p>
          </div>
        </div>
      </div>

       <div class="col-md-3">
        <div class="card border-0 shadow-sm mb-4">
          <img src="assets/img/kaiadmin/1.jpg" class="card-img-top program-img" alt="Kegiatan">
          <div class="card-body">
            <h5 class="card-title">Penyuluhan</h5>
            <p class="card-text">Edukasi tentang pemilahan sampah kepada warga.</p>
          </div>
        </div>
      </div>

       <div class="col-md-3">
        <div class="card border-0 shadow-sm mb-4">
          <img src="assets/img/kaiadmin/1.jpg" class="card-img-top program-img" alt="Kegiatan">
          <div class="card-body">
            <h5 class="card-title">Penyuluhan</h5>
            <p class="card-text">Edukasi tentang pemilahan sampah kepada warga.</p>
          </div>
        </div>
      </div>

       <div class="col-md-3">
        <div class="card border-0 shadow-sm mb-4">
          <img src="assets/img/kaiadmin/1.jpg" class="card-img-top program-img" alt="Kegiatan">
          <div class="card-body">
            <h5 class="card-title">Penyuluhan</h5>
            <p class="card-text">Edukasi tentang pemilahan sampah kepada warga.</p>
          </div>
        </div>
      </div>

       <div class="col-md-3">
        <div class="card border-0 shadow-sm mb-4">
          <img src="assets/img/kaiadmin/1.jpg" class="card-img-top program-img" alt="Kegiatan">
          <div class="card-body">
            <h5 class="card-title">Penyuluhan</h5>
            <p class="card-text">Edukasi tentang pemilahan sampah kepada warga.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Kontak + Maps -->
<section class="py-5">
  <div class="container">
    <h3 class="fw-bold text-center mb-4">Kontak Kami</h3>
    <div class="row g-4">
      
      <!-- Google Maps -->
      <div class="col-lg-8">
        <div class="contact-box">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.0077446541384!2d115.1622125!3d-8.5361662!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23b00167bb363%3A0x467fe63039add4d4!2sBalai%20Banjar%20Bajra%20Pegebegan!5e0!3m2!1sid!2sid!4v1719360341573!5m2!1sid!2sid"
            width="100%"
            height="350"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
        </div>
      </div>

      <!-- Informasi Kontak -->
      <div class="col-lg-4">
        <div class="contact-info p-4 rounded" style="background-color: #498536; color: #fff;">
          <h6>Phone Number</h6>
          <p>0812-3456-7890</p>
          <h6>Email Address</h6>
          <p>banksampah@gmail.com</p>
          <h6>Street Address</h6>
          <p>Br. Bajera Pegebegan, Belayu, Marga – Tabanan</p>
          <h6>Website</h6>
          <p>www.bajerabersemi.com</p>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- Footer -->
<footer class="text-white text-center py-3" style="background-color: #498536;">
  <div class="container">
    <p>Br. Bajera Pegebegan, Beringkit Belayu, Marga, Tabanan</p>
    <p>&copy; Bajera Bersih Bersemi. All rights reserved.</p>
  </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
