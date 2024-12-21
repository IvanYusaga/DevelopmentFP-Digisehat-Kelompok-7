@extends('mainUser')

@section('title', 'Ubah Password')

@section('breadcrumbs')
<main id="main" class="main">

    <div class="pagetitle">
        <h1 class="text-center">Ubah Password Anda</h1>
        <br>
    </div>
@endsection

@section('content')
<section class="section profile">
    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="card">
                <div class="card-body pt-8">
                    <h5 class="card-title text-center">Ganti Password</h5>

                    <form action="{{ route('changePassword.post') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="password" type="password" autocomplete="off" class="form-control form-control-sm" id="currentPassword" required>
                                @error('password')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-octagon me-1"></i>
                                        {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="newpassword" type="password" autocomplete="off" class="form-control form-control-sm" id="newPassword" placeholder="Min:10; Special Char(@#$_); Use Number(0-9); Use Capitalization(A-Z, a-z);" required>
                                
                                <!-- Password Strength Bar -->
                                <div class="progress mt-2" style="height: 8px;">
                                    <div id="password-strength-bar" class="progress-bar" role="progressbar"></div>
                                </div>
                                <small id="password-strength-text" class="text-muted"></small>

                                @error('newpassword')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-octagon me-1"></i>
                                        {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Re-enter New Password -->
                        <div class="row mb-3">
                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="newpassword_confirmation" type="password" autocomplete="off" class="form-control form-control-sm" id="renewPassword" required>
                                @error('newpassword_confirmation')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-octagon me-1"></i>
                                        {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    const passwordField = document.getElementById("newPassword");
    const strengthBar = document.getElementById("password-strength-bar");
    const strengthText = document.getElementById("password-strength-text");

    // Event Listener untuk menghitung kekuatan password
    passwordField.addEventListener("input", () => {
        const password = passwordField.value;
        const strengthScore = calculateStrength(password);
        updateStrengthBar(strengthScore);
    });

    function calculateStrength(password) {
        let score = 0;
        if (password.length >= 10) score += 15; // Panjang minimal 10
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) score += 25; // Karakter spesial
        if (/\d/.test(password)) score += 20; // Angka
        if (/[a-z]/.test(password)) score += 20; // Huruf kecil
        if (/[A-Z]/.test(password)) score += 20; // Huruf besar

        return Math.min(score, 100); // Maksimal skor 100
    }

    function updateStrengthBar(score) {
        let level;

        if (score < 25) {
            level = { text: "Very Weak", color: "danger" };
        } else if (score < 50) {
            level = { text: "Weak", color: "warning" };
        } else if (score < 90) {
            level = { text: "Good", color: "info" };
        } else {
            level = { text: "Strong", color: "success" };
        }

        strengthBar.style.width = `${score}%`;
        strengthBar.className = `progress-bar bg-${level.color}`;
        strengthText.textContent = `Strength: ${level.text}`;
    }
</script>
</main>

@endsection


