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

        // Siapkan array untuk menghitung obat selesai per id_obat
        $statusCount = [];

        // Loop untuk menghitung jumlah selesai dan total per id_obat
        foreach ($jadwalPengingat as $jadwal) {
            // Inisialisasi array untuk tiap id_obat jika belum ada
            if (!isset($statusCount[$jadwal->id_obat])) {
                $statusCount[$jadwal->id_obat] = [
                    'completed' => 0, // Jumlah selesai
                    'total' => 0, // Jumlah total
                ];
            }

            // Update jumlah total berdasarkan jumlah_obat
            $statusCount[$jadwal->id_obat]['total'] += $jadwal->jumlah_obat;

            // Update jumlah selesai jika statusnya 'Nonaktif' (selesai)
            if ($jadwal->status == 'Nonaktif') {
                $statusCount[$jadwal->id_obat]['completed'] += $jadwal->jumlah_obat;
            }
        }

        // Kirim data ke view
        return view('user.userRiwayatObat', compact('jadwalPengingat', 'statusCount'));
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

    public function selesaiJadwal($id)
    {
        // Cari jadwal berdasarkan ID
        $jadwal = JadwalPengingat::findOrFail($id);

        // Ubah status menjadi nonaktif
        $jadwal->status = 'Selesai';
        $jadwal->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Status jadwal berhasil diubah menjadi nonaktif.');
    }
}
