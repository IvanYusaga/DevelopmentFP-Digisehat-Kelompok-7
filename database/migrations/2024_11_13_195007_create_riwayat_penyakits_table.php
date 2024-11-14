<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('riwayat_penyakit', function (Blueprint $table) {
            $table->id('id_riwayat_penyakit');
            $table->string('nama_riwayat_penyakit');
            $table->text('gejala');
            $table->text('pengobatan');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('riwayat_penyakit');
    }
};
