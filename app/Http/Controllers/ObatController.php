<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    // Tampilan View Obat
    public function index()
    {
        return view('user.manajemenObat.formulirObat');
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
        $obats = Obat::all();

        return view('user.manajemenObat.informasiObat', compact('obats'));
    }

    // Menampilkan Edit Obat
    public function editObat($id)
    {
        $obat = Obat::findOrFail($id);

        return view('user.manajemenObat.editObat', compact('obat'));
    }

    // Update Data Obat
    public function updateObat(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'date' => 'required|date',
            'penggunaan_obat' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $obat = Obat::findOrFail($id);
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
        $obat->delete();

        return redirect()->route('informasiObat')->with('success', 'Data obat berhasil dihapus');
    }
}
