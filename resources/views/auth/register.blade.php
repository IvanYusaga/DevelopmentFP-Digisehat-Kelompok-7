<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Medipulse - Register</title>
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

</head>
<body class="bg-gradient-primary">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

        <!-- Bagian Logo -->
        <div class="d-flex justify-content-center py-4">
          <a href="index.html" class="logo d-flex align-items-center w-auto">
            <img src="{{asset('style/assets/img/logo.jpg')}}" alt="Logo" class="img-fluid">
            <span class="d-none d-lg-block fs-4 fw-bold ms-2">Medipulse</span>
          </a>
        </div>
        <!-- Akhir Logo -->

        <!-- Kartu untuk Membuat Akun -->
        <div class="col-12 card shadow-lg mb-5 rounded-4 border-0">
          <div class="card-body p-4">

            <!-- Judul Kartu dan Deskripsi -->
            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4 fw-semibold">Buat Akun</h5>
              <p class="text-center small text-muted">Masukkan data pribadi Anda untuk membuat akun</p>
            </div>

            <!-- Formulir untuk Membuat Akun -->
            <form action="{{ route('register.simpan') }}" method="POST" class="user needs-validation" novalidate>
              @csrf

              <!-- Input Nama -->
              <div class="form-group mb-3">
                <label for="yourName" class="form-label">Nama Anda</label>
                <input type="text" name="name" class="form-control" id="yourName" required>
                <div class="invalid-feedback">Harap masukkan nama Anda!</div>
              </div>

              <!-- Input Email -->
              <div class="form-group mb-3">
                <label for="yourEmail" class="form-label">Email Anda</label>
                <input type="email" name="email" class="form-control" id="yourEmail" required>
                <div class="invalid-feedback">Harap masukkan alamat email yang valid!</div>
              </div>

              <!-- Input Username -->
              <div class="form-group mb-3">
                <label for="yourUsername" class="form-label">Nama Pengguna</label>
                <div class="input-group">
                  <span class="input-group-text" id="inputGroupPrepend">@</span>
                  <input type="text" name="username" class="form-control" id="yourUsername" required>
                  <div class="invalid-feedback">Harap pilih nama pengguna.</div>
                </div>
              </div>

              <!-- Input Password -->
              <div class="form-group mb-3">
                <label for="yourPassword" class="form-label">Kata Sandi</label>
                <input type="password" name="password" class="form-control" id="yourPassword" required>
                <div class="invalid-feedback">Harap masukkan kata sandi Anda!</div>
              </div>

              <!-- Konfirmasi Password -->
              <div class="form-group mb-3">
                <label for="yourPasswordConfirmation" class="form-label">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" class="form-control" id="yourPasswordConfirmation" required>
                <div class="invalid-feedback">Harap konfirmasi kata sandi Anda!</div>
              </div>

              <!-- Syarat dan Ketentuan -->
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="terms" id="acceptTerms" required>
                <label class="form-check-label" for="acceptTerms">Saya setuju dan menerima <a href="#">syarat dan ketentuan</a></label>
                <div class="invalid-feedback">Anda harus setuju sebelum mengirimkan.</div>
              </div>

              <!-- Tombol Kirim -->
              <div class="col-12 mb-3">
                <button class="btn btn-primary w-100" type="submit">Buat Akun</button>
              </div>

              <!-- Link Login -->
              <div class="col-12 text-center">
                <p class="small mb-0 text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Masuk di sini</a></p>
              </div>
            </form>

          </div>
        </div>
        <!-- Akhir Kartu -->

        <!-- Footer -->
        <div class="credits text-center py-3">
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
        <!-- End Footer -->

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