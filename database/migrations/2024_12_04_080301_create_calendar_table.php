<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calendar', function (Blueprint $table) {
            $table->id(); // Kolom ID otomatis
            $table->string('nama_obat'); // Kolom untuk nama obat
            $table->string('deskripsi')->nullable(); // Kolom deskripsi obat (boleh kosong)
            $table->time('waktu_pengingat'); // Kolom waktu pengingat
            $table->date('tanggal_mulai'); // Kolom tanggal mulai
            $table->date('tanggal_selesai')->nullable(); // Kolom tanggal selesai (opsional)
            $table->string('google_calendar_event_id'); // Kolom untuk nama obat
            $table->timestamps(); // Menyediakan created_at dan updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar');
    }
};
