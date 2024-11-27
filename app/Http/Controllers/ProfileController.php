<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Simpan data profil pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    // Menampilkan Add Profile (Jika belum terdapat profile pada database)
    public function index()
    {
        if (Auth::check() && Auth::user()->profil) {
            return redirect()->route('user.profile');
        }
        return view('user.userAddProfile');
    }

    // Logic Add Profile
    public function post(Request $request)
    {
        $validated = $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_lengkap' => 'required|string|max:255',
            'usia' => 'required|integer|min:0',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'riwayat_penyakit' => 'nullable|string',
        ]);

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image');
        }

        $validated['id_user'] = Auth::id();

        Profil::create($validated);

        return redirect()->route('user.profile')->with('success', 'Profil berhasil ditambahkan!');
    }

    // Menampilkan User Profile
    public function profile()
    {
        $profil = Profil::where('id_user', auth::id())->first();

        return view('user.userProfile', compact('profil'));
    }

    // Menampilkan Edit Profile
    public function editProfile($id_profil)
    {
        $profil = Profil::findOrFail($id_profil);

        return view('user.userEditProfile', compact('profil'));
    }

    // Logic Edit Profile
    public function update(Request $request, $id_profil)
    {
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_lengkap' => 'required|string|max:255',
            'usia' => 'required|integer|min:0',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'riwayat_penyakit' => 'nullable|string',
        ]);

        $profil = profil::findOrFail($id_profil);
        $profil->update([
            'profile_image' => $request->file('profile_image'),
            'nama_lengkap' => $request->nama_lengkap,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'riwayat_penyakit' => $request->riwayat_penyakit,
        ]);

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
