<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Medipulse - Login</title>
  <!-- Favicons -->
  <link rel="icon" href="{{ asset('/style/assets/img/logo.jpg') }}" type="image/png">
  <link href="{{asset('style/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

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

<body style="background: linear-gradient(to right, #cfdde6, #fff, #cfdde6);">
  <div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7 d-flex flex-column align-items-center justify-content-center">

      <!-- Logo Section -->
      <div class="d-flex justify-content-center py-3">
        <a href="index.html" class="d-flex align-items-center text-decoration-none">
          <img src="{{ asset('style/assets/img/logo.jpg') }}" alt="Logo" class="img-fluid me-2" style="height: 50px;">
          <h2 class="fw-bold text-primary mb-0">Medipulse</h2>
        </a>
      </div>

      <!-- Card for Login -->
      <div class="card shadow-lg border-0 rounded-4 w-100">
        <div class="card-body px-4 py-3">

          <!-- Card Title -->
          <div class="text-center mb-4">
            <h3 class="fw-bold">Selamat Datang!</h3>
            <p class="text-muted small">Masuk untuk melanjutkan</p>
          </div>

          <!-- Alert Message -->
          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          <!-- Login Form -->
          <form action="{{ route('login.post') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <!-- Login with Google -->
            <a href="{{ route('redirect') }}" class="text-decoration-none">
              <button class="btn btn-outline-light text-dark border border-primary w-100 btn-lg d-flex align-items-center justify-content-center mb-4" type="button">
                <i class="bi bi-google me-2 text-danger"></i>Lanjut Menggunakan Google
              </button>
            </a>

            <!-- Input Fields -->
            <div class="form-floating mb-3">
              <input type="text" name="email" id="username" class="form-control rounded-3" placeholder="Username" required>
              <label for="username"><i class="bi bi-person-circle"></i> email</label>
              <div class="invalid-feedback">Masukkan email Anda.</div>
            </div>

            <div class="form-floating mb-3">
              <input type="password" name="password" id="password" class="form-control rounded-3" placeholder="Password" required>
              <label for="password"><i class="bi bi-lock-fill"></i> Kata Sandi</label>
              <div class="invalid-feedback">Masukkan kata sandi Anda!</div>
            </div>

            <!-- Remember Me Checkbox -->
            <div class="form-check mb-3">
              <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
              <label for="rememberMe" class="form-check-label">Ingat Saya</label>
            </div>

            <!-- Submit Button -->
            <button class="btn btn-primary w-100 btn-lg mb-3" type="submit">Masuk</button>
          </form>

          <!-- Register Link -->
          <div class="text-center mt-2">
            <p class="small mb-0">Belum punya akun? <a href="{{ route('register.view') }}" class="text-decoration-none fw-bold text-primary">Daftar Sekarang</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Footer -->
  <footer id="footer" class="footer mt-auto ms-0">
    <div class="copyright">
      &copy; Copyright <strong><span>DigiSehat</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://bootstrapmade.com/">Kelompok VII</a>
    </div>
  </footer><!-- End Footer -->

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

    <script>
        // Menghapus localStorage 'loadingShown' setiap kali halaman login dibuka
        localStorage.removeItem('loadingShown');
    </script>

</body>
</html>
