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
        // Ambil semua jadwal pengingat dengan relasi ke data obat untuk user yang sedang login
        $jadwalPengingat = JadwalPengingat::with('obat') // Mengambil data dari relasi tabel 'obat'
            ->where('id_user', Auth::id()) // Filter hanya data milik user yang sedang login
            ->get()
            ->unique('id_obat'); // Hapus duplikasi berdasarkan 'id_obat'

        // Siapkan array untuk menyimpan informasi status selesai dan total obat berdasarkan id_obat
        $statusCount = [];

        foreach ($jadwalPengingat as $jadwal) {
            // Hitung total jumlah_obat dari semua jadwal untuk id_obat tertentu
            $total = JadwalPengingat::where('id_user', Auth::id())
                ->where('id_obat', $jadwal->id_obat)
                ->sum('jumlah_obat'); // Jumlahkan kolom jumlah_obat

            // Hitung jumlah jadwal dengan status "Nonaktif" (obat selesai) untuk id_obat tertentu
            $completed = JadwalPengingat::where('id_user', Auth::id())
                ->where('id_obat', $jadwal->id_obat)
                ->where('status', 'selesai') // Filter hanya yang selesai
                ->count(); // Hitung jumlah baris

            // Simpan hasilnya ke array $statusCount
            $statusCount[$jadwal->id_obat] = [
                'completed' => $completed, // Jumlah selesai
                'total' => $total,         // Jumlah total obat
            ];
        }

        // Kirim data jadwalPengingat dan statusCount ke view
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
