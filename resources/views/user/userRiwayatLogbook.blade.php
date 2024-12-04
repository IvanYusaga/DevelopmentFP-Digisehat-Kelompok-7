@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Riwayat Logbook Kamu...</h1>
        <br>
    </div>

    <div style="display: flex; align-items: center;">
        <div>
            <img src="{{asset('style/assets/img/Logbook_logo.png')}}" alt="Doctor Illustration" width="350">
        </div>
        <div style="margin-left: 20px;">
            <h5 class="text-primary text-center">
                Jalani pengobatan dengan disiplin. Lihat perubahan positif pada kesehatan Anda melalui lembar progres minum obat.
            </h5>
        </div>
    </div>
@endsection

@section('content')
<div class="container">
    <div class="progress-grid">
        <!-- Obat 1 -->
        <div class="progress-card">
            <div class="progress-circle" style="--progress: 67;">
                <div class="circle"></div>
                <div class="text">67%</div>
            </div>
            <div class="med-info">
                <p>Nama Obat</p>
                <p>Vitamin B</p>
            </div>
            <div class="med-info">
                <p>Dosis</p>
                <p>1 Tablet <br>
                (10/15 Obat)</p>
            </div>
        </div>

        <!-- Obat 2 -->
        <div class="progress-card">
            <div class="progress-circle" style="--progress: 75;">
                <div class="circle"></div>
                <div class="text">75%</div>
            </div>
            <div class="med-info">
                <p>Nama Obat</p>
                <p>Paracetamol</p>
            </div>
            <div class="med-info">
                <p>Dosis</p>
                <p>1 Tablet <br>
                (15/20 Obat)</p>
            </div>
        </div>

        <!-- Obat 3 -->
        <div class="progress-card">
            <div class="progress-circle" style="--progress: 100;">
                <div class="circle"></div>
                <div class="text">100%</div>
            </div>
            <div class="med-info">
                <p>Nama Obat</p>
                <p>Amoxicillin</p>
            </div>
            <div class="med-info">
                <p>Dosis</p>
                <p>1 Tablet <br>
                (20/20 Obat)</p>
            </div>
        </div>

        <!-- Obat 4 -->
        <div class="progress-card">
            <div class="progress-circle" style="--progress: 20;">
                <div class="circle"></div>
                <div class="text">20%</div>
            </div>
            <div class="med-info">
                <p>Nama Obat</p>
                <p>Ibuprofen</p>
            </div>
            <div class="med-info">
                <p>Dosis</p>
                <p>1 Tablet <br>
                (4/20 Obat)</p>
            </div>
        </div>
    </div>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .progress-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
    }

    .progress-card {
        background: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: left;
    }

    .progress-circle {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto 20px;
    }

    .progress-circle .circle {
        position: relative;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: conic-gradient(
            #1a56db calc(var(--progress) * 1%),
            #e5e7eb calc(var(--progress) * 1%)
        );
    }


Untuk mengubah progress bar agar sesuai dengan tampilan di gambar kedua (progress bar berbentuk lingkaran dengan bagian tengah kosong), kita dapat memperbarui bagian CSS yang mendefinisikan elemen .progress-circle. Berikut adalah langkah-langkah untuk mengimplementasikan perubahan tersebut:

CSS Diperbarui
Gunakan CSS gradient untuk membuat progress bar berbentuk lingkaran dengan bagian tengah kosong.
Atur ukuran lingkaran dalam lingkaran untuk menciptakan efek "hole" di tengah.
Berikut kode CSS yang telah dimodifikasi:

html
Copy code
<style>
    .progress-circle {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto 20px;
    }

    .progress-circle .circle {
        position: relative;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: conic-gradient(
            #1a56db calc(var(--progress) * 1%),
            #e5e7eb calc(var(--progress) * 1%)
        );
    }

    .progress-circle .circle::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 70%;
        height: 70%;
        background: white;
        border-radius: 50%;
        transform: translate(-50%, -50%);
    }

    .progress-circle .text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    .med-info {
        background: #f3f4f6;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 10px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .med-info p:first-child {
        color: #666;
        margin-bottom: 5px;
        font-size: 14px;
    }

    .med-info p:last-child {
        font-weight: 600;
        color: #333;
    }
</style>
</main>
@endsection