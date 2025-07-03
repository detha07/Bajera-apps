<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Bank Sampah</title>

  {{-- Fonts & Styles --}}
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
      active: () => sessionStorage.fonts = true
    });
  </script>

  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}">

  <style>
    body, html {
      height: 100%;
      margin: 0;
    }

    .bg-cover {
      background: url('{{ asset('assets/img/kaiadmin/try.jpeg') }}') no-repeat center center;
      background-size: cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    .bg-cover::before {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 1;
    }

    .login-box {
      position: relative;
      z-index: 2;
      background: rgba(255, 255, 255, 0.95);
      padding: 30px;
      border-radius: 12px;
      max-width: 400px;
      width: 100%;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      text-align: center;
    }

    .login-box img.logo {
      max-height: 120px;
      margin-bottom: 15px;
    }

    .logo {
      max-height: 300px;
      display: block;
      margin: 0 auto 50px auto;
    }

    .btn-custom {
      background-color: #498536;
      border-color: #498536;
      color: white;
    }

    .btn-custom:hover {
      background-color: #3e6f2c;
      border-color: #3e6f2c;
    }
  </style>
</head>
<body>

  <div class="bg-cover">
    <div class="login-box">
      <img src="{{ asset('assets/img/kaiadmin/login.png') }}" alt="Logo Bank Sampah" class="logo">

      {{-- Alert Error --}}
      @if (session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
<script>
  Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '{{ session('success') }}',
    timer: 3000,
    showConfirmButton: false
  });
</script>
@endif

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3 text-start">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" class="form-control" style="border: 2px solid #498536; border-radius: 6px;" required autofocus>
        </div>
        <div class="mb-3 text-start">
          <label for="password" class="form-label">Kata Sandi</label>
          <input type="password" name="password" id="password" class="form-control" style="border: 2px solid #498536; border-radius: 6px;" required>
        </div>

        <div class="mb-3 d-flex justify-content-between align-items-center">
          <div class="form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Ingat saya</label>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="showPassword" onclick="togglePassword()">
            <label class="form-check-label" for="showPassword">Lihat password</label>
          </div>
        </div>

        <button type="submit" class="btn btn-custom w-100">Masuk</button>

        <p class="text-center mt-3">
          Belum punya akun? <a href="{{ route('register') }}" style="color: #498536;">Daftar di sini</a>
        </p>
      </form>
      <p class="text-center mt-3">
        <a href="/" style="color: #498536;">Kembali</a>
      </p>
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
    }
  </script>

</body>
</html>
