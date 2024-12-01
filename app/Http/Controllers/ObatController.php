<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObatController extends Controller
{
    // Tampilan View Obat
    public function index()
    {
        return view('user.manajemenObat.formulirObat');
    }

    public function checkStatusObat()
    {
        $user = auth::id();
        $hasObat = Obat::where('id_user', $user)->exists();

        if ($hasObat) {
            return redirect()->route('informasiObat');
        } else {
            return redirect()->route('userManagement');
        }
    }

    // Menambahkan Data Obat
    public function postObat(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'date' => 'required|date',
            'penggunaan_obat' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        Obat::create([
            'id_user' => auth::id(),
            'nama_obat' => $request->nama_obat,
            'date' => $request->date,
            'penggunaan_obat' => $request->penggunaan_obat,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('informasiObat')->with('success', 'Data obat berhasil disimpan');
    }

    // Menampilkan Data Obat
    public function informasiObat()
    {
        $obats = Obat::where('id_user', auth::id())->get();

        return view('user.manajemenObat.informasiObat', compact('obats'));
    }

    // Menampilkan Dashboard
    public function dashboard()
    {
        $jumlahObat = Obat::where('id_user', auth::id())->count();

        return view('user.userDashboard', compact('jumlahObat'));
    }

    // Menampilkan Edit Obat
    public function editObat($id_obat)
    {
        $obat = Obat::findOrFail($id_obat);

        return view('user.manajemenObat.editObat', compact('obat'));
    }

    // Update Data Obat
    public function updateObat(Request $request, $id_obat)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'date' => 'required|date',
            'penggunaan_obat' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $obat = Obat::findOrFail($id_obat);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'date' => $request->date,
            'penggunaan_obat' => $request->penggunaan_obat,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('informasiObat')->with('success', 'Data obat berhasil diperbarui');
    }

    // Delete Data Obat
    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $userId = $obat->id_user;
        $obat->delete();

        $hasObat = Obat::where('id_user', $userId)->exists();

        if ($hasObat) {
            return redirect()->route('informasiObat')->with('success', 'Data obat berhasil dihapus');
        } else {
            return redirect()->route('userManagement');
        }
    }
}
