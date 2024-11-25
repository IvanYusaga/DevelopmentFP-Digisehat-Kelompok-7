@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
{{-- @dd(auth()->check()) --}}
    <main id="main" class="main">

    <div class="pagetitle">
        <h1>Halo, {{ auth()->user()->nama_pengguna }}</h1>
        <h1>Selamat Datang di MediPulse</h1><br>
            <p>Yuk Lengkapi Profilemu! <a href="userProfile"><strong>Klik Disini</strong></a></p>
        <br>
    </div>
@endsection

@section('content')
<section class="section dashboard">
    <div class="row">

      <div class="col-lg-8">
        <div class="row">

          <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

              <div class="card-body">
                <h5 class="card-title">Jumlah Obat</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-capsule"></i>
                  </div>
                  <div class="ps-3">
                    <h6>1244</h6>
                    <span class="text-primary small pt-1 fw-bold">Obat yang telah di input</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
