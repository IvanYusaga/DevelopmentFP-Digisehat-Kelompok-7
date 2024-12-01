@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
<main id="main" class="main">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Pengingat Obat</h2>
            <form class="row g-3" id="scheduleForm" action="{{ route('jadwal.store') }}" method="POST">
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

                <div class="col-12">
                    <label for="inputGunaObat" class="form-label">Cara Pengguna Obat:</label>
                    <input type="text" id="inputGunaObat" class="form-control" name="dosis" required>
                </div>

                <div class="col-12">
                    <label for="inputJumlahObat" class="form-label">Jumlah Obat:</label>
                    <input type="number" id="inputJumlahObat" class="form-control" name="jumlah_obat" required>
                </div>

                <div class="col-12">
                    <label for="inputDate" class="form-label">Tanggal Konsumsi:</label>
                    <input type="date" id="inputDate" class="form-control" name="tanggal_konsumsi" required>
                </div>

                <div class="col-12">
                    <label for="inputTime" class="form-label">Durasi Pengingat (Menit):</label>
                    <input type="number" id="inputTime" class="form-control" name="durasi_pengingat" required>
                </div>

                <div class="col-12">
                    <label for="inputFrekuensi" class="form-label">Frekuensi Minum Obat (Per Hari):</label>
                    <select id="inputFrekuensi" class="form-select" name="frekuensi">
                        <option value="">Pilih</option>
                        <option value="1">1 kali dalam sehari</option>
                        <option value="2">2 kali dalam sehari</option>
                        <option value="3">3 kali dalam sehari</option>
                        <option value="4">4 kali dalam sehari</option>
                        <option value="5">5 kali dalam sehari</option>
                    </select>
                </div>

                <div class="col-12">
                    <label for="inputStatus" class="form-label">Status:</label>
                    <select id="inputStatus" class="form-select" name="status" required>
                        <option value="aktif">Aktif</option>
                        <option value="non-aktif">Non-Aktif</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Jadwalkan Reminder</button>
            </form>
        </div>
    </div>
</div>
<script>
    // Your existing JavaScript here...
</script>
@endsection
