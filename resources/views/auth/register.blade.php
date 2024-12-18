<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Medipulse - Register</title>

  <!-- Favicons -->
  <link rel="icon" href="{{ asset('/style/assets/img/logo-nobg.png') }}" type="image/png">
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
  <link href="{{asset('style/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">\

  <!-- Template Main CSS File -->
  <link href="{{asset('style/assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary" style="background: linear-gradient(to right, #cfdde6, #fff, #cfdde6);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

        <!-- Logo Section -->
      <div class="d-flex justify-content-center py-3">
        <a href="/" class="d-flex align-items-center text-decoration-none">
          <img src="{{ asset('style/assets/img/logo-nobg.png') }}" alt="Logo" class="img-fluid me-2" style="height: 50px;">
          <h2 class="fw-bold text-primary mb-0">Medipulse</h2>
        </a>
      </div>

           <!-- Kartu untuk Membuat Akun -->
        <div class="col-12 card shadow-lg mb-5 rounded-4 border-0">
          <div class="card-body">

            <!-- Pesan Error atau Sukses -->
            @if (session('error'))
              <div class="alert alert-danger text-center">
                {{ session('error') }}
              </div>
            @endif

            @if (session('success'))
              <div class="alert alert-success text-center">
                {{ session('success') }}
              </div>
            @endif

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <!-- Judul Kartu dan Deskripsi -->
            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4 fw-semibold">Buat Akun</h5>
              <p class="text-center small text-muted">Masukkan data pribadi Anda untuk membuat akun</p>
            </div>

            <!-- Login with Google -->
            <a href="{{ route('redirect') }}" class="text-decoration-none">
              <button class="btn btn-outline-light text-dark border border-primary w-100 btn-lg d-flex align-items-center justify-content-center mb-4" type="button">
                <i class="bi bi-google me-2 text-danger"></i>Lanjut Menggunakan Google
              </button>
            </a>
            
            <!-- Formulir untuk Membuat Akun -->
            <form action="{{ route('register.post') }}" method="POST" class="needs-validation" novalidate>
              @csrf

              <div class="form-group mb-3">
                <label for="yourName" class="form-label">Nama Pengguna</label>
                <input type="text" name="nama_pengguna" class="form-control" id="yourName" value="{{ old('nama_pengguna') }}" required>
                <div class="invalid-feedback">Harap masukkan nama pengguna Anda!</div>
              </div>

              <div class="form-group mb-3">
                <label for="yourEmail" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="yourEmail" value="{{ old('email') }}" required>
                <div class="invalid-feedback">Harap masukkan alamat email yang valid!</div>
              </div>

              <div class="form-group mb-3">
                <label for="yourPassword" class="form-label">Password</label>
                <div class="input-group">
                  <input type="password" name="password" class="form-control" id="yourPassword" required>
                  <div class="invalid-feedback">Harap masukkan kata sandi Anda!</div>
                </div>
              </div>

              <div class="form-group mb-3">
                <label for="yourPasswordConfirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="yourPasswordConfirmation" required>
                <div class="invalid-feedback">Harap konfirmasi kata sandi Anda!</div>
              </div>

               <!-- Tombol Kirim -->
              <div class="col-12 mb-3">
                <button class="btn btn-primary w-100" type="submit">Buat Akun</button>
              </div>

              <!-- Link Login -->
              <div class="col-12 text-center">
                <p class="small mb-0">Sudah punya akun? <a href="{{ route('login.view') }}" class="text-decoration-none fw-bold text-primary">Masuk di sini</a></p>
              </div>
            </form>

          </div>
        </div>
        <!-- Akhir Kartu -->

         <!-- Footer -->
         
        </div>
      </div>
    </div>
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

<script>
  function togglePassword() {
  const passwordField = document.getElementById("yourPassword");
  passwordField.type = passwordField.type === "password" ? "text" : "password";
  }
</script>
</body>
</html>
