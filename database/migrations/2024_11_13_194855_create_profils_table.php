<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('profil', function (Blueprint $table) {
            $table->id('id_profil');
            $table->foreignId('id_user');
            $table->foreignId('id_penyakit')->nullable();
            $table->foreignId('id_riwayat_penyakit')->nullable();
            $table->string('nama_panjang');
            $table->integer('umur');
            $table->string('jenis_kelamin');
            $table->float('tinggi_badan');
            $table->float('berat_badan');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('profil');
    }
};
