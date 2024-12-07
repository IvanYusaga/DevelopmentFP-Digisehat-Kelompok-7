<?php

namespace App\Http\Controllers;

use App\Models\JadwalPengingat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatLogbookController extends Controller
{
    public function checkStatusRiwayatLogbook()
    {
        $user = auth::id();
        $hasJadwal = JadwalPengingat::where('id_user', $user)->exists();

        if ($hasJadwal) {
            return redirect()->route('userLogbook');
        } else {
            return redirect()->route('userManagementRiwayatLogbook');
        }
    }

    public function index()
    {
        // Ambil semua data jadwal pengingat dengan relasi obat
        $logbookEntries = JadwalPengingat::with('obat')
            ->where('id_user', Auth::id())
            ->get();

        // Inisialisasi data progress
        $progressData = [];

        foreach ($logbookEntries as $entry) {
            $idObat = $entry->id_obat;

            // Hitung total dan selesai
            $totalObat = JadwalPengingat::where('id_user', Auth::id())
                ->where('id_obat', $idObat)
                ->sum('jumlah_obat');
            $selesaiObat = JadwalPengingat::where('id_user', Auth::id())
                ->where('id_obat', $idObat)
                ->where('status', 'selesai')
                ->count();

            $progress = $totalObat > 0 ? round(($selesaiObat / $totalObat) * 100, 2) : 0;

            $progressData[$idObat] = [
                'nama_obat' => $entry->obat->nama_obat,
                'frekuensi' => $entry->frekuensi,
                'progress' => $progress,
                'selesai' => $selesaiObat,
                'total' => $totalObat,
            ];
        }

        // Pastikan variabel progressData dikirim ke view
        return view('user.userRiwayatLogbook', compact('progressData'));
    }
}
