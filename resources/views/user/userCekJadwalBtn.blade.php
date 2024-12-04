@extends('mainUser')

@section('title', 'Cek Jadwal Obat')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="text-center">Cek Jadwal Obat {{ $namaObat }} Kamu</h1> <br>
    </div>
@endsection

@section('content')
<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body p-4">
        <!-- Tabel Desktop -->
        <div class="table-responsive d-none d-md-block">
            <table class="table table-bordered table-striped table-hover text-center align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Tanggal Konsumsi</th>
                        <th scope="col">Waktu Pengingat</th>
                        <th scope="col">Cara Penggunaan Obat</th>
                        <th scope="col">Frekuensi</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwalPengingat as $index => $jadwal)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $jadwal->obat->nama_obat }}</td>
                        <td>{{ $jadwal->tanggal_konsumsi }}</td>
                        <td>{{ $jadwal->waktu_pengingat }}</td>
                        <td>{{ $jadwal->caraPenggunaanObat }}</td>
                        <td>{{ $jadwal->frekuensi }} Obat</td>
                        <td>
                            @if($jadwal->status == 'aktif')
                            <span class="badge bg-success text-wrap fs-6">
                                <i class="bi bi-check-circle"></i> Aktif
                            </span>
                            @else
                            <span class="badge bg-secondary text-wrap fs-6">
                                <i class="bi bi-clock"></i> Non aktif
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($jadwal->status == 'aktif')
                                <form action="{{ route('riwayatObat.selesai', $jadwal->id_jadwal) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-check-circle"></i> Selesai
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">Sudah Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">Tidak ada jadwal untuk obat ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Tabel Mobile -->
        <div class="table-responsive d-md-none">
            @forelse($jadwalPengingat as $jadwal)
            <div class="mb-3 p-2 border rounded">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>Nama Obat</th>
                            <td>{{ $jadwal->obat->nama_obat }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Konsumsi</th>
                            <td>{{ $jadwal->tanggal_konsumsi }}</td>
                        </tr>
                        <tr>
                            <th>Waktu Pengingat</th>
                            <td>{{ $jadwal->waktu_pengingat }}</td>
                        </tr>
                        <tr>
                            <th>Cara Penggunaan Obat</th>
                            <td>{{ $jadwal->caraPenggunaanObat }}</td>
                        </tr>
                        <tr>
                            <th>Frekuensi</th>
                            <td>{{ $jadwal->frekuensi }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($jadwal->status == 'Aktif')
                                <span class="badge bg-success text-wrap fs-6">
                                    <i class="bi bi-check-circle"></i> Aktif
                                </span>
                                @else
                                <span class="badge bg-secondary text-wrap fs-6">
                                    <i class="bi bi-clock"></i> Nonaktif
                                </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Aksi</th>
                            <td>
                                @if($jadwal->status == 'aktif')
                                    <form action="{{ route('riwayatObat.selesai', $jadwal->id_jadwal) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-check-circle"></i> Selesai
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">Sudah Selesai</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @empty
            <p class="text-center">Tidak ada jadwal untuk obat ini.</p>
            @endforelse
        </div>
    </div>
</div>
</main>
@endsection
