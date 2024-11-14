<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
	public function register()
	{
		return view('auth/register');
	}

	public function registerSimpan(Request $request)
	{
		Validator::make($request->all(), [
			'nama' => 'required',
			'email' => 'required|email',
			'password' => 'required|confirmed'
		])->validate();

		User::create([
			'nama' => $request->nama,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'level' => 'USER'
		]);

		return redirect()->route('login');
	}

	public function login()
	{
		return view('auth/login');
	}

	public function loginAksi(Request $request)
{
    // Validasi input email dan password
    Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required'
    ])->validate();

    // Cek kredensial pengguna
    if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        // Jika gagal, kembalikan dengan pesan error spesifik
        return back()->withErrors([
            'login_error' => 'Email dan Password Yang Anda Masukkan Itu SALAH!'
        ])->withInput(); // Mengembalikan input ke halaman sebelumnya
    }

    // Regenerasi session untuk keamanan
    $request->session()->regenerate();
	if (Auth::user()->level === 'admin') {
        // Jika level admin, redirect ke halaman dashboard admin
        return redirect()->route('adminDashboard');  // Pastikan route ini ada
    } else {
        // Jika level user, redirect ke halaman dashboard user
        return redirect()->route('userDashboard');  // Pastikan route ini ada
    }
}

	public function logout(Request $request)
	{
		Auth::guard('web')->logout();

		$request->session()->invalidate();

		return redirect('/');
	}
}