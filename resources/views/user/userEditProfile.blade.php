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
                    <img src="{{ $profil->profile_image ?? asset('style/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                    <h2>{{ auth()->user()->nama_pengguna }}</h2>
                    <h3>Pengguna Obat</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body pt-3">
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                            <form action="{{ route('profile.update', $profil->id_profil) }}" method="POST" enctype="multipart/form-data">
                                @csrf                      
                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                    <div class="col-md-8 col-lg-9">
                                        <img src="{{ $profil->profile_image ?? asset('style/assets/img/profile-img.jpg') }}" alt="Profile">
                                        <div class="pt-2">
                                            <input type="file" name="profile_image" class="form-control mt-2">
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="nama_lengkap" type="text" class="form-control" id="fullName" value="{{ old('nama_lengkap', $profil->nama_lengkap) }}">
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <label for="usia" class="col-md-4 col-lg-3 col-form-label">Usia</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="usia" type="number" class="form-control" id="usia" value="{{ old('usia', $profil->usia) }}">
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <label for="jenisKelamin" class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</label>
                                    <div class="col-md-8 col-lg-9">
                                        <select name="jenis_kelamin" class="form-control" id="jenisKelamin">
                                            <option value="Laki-Laki" {{ old('jenis_kelamin', $profil->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin', $profil->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <label for="riwayatPenyakit" class="col-md-4 col-lg-3 col-form-label">Riwayat Penyakit</label>
                                    <div class="col-md-8 col-lg-9">
                                        <textarea name="riwayat_penyakit" class="form-control" id="riwayatPenyakit">{{ old('riwayat_penyakit', $profil->riwayat_penyakit) }}</textarea>
                                    </div>
                                </div>
                            
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    </main>
@endsection
