<?php

namespace App\Http\Controllers;

use App\Models\JadwalPengingat;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        // Validasi input dari user
        $validatedData = $request->validate([
            'id_obat' => 'required|exists:obats,id_obat',
            'caraPenggunaanObat' => 'required|string|max:255',
            'jumlah_obat' => 'required|integer|min:1',
            'frekuensi' => 'required|integer|min:1|max:5',
            'waktu_pengingat' => 'required|array',
            'waktu_pengingat.*' => 'required|date_format:H:i',
            'rentanghari' => 'required|integer|min:1',
            'tanggal_konsumsi' => 'required|date|after_or_equal:today',
            'status' => 'nullable|in:aktif,selesai',
        ]);

        $startDate = Carbon::parse($request->tanggal_konsumsi);
        $endDate = $startDate->copy()->addDays($request->rentanghari - 1);
        $validatedData['status'] = $request->status ?? 'aktif';

        // Siapkan array untuk data jadwal pengingat
        $scheduleData = [];
        foreach ($request->waktu_pengingat as $time) {
            $currentDate = $startDate->copy();
            while ($currentDate <= $endDate) {
                $scheduleData[] = [
                    'id_obat' => $request->id_obat,
                    'id_user' => auth::id(),
                    'caraPenggunaanObat' => $request->caraPenggunaanObat,
                    'jumlah_obat' => $request->jumlah_obat,
                    'frekuensi' => $request->frekuensi,
                    'waktu_pengingat' => $time, // Simpan waktu satu per satu
                    'rentanghari' => $request->rentanghari,
                    'tanggal_konsumsi' => $currentDate->toDateString(),
                    'status' => $request->status ?? 'aktif',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $currentDate->addDay(); // Lanjutkan ke hari berikutnya
            }
        }

        // Coba simpan data ke database
        try {
            // Masukkan data ke tabel
            JadwalPengingat::insert($scheduleData);

            // Redirect ke halaman jadwal dengan pesan sukses
            return redirect()->route('user.jadwal')->with('success', 'Jadwal pengingat obat berhasil ditambahkan');
        } catch (\Exception $e) {
            // Jika terjadi error, tampilkan pesan error
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Menampilkan Jadwal Pengingat
    public function index()
    {
        $jadwalPengingat = JadwalPengingat::with('obat') // Muat data dari relasi obat
            ->whereHas('obat', function ($query) {
                $query->where('id_user', Auth::id()); // Filter hanya obat milik user
            })
            ->get();

        return view('user.aturJadwal.Jadwal', compact('jadwalPengingat'));
    }

    // Menghapus Jadwal Pengingat
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
