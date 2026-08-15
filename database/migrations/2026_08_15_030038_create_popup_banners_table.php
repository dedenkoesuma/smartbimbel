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
       Schema::create('popup_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Nama promosi
            $table->boolean('is_active')->default(false); // Sakelar utama
            $table->date('start_date')->nullable(); // Tanggal mulai tayang
            $table->date('end_date')->nullable(); // Tanggal selesai tayang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('popup_banners');
    }
};
