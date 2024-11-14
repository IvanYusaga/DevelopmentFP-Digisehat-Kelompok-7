<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        // Menampilkan form
        return view('user.manajemenObat.formulirObat');
    }

    public function postObat(Request $request)
    {

        // Validasi data
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'date' => 'required|date',
            'penggunaan_obat' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        // Menyimpan data ke dalam tabel `obats`
        Obat::create([
            'nama_obat' => $request->nama_obat,
            'date' => $request->date,
            'penggunaan_obat' => $request->penggunaan_obat,
            'deskripsi' => $request->deskripsi,
        ]);



        // Redirect ke halaman lain setelah berhasil submit
        return redirect()->route('informasiObat')->with('success', 'Data obat berhasil disimpan');
    }
}
