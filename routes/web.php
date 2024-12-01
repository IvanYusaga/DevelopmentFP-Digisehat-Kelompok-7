<?php

use App\Http\Middleware\UserLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\BMIController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JadwalPengingatController;
use App\Http\Controllers\SocialiteController;
use Laravel\Socialite\Facades\Socialite;

// Halaman login dan register
Route::get('/register', [AuthController::class, 'registerView'])->name('register.view');
Route::post('/registerPost', [AuthController::class, 'registerPost'])->name('register.post');

Route::get('/login', [AuthController::class, 'loginView'])->name('login.view');
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('login.post');

Route::get('/redirect', [SocialiteController::class, 'redirect'])->name('redirect');
Route::get('/callback', [SocialiteController::class, 'callback'])->name('callback');

// Halaman Awal
Route::get('/', function () {
    if (Auth::check()) {
        return back();
    }
    return view('welcome');
});

// Admin Routes
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

// User Routes
Route::middleware(UserLogin::class)->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
    Route::get('/user/userManagement', function () {
        return view('user.userManagement');
    })->name('userManagement');

    Route::get('/user/checkStatusObat', [ObatController::class, 'checkStatusObat'])->name('checkStatusObat');

    Route::get('/user/formulirObat', [ObatController::class, 'index'])->name('obat.form');
    Route::post('/user/postObat', [ObatController::class, 'postObat'])->name('obat.post');

    Route::get('/user/informasiObat', [ObatController::class, 'informasiObat'])->name('informasiObat');
    Route::delete('/user/destroyObat/{id_obat}', [ObatController::class, 'destroy'])->name('obat.destroy');

    Route::get('/user/editObat/{id_obat}', [ObatController::class, 'editObat'])->name('obat.edit');
    Route::post('/user/updateObat/{id_obat}', [ObatController::class, 'updateObat'])->name('obat.update');

    // Atur Jadwal User
    Route::get('/user/userJadwal', function () {
        return view('user.userJadwal');
    })->name('userJadwal');

    Route::get('/user/formulirJadwal', [JadwalPengingatController::class, 'create'])->name('jadwalPengingat.form');
    Route::post('/user/storeJadwal', [JadwalPengingatController::class, 'store'])->name('jadwalPengingat.store');

    Route::get('/user/userRiwayat', function () {
        return view('user.userRiwayat');
    })->name('userRiwayat');

    Route::get('/user/userLogbook', function () {
        return view('user.userLogbook');
    })->name('userLogbook');

    //Buat BMI
    Route::get('/user/userBMI', [BMIController::class, 'index'])->name('userBMI'); // Untuk menampilkan form
    Route::post('/user/hasilBMI', [BMIController::class, 'cekBMI'])->name('user.hasilBMI'); // Untuk memproses form
});

Route::get('/user/userDashboard', [ObatController::class, 'dashboard'])->name('userDashboard');

//route jadwal 
Route::get('/jadwal/create', [JadwalPengingatController::class, 'create'])->name('jadwal.create');
Route::post('/jadwal/store', [JadwalPengingatController::class, 'store'])->name('jadwal.store');


//Change Password
Route::get('/user/userPassword', function () {
    return view('user.userPassword');
});

//Add Password
Route::get('/user/userAddPass', function () {
    return view('user.userAddPass');
});
