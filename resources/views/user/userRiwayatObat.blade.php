@extends('mainUser')

@section('title', 'Riwayat Obat')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="container">
        <div class="progress-grid" id="progressGrid"></div>

        <div class="list-container">
            <div class="filter-buttons">
                <button class="filter-button active">Semua</button>
                <button class="filter-button">Selesai</button>
                <button class="filter-button">Belum</button>
            </div>
        </div>
@endsection

@section('content')
<!-- Medication Cards -->
@foreach($jadwalPengingat as $jadwal)
    <div class="card mb-3">
        <div class="card-body d-flex justify-content-between align-items-start">
            <div>
                <h5 class="card-title mb-1">{{ $jadwal->obat->nama_obat }}</h5> <!-- Nama Obat -->
                <a class="btn btn-info" href="{{ route('riwayatObat.cek', $jadwal->id_obat) }}">
                    <i class="bi bi-info-circle"></i> Cek Jadwal
                </a>
            </div>
            <!-- Menampilkan jumlah selesai / total per obat berdasarkan id_obat -->
            <span class="text-primary fw-bold align-self-center">
                {{ $statusCount[$jadwal->id_obat]['completed'] }}/{{ $statusCount[$jadwal->id_obat]['total'] }} Obat
            </span>
        </div>
    </div>
@endforeach
    </div>
</main>
@endsection

<style>
    .filter-buttons {
        margin-bottom: 20px;
    }

    .filter-button {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        margin-right: 10px;
        cursor: pointer;
        font-weight: 500;
    }

    .filter-button.active {
        background: #dbeafe;
        color: #1a56db;
    }

    .filter-button:not(.active) {
        background: transparent;
        color: #666;
    }
</style>
