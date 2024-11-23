<?php

namespace App\Http\Controllers;

use App\Models\JadwalPengingat;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPengingatController extends Controller
{
    // Menampilkan Formulir Jadwal Pengingat
    public function create()
    {
        // Mendapatkan daftar obat yang dimiliki oleh user yang login
        $obats = Obat::where('id_user', Auth::id())->get();
        
        return view('user.aturJadwal.formulirJadwal', compact('obats'));
    }

    // Menyimpan Jadwal Pengingat
    public function store(Request $request)
    {
        $request->validate([
            'id_obat' => 'required|exists:obats,id_obat',
            'durasi_pengingat' => 'required|integer',
            'dosis' => 'required|string',
            'jumlah_obat' => 'required|integer',
            'frekuensi' => 'required|integer',
            'tanggal_konsumsi' => 'required|date',
            'status' => 'required|string',
        ]);

        // Menyimpan jadwal pengingat
        JadwalPengingat::create([
            'id_obat' => $request->id_obat,
            'durasi_pengingat' => $request->durasi_pengingat,
            'dosis' => $request->dosis,
            'jumlah_obat' => $request->jumlah_obat,
            'frekuensi' => $request->frekuensi,
            'tanggal_konsumsi' => $request->tanggal_konsumsi,
            'status' => $request->status,
        ]);

        return redirect()->route('userJadwal')->with('success', 'Jadwal pengingat obat berhasil ditambahkan');
    }
}
