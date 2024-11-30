@extends('mainUser')

@section('title', 'Add Profile')

@section('breadcrumbs')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Ubah Password</h1>
        <br>
    </div>
@endsection

@section('content')
<section class="section profile">
    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="card">
                <div class="card-body pt-8">
                    <h5 class="card-title">Ubah Password Anda</h5>

                    <form>
                        <div class="row mb-3">
                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                            <div class="col-md-8 col-lg-9">
                              <input name="password" type="password" class="form-control" id="currentPassword">
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                            <div class="col-md-8 col-lg-9">
                              <input name="newpassword" type="password" class="form-control" id="newPassword">
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                            <div class="col-md-8 col-lg-9">
                              <input name="renewpassword" type="password" class="form-control" id="renewPassword">
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
