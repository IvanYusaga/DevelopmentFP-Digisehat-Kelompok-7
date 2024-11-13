@extends('main')

@section('title')

@section('breadcrumbs')
    <main id="main" class="main">

    <div class="pagetitle">
        <h1>Yuk Lihat Data Diri Pengguna</h1>
        <br>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-striped text-center datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Usia</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Riwayat Penyakit</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Vinicius Junior</td>
                    <td>23</td>
                    <td>Laki-Laki</td>
                    <td>Anterior Cruciate Ligament</td>
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
                    <td>Rodrygo Goes Da Silva</td>
                    <td>22</td>
                    <td>Laki-Laki</td>
                    <td>Angkle Sprain</td>
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
                    <td>Kylian Mbappe</td>
                    <td>26</td>
                    <td>Laki-Laki</td>
                    <td>Meniskus</td>
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
                    <td>Jude Bellingham</td>
                    <td>20</td>
                    <td>Laki-Laki</td>
                    <td>Quadriceps Strain</td>
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
                    <td>Luka Modric</td>
                    <td>39</td>
                    <td>Laki-Laki</td>
                    <td>Hamstring</td>
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
                    <th scope="row">6</th>
                    <td>Aurelien Tchouameni</td>
                    <td>26</td>
                    <td>Laki-Laki</td>
                    <td>Lower Back Pain</td>
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
                    <th scope="row">7</th>
                    <td>Ferland Mendy</td>
                    <td>29</td>
                    <td>Laki-Laki</td>
                    <td>Calf Strain</td>
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
                    <th scope="row">8</th>
                    <td>Antonio Rudiger</td>
                    <td>32</td>
                    <td>Laki-Laki</td>
                    <td>Shin Splints</td>
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
                    <th scope="row">9</th>
                    <td>Eder Militao</td>
                    <td>24</td>
                    <td>Laki-Laki</td>
                    <td>Achilles Tendonitis</td>
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
                    <th scope="row">10</th>
                    <td>Lucas Vazquez</td>
                    <td>30</td>
                    <td>Laki-Laki</td>
                    <td>Rupture</td>
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
                    <th scope="row">11</th>
                    <td>Thibaut Courtois</td>
                    <td>32</td>
                    <td>Laki-Laki</td>
                    <td>Concussion</td>
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
</div>

</main>
@endsection
