@extends('mainUser')

@section('title', 'Tes BMI')

@section('breadcrumbs')
<main id="main" class="main">

    <div class="d-flex align-items-center gap-4">
        <div class="pagetitle">
            <h1>Yuk...</h1>
            <h1>Ukur Berat Badan Ideal (BMI)</h1>
            <h1>Kamu</h1>
            <br>
            <img src="{{asset('style/assets/img/BMI_logo.png')}}" alt="Doctor Illustration" width="450">
        </div>

        <div class="col-lg-5 ms-auto d-flex justify-content-center align-items-center">
            <div class="card w-100">
                <div class="card-body" style="background:#C8D9FA">
                    <h6 class="card-title text-center fw-bold">Mari Kita Cek</h6>

                    <form action="{{ route('user.hasilBMI') }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label for="inputBeratBadan" class="form-label">Berat Badan</label>
                            <input type="text" class="form-control rounded-pill" id="inputBeratBadan" name="beratBadan">
                        </div>
                        <div class="col-12">
                            <label for="inputTinggiBadan" class="form-label">Tinggi Badan</label>
                            <input type="text" class="form-control rounded-pill" id="inputTinggiBadan" name="tinggiBadan">
                        </div>
                        <div class="col-md-4">
                            <label for="inputJenisKelamin" class="form-label">Jenis Kelamin</label>
                            <select id="inputJenisKelamin" name="jenisKelamin" class="form-select rounded-pill">
                                <option value="" disabled selected>Pilih...</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info rounded-pill text-white">Atur Sekarang</button>
                        </div>
                    </form>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
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
