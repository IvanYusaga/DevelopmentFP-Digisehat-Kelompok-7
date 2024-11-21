@extends('mainUser')

@section('title', 'dashboard')

@section('breadcrumbs')
    <main id="main" class="main">

    <div class="pagetitle">
        <h1>Profil</h1>
        <br>
    </div>
@endsection

@section('content')
<section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="{{asset('style/assets/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
            <h2>Manusia Pentung</h2>
            <h3>Pengguna Obat</h3>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                  <div class="col-lg-9 col-md-8">Federico Valverde</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Usia</div>
                  <div class="col-lg-9 col-md-8">26</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                  <div class="col-lg-9 col-md-8">Laki-Laki</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Riwayat Penyakit</div>
                  <div class="col-lg-9 col-md-8">Demam, Batuk, ACL</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">fedevalverde@example.com</div>
                </div>
              </div>

            </div><!-- End Bordered Tabs -->
          </div>
        </div>
      </div>
    </div>
  </section>

    </main>
@endsection
