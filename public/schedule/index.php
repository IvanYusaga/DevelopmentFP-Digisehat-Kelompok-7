<?php
session_start(); // Pastikan sesi dimulai di awal

// Cek apakah token CSRF ada dalam sesi
if (isset($_SESSION['XSRF-TOKEN'])) {
    // Ambil token CSRF dari sesi pengguna
    $token = $_SESSION['XSRF-TOKEN'];

    // Tambahkan token ke header Authorization
    header('Authorization: Bearer ' . $token);

    // Redirect ke halaman /user/jadwal dengan parameter status=success
    header('Location: /user/jadwal?status=success');
    exit();
} else {
    // Token CSRF tidak ditemukan dalam sesi
    // Buat token CSRF baru dan simpan dalam sesi
    $_SESSION['XSRF-TOKEN'] = bin2hex(random_bytes(32)); // Menghasilkan token acak yang aman

    // Simpan token CSRF ke dalam cookie untuk client-side (optional)
    setcookie('XSRF-TOKEN', $_SESSION['XSRF-TOKEN'], time() + 3600, '/', '', false, true); // Set cookie

    // Redirect ke halaman sebelumnya agar token baru tersedia
    header('Location: /user/jadwal');
    exit();
}
?>
