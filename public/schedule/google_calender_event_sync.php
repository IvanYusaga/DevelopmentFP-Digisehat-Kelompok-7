<?php
session_start(); // Pastikan sesi dimulai di awal
include_once 'GoogleCalendarApi.class.php';
require_once 'dbConfig.php';

// Pastikan Anda sudah mengonfigurasi kredensial API Google
define('GOOGLE_CLIENT_ID', 'your_client_id');
define('REDIRECT_URI', 'your_redirect_uri');
define('GOOGLE_CLIENT_SECRET', 'your_client_secret');

$statusMsg = '';
$status = 'danger';

if (isset($_GET['code']) || isset($_POST['update_event']) || isset($_POST['delete_event'])) {
    // Inisialisasi API Google Calendar
    $GoogleCalendarApi = new GoogleCalendarApi();

    // Ambil access token dari session, jika tidak ada, minta token baru
    $access_token = $_SESSION['google_access_token'] ?? null;
    if (empty($access_token) && isset($_GET['code'])) {
        $data = $GoogleCalendarApi->GetAccessToken(GOOGLE_CLIENT_ID, REDIRECT_URI, GOOGLE_CLIENT_SECRET, $_GET['code']);
        $access_token = $data['access_token'];
        $_SESSION['google_access_token'] = $access_token;
    }

    if (empty($access_token)) {
        $statusMsg = 'Access token tidak tersedia.';
        $_SESSION['status_response'] = array('status' => 'danger', 'status_msg' => $statusMsg);
        header("Location: index.php");
        exit();
    }

    // Mengambil ID event terakhir yang disimpan di sesi
    $event_id = $_SESSION['last_event_id'] ?? null;

    // Menambahkan event baru
    if (isset($_GET['code'])) {
        // Ambil detail event dari database
        $sqlQ = "SELECT * FROM calendar WHERE id = ?";
        $stmt = $db->prepare($sqlQ);
        $stmt->bind_param("i", $event_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $eventData = $result->fetch_assoc();

        if (!empty($eventData)) {
            $tanggal_mulai = $eventData['tanggal_mulai'];
            $tanggal_selesai = $eventData['tanggal_selesai'];
            $waktu_pengingat = $eventData['waktu_pengingat'];
            $interval_minutes = 5; // Interval waktu pengingat, misal 5 menit

            $calendar_event = array(
                'summary' => $eventData['nama_obat'],
                'description' => "Waktunya konsumsi obat: {$eventData['nama_obat']} | Cara Penggunaan Obat: {$eventData['deskripsi']}"
            );

            $current_date = $tanggal_mulai;

            $google_event_ids = []; // Untuk menyimpan ID event dari Google Calendar

            while (strtotime($current_date) <= strtotime($tanggal_selesai)) {
                $event_datetime = array(
                    'event_date' => $current_date,
                    'start_time' => $waktu_pengingat,
                    'end_time' => date("H:i:s", strtotime($waktu_pengingat) + ($interval_minutes * 60))
                );

                try {
                    $user_timezone = $GoogleCalendarApi->GetUserCalendarTimezone($access_token);

                    // Buat event di Google Calendar
                    $google_event_id = $GoogleCalendarApi->CreateCalendarEvent(
                        $access_token,
                        'primary',
                        $calendar_event,
                        0,
                        $event_datetime,
                        $user_timezone
                    );

                    if ($google_event_id) {
                        $google_event_ids[] = $google_event_id;
                    }
                } catch (Exception $e) {
                    $statusMsg = 'Gagal menambah event ke Google Calendar: ' . $e->getMessage();
                }

                // Perbarui tanggal untuk loop berikutnya
                $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
            }

            // Simpan satu record di database setelah semua event dibuat
            if (!empty($google_event_ids)) {
                $stmt = $db->prepare("UPDATE calendar SET google_calendar_event_id = ? WHERE id = ?");
                $stmt->bind_param("si", json_encode($google_event_ids), $event_id);
                $stmt->execute();
                unset($_SESSION['last_event_id']);
                unset($_SESSION['google_access_token']);
            }
            $status = 'success';
            $statusMsg = '<p>Event berhasil ditambahkan ke Google Calendar!</p>';
            $statusMsg .= '<p><a href="https://calendar.google.com/calendar/" target="_blank"><i class="bi bi-calendar2-week-fill"></i>&nbsp;Buka Kalender</a></p>';
        } else {
            $statusMsg = 'Data event tidak ditemukan!';
        }
    }

    // Update event
    if (isset($_POST['update_event'])) {
        $event_id = $_POST['event_id'];
        $nama_obat = $_POST['nama_obat'];
        $deskripsi = $_POST['deskripsi'];
        $waktu_pengingat = $_POST['waktu_pengingat'];
        $tanggal_mulai = $_POST['tanggal_mulai'];
        $tanggal_selesai = $_POST['tanggal_selesai'];

        try {
            $calendar_event = array(
                'summary' => $nama_obat,
                'description' => "Dosis: $deskripsi",
            );

            $event_datetime = array(
                'event_date' => $tanggal_mulai,
                'start_time' => $waktu_pengingat,
                'end_time' => date("H:i:s", strtotime($waktu_pengingat) + 3600), // Durasi 1 jam
            );

            $user_timezone = $GoogleCalendarApi->GetUserCalendarTimezone($access_token);
            $GoogleCalendarApi->UpdateCalendarEvent(
                $access_token,
                'primary',
                $event_id,
                $calendar_event,
                0,
                $event_datetime,
                $user_timezone
            );

            // Perbarui data di database
            $sqlQ = "UPDATE calendar SET nama_obat = ?, deskripsi = ?, waktu_pengingat = ?, tanggal_mulai = ?, tanggal_selesai = ? WHERE google_calendar_event_id = ?";
            $stmt = $db->prepare($sqlQ);
            $stmt->bind_param("ssssss", $nama_obat, $deskripsi, $waktu_pengingat, $tanggal_mulai, $tanggal_selesai, $event_id);
            $stmt->execute();

            $status = 'success';
            $statusMsg = "Event berhasil diperbarui!";
        } catch (Exception $e) {
            $status = 'danger';
            $statusMsg = "Gagal memperbarui event: " . $e->getMessage();
        }
    }

    $_SESSION['status_response'] = array('status' => $status, 'status_msg' => $statusMsg);
    header("Location: index.php");
    exit();
}
?>
