@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
<main id="main" class="main">

    <div class="pagetitle">
        <h1 class="text-center">Cek Jadwal Obat Paracetamol Kamu</h1> <br>
    </div>

@endsection

@section('content')
<div class="card shadow-sm border-0 rounded-3">
    <div class="card-header text-dark text-center py-2">
    </div>
    <div class="card-body p-4">
        <!-- Table -->
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
                    <tr>
                        <th scope="row">1</th>
                        <td>Paracetamol</td>
                        <td>20 Kali</td>
                        <td>14.00</td>
                        <td>Diminum</td>
                        <td>2 kali sehari</td>
                        <td>
                            <span class="badge bg-success text-wrap fs-6">
                                <i class="bi bi-check-circle"></i> Aktif
                            </span>
                        </td>
                        <td>
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">1</th>
                        <td>Paracetamol</td>
                        <td>20 Kali</td>
                        <td>14.00</td>
                        <td>Diminum</td>
                        <td>2 kali sehari</td>
                        <td>
                            <span class="badge bg-success text-wrap fs-6">
                                <i class="bi bi-check-circle"></i> Aktif
                            </span>
                        </td>
                        <td>
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">1</th>
                        <td>Paracetamol</td>
                        <td>20 Kali</td>
                        <td>14.00</td>
                        <td>Diminum</td>
                        <td>2 kali sehari</td>
                        <td>
                            <span class="badge bg-success text-wrap fs-6">
                                <i class="bi bi-check-circle"></i> Aktif
                            </span>
                        </td>
                        <td>
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">1</th>
                        <td>Paracetamol</td>
                        <td>20 Kali</td>
                        <td>14.00</td>
                        <td>Diminum</td>
                        <td>2 kali sehari</td>
                        <td>
                            <span class="badge bg-success text-wrap fs-6">
                                <i class="bi bi-check-circle"></i> Aktif
                            </span>
                        </td>
                        <td>
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">1</th>
                        <td>Paracetamol</td>
                        <td>20 Kali</td>
                        <td>14.00</td>
                        <td>Diminum</td>
                        <td>2 kali sehari</td>
                        <td>
                            <span class="badge bg-success text-wrap fs-6">
                                <i class="bi bi-check-circle"></i> Aktif
                            </span>
                        </td>
                        <td>
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                        </td>
                      </tr>
                </tbody>
            </table>
        </div>
             <!-- Tabel Vertikal untuk Perangkat Kecil -->
             <div class="table-responsive d-md-none">
                <!-- Tabel Pertama -->
                <div class="mb-3 p-2 border rounded">
                    <table class="table table-bordered table-striped mb-4"><!-- Tambahkan mb-4 untuk jarak antar tabel -->
                        <tbody>
                            <tr>
                                <th>Nama Obat</th>
                                <td>Paracetamol</td>
                            </tr>
                            <tr>
                                <th>Tanggal Konsumsi</th>
                                <td>20 Kali</td>
                            </tr>
                            <tr>
                                <th>Waktu Pengingat</th>
                                <td>14.00</td>
                            </tr>
                            <tr>
                                <th>Cara Penggunaan Obat</th>
                                <td>Diminum</td>
                            </tr>
                            <tr>
                                <th>Frekuensi</th>
                                <td>2 Kali Sehari</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge bg-success text-wrap fs-6">
                                        <i class="bi bi-check-circle"></i> Aktif
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Aksi</th>
                                <td>
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Tabel Kedua -->
                <div class="mb-3 p-2 border rounded">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>Nama Obat</th>
                                <td>Paracetamol</td>
                            </tr>
                            <tr>
                                <th>Tanggal Konsumsi</th>
                                <td>20 Kali</td>
                            </tr>
                            <tr>
                                <th>Waktu Pengingat</th>
                                <td>14.00</td>
                            </tr>
                            <tr>
                                <th>Cara Penggunaan Obat</th>
                                <td>Diminum</td>
                            </tr>
                            <tr>
                                <th>Frekuensi</th>
                                <td>2 Kali Sehari</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge bg-success text-wrap fs-6">
                                        <i class="bi bi-check-circle"></i> Aktif
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Aksi</th>
                                <td>
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
</main>
@endsection
