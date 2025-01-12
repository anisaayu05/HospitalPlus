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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama ruangan
            $table->string('type'); // Tipe ruangan, misalnya ICU, Kamar Operasi
            $table->integer('capacity'); // Kapasitas pasien
            $table->enum('status', ['available', 'occupied', 'maintenance'])->default('available'); // Status ruangan
            $table->text('notes')->nullable(); // Catatan tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
