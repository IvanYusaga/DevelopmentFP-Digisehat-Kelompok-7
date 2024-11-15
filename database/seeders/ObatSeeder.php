<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Obat::create([
            "id_user" => "1",
            "nama_obat" => "paracetamol",
            "date" => "2024-11-15",
            "penggunaan_obat" => "diminum setelah makan",
            "deskripsi" => "obat untuk pusing"
        ]);

        Obat::create([
            "id_user" => "1",
            "nama_obat" => "ibuprofen",
            "date" => "2024-11-16",
            "penggunaan_obat" => "diminum setiap 6 jam",
            "deskripsi" => "obat untuk nyeri"
        ]);

        Obat::create([
            "id_user" => "2",
            "nama_obat" => "amoxicillin",
            "date" => "2024-11-17",
            "penggunaan_obat" => "diminum setiap 8 jam",
            "deskripsi" => "antibiotik untuk infeksi"
        ]);

        Obat::create([
            "id_user" => "2",
            "nama_obat" => "cetirizine",
            "date" => "2024-11-18",
            "penggunaan_obat" => "diminum sebelum tidur",
            "deskripsi" => "obat untuk alergi"
        ]);
    }
}
