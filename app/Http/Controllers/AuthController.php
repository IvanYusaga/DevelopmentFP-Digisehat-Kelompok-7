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
        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

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
        $request->validate([
            'newpassword' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        $user->password = Hash::make($request->newpassword);
        $user->save();

        return redirect()->route('userDashboard');
    }

    public function changePasswordView()
    {
        return view('user/userChangePassword');
    }

    public function postChangePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|current_password',
            'newpassword' => 'required|string|min:8|confirmed',
            'newpassword_confirmation' => 'required|string|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password lama yang Anda masukkan salah.']);
        }

        $user->password = Hash::make($request->newpassword);
        $user->save();

        return redirect()->route('userDashboard')->with('success', 'Password berhasil diubah.');
    }
}
