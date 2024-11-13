@extends('mainUser')

@section('title')

@section('breadcrumbs')
    <main id="main" class="main">
    <div class="pagetitle d-flex justify-content-between align-items-center">
        <h1>Berikut Informasi Obat Kamu</h1>
        <a href="formulirObat">
            <button type="button" class="btn btn-info rounded-pill text-white">Tambah</button>
        </a>
    </div>
@endsection

@section('content')

        <div class="card">
        <div class="card-body">

            <table class="table table-striped text-center">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name Obat</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Cara <br> Penggunaan Obat</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Paracetamol</td>
                    <td>2024-11-13</td>
                    <td>2 kali sehari</td>
                    <td>Pereda nyeri dan demam</td>
                    <td>
                        <a href="edit" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Ibuprofen</td>
                    <td>2024-11-10</td>
                    <td>3 kali sehari setelah makan</td>
                    <td>Anti-inflamasi dan pereda nyeri</td>
                    <td>
                        <a href="edit" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Amoxicillin</td>
                    <td>2024-10-25</td>
                    <td>2 kali sehari</td>
                    <td>Antibiotik untuk infeksi bakteri</td>
                    <td>
                        <a href="edit" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Loratadine</td>
                    <td>2024-09-18</td>
                    <td>1 kali sehari</td>
                    <td>Antihistamin untuk alergi</td>
                    <td>
                        <a href="edit" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Metformin</td>
                    <td>2024-08-20</td>
                    <td>2 kali sehari dengan makan</td>
                    <td>Obat diabetes tipe 2</td>
                    <td>
                        <a href="edit" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
            </tbody>
            </table>

        </div>
    </div>
</main>
@endsection

