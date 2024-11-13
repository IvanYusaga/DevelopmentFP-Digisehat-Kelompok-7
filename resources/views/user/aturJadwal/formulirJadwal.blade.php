@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <main id="main" class="main">
@endsection

@section('content')
<section class="section d-flex justify-content-center align-items-center" style="padding-left: 20px; margin-left: 20px;">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-center">Atur Jadwal Obat</h5>

        <form class="row g-3" id="scheduleForm">
          <div class="col-12">
            <label for="inputNamaObat" class="form-label text-primary">Nama Obat</label>
            <input type="text" class="form-control" id="inputNamaObat" placeholder="">
          </div>
          <div class="col-12">
            <label for="inputDosis" class="form-label text-primary">Dosis</label>
            <input type="text" class="form-control" id="inputDosis" placeholder="">
          </div>
          <div class="col-12">
            <label for="inputJumlahObat" class="form-label text-primary">Jumlah Obat</label>
            <input type="text" class="form-control" id="inputJumlahObat" placeholder="">
          </div>
          <div class="col-12">
            <label for="inputFrekuensi" class="form-label text-primary">Frekuensi (Berapa kali minum obat)</label>
            <input type="text" class="form-control" id="inputFrekuensi" placeholder="">
          </div>
          <div class="col-12">
            <label for="inputDurasiPengingat" class="form-label text-primary">Durasi Pengingat (Hari)</label>
            <input type="text" class="form-control" id="inputDurasiPengingat" placeholder="">
          </div>
          <div class="col-8">
            <label for="inputDate" class="col-sm-4 col-form-label text-primary">Jadwal Pengingat</label>
            <div class="col-sm-10">
              <input type="date" class="form-control text-primary" id="inputDate">
            </div>
          </div>
        <div class="text-center mt-3">
            <a>
                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-info rounded-pill text-white" id="basic-info-trigger">Buka Pengingat di Google Calendar</button>
            </a>
        </div>
        </form>
      </div>
    </div>
</section>
</main>
@endsection
