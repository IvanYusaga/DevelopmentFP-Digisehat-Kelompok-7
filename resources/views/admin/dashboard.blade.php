@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <main id="main" class="main">

    <div class="pagetitle">
        <h1>Halo,Manusia Pentung</h1>
        <h1>Selamat Datang di MediPulse</h1><br>
            <p>Yuk Lengkapi Profilemu! <a href="profile"><strong>Klik Disini</strong></a></p>
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

      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">

          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Pengguna <span>| Tahun ini</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>1244</h6>
                    <span class="text-primary small pt-1 fw-bold">Pengguna</span>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Customers Card -->
        </div>
      </div><!-- End Left side columns -->
    </div>
  </section>
</main>
@endsection
