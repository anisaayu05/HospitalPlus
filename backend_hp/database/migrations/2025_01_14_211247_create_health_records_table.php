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
        Schema::create('health_records', function (Blueprint $table) {
            $table->id(); // ID untuk health record
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade'); // Relasi ke tabel patients
            $table->text('medical_history'); // Kolom untuk riwayat medis
            $table->text('lab_results'); // Kolom untuk hasil lab
            $table->text('vaccination')->nullable(); // Kolom untuk vaksinasi (nullable)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};
