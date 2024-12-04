<?php
// Include konfigurasi database
require_once 'dbConfig.php';

$postData = $statusMsg = $valErr = '';
$status = 'danger';

// Jika form disubmit
if (isset($_POST['submit'])) {
    // Ambil data dari form
    $nama_obat = !empty($_POST['inputNamaObat']) ? trim($_POST['inputNamaObat']) : '';
    $deskripsi = !empty($_POST['caraPenggunaanObat']) ? trim($_POST['caraPenggunaanObat']) : '';
    $waktu_pengingat = !empty($_POST['waktu_pengingat']) ? trim($_POST['waktu_pengingat']) : '';
    $tanggal_mulai = !empty($_POST['tanggal_konsumsi']) ? trim($_POST['tanggal_konsumsi']) : '';
    $tanggal_selesai = !empty($_POST['tanggal_selesai']) ? trim($_POST['tanggal_selesai']) : ''; // Tambahkan tanggal selesai
    $created_at = date('Y-m-d H:i:s');  // Menyimpan waktu sekarang

    // Validasi input
    if (empty($nama_obat)) {
        $valErr .= 'Harap masukkan nama obat.<br/>';
    }
    if (empty($tanggal_mulai)) {
        $valErr .= 'Harap masukkan tanggal mulai.<br/>';
    }
    if (empty($waktu_pengingat)) {
        $valErr .= 'Harap masukkan waktu pengingat.<br/>';
    }

     if (empty($valErr)) {
        // Query untuk menyimpan data pengingat
        $sqlQ = "INSERT INTO calendar (nama_obat, deskripsi, waktu_pengingat, tanggal_mulai, tanggal_selesai, created_at) 
                 VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $db->prepare($sqlQ);

        // Eksekusi query
        if ($stmt) {
            $stmt->bind_param("sssss", $nama_obat, $deskripsi, $waktu_pengingat, $tanggal_mulai, $tanggal_selesai);
            $insert = $stmt->execute();

            // Cek apakah data berhasil disimpan
            if ($insert) {
                $event_id = $stmt->insert_id;
                unset($_SESSION['postData']); // Hapus data form dari sesi

                // Simpan ID event ke sesi
                $_SESSION['last_event_id'] = $event_id;

                // Redirect ke Google OAuth
                header("Location: $googleOauthURL");
                exit();
            } else {
                $statusMsg = 'Terjadi kesalahan, silakan coba lagi.';
            }
            $stmt->close();
        } else {
            $statusMsg = 'Gagal menyiapkan query database, harap hubungi administrator.';
        }
    } else {
        $statusMsg = '<p>Harap lengkapi semua field yang wajib diisi:</p>' . trim($valErr, '<br/>');
    }
}


// Simpan status ke sesi untuk ditampilkan di halaman utama
$_SESSION['status_response'] = array('status' => $status, 'status_msg' => $statusMsg);

// Redirect kembali ke halaman utama
header("Location: index.php");
exit();
?>