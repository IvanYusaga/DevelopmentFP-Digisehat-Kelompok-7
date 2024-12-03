@extends('mainUser')

@section('title')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between align-items-center">
        <h1>Berikut Informasi Obat Kamu</h1>
        <a href="{{ route('obat.form') }}">
            <button type="button" class="btn btn-info rounded-pill text-white">Tambah</button>
        </a>
    </div>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">
    <div class="card-body">
        <!-- Tabel Horizontal untuk Perangkat Besar -->
        <div class="table-responsive d-none d-md-block">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Cara <br> Penggunaan Obat</th>
                        <th scope="col" class="d-none d-md-table-cell">Deskripsi</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($obats as $index => $obat)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $obat->nama_obat }}</td>
                        <td>{{ $obat->date }}</td>
                        <td>{{ $obat->penggunaan_obat }}</td>
                        <td class="d-none d-md-table-cell">{{ $obat->deskripsi }}</td>
                        <td>
                            <a href="{{ route('obat.edit', $obat->id_obat) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('obat.destroy', $obat->id_obat) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus obat ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tabel Vertikal untuk Perangkat Kecil -->
        <div class="table-responsive d-md-none">
            @foreach($obats as $index => $obat)
            <div class="mb-3 p-2 border rounded"> <!-- Tambahkan jarak antar grup dengan mb-3 -->
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>Nama Obat</th>
                            <td>{{ $obat->nama_obat }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>{{ $obat->date }}</td>
                        </tr>
                        <tr>
                            <th>Cara Penggunaan Obat</th>
                            <td>{{ $obat->penggunaan_obat }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $obat->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th>Opsi</th>
                            <td>
                                <a href="{{ route('obat.edit', $obat->id_obat) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('obat.destroy', $obat->id_obat) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus obat ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endforeach
        </div>
    </div>
</div>


</main>
@endsection
