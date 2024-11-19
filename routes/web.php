<?php
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\UserLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ObatController;

// Halaman login dan register
Route::get('/register', [AuthController::class, 'registerView'])->name('register.view');
Route::post('/registerPost', [AuthController::class, 'registerPost'])->name('register.post');
Route::get('/login', [AuthController::class, 'loginView'])->name('login.view');
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('login.post');

// Halaman Awal
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
    Route::get('/user/userDashboard', function () {
        return view('user.userDashboard');
    })->name('userDashboard');
    Route::get('/user/userProfile', function () {
        return view('user.userProfile');
    });
    Route::get('/user/userManagement', function () {
        return view('user.userManagement');
    });
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

    
    // Rute untuk formulir dan manajemen obat
    Route::get('/user/formulirObat', [ObatController::class, 'index'])->name('obat.form');
    Route::post('/user/postObat', [ObatController::class, 'postObat'])->name('obat.post');
    Route::get('/user/informasiObat', [ObatController::class, 'informasiObat'])->name('informasiObat');
    Route::delete('/user/destroyObat/{id_obat}', [ObatController::class, 'destroy'])->name('obat.destroy');
    Route::get('/user/editObat/{id_obat}', [ObatController::class, 'editObat'])->name('obat.edit');
    Route::post('/user/updateObat/{id_obat}', [ObatController::class, 'updateObat'])->name('obat.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');