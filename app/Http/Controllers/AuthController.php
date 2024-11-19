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
        'role' => 'user', 
    ]);

    return redirect()->route('login.view')->with('success', 'Akun berhasil dibuat');
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
        'username' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Arahkan berdasarkan peran user
        if (Auth::user()->role === 'admin') {
            return redirect()->route('adminDashboard');
        } elseif (Auth::user()->role === 'user') {
            return redirect()->route('userDashboard');
        }
    }

    return back()->withErrors([
        'username' => 'The provided credentials do not match our records.',
    ])->onlyInput('username');
}

	// Logout
	public function logout(Request $request)
	{
		  // Periksa apakah pengguna sudah login
          if (!Auth::check()) {
            return redirect()->route('login.view'); // Jika tidak login, arahkan ke halaman login
        }
    
        // Logout pengguna
        Auth::logout();
        $request->session()->invalidate(); // Hapus semua data sesi
        $request->session()->regenerateToken(); // Regenerasi token CSRF
    
        // Arahkan ke halaman login yang sama untuk semua pengguna
        return redirect()->route('login.view')->with('success', 'You have been logged out successfully.');
	}
}
