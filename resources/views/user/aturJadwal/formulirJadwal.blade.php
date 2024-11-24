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
            <form class="row g-3" id="scheduleForm" action="{{ route('jadwalPengingat.store') }}" method="POST">
                    @csrf
                <div class="col-12">
                    <label for="inputNamaObat" class="form-label ">Nama Obat</label>
                    <select class="form-control" id="inputNamaObat" name="id_obat">
                        <option value="">Pilih Obat</option>
                        @foreach($obats as $obat)
                            <option value="{{ $obat->id_obat }}">{{ $obat->nama_obat }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Dosis -->
                <div class="col-12">
                    <label for="inputDosis" class="form-label">Dosis:</label>
                    <input type="text" id="inputDosis" class="form-control" placeholder="Masukkan dosis" required>
                </div>
                <!-- Jumlah Obat -->
                <div class="col-12">
                    <label for="inputJumlahObat" class="form-label">Jumlah Obat:</label>
                    <input type="number" id="inputJumlahObat" class="form-control " placeholder="Masukkan jumlah obat" required>
                </div>
                <!-- Tanggal Mulai -->
                <div class="col-12">
                    <label for="inputDate" class="form-label">Tanggal Mulai:</label>
                    <input type="date" id="inputDate" class="form-control">
                </div>
                <!-- Frekuensi Minum Obat -->
                <div class="col-12">
                    <label for="inputFrekuensi" class="form-label">Frekuensi Minum Obat (Per Hari):</label>
                    <select id="inputFrekuensi" class="form-select" onchange="updateTimeInputs()">
                        <option>Pilih</option>
                        <option value="1">1 kali</option>
                        <option value="2">2 kali</option>
                        <option value="3">3 kali</option>
                        <option value="4">4 kali</option>
                        <option value="5">5 kali</option>
                    </select>
                </div>
                <div id="timeInputsContainer"></div>

                <!-- Button untuk Jadwalkan Reminder -->
                <button type="button" class="btn btn-primary w-100" onclick="scheduleReminder()">Jadwalkan Reminder</button>
            </form>
        </div>

        <!-- Table Section -->
        <div class="col-md-12 mt-4">
            <h2 class="text-center mb-4">Daftar Pengingat Obat</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Obat</th>
                        <th>Dosis</th>
                        <th>Jumlah Obat</th>
                        <th>Waktu Pengingat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="reminderTableBody"></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Notification -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="notificationModalLabel">
                    Pengingat Obat: <span id="notifNamaObat"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('/style/assets/img/logo.jpg') }}" alt="Logo Obat" class="img-fluid me-3" style="width: 50px; height: 50px;">
                    <div>
                        <p id="notifDeskripsi"></p>
                        <small><strong>Frekuensi:</strong> <span id="notifFrekuensi"></span></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="closeReminder()">Sudah Minum</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeReminder()">Nanti</button>
            </div>
        </div>
    </div>
</div>

<audio src="{{ asset('audio/mixkit-positive-notification-951.wav') }}" id="notificationSound"></audio>

<script>
    // Set tanggal default ke hari ini
    document.getElementById("inputDate").value = new Date().toISOString().split("T")[0];

    const timeoutIds = [];

    function updateTimeInputs() {
        const frequency = parseInt(document.getElementById("inputFrekuensi").value);
        const timeInputsContainer = document.getElementById("timeInputsContainer");

        timeInputsContainer.innerHTML = ''; // Reset input sebelumnya
        for (let i = 1; i <= frequency; i++) {
            const label = document.createElement("label");
            label.classList.add("form-label");
            label.textContent = `Jam Minum ke-${i}:`;

            const input = document.createElement("input");
            input.type = "time";
            input.id = `timeInput${i}`;
            input.classList.add("form-control");
            input.required = true;

            timeInputsContainer.appendChild(label);
            timeInputsContainer.appendChild(input);
        }
    }

    function scheduleReminder() {
        const title = document.getElementById("inputNamaObat").value.trim();
    const description = document.getElementById("inputDosis").value.trim();
    const quantity = document.getElementById("inputJumlahObat").value.trim();
    const date = document.getElementById("inputDate").value;
    const frequency = parseInt(document.getElementById("inputFrekuensi").value);

    if (!title || !description || !quantity || !date || !frequency) {
        alert("Semua kolom harus diisi.");
        return;
    }

    const startDate = new Date(date);

    // Menjadwalkan pengingat sesuai frekuensi
    for (let day = 0; day < Math.ceil(quantity / frequency); day++) {
        const reminderDate = new Date(startDate.getTime() + day * 24 * 60 * 60 * 1000);
        for (let i = 1; i <= frequency; i++) {
            const timeInput = document.getElementById(`timeInput${i}`);
            if (!timeInput || !timeInput.value) {
                alert(`Jam Minum ke-${i} belum diatur.`);
                return;
            }

            const [hours, minutes] = timeInput.value.split(":");
            const reminderTime = new Date(reminderDate);
            reminderTime.setHours(hours, minutes);

            // Menambahkan pengingat ke tabel dan jadwal
            addReminder(title, description, quantity, reminderTime.toLocaleString());
            scheduleSingleReminder(title, description, quantity, reminderTime);
        }
    }

    }

    function scheduleSingleReminder(title, description, quantity, reminderTime) {
        const currentTime = new Date();

    if (reminderTime <= currentTime) {
        console.warn(`Waktu pengingat (${reminderTime}) sudah lewat.`);
        return;
    }

    const timeDifference = reminderTime - currentTime;

    const timeoutId = setTimeout(() => {
        const audio = document.getElementById("notificationSound");
        audio.play();

        // Perbarui konten modal
        document.getElementById("notifNamaObat").textContent = title;
        document.getElementById("notifDeskripsi").textContent = description;
        document.getElementById("notifFrekuensi").textContent = reminderTime.toLocaleString();

        // Tampilkan modal
        const notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
        notificationModal.show();

        // Jika notifikasi desktop diizinkan, tampilkan juga
        if (Notification.permission === "granted") {
            new Notification(title, { body: description, requireInteraction: true });
        }
        }, timeDifference);

        timeoutIds.push(timeoutId);
    }

    function addReminder(title, description, quantity, dateTimeString) {
        const tableBody = document.getElementById("reminderTableBody");
        const row = tableBody.insertRow();

        const titleCell = row.insertCell(0);
        const descriptionCell = row.insertCell(1);
        const quantityCell = row.insertCell(2); // Tambahkan kolom untuk jumlah obat
        const dateTimeCell = row.insertCell(3);
        const actionCell = row.insertCell(4);

        titleCell.textContent = title;
        descriptionCell.textContent = description;
        quantityCell.textContent = quantity;
        dateTimeCell.textContent = dateTimeString;
        actionCell.innerHTML = '<button class="btn btn-danger btn-sm" onclick="deleteReminder(this)">Hapus</button>';
    }

    function deleteReminder(button) {
        const row = button.closest("tr");
        const index = row.rowIndex - 1;
        timeoutIds.splice(index, 1);
        row.remove();
    }
</script>
@endsection
