@extends('mainUser')

@section('title', 'Tes BMI')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="row justify-content-center align-items-center g-4">
        <!-- Bagian Judul dan Gambar -->
        <div class="col-lg-6">
            <div class="pagetitle text-center text-lg-start">
                <h1>Yuk...</h1>
                <h1>Ukur Berat Badan Ideal (BMI)</h1>
                <h1>Kamu</h1>
                <br>
                <img src="{{asset('style/assets/img/BMI_logo.png')}}" alt="Doctor Illustration" class="img-fluid mt-3" style="max-width: 400px;">
            </div>
        </div>

        <!-- Bagian Form -->
        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body" style="background:#C8D9FA">
                    <h6 class="card-title text-center fw-bold mb-4">Mari Kita Cek</h6>
                    <form action="{{ route('user.hasilBMI') }}" method="POST" class="row g-3">
                        @csrf
                        <!-- Input Berat Badan -->
                        <div class="col-12">
                            <label for="inputBeratBadan" class="form-label">Berat Badan (kg)</label>
                            <input type="text" class="form-control rounded-pill" id="inputBeratBadan" name="beratBadan" placeholder="Masukkan berat badan">
                        </div>
                        <!-- Input Tinggi Badan -->
                        <div class="col-12">
                            <label for="inputTinggiBadan" class="form-label">Tinggi Badan (cm)</label>
                            <input type="text" class="form-control rounded-pill" id="inputTinggiBadan" name="tinggiBadan" placeholder="Masukkan tinggi badan">
                        </div>
                        <!-- Pilih Jenis Kelamin -->
                        <div class="col-12">
                            <label for="inputJenisKelamin" class="form-label">Jenis Kelamin</label>
                            <select id="inputJenisKelamin" name="jenisKelamin" class="form-select rounded-pill">
                                <option value="" disabled selected>Pilih...</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <!-- Tombol Submit -->
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-info rounded-pill text-white">Atur Sekarang</button>
                        </div>
                    </form>

                    <!-- Error Handling -->
                    @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
