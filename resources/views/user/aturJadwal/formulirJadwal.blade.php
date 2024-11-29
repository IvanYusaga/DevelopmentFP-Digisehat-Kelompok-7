@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
<main id="main" class="main">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <!-- Form Section -->
        <div class="col-md-12">
            <h2 class="text-center mb-4">Pengingat Obat</h2>
            <form class="row g-3" id="scheduleForm" action="" method="POST">
                @csrf
                <div class="col-12">
                    <label for="inputNamaObat" class="form-label">Nama Obat</label>
                    <select class="form-control" id="inputNamaObat" name="id_obat" onchange="populateObatDetails()">
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
                <!-- Cara Pengguna Obat -->
                <div class="col-12">
                    <label for="inputGunaObat" class="form-label">Cara Pengguna Obat:</label>
                    <input type="text" id="inputGunaObat" class="form-control" required>
                </div>
                <!-- Jumlah Obat -->
                <div class="col-12">
                    <label for="inputJumlahObat" class="form-label">Jumlah Obat:</label>
                    <input type="number" id="inputJumlahObat" class="form-control" placeholder="Masukkan jumlah obat" required>
                </div>
                <!-- Tanggal Mulai -->
                <div class="col-12">
                    <label for="inputDate" class="form-label">Tanggal Pengingat:</label>
                    <input type="date" id="inputDate" class="form-control">
                </div>
                <!-- Waktu Pengingat -->
                <div class="col-12">
                    <label for="inputTime" class="form-label">Waktu Pengingat:</label>
                    <input type="time" id="inputTime" class="form-control">
                </div>
                <!-- Frekuensi Minum Obat -->
                <div class="col-12">
                    <label for="inputFrekuensi" class="form-label">Frekuensi Minum Obat (Per Hari):</label>
                    <select id="inputFrekuensi" class="form-select">
                        <option>Pilih</option>
                        <option value="1">1 kali dalam sehari</option>
                        <option value="2">2 kali dalam sehari</option>
                        <option value="3">3 kali dalam sehari</option>
                        <option value="4">4 kali dalam sehari</option>
                        <option value="5">5 kali dalam sehari</option>
                    </select>
                </div>
                
                <!-- Button untuk Jadwalkan Reminder -->
                <button type="button" class="btn btn-primary w-100">Jadwalkan Reminder</button>
            </form>
        </div>
    </div>
</div>

<script>
    function populateObatDetails() {
        // Ambil elemen dropdown
        const obatSelect = document.getElementById('inputNamaObat');

        // Ambil opsi yang dipilih
        const selectedOption = obatSelect.options[obatSelect.selectedIndex];

        // Validasi jika pengguna belum memilih obat
        if (selectedOption.value === "") {
            document.getElementById('inputGunaObat').value = ''; // Kosongkan input Cara Pengguna Obat
            return;
        }

        // Ambil data dari atribut opsi yang dipilih
        const penggunaan_obat = selectedOption.getAttribute('data-penggunaanobat');

        // Isi input form dengan data yang sesuai
        document.getElementById('inputGunaObat').value = penggunaan_obat || '';
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
            document.getElementById('inputGunaObat').value = ''; // Kosongkan input
            return;
        }

        // Ambil data dari atribut opsi yang dipilih
        const penggunaan_obat = selectedOption.getAttribute('data-penggunaanobat');

        // Isi input form dengan data yang sesuai
        document.getElementById('inputGunaObat').value = penggunaan_obat || '';
    }
</script>
@endsection
