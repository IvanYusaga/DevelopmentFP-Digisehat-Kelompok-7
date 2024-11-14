<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteRegistrar;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\AuthController;

//Halaman login dan register
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSimpan')->name('register.simpan');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAksi')->name('login.aksi');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::get('/', function () {
    return view('welcome');
});


//Buat Admin

Route::get('/admin/wireframe', function () {
    return view('admin.wireframe');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('adminDashboard');

Route::get('/admin/management', function () {
    return view('admin.management');
});

Route::get('/admin/profile', function () {
    return view('admin.profile');
});



//Buat User
Route::get('/user/userDashboard', function () {
    return view('user.userDashboard');
})->name('userDashboard');

Route::get('/user/userProfile', function () {
    return view('user.userProfile');
});

//Manajemen Obat User
Route::get('/user/userManagement', function () {
    return view('user.userManagement');
});

// Testing Fomulir Obat
Route::get('/user/formulirObat', [ObatController::class, 'index'])->name('obat.form');
Route::post('/user/postObat', [ObatController::class, 'postObat'])->name('obat.post');

Route::get('/user/informasiObat', [ObatController::class, 'informasiObat'])->name('informasiObat');
Route::delete('/user/destroyObat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');

Route::get('/user/editObat/{id}', [ObatController::class, 'editObat'])->name('obat.edit');
Route::post('/user/updateObat/{id}', [ObatController::class, 'updateObat'])->name('obat.update');


//Atur Jadwal User
Route::get('/user/userJadwal', function () {
    return view('user.userJadwal');
});

Route::get('/user/formulirJadwal', function () {
    return view('user.aturJadwal.formulirJadwal');
});

Route::get('/user/userRiwayat', function () {
    return view('user.userRiwayat');
});

Route::get('/user/userLogbook', function () {
    return view('user.userLogbook');
});

Route::get('/user/userBMI', function () {
    return view('user.userBMI');
});
