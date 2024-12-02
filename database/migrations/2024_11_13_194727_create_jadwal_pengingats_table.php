<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('jadwal_pengingat', function (Blueprint $table) {
            $table->id('id_jadwal'); // Primary Key
            $table->unsignedBigInteger('id_obat'); // Kolom referensi tanpa foreign key
            $table->time('waktu_pengingat'); // Durasi dalam satuan waktu (e.g., jam, hari)
            $table->string('caraPenggunaanObat'); // Dosis obat
            $table->integer('jumlah_obat'); // Jumlah obat yang harus diminum
            $table->integer('frekuensi'); // frekuensi per hari
            $table->integer('rentanghari'); // rentanghari
            $table->date('tanggal_konsumsi'); // Tanggal mulai konsumsi
            $table->string('status'); // Status jadwal (e.g., aktif/tidak aktif)
            $table->timestamps(); // Created_at & Updated_at
        });
    }

    public function down(): void {
        Schema::dropIfExists('jadwal_pengingat');
    }
};
