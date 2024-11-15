<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	// Menampilkan Tampilan View
	public function registerView()
	{
		if (Auth::check()) {
			return back();
		}
		return view('auth/register');
	}

	// Create Akun User
	public function registerPost(Request $request)
	{
		$request->validate([
			'nama_pengguna' => 'required|string|max:255',
			'email' => 'required|email',
			'username' => 'required|string|max:8',
			'password' => 'required|string',
		]);

		User::create([
			'nama_pengguna' => $request->nama_pengguna,
			'email' => $request->email,
			'username' => $request->username,
			'password' => Hash::make($request->password),
		]);

		return redirect()->route('login.view')->with('success', 'Anda berhasil membuat akun');
	}

	// Menampilkan Tampilan Login
	public function loginView()
	{
		if (Auth::check()) {
			return back();
		}
		return view('auth/login');
	}

	// Login User
	public function loginPost(Request $request)
	{
		$credentials = $request->validate([
			'username' => ['required'],
			'password' => ['required'],
		]);

		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();

			return redirect()->intended(route('userDashboard'));
		}

		return back()->withErrors([
			'username' => 'The provided credentials do not match our records.',
		])->onlyInput('username');
	}

	// Logout
	public function logout(Request $request)
	{
		Auth::logout();

		$request->session()->invalidate();

		$request->session()->regenerateToken();

		return redirect()->route('login.view');
	}
}
