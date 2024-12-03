@extends('mainUser')

@section('title', 'Dashboard')

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
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="card-title mb-1">Vitamin A</h5>
                    <a class="btn btn-info" href="userCekJadwalBtn">
                        <i class="bi bi-info-circle"></i> Cek Jadwal
                    </a>
                </div>
                <span class="text-primary fw-bold align-self-center">9/20 Obat</span>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="card-title mb-1">Paracetamol</h5>
                    <a class="btn btn-info" href="userCekJadwalBtn">
                        <i class="bi bi-info-circle"></i> Cek Jadwal
                    </a>
                </div>
                <span class="text-primary fw-bold align-self-center">9/20 Obat</span>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="card-title mb-1">Amoxicillin</h5>
                    <a class="btn btn-info" href="userCekJadwalBtn">
                        <i class="bi bi-info-circle"></i> Cek Jadwal
                    </a>
                </div>
                <span class="text-primary fw-bold align-self-center">9/20 Obat</span>
            </div>
        </div>
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
