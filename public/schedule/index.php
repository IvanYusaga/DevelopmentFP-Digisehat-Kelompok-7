<?php
// Pastikan cookie XSRF-TOKEN ada
if (isset($_COOKIE['XSRF-TOKEN'])) {
    // Decode nilai XSRF-TOKEN (biasanya Base64 encoded)
    $token = $_COOKIE['XSRF-TOKEN'];

    // Tambahkan token ke header Authorization
    header('Authorization: Bearer ' . $token);

    // Redirect ke halaman /user/jadwal
    header('Location: /user/jadwal');
    exit();
} else {
    // Token tidak ditemukan
    http_response_code(403);
    echo "Error: XSRF-TOKEN tidak ditemukan.";
    exit();
}
?>
