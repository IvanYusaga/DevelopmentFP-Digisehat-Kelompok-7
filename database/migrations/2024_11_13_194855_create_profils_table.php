<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profils', function (Blueprint $table) {
            $table->id('id_profil');
            $table->foreignId('id_user')
                ->constrained('users', 'id_user')
                ->onDelete('cascade');
            $table->string('profile_image')->nullable();
            $table->string('nama_lengkap');
            $table->integer('usia');
            $table->string('jenis_kelamin');
            $table->text('riwayat_penyakit')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};
