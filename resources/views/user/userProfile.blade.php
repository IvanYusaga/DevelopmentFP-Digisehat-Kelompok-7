@extends('mainUser')

@section('title', 'Dashboard')

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
          <img src="{{ $profil->profile_image ?? asset('style/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
          <h2>{{ auth()->user()->profil->nama_lengkap }}</h2>
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
                          @if(session('success'))
                            <div class="alert alert-success">
                              {{ session('success') }}
                            </div>
                          @endif
                          
                            <h5 class="card-title">Profile Details</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nama Lengkap</div>
                                <div class="col-lg-9 col-md-8">{{ $profil->nama_lengkap ?? 'Tidak tersedia' }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Usia</div>
                                <div class="col-lg-9 col-md-8">{{ $profil->usia ?? 'Tidak tersedia' }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                <div class="col-lg-9 col-md-8">{{ $profil->jenis_kelamin ?? 'Tidak tersedia' }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Riwayat Penyakit</div>
                                <div class="col-lg-9 col-md-8">{{ $profil->riwayat_penyakit ?? 'Tidak tersedia' }}</div>
                            </div>

                            <div class="row">
                              <a href="{{ route('profile.edit', $profil->id_profil) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i> Edit Profile
                              </a>
                            </div>
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
