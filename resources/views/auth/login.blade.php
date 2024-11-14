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
  <link href="{{asset('style/assets/img/favicon.png') }}" rel="icon">
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
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f7f9fc;
      padding-top: 50px;
    }

    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-body {
      padding: 30px;
    }

    .form-label {
      font-weight: 600;
    }

    .btn-primary {
      background-color: #0069d9;
      border-color: #0069d9;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #004085;
    }

    .credits {
      text-align: center;
      font-size: 0.875rem;
      margin-top: 20px;
    }

    .credits a {
      color: #0069d9;
    }

    .alert-danger {
      border-radius: 10px;
    }

    @media (max-width: 576px) {
      .container {
        padding: 10px;
      }
    }
  </style>

</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

        <!-- Logo Section -->
        <div class="d-flex justify-content-center py-4">
          <a href="index.html" class="logo d-flex align-items-center w-auto">
            <img src="{{asset('style/assets/img/logo.jpg')}}" alt="Logo" class="img-fluid">
            <span class="d-none d-lg-block">Medipulse</span>
          </a>
        </div>

        <!-- Card for Login -->
        <div class="card mb-3">
          <div class="card-body">

            <!-- Card Title and Description -->
            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4">Masuk ke Akun Anda</h5>
              <p class="text-center small">Masukkan nama pengguna &amp; kata sandi Anda untuk masuk</p>
          </div>

            <!-- Login Form -->
            <form action="{{ route('login.aksi') }}" method="POST" class="user row g-3 needs-validation" novalidate>
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Username Input -->
                <div class="col-12">
                    <label for="yourUsername" class="form-label">Nama Pengguna</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Masukkan nama pengguna Anda.</div>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="col-12">
                    <label for="yourPassword" class="form-label">Kata Sandi</label>
                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                    <div class="invalid-feedback">Masukkan kata sandi Anda!</div>
                </div>

                <!-- Remember Me Checkbox -->
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Ingat saya</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Masuk</button>
                </div>

                <!-- Register Link -->
                <div class="col-12">
                    <p class="small mb-0">Belum punya akun? <a class="small" href="{{ route('register') }}">&nbsp;Daftar di sini</a></p>
                </div>
            </form>
          </div>
        </div>

        <!-- Footer -->
        <div class="credits">
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>

      </div>
    </div>
  </div>

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
