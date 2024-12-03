<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jadwal_pengingats', function (Blueprint $table) {
            $table->id('id_jadwal'); // Primary Key
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->unsignedBigInteger('id_obat'); // Kolom referensi tanpa foreign key
            $table->string('caraPenggunaanObat'); // Dosis obat
            $table->integer('jumlah_obat'); // Jumlah obat
            $table->integer('frekuensi'); // frekuensi per hari
            $table->time('waktu_pengingat'); // Waktu pengingat
            $table->date('tanggal_konsumsi'); // Tanggal konsumsi
            $table->enum('status', ['aktif', 'selesai'])->default('aktif');
            $table->timestamps();

            // Definisikan Foreign Key
            $table->foreign('id_obat')->references('id_obat')->on('obats')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_pengingats');
    }
};
