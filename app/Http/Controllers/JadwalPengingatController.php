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
        $obats = Obat::where('id_user', Auth::id())->get();
        return view('user.aturJadwal.formulirJadwal', compact('obats'));
    }

    // Menyimpan Jadwal Pengingat
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'id_obat' => 'required|exists:obats,id_obat',
        'waktu_pengingat' => 'required|date_format:H:i', // Validasi format waktu
        'caraPenggunaanObat' => 'required|string',
        'jumlah_obat' => 'required|integer',
        'frekuensi' => 'required|integer', // Lama pengingat dalam hari
        'rentanghari' => 'required|integer', // Lama pengingat
        'tanggal_konsumsi' => 'required|date', // Tanggal awal pengingat
        'status' => 'required|string',
    ]);

        // Deklarasi variabel awal
        $id_obat = $validatedData['id_obat'];
        $caraPenggunaanObat = $validatedData['caraPenggunaanObat'];
        $jumlah_obat = $validatedData['jumlah_obat'];
        $frekuensi = $validatedData['frekuensi']; // frekuensi
        $rentanghari = $validatedData['rentanghari']; // Lama dalam hari
        $tanggal_awal = $validatedData['tanggal_konsumsi'];
        $waktu_pengingat = $validatedData['waktu_pengingat'];
        $status = $validatedData['status'];

        // Data yang akan disimpan
        $pengingatData = [];

        // Loop untuk setiap hari berdasarkan rentanghari
        for ($i = 0; $i < $rentanghari; $i++) {
            $tanggal = date('Y-m-d', strtotime("+$i days", strtotime($tanggal_awal)));
            $pengingatData[] = [
                'id_obat' => $id_obat,
                'caraPenggunaanObat' => $caraPenggunaanObat,
                'jumlah_obat' => $jumlah_obat,
                'tanggal_konsumsi' => $tanggal,
                'waktu_pengingat' => $waktu_pengingat,
                'frekuensi' => $frekuensi, // frekuensi
                'rentanghari' => $rentanghari, // Tambahkan kolom ini
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Masukkan data ke tabel
        JadwalPengingat::insert($pengingatData);

        return redirect()->route('user.jadwal')->with('success', 'Jadwal pengingat obat berhasil ditambahkan');
    }

    public function index()
    {
        $jadwalPengingat = JadwalPengingat::with('obat') // Muat data dari relasi obat
            ->whereHas('obat', function ($query) {
                $query->where('id_user', Auth::id()); // Filter hanya obat milik user
            })
            ->get();

        return view('user.aturJadwal.Jadwal', compact('jadwalPengingat'));
    }

     // Metode untuk menghapus jadwal
    public function destroy($id)
    {
        // Cari jadwal berdasarkan ID
        $jadwal = JadwalPengingat::findOrFail($id);

        // Hapus jadwal
        $jadwal->delete();

        // Redirect kembali ke halaman jadwal dengan pesan sukses
        return redirect()->route('user.jadwal')->with('success', 'Jadwal berhasil dihapus!');
    }

}
