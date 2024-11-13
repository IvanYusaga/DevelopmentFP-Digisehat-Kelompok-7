<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('jadwal_pengingat', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->foreignId('id_obat');
            $table->string('durasi_pengingat');
            $table->string('dosis');
            $table->integer('jumlah_obat');
            $table->string('frekuensi');
            $table->date('tanggal_konsumsi');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('jadwal_pengingat');
    }
};
