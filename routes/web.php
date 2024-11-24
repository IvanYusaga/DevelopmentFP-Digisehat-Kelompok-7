<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ProfileController;

// **Halaman Login dan Register**
Route::get('/register', [AuthController::class, 'registerView'])->name('register.view');
Route::post('/registerPost', [AuthController::class, 'registerPost'])->name('register.post');
Route::get('/login', [AuthController::class, 'loginView'])->name('login.view');
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('login.post');

// **Halaman Awal**
Route::get('/', function () {
    return view('welcome');
});

// **Rute untuk Admin dengan Middleware**
Route::middleware([AdminMiddleware::class])->group(function () {
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
});

// **Rute untuk User dengan Middleware**
Route::middleware([UserMiddleware::class])->group(function () {
    // Dashboard User
    Route::get('/user/userDashboard', function () {
        return view('user.userDashboard');
    })->name('userDashboard');

    // Profile User
    Route::get('/user/userProfile', [ProfileController::class, 'profile'])->name('user.profile');
    Route::get('/user/userAddProfile', [ProfileController::class, 'index'])->name('profile.form');
    Route::post('/user/postProfile', [ProfileController::class, 'post'])->name('profile.post');
    Route::get('/user/editProfile/{id_profil}', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::post('/user/updateProfile/{id_profil}', [ProfileController::class, 'update'])->name('profile.update');

    // Manajemen Obat User
    Route::get('/user/checkStatusObat', [ObatController::class, 'checkStatusObat'])->name('checkStatusObat');
    Route::get('/user/formulirObat', [ObatController::class, 'index'])->name('obat.form');
    Route::post('/user/postObat', [ObatController::class, 'postObat'])->name('obat.post');
    Route::get('/user/informasiObat', [ObatController::class, 'informasiObat'])->name('informasiObat');
    Route::delete('/user/destroyObat/{id_obat}', [ObatController::class, 'destroy'])->name('obat.destroy');
    Route::get('/user/editObat/{id_obat}', [ObatController::class, 'editObat'])->name('obat.edit');
    Route::post('/user/updateObat/{id_obat}', [ObatController::class, 'updateObat'])->name('obat.update');

    // Jadwal User
    Route::get('/user/userJadwal', function () {
        return view('user.userJadwal');
    })->name('userJadwal');
    Route::get('/user/formulirJadwal', function () {
        return view('user.aturJadwal.formulirJadwal');
    });

    // Riwayat, Logbook, dan BMI
    Route::get('/user/userRiwayat', function () {
        return view('user.userRiwayat');
    })->name('userRiwayat');
    Route::get('/user/userLogbook', function () {
        return view('user.userLogbook');
    })->name('userLogbook');
    Route::get('/user/userBMI', function () {
        return view('user.userBMI');
    })->name('userBMI');
});

// **Rute Logout**
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');