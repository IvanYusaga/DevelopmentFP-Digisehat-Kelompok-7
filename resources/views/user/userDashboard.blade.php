@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Halo, {{ auth()->user()->profil->nama_lengkap ?? auth()->user()->nama_pengguna }}</h1>
        <h1>Selamat Datang di MediPulse</h1><br>

        @if (!auth()->user()->profil)
            <p>Yuk Lengkapi Profilmu! <a href="{{ route('profile.form') }}"><strong>Klik Disini</strong></a></p>
        @endif
        <br>
    </div>
@endsection

@section('content')
<section class="section dashboard">
    <div class="row">

        <!-- Jumlah Obat -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Obat</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <img src="{{ asset('style/assets/img/obat_dashboard.jpeg') }}" alt="" style="width: 40px; height: 40px;">
                        </div>
                        <div class="ps-3">
                            <h6>{{ $jumlahObat }}</h6>
                            <span class="text-primary fw-bold small pt-2 ps-1">Obat yang telah diinput</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Jadwal -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Jadwal</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <img src="{{ asset('style/assets/img/jumlah_jadwal.png') }}" alt="" style="width: 40px; height: 40px;">
                        </div>
                        <div class="ps-3">
                            <h6>{{ $jumlahJadwal }}</h6>
                            <span class="text-primary fw-bold small pt-2 ps-1">Jadwal yang telah diatur</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jadwal Minum Obat -->
        <div class="col-12">
            <h5 class="fw-bold text-primary mt-3">Jadwal Minum Obat</h5><br>
        </div>

        <!-- Slider -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach ($jadwalPengingat as $jadwal)
                <div class="swiper-slide">
                    <a href="{{ route('jadwal.view', ['id' => $jadwal->id_jadwal]) }}">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('style/assets/img/jadwal_minum_obat_dashboard.png') }}" alt="" style="width: 40px; height: 40px;">
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="mb-1" style="font-size: 1rem; font-weight: bold;">{{ $jadwal->obat->nama_obat }}</h6>
                                        <p class="mb-0 text-dark small" style="margin-top: 5px;">{{ $jadwal->tanggal_konsumsi }}</p>
                                        <p class="mb-0 text-dark small" style="margin-top: 3px;">{{ $jadwal->waktu_pengingat }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
</main>

<!-- Inisialisasi Swiper -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true, // Looping slider
            autoplay: {
                delay: 1500, // Mempercepat jeda antar slide (1.5 detik)
                disableOnInteraction: false, // Tetap autoplay meskipun user berinteraksi
            },
            speed: 800, // Kecepatan transisi antar slide (800ms)
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
        });
    });
</script>

@endsection

<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        padding: 20px;
    }

    .card-icon {
        background-color: #f1f1f1;
        border-radius: 50%;
        padding: 10px;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333;
    }

    .swiper-container {
        margin-top: 20px;
    }

    .swiper-slide {
        display: flex;
        justify-content: center;
        padding: 10px;
    }

    .swiper-slide a {
        width: 100%;
        text-decoration: none;
    }

    .swiper-slide .card {
        width: 100%;
        margin: 0 auto;
        background-color: #fff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .swiper-slide .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .swiper-slide .card-body {
        padding: 20px;
    }

    .swiper-slide .ps-3 {
        margin-left: 15px;
    }

    .swiper-slide .ps-3 h6 {
        font-size: 1rem;
        font-weight: bold;
    }

    .swiper-slide .ps-3 p {
        margin-top: 5px;
        font-size: 0.875rem;
        color: #555;
    }
</style>
