<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat');
            $table->date('date');
            $table->string('penggunaan_obat');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};
