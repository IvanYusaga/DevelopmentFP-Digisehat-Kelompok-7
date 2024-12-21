<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

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
        $request->validate(
            [
                'nama_pengguna' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => [
                    'required',
                    'string',
                    'min:10',
                    'confirmed',
                    'regex:/^(?=.*[!@#$%^&*(),.?":{}|<>])(?=.*\d).+$/'
                ],
            ],
        );

        try {
            User::create([
                'nama_pengguna' => $request->nama_pengguna,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('login.view')->with('success', 'Anda berhasil membuat akun');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with('error', 'Email sudah digunakan.')->withInput();
            }

            throw $e;
        }
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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Jika email tidak ditemukan
        if (!$user) {
            return back()->withErrors([
                'email' => 'The email is not registered.',
            ])->onlyInput('email');
        }

        // Jika password salah
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'The password is incorrect.',
            ])->onlyInput('email');
        }

        // Jika login berhasil
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('userDashboard'));
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.view');
    }

    public function addPasswordView()
    {
        if (Auth::user()->password !== null) {
            return redirect()->route('userDashboard');
        }
        return view('user/userAddPass');
    }

    public function postAddPassword(Request $request)
    {
        // Validasi dengan aturan yang lebih ketat
        $request->validate([
            'newpassword' => [
                'required',
                'string',
                'min:10', // minimal 10 karakter
                'confirmed', // harus cocok dengan konfirmasi password
                'regex:/[A-Z]/', // harus ada huruf kapital
                'regex:/[a-z]/', // harus ada huruf kecil
                'regex:/\d/', // harus ada angka
                'regex:/[!@#$%^&*(),.?":{}|<>]/', // harus ada karakter spesial
            ],
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Update password
        $user->password = Hash::make($request->newpassword);
        $user->save();

        // Redirect ke dashboard atau halaman lain
        return redirect()->route('userDashboard')->with('success', 'Password berhasil diperbarui.');
    }

    public function changePasswordView()
    {
        return view('user/userChangePassword');
    }

    public function postChangePassword(Request $request)
    {
        // Validasi dengan aturan yang lebih ketat
        $request->validate([
            'password' => 'required|string|min:10|current_password', // Password lama minimal 10 karakter
            'newpassword' => [
                'required',
                'string',
                'min:10', // Minimal 10 karakter
                'confirmed', // Harus cocok dengan konfirmasi password
                'regex:/[A-Z]/', // Harus ada huruf kapital
                'regex:/[a-z]/', // Harus ada huruf kecil
                'regex:/\d/', // Harus ada angka
                'regex:/[!@#$%^&*(),.?":{}|<>]/', // Harus ada karakter spesial
            ],
            'newpassword_confirmation' => 'required|string|min:10', // Konfirmasi password harus sesuai
        ]);

        $user = Auth::user();

        // Verifikasi password lama
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password lama yang Anda masukkan salah.']);
        }

        // Update password
        $user->password = Hash::make($request->newpassword);
        $user->save();

        return redirect()->route('userDashboard')->with('success', 'Password berhasil diubah.');
    }
}
