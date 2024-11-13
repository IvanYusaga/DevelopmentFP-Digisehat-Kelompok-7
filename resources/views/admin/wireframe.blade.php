@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <main id="main" class="main">

    <div class="pagetitle">
        <h1>Halo,</h1>
        <h1>Selamat Datang di MediCare</h1><br>
            <p>Yuk Lengkapi Profilemu! <a href="https://facebook.com/"><strong>Klik Disini</strong></a></p>
    </div>
@endsection

@section('content')
    <!-- Tambahkan div dengan class "row" untuk grid layout -->
    <div class="row">
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pengguna Aktif</h5>
                    <div id="pieChart"></div>
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            new ApexCharts(document.querySelector("#pieChart"), {
                                series: [90, 10],
                                chart: {
                                    height: 350,
                                    type: 'pie',
                                    toolbar: { show: true }
                                },
                                labels: ['Active Users', 'Nonactive Users']
                            }).render();
                        });
                    </script>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Obat Pengguna</h5>
                    <div class="white-box">
                        Yuk cek perkembangan minum obat pengguna!
                    </div>
                    <a href="#" class="custom-button">Klik disini!</a>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection

@section('custom_css')
<style>
    #main {
        transition: margin-left 0.3s ease;
    }
    .sidebar-closed #main {
        margin-left: 50px;
        margin-right: 50px;
    }
    .card-body {
        background-color: #d08dd1;
        border-radius: 15px;
        text-align: center;
        color: white;
    }
    .white-box {
        background-color: white;
        color: black;
        border-radius: 8px;
        padding: 20px;
        margin: 20px 0;
        font-size: 1em;
        font-weight: 500;
    }
    .custom-button {
        background-color: white;
        color: #7a3eb2;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        font-weight: bold;
        text-decoration: none;
    }
    .custom-button:hover {
        background-color: #e2d8f7;
        color: #7a3eb2;
    }
</style>
@endsection

@section('custom_js')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const mainContent = document.querySelector("#main");
        const sidebarToggleBtn = document.querySelector(".toggle-sidebar-btn");

        sidebarToggleBtn.addEventListener("click", () => {
            // Tambahkan atau hapus kelas "sidebar-closed" pada body saat tombol sidebar diklik
            document.body.classList.toggle("sidebar-closed");
        });
    });
</script>
@endsection
