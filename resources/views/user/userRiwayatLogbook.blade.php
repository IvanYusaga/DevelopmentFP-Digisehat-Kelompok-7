@extends('mainUser')

@section('title', 'Riwayat Logbook')

@section('breadcrumbs')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Riwayat Logbook Kamu...</h1>
        <br>
    </div>

    <div style="display: flex; align-items: center;">
        <div>
            <img src="{{ asset('style/assets/img/Logbook_logo.png') }}" alt="Doctor Illustration" width="350">
        </div>
        <div style="margin-left: 20px;">
            <h5 class="text-primary text-center">
                Jalani pengobatan dengan disiplin. Lihat perubahan positif pada kesehatan Anda melalui lembar progres minum obat.
            </h5>
        </div>
    </div>

    <div class="container">
        <div class="progress-grid">
            @foreach($progressData as $data)
            <div class="progress-card">
                <div class="progress-circle" style="--progress: {{ $data['progress'] }};">
                    <div class="circle"></div>
                    <div class="text">{{ $data['progress'] }}%</div>
                </div>
                <div class="med-info">
                    <p>Nama Obat</p>
                    <p>{{ $data['nama_obat'] }}</p>
                </div>
                <div class="med-info">
                    <p>Frekuensi</p>
                    <p>{{ $data['frekuensi'] }} Kali Sehari <br>({{ $data['selesai'] }}/{{ $data['total'] }} Obat)</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection

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
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .progress-card {
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        text-align: center;
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
