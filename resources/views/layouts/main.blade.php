<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>BANK SAMPAH BAJERA</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="{{ asset('assets/img/kaiadmin/logo.ico') }}" type="image/x-icon" />

  <!-- Fonts and Icons -->
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
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="index.html" class="logo">
            <img src="{{ asset('assets/img/kaiadmin/logo.svg') }}" alt="navbar brand" class="navbar-brand" height="80" />
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
            <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
          </div>
          <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
        </div>
        <!-- End Logo Header -->
      </div>

      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            <li class="nav-item">
              <a href="{{ url('/Dadmin') }}">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
              </a>
            </li>

            <li class="nav-section">
              <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
              <h4 class="text-section">Fitur</h4>
            </li>

            <li class="nav-item">
              <a href="{{ url('/user') }}">
                <i class="fas fa-users"></i>
                <p>Manajemen Pengguna</p>
              </a>
            </li>

            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#sidebarLayouts">
                <i class="fas fa-exchange-alt"></i>
                <p>Manajemen Transaksi</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="sidebarLayouts">
                <ul class="nav nav-collapse">
                  <li><a href="{{ url('/setor') }}"><span class="sub-item">Setor</span></a></li>
                  <li><a href="{{ url('/tarik') }}"><span class="sub-item">Penarikan</span></a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a href="{{ url('/sampah') }}">
                <i class="fas fa-recycle"></i>
                <p>Manajemen Sampah</p>
              </a>
            </li>

             <li class="nav-item">
              <a href="{{ url('/berita') }}">
                <i class="fas fa-newspaper"></i>
                <p>Berita</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('/laporan') }}">
                <i class="fas fa-file-alt"></i>
                <p>Laporan</p>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->

    <!-- Main Panel -->
    <div class="main-panel">
      <!-- Main Header -->
      <div class="main-header">
        <div class="main-header-logo">
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
              <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
            </div>
            <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
          </div>
        </div>

        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
          <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown">
                </a>
                </li>
              <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#">
                  <div class="avatar-sm">
                    <img src="{{ asset('assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle" />
                  </div>
                  <span class="profile-username">
                  <span class="op-7">Hi,</span>
                  <span class="fw-bold">{{ Auth::user()->name }}</span>
                  </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                  <li>
                    <div class="dropdown-user-scroll">
                      <div class="user-box">
                        <div class="avatar-lg">
                          <img src="{{ asset('assets/img/profile.jpg') }}" alt="image profile" class="avatar-img rounded" />
                        </div>
                        <div class="u-text">
                          <h4>{{ Auth::user()->name }}</h4>
                          <p class="text-muted">{{ Auth::user()->email }}</p>
                        </div>
                      </div>
                      <div class="dropdown-divider"></div>
                      <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                          <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                      </form>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>

      <!-- Konten Halaman -->
      <div class="container mt-100">
        @yield('container')
      </div>
    </div>
    <!-- End Main Panel -->
  </div>

  <!-- Core JS Files -->
  <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

  <!-- Plugin JS -->
  <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>
  <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

  <!-- Kaiadmin Main JS -->
  <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
  @stack('scripts')
</body>
</html>
