@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Halo, {{ auth()->user()->profil->nama_lengkap ?? auth()->user()->nama_pengguna }}</h1>
        <h1>Selamat Datang di MediPulse</h1><br>

        @if (!auth()->user()->profil)
            <p>Yuk Lengkapi Profilemu! <a href="{{ route('profile.form') }}"><strong>Klik Disini</strong></a></p>
        @endif
        <br>
    </div>

@endsection

@section('content')
<div class="loading-page">
      <div class="img-container">
        <img src="{{ asset('/style/assets/img/logo-nobg.png') }}" alt="Pengingat Obat" />
      </div><br>
      <div class="name-container">
        <div class="logo-name">Website Pengingat Obat</div>
      </div>
    </div>
<section class="section dashboard">
    <div class="row">

            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">

                  <div class="card-body">
                    <h5 class="card-title">Jumlah obat</h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <img src="{{asset('style/assets/img/obat_dashboard.jpeg')}}" alt="" style="width: 40px; height: 40px;">
                      </div>
                      <div class="ps-3">
                        <h6>25</h6>
                        <span class="text-primary fw-bold small pt-2 ps-1">Obat yang telah di input</span>

                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">

                  <div class="card-body">
                    <h5 class="card-title">Jadwal obat</h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <img src="{{asset('style/assets/img/jumlah_jadwal.png')}}" alt="" style="width: 40px; height: 40px;">
                      </div>
                      <div class="ps-3">
                        <h6>25</h6>
                        <span class="text-primary fw-bold small pt-2 ps-1">Jumlah Jadwal</span>

                      </div>
                    </div>
                  </div>

                </div>
              </div>

            <div class="col-12">
                <h5 class="fw-bold text-primary mt-3">Jadwal Minum Obat</h5> <br>
            </div>

            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">

                  <div class="card-body">
                    <h5 class="card-title"></h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <img src="{{asset('style/assets/img/jadwal_minum_obat_dashboard.png')}}" alt="" style="width: 40px; height: 40px;">
                      </div>
                      <div class="ps-3">
                        <h6>Vit A</h6>
                        <span class="text-dark small pt-2 ps-1">1 Butir</span> <br>
                        <span class="text-dark small pt-2 ps-1">08.00</span>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">

                  <div class="card-body">
                    <h5 class="card-title"></h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <img src="{{asset('style/assets/img/jadwal_minum_obat_dashboard.png')}}" alt="" style="width: 40px; height: 40px;">
                      </div>
                      <div class="ps-3">
                        <h6>Vit B</h6>
                        <span class="text-dark small pt-2 ps-1">1 Butir</span> <br>
                        <span class="text-dark small pt-2 ps-1">09.00</span>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">

                  <div class="card-body">
                    <h5 class="card-title"></h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <img src="{{asset('style/assets/img/jadwal_minum_obat_dashboard.png')}}" alt="" style="width: 40px; height: 40px;">
                      </div>
                      <div class="ps-3">
                        <h6>Vit B</h6>
                        <span class="text-dark small pt-2 ps-1">1 Butir</span> <br>
                        <span class="text-dark small pt-2 ps-1">09.00</span>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

    </div>
</section>
</main>
@endsection
