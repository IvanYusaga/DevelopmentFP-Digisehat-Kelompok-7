@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
<main id="main" class="main">
@endsection

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-9 col-sm-12">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <h2 class="text-center my-4">Form Pengingat Obat</h2>
                    <form id="scheduleForm" action="{{ route('jadwal.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="inputNamaObat" class="form-label">Nama Obat</label>
                            <select class="form-select" id="inputNamaObat" name="id_obat" onchange="populateObatDetails()">
                                <option value="">Pilih Obat</option>
                                @foreach($obats as $obat)
                                    <option 
                                        value="{{ $obat->id_obat }}" 
                                        data-penggunaanobat="{{ $obat->penggunaan_obat ?? 'Tidak tersedia' }}">
                                        {{ $obat->nama_obat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="caraPenggunaanObat" class="form-label">Cara Penggunaan Obat</label>
                            <input type="text" id="caraPenggunaanObat" class="form-control" name="caraPenggunaanObat" required>
                        </div>

                        <div class="mb-3">
                            <label for="inputJumlahObat" class="form-label">Jumlah Obat</label>
                            <input type="number" id="inputJumlahObat" class="form-control" name="jumlah_obat" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="inputDate" class="form-label">Tanggal Mulai Konsumsi</label>
                                <input type="date" id="inputDate" class="form-control" name="tanggal_konsumsi" required>
                            </div>
                           <div class="mb-3 col-6">
                            <label for="inputFrekuensi" class="form-label">Frekuensi Minum Obat (Per Hari)</label>
                            <select id="inputFrekuensi" class="form-select" name="frekuensi" onchange="generateTimeInputs()">
                                <option value="">Pilih</option>
                                <option value="1">1 kali dalam sehari</option>
                                <option value="2">2 kali dalam sehari</option>
                                <option value="3">3 kali dalam sehari</option>
                                <option value="4">4 kali dalam sehari</option>
                                <option value="5">5 kali dalam sehari</option>
                            </select>
                        </div>
                        <div id="inputWaktuPengingatContainer" class="row"></div>
                        </div>

                        <div class="mb-3">
                            <label for="inputStatus" class="form-label">Status</label>
                            <select id="inputStatus" class="form-select" name="status">
                                <option value="aktif">Aktif</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="rentanghari" class="form-label">Ingin Melakukan Pengingat Berapa Lama?</label>
                            <select id="rentanghari" class="form-select" name="rentanghari">
                                <option value="">Pilih</option>
                                <option value="1">Hari ini saja</option>
                                <option value="3">3 Hari</option>
                                <option value="7">1 Minggu</option>
                                <option value="14">2 Minggu</option>
                                <option value="30">1 Bulan</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-info text-white w-100">Jadwalkan Reminder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Berhasil Kirim -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">
                    <i class="bi bi-check-circle-fill me-2"></i>Berhasil!
                </h5>
            </div>
            <!-- Body Modal -->
            <div class="modal-body p-4 d-flex flex-column align-items-center justify-content-center">
                <div class="text-center mb-4">
                    <img src="{{ asset('/style/assets/img/logo-nobg.png') }}" alt="Success Icon" class="img-fluid" style="width: 100px;">
                </div>
                <h4 class="fw-bold text-success mb-3">Data Berhasil Dikirim!</h4>
                <p class="text-muted fs-5 text-center">
                    Terima kasih telah menggunakan pengingat obat. Kami telah menyimpan jadwal pengingat Anda, dan Anda akan diberi notifikasi pada waktu yang tepat.
                </p>
                <p class="text-muted fs-6 text-center mt-2">
                    Jangan ragu untuk menghubungi kami jika ada pertanyaan atau kebutuhan lebih lanjut. Kami di sini untuk membantu Anda!
                </p>
            </div>
            <!-- Footer Modal -->
            <div class="modal-footer justify-content-center" style="background-color: #f8f9fa;">
                <button type="button" class="btn btn-success btn-lg rounded-pill px-5 shadow-sm" data-bs-dismiss="modal">
                    <i class="bi bi-check-circle me-2"></i> OK, Terima Kasih!
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function populateObatDetails() {
        // Ambil elemen dropdown
        const obatSelect = document.getElementById('inputNamaObat');
        // Ambil opsi yang dipilih
        const selectedOption = obatSelect.options[obatSelect.selectedIndex];
        // Validasi jika pengguna belum memilih obat
        if (selectedOption.value === "") {
            document.getElementById('caraPenggunaanObat').value = ''; // Kosongkan input Cara Pengguna Obat
            return;
        }
        // Ambil data dari atribut opsi yang dipilih
        const penggunaan_obat = selectedOption.getAttribute('data-penggunaanobat');
        // Isi input form dengan data yang sesuai
        document.getElementById('caraPenggunaanObat').value = penggunaan_obat || '';
    }
    
    // Menetapkan tanggal hari ini dan 30 hari ke depan
    const today = new Date();
    const maxDate = new Date();
    maxDate.setDate(today.getDate() + 30);
    // Format tanggal menjadi yyyy-mm-dd
    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }
    // Atur atribut min dan max pada input tanggal
    const inputDate = document.getElementById('inputDate');
    inputDate.min = formatDate(today);
    inputDate.max = formatDate(maxDate);
    // Mencegah klik di luar rentang dengan JavaScript
    inputDate.addEventListener('input', function () {
        const selectedDate = new Date(this.value);
        if (selectedDate < today || selectedDate > maxDate) {
            alert("Tanggal di luar rentang yang diperbolehkan.");
            this.value = ''; // Reset input jika tidak valid
        }
    });
    // Disable waktu di masa lalu jika tanggal hari ini dipilih
    const inputTime = document.getElementById('inputTime');
    inputDate.addEventListener('change', function () {
        const selectedDate = new Date(this.value);
        if (selectedDate.toDateString() === today.toDateString()) {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            inputTime.min = `${hours}:${minutes}`;
        } else {
            inputTime.min = '00:00'; // Reset jika bukan hari ini
        }
    });
    document.addEventListener("DOMContentLoaded", function () {
        const inputDate = document.getElementById('inputDate');
        const inputTime = document.getElementById('inputTime');
        // Dapatkan tanggal dan waktu sekarang
        const now = new Date();
        const today = now.toISOString().split("T")[0];
        const thirtyDaysLater = new Date(now);
        thirtyDaysLater.setDate(thirtyDaysLater.getDate() + 30);
        // Format tanggal 30 hari ke depan
        const maxDate = thirtyDaysLater.toISOString().split("T")[0];
        // Set nilai default untuk tanggal dan batasan
        inputDate.min = today; // Tidak boleh di masa lalu
        inputDate.max = maxDate; // Tidak boleh lebih dari 30 hari ke depan
        inputDate.value = today; // Set nilai default hari ini
        // Set nilai default untuk waktu
        const currentTime = now.toTimeString().split(" ")[0].slice(0, 5); // Format HH:MM
        inputTime.value = currentTime;
    });
    function populateObatDetails() {
        // Ambil elemen dropdown
        const obatSelect = document.getElementById('inputNamaObat');
        // Ambil opsi yang dipilih
        const selectedOption = obatSelect.options[obatSelect.selectedIndex];
        // Validasi jika pengguna belum memilih obat
        if (selectedOption.value === "") {
            document.getElementById('caraPenggunaanObat').value = ''; // Kosongkan input
            return;
        }
        // Ambil data dari atribut opsi yang dipilih
        const penggunaan_obat = selectedOption.getAttribute('data-penggunaanobat');
        // Isi input form dengan data yang sesuai
        document.getElementById('caraPenggunaanObat').value = penggunaan_obat || '';
    }

    // Ketika form disubmit
    $(document).ready(function () {
        $('#scheduleForm').submit(function (e) {
            e.preventDefault(); // Hentikan form agar tidak langsung mengirim

            // Kirim data form menggunakan AJAX
            $.ajax({
                url: $(this).attr('action'),  // Ambil URL dari atribut action form
                type: 'POST',
                data: $(this).serialize(),  // Serialize data form
                success: function (response) {
                    // Tampilkan modal sukses
                    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();

                    // Redirect setelah 2 detik
                    setTimeout(function () {
                        window.location.href = '/user/jadwal';  // Ganti dengan URL yang sesuai
                    }, 2000);
                },
                error: function () {
                    alert('Terjadi kesalahan, coba lagi!');
                }
            });
        });
    });

    document.getElementById('inputFrekuensi').addEventListener('change', function() {
        const container = document.getElementById('inputWaktuPengingatContainer');
        container.innerHTML = ''; // Reset container
        const jumlah = parseInt(this.value, 10);

        for (let i = 1; i <= jumlah; i++) {
            container.innerHTML += `
                <div class="col-4 mx-auto">
                    <label for="inputWaktuPengingat${i}" class="form-label">Jam Pengingat ${i}</label>
                    <input type="time" class="form-control" name="waktu_pengingat[]" id="inputWaktuPengingat${i}" required>
                </div>
            `;
        }
    });

</script>
@endsection
