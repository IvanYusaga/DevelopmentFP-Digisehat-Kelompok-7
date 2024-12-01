<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $userFromGoogle = Socialite::driver('google')->user();

        // Cari user berdasarkan email
        $userFromDb = User::where('email', $userFromGoogle->getEmail())->first();

        if ($userFromDb) {
            // Jika user ditemukan tapi belum terkait dengan Google
            if (is_null($userFromDb->google_id)) {
                $userFromDb->google_id = $userFromGoogle->getId();
                $userFromDb->save();
            }
        } else {
            // Buat user baru jika tidak ditemukan
            $userFromDb = new User();
            $userFromDb->email = $userFromGoogle->getEmail();
            $userFromDb->google_id = $userFromGoogle->getId();
            $userFromDb->nama_pengguna = $userFromGoogle->getName();

            $userFromDb->save();
        }

        // Login user
        auth('web')->login($userFromDb);
        session()->regenerate();
        return redirect()->route('userDashboard');
    }

    public function logout(Request $request)
    {
        auth('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
