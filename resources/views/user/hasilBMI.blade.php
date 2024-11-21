@extends('mainUser')

@section('title', 'Dashboard')

@section('breadcrumbs')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Ini Hasil BMI Kamu...</h1>
    </div>

@endsection

@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2 class="font-weight-bold">{{ $kategori }}</h2>

                <img src="{{ $image }}" alt="BMI Illustration" width="100" class="my-4">
                <p class="text-primary">{{ $message }}</p>
                <p class="text-primary">{{ $advice }}</p>
            </div>
        </div>
    </div>
</main>
@endsection
