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
        Schema::create('layanan_programs', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->nullable(); // Untuk "Program SD"
            $table->string('title'); // Untuk "Program Sekolah Dasar" atau "Kelas Privat"
            $table->string('subtitle')->nullable(); // Untuk "Untuk kelas 1-6 SD"
            $table->text('description'); // Untuk deskripsi
            $table->json('checklists')->nullable(); // Untuk poin centang (Array)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_programs');
    }
};
