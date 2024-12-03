@extends('mainUser')

@section('title', 'Edit Obat')

@section('breadcrumbs')
    <main id="main" class="main">
@endsection

@section('content')
<section class="section d-flex justify-content-center align-items-center" style="padding-left: 20px; margin-left: 20px;">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Edit Informasi Obat</h5>

            <!-- Form untuk Edit Data Obat -->
            <form action="{{ route('obat.update', $obat->id_obat) }}" method="POST" class="row g-3">
                @csrf
                @method('POST')
                <div class="col-12">
                    <label for="nama_obat" class="form-label text-primary">Nama Obat</label>
                    <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="{{ old('nama_obat', $obat->nama_obat) }}" required>
                </div>
                <div class="col-8">
                    <div class="col-sm-10">
                    <input type="hidden" id="date" name="date" class="form-control text-primary" value="{{ old('date', $obat->date) }}" required>
                </div>
                </div>
                <div class="col-12">
                    <label for="penggunaan_obat" class="form-label text-primary">Cara Penggunaan Obat</label>
                    <input type="text" class="form-control" id="penggunaan_obat" name="penggunaan_obat" value="{{ old('penggunaan_obat', $obat->penggunaan_obat) }}" required>
                </div>
                <div class="col-12">
                    <label for="deskripsi" class="form-label text-primary">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', $obat->deskripsi) }}" placeholder="Isi jam minum obat dan boleh jelaskan aturan pengguna obat" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-info rounded-pill text-white">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
      const dateInput = document.getElementById('date');
      const today = new Date();
      const yyyy = today.getFullYear();
      const mm = String(today.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
      const dd = String(today.getDate()).padStart(2, '0');
      
      // Formatkan tanggal menjadi yyyy-mm-dd
      const formattedDate = `${yyyy}-${mm}-${dd}`;
      
      // Tetapkan nilai default ke input
      dateInput.value = formattedDate;
  });
</script>
</section>
</main>
@endsection
