<?php

namespace Database\Seeders;

use App\Models\JadwalPengingat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JadwalPegingatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        JadwalPengingat::create([
            'id_user' => 1, // Sesuaikan dengan id_user yang tersedia di tabel users
            'id_obat' => 1, // Sesuaikan dengan id_obat yang tersedia di tabel obats
            'caraPenggunaanObat' => 'Diminum setelah makan',
            'jumlah_obat' => 1,
            'frekuensi' => 1,
            'waktu_pengingat' => '08:00:00',
            'tanggal_konsumsi' => '2024-12-04',
            'status' => 'aktif',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        JadwalPengingat::create([
            'id_user' => 1, // Sesuaikan dengan id_user yang tersedia di tabel users
            'id_obat' => 1, // Sesuaikan dengan id_obat yang tersedia di tabel obats
            'caraPenggunaanObat' => 'Diminum setelah makan',
            'jumlah_obat' => 1,
            'frekuensi' => 1,
            'waktu_pengingat' => '08:00:00',
            'tanggal_konsumsi' => '2024-12-05',
            'status' => 'aktif',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        JadwalPengingat::create([
            'id_user' => 1, // Sesuaikan dengan id_user yang tersedia di tabel users
            'id_obat' => 2, // Sesuaikan dengan id_obat yang tersedia di tabel obats
            'caraPenggunaanObat' => 'Diminum setelah makan',
            'jumlah_obat' => 1,
            'frekuensi' => 1,
            'waktu_pengingat' => '10:00:00',
            'tanggal_konsumsi' => '2024-12-04',
            'status' => 'aktif',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        JadwalPengingat::create([
            'id_user' => 1, // Sesuaikan dengan id_user yang tersedia di tabel users
            'id_obat' => 2, // Sesuaikan dengan id_obat yang tersedia di tabel obats
            'caraPenggunaanObat' => 'Diminum setelah makan',
            'jumlah_obat' => 1,
            'frekuensi' => 1,
            'waktu_pengingat' => '10:00:00',
            'tanggal_konsumsi' => '2024-12-05',
            'status' => 'aktif',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        JadwalPengingat::create([
            'id_user' => 1, // Sesuaikan dengan id_user yang tersedia di tabel users
            'id_obat' => 3, // Sesuaikan dengan id_obat yang tersedia di tabel obats
            'caraPenggunaanObat' => 'Diminum setelah makan',
            'jumlah_obat' => 1,
            'frekuensi' => 1,
            'waktu_pengingat' => '08:00:00',
            'tanggal_konsumsi' => '2024-12-04',
            'status' => 'aktif',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        JadwalPengingat::create([
            'id_user' => 1, // Sesuaikan dengan id_user yang tersedia di tabel users
            'id_obat' => 3, // Sesuaikan dengan id_obat yang tersedia di tabel obats
            'caraPenggunaanObat' => 'Diminum setelah makan',
            'jumlah_obat' => 1,
            'frekuensi' => 1,
            'waktu_pengingat' => '08:00:00',
            'tanggal_konsumsi' => '2024-12-05',
            'status' => 'aktif',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
