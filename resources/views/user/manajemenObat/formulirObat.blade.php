@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <main id="main" class="main">
@endsection

@section('content')
<section class="section d-flex justify-content-center align-items-center" style="padding-left: 20px margin-left:20px">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-center">Formulir Manajemen Obat</h5>

        <form class="row g-3">
          <div class="col-12">
            <label for="inputNanme4" class="form-label text-primary">Nama Obat</label>
            <input type="text" class="form-control" id="inputNanme4" placeholder="">
          </div>
          <div class="col-8">
            <label for="inputDate" class="col-sm-2 col-form-label text-primary">Date</label>
            <div class="col-sm-10">
              <input type="date" class="form-control text-primary">
            </div>
          </div>
          <div class="col-12">
            <label for="inputPenggunaanObat" class="form-label text-primary">Cara Penggunaan Obat</label>
            <input type="text" class="form-control" id="inputPenggunaanObat" placeholder="">
          </div>
          <div class="col-12">
            <label for="inputDeskripsi" class="form-label text-primary">Deskripsi</label>
            <input type="text" class="form-control" id="inputDeskripsi" placeholder="Isi jam minum obat dan boleh jelaskan aturan pengguna obat">
          </div>
          <div class="text-center">
            <a href="informasiObat"><button type="button" class="btn btn-info rounded-pill text-white">Kirim</button></a>
          </div>
        </form>
      </div>
    </div>
</section>
</main>
@endsection



