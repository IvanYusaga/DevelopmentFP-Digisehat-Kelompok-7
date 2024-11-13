@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <main id="main" class="main">
@endsection

@section('content')
<section class="section d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="text-center">
        <img src="{{asset('style/assets/img/OrangBingung.png')}}" alt="Orang Bingung" style="max-width: 300px; margin-bottom: 20px;">
        <br>
        <p>Saat ini kamu belum punya informasi obat kamu.<br>
            Yuk di isi informasi obat kamu!</p>
            <a href="formulirObat">
                <button type="button" class="btn btn-info rounded-pill text-white">Atur Sekarang</button>
            </a>
        </div>
</section>
</main>
@endsection
