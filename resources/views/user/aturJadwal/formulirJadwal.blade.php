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
                    <label for="inputDate" class="form-label">Tanggal Pengingat:</label>
                    <input type="date" id="inputDate" class="form-control">
                </div>
                <!-- waktu pengingat -->
                <div class="col-12">
                    <label for="inputDate" class="form-label">Waktu Pengingat:</label>
                    <input type="time" id="inputDate" class="form-control">
                </div>
                <!-- Frekuensi Minum Obat -->
                <div class="col-12">
                    <label for="inputFrekuensi" class="form-label">Frekuensi Minum Obat (Per Hari):</label>
                    <select id="inputFrekuensi" class="form-select" onchange="updateTimeInputs()">
                        <option>Pilih</option>
                        <option value="1">1 kali dalam sehari</option>
                        <option value="2">2 kali dalam sehari</option>
                        <option value="3">3 kali dalam sehari</option>
                        <option value="4">4 kali dalam sehari</option>
                        <option value="5">5 kali dalam sehari</option>
                    </select>
                </div>
                
                <!-- Button untuk Jadwalkan Reminder -->
                <button type="button" class="btn btn-primary w-100" >Jadwalkan Reminder</button>
            </form>
        </div>

@endsection
