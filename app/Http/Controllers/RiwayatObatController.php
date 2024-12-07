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
        $jadwalPengingat = JadwalPengingat::with('obat')
            ->where('id_user', Auth::id())
            ->get()
            ->unique('id_obat');

        $statusCount = [];

        foreach ($jadwalPengingat as $jadwal) {
            $total = JadwalPengingat::where('id_user', Auth::id())
                ->where('id_obat', $jadwal->id_obat)
                ->count();

            $completed = JadwalPengingat::where('id_user', Auth::id())
                ->where('id_obat', $jadwal->id_obat)
                ->where('status', 'selesai')
                ->count();

            $statusCount[$jadwal->id_obat] = [
                'completed' => $completed,
                'total' => $total,
            ];
        }

        return view('user.userRiwayatObat', compact('jadwalPengingat', 'statusCount'));
    }


    public function cekJadwal($id_obat)
    {
        $jadwalPengingat = JadwalPengingat::with('obat')
            ->where('id_obat', $id_obat)
            ->where('id_user', Auth::id())
            ->get();

        $namaObat = $jadwalPengingat->first()->obat->nama_obat ?? 'Obat Tidak Ditemukan';

        return view('user.userCekJadwalBtn', compact('jadwalPengingat', 'namaObat'));
    }

    public function selesaiJadwal($id)
    {
        $jadwal = JadwalPengingat::findOrFail($id);
        $jadwal->status = 'Selesai';
        $jadwal->save();

        return redirect()->back()->with('success', 'Status jadwal berhasil diubah menjadi nonaktif.');
    }
}
