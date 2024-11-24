@extends('mainUser')

@section('title', 'Add Profile')

@section('breadcrumbs')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tambah Profile</h1>
        <br>
    </div>
@endsection

@section('content')
<section class="section profile">
    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="card">
                <div class="card-body pt-3">
                    <h5 class="card-title">Lengkapi Profile Anda</h5>

                    <form action="{{ route('profile.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-3">
                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                            <div class="col-md-8 col-lg-9">
                                <input type="file" name="profile_image" class="form-control" id="profileImage" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="namaLengkap" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                            <div class="col-md-8 col-lg-9">
                                <input type="text" name="nama_lengkap" class="form-control" id="namaLengkap" placeholder="Masukkan Nama Lengkap Anda" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="usia" class="col-md-4 col-lg-3 col-form-label">Usia</label>
                            <div class="col-md-8 col-lg-9">
                                <input type="number" name="usia" class="form-control" id="usia" placeholder="Masukkan Usia Anda" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jenisKelamin" class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-md-8 col-lg-9">
                                <select name="jenis_kelamin" class="form-control" id="jenisKelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="riwayatPenyakit" class="col-md-4 col-lg-3 col-form-label">Riwayat Penyakit</label>
                            <div class="col-md-8 col-lg-9">
                                <textarea name="riwayat_penyakit" class="form-control" id="riwayatPenyakit" placeholder="Masukkan Riwayat Penyakit Anda (jika ada)" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Simpan Profil</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
@endsection
