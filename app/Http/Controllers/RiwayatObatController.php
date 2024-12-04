<?php

namespace App\Http\Controllers;

use App\Models\RiwayatObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalPengingat;

class RiwayatObatController extends Controller
{
    public function index()
    {
        // Ambil semua jadwal pengingat dengan data obat untuk user yang sedang login
        $jadwalPengingat = JadwalPengingat::with('obat') // Ambil relasi obat
            ->where('id_user', Auth::id()) // Filter berdasarkan user login
            ->get()
            ->unique('id_obat'); // Hapus duplikasi berdasarkan id_obat

        return view('user.userRiwayatObat', compact('jadwalPengingat'));
    }

    public function cekJadwal($id_obat)
    {
        // Ambil data jadwal berdasarkan id_obat dan user login
        $jadwalPengingat = JadwalPengingat::with('obat')
            ->where('id_obat', $id_obat)
            ->where('id_user', Auth::id())
            ->get();

        // Ambil nama obat untuk ditampilkan di halaman
        $namaObat = $jadwalPengingat->first()->obat->nama_obat ?? 'Obat Tidak Ditemukan';

        return view('user.userCekJadwalBtn', compact('jadwalPengingat', 'namaObat'));
    }
}
