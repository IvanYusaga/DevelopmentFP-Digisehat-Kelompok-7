<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    // Menampilkan Tampilan Register
    public function registerView()
    {
        if (Auth::check()) {
            return redirect()->route('userDashboard'); // Jika sudah login, arahkan ke dashboard
        }
        return view('auth/register');
    }

    // Register User
    public function registerPost(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:8|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            User::create([
                'nama_pengguna' => $request->nama_pengguna,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'user', // Default role untuk pengguna baru
            ]);

            return redirect()->route('login.view')->with('success', 'Akun berhasil dibuat. Silakan login.');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) { // Error kode 1062 adalah Duplicate Entry
                return back()->with('error', 'Username atau Email sudah digunakan.')->withInput();
            }

            // Lempar error lain yang tidak terduga
            throw $e;
        }
    }

    // Menampilkan Tampilan Login
    public function loginView()
    {
        if (Auth::check()) {
            return redirect()->route('userDashboard'); // Jika sudah login, arahkan ke dashboard
        }
        return view('auth/login');
    }

    // Login User
    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Arahkan pengguna berdasarkan peran mereka
            if (Auth::user()->role === 'admin') {
                return redirect()->route('adminDashboard');
            }
            return redirect()->route('userDashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password tidak sesuai.',
        ])->onlyInput('username');
    }

    // Logout User
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();

            $request->session()->invalidate(); // Hapus semua data sesi
            $request->session()->regenerateToken(); // Regenerasi token CSRF
        }

        return redirect()->route('login.view')->with('success', 'Anda berhasil logout.');
    }
}
