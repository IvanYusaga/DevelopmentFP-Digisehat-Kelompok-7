<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\JadwalPengingat;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Hitung jumlah obat dan jadwal
        $jumlahObat = Obat::where('id_user', $userId)->count();
        $jumlahJadwal = JadwalPengingat::where('id_user', $userId)->where('status', 'aktif')->count();

        // Ambil maksimal 15 jadwal pengingat yang aktif
        $jadwalPengingat = JadwalPengingat::with('obat')
            ->where('id_user', $userId)
            ->where('status', 'aktif') // Filter hanya jadwal yang aktif
            ->orderBy('tanggal_konsumsi', 'asc') // Urutkan berdasarkan tanggal konsumsi
            ->orderBy('waktu_pengingat', 'asc') // Urutkan berdasarkan waktu pengingat
            ->take(15) // Batasi hanya 15 jadwal
            ->get();

        return view('user.userDashboard', compact('jumlahObat', 'jumlahJadwal', 'jadwalPengingat'));
    }
}
