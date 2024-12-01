@extends('mainUser')

@section('title', 'Ubah Password')

@section('breadcrumbs')
<main id="main" class="main">

    <div class="pagetitle">
        <h1 class="text-center">Ubah Password Anda</h1>
        <br>
    </div>
@endsection

@section('content')
<section class="section profile">
    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="card">
                <div class="card-body pt-8">
                    <h5 class="card-title text-center">Ganti Password</h5>

                    <form action="{{ route('changePassword.post') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="password" type="password" class="form-control form-control-sm" id="currentPassword" required>
                                @error('password')
                                  <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="newpassword" type="password" class="form-control form-control-sm" id="newPassword" required>
                                @error('newpassword')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="newpassword_confirmation" type="password" class="form-control form-control-sm" id="renewPassword" required>
                                @error('newpassword_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
@endsection
