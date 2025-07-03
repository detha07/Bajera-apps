<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - Bank Sampah</title>
  <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
  <script>
    WebFont.load({
      google: { families: ["Public Sans:300,400,500,600,700"] },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["{{ asset('assets/css/fonts.min.css') }}"],
      },
      active: function () {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
  <style>
    body, html {
      height: 100%;
      margin: 0;
    }

    .bg-cover {
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
      position: relative;
      background-image: url('/images/kegiatan1.jpg');
      animation: bgSlide 15s infinite;
    }

    @keyframes bgSlide {
      0%   { background-image: url('/images/kegiatan1.jpg'); }
      33%  { background-image: url('/images/kegiatan2.jpg'); }
      66%  { background-image: url('/images/kegiatan3.jpg'); }
      100% { background-image: url('/images/kegiatan1.jpg'); }
    }

    .login-box {
      background: rgba(255, 255, 255, 0.9);
      padding: 30px;
      border-radius: 10px;
      max-width: 450px;
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="bg-cover d-flex justify-content-center align-items-center">
    <div class="login-box shadow">
      <h3 class="text-center mb-4">Daftar Akun Bank Sampah</h3>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nama Lengkap</label>
          <input type="text" name="name" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Kata Sandi</label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
          <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="showPassword" onclick="togglePassword()">
          <label class="form-check-label" for="showPassword">Lihat kata sandi</label>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
        <button type="submit" class="btn btn-primary">Daftar</button>
        </div>
        <div class="text-center mt-3">
          Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
      </form>

      <script>
        function togglePassword() {
          const passwordField = document.getElementById('password');
          const confirmField = document.querySelector('input[name="password_confirmation"]');
          const type = passwordField.type === 'password' ? 'text' : 'password';
          passwordField.type = type;
          confirmField.type = type;
        }
      </script>
    </div>
  </div>
</body>
</html>
