<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('obat', function (Blueprint $table) {
            $table->id('id_obat');
            $table->foreignId('id_user');
            $table->string('nama_obat');
            $table->text('cara_penggunaan');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('obat');
    }
};
