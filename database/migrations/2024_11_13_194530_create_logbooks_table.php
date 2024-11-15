<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('logbook', function (Blueprint $table) {
            $table->id('id_logbook');
            $table->foreignId('id_jadwal');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('logbook');
    }
};
