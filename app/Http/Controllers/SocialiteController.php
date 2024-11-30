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

        $userFromDb = User::where('google_id', $userFromGoogle->getId())->first();

        if (!$userFromDb) {
            $userFromDb = new User();
            $userFromDb->email = $userFromGoogle->getEmail();
            $userFromDb->google_id = $userFromGoogle->getId();
            $userFromDb->nama_pengguna = $userFromGoogle->getName();

            $userFromDb->save();
            auth('web')->login($userFromDb);
            session()->regenerate();
            return redirect()->route('userDashboard');
        }

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
