
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title') User Dashboard-DigiSehat</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('style/assets/img/favicon.png') }}" rel="icon">
  <link href="{{asset('style/assets/img/apple-touch-icon.pn') }}g" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('style/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{asset('style/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{asset('style/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{asset('style/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{asset('style/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{asset('style/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{asset('style/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('style/assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{asset('style/assets/img/logo.jpg')}}" alt="">
        <span class="d-none d-lg-block text-primary">MediPulse</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ auth()->user()->profil && auth()->user()->profil->profile_image ? auth()->user()->profil->profile_image : asset('style/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->nama_pengguna }}</span>
          </a><!-- End Profile Image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ auth()->user()->nama_pengguna }}</h6>
              <span>Pengguna Obat</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.form') }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="dropdown-item d-flex align-items-center">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Log Out</span>
                </button>
              </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('userDashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('checkStatusObat') }}">
            <i class="bi bi-people"></i>
            <span>Manajemen Obat</span>
          </a>
        </li><!-- End Dashboard Nav -->
    </ul>

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('userJadwal') }}">
            <i class="bi bi-people"></i>
            <span>Atur Jadwal</span>
          </a>
        </li><!-- End Dashboard Nav -->
    </ul>

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('userRiwayat') }}">
            <i class="bi bi-people"></i>
            <span>Riwayat Obat</span>
          </a>
        </li><!-- End Dashboard Nav -->
    </ul>

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('userLogbook') }}">
            <i class="bi bi-people"></i>
            <span>Riwayat Logbook</span>
          </a>
        </li><!-- End Dashboard Nav -->
    </ul>

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('userBMI') }}">
            <i class="bi bi-people"></i>
            <span>Tes BMI</span>
          </a>
        </li><!-- End Dashboard Nav -->
    </ul>


  </aside><!-- End Sidebar-->

 @yield('breadcrumbs')

 @yield('content')

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer mt-auto">
    <div class="copyright">
      &copy; Copyright <strong><span>DigiSehat</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://bootstrapmade.com/">Kelompok VII</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('style/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{asset('style/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{asset('style/assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{asset('style/assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{asset('style/assets/vendor/quill/quill.js') }}"></script>
  <script src="{{asset('style/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{asset('style/assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{asset('style/assets/vendor/php-email-form/validate.js') }}"></script>

  <script src="{{asset('style/assets/js/main.js') }}"></script>

</body>

</html>
