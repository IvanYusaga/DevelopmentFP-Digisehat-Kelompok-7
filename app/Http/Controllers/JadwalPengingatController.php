<?php

namespace App\Http\Controllers;

use App\Models\JadwalPengingat;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class JadwalPengingatController extends Controller
{

    public function checkStatusJadwal()
    {
        $user = auth::id();
        $hasJadwal = JadwalPengingat::where('id_user', $user)->exists();

        if ($hasJadwal) {
            return redirect()->route('jadwal.view');
        } else {
            return redirect()->route('jadwal.create');
        }
    }

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
            'caraPenggunaanObat' => 'required|string|max:255',
            'jumlah_obat' => 'required|integer|min:1',
            'frekuensi' => 'required|integer|min:1|max:5',
            'waktu_pengingat' => 'required|array',
            'waktu_pengingat.*' => 'required|date_format:H:i',
            'tanggal_konsumsi' => 'required|date|after_or_equal:today',
            'status' => 'nullable|in:aktif,selesai',
        ]);

        $startDate = Carbon::parse($request->tanggal_konsumsi);
        $jumlahObat = $request->jumlah_obat;
        $validatedData['status'] = $request->status ?? 'aktif';

        $scheduleData = [];
        $counterObat = 0;

        for ($day = 0; $day < $jumlahObat; $day++) {
            $currentDate = $startDate->copy()->addDays($day);

            foreach ($request->waktu_pengingat as $time) {
                if ($counterObat < $jumlahObat) {

                    $scheduleData[] = [
                        'id_obat' => $request->id_obat,
                        'id_user' => Auth::id(),
                        'caraPenggunaanObat' => $request->caraPenggunaanObat,
                        'jumlah_obat' => 1,
                        'frekuensi' => $request->frekuensi,
                        'waktu_pengingat' => $time,
                        'tanggal_konsumsi' => $currentDate->toDateString(),
                        'status' => $request->status ?? 'aktif',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $counterObat++;

                    if ($counterObat >= $jumlahObat) {
                        break 2;
                    }
                }
            }
        }

        // Simpan data ke database
        try {
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
        // Muat data jadwal pengingat, hanya untuk user yang login, diurutkan berdasarkan tanggal konsumsi dan waktu pengingat
        $jadwalPengingat = JadwalPengingat::with('obat') // Muat data dari relasi obat
            ->whereHas('obat', function ($query) {
                $query->where('id_user', Auth::id()); // Filter hanya obat milik user yang login
            })
            ->orderBy('tanggal_konsumsi', 'asc') // Urutkan berdasarkan tanggal konsumsi
            ->orderBy('waktu_pengingat', 'asc') // Urutkan berdasarkan waktu pengingat
            ->get();

        // Tampilkan data ke view
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

    public function viewJadwal()
{
    $jadwalPengingat = JadwalPengingat::with('obat')
        ->where('id_user', Auth::id())
        ->orderBy('tanggal_konsumsi')
        ->get();

    // Update status berdasarkan waktu
    foreach ($jadwalPengingat as $jadwal) {
        $currentDateTime = now();
        $jadwalTime = Carbon::parse("{$jadwal->tanggal_konsumsi} {$jadwal->waktu_pengingat}");
        $jadwal->status = $jadwalTime->isPast() ? 'nonaktif' : 'aktif';
        $jadwal->save();
    }

    return view('user.jadwalPengingat', compact('jadwalPengingat'));
}

}
