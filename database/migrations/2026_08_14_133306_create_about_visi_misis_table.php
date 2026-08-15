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
        Schema::create('about_visi_misis', function (Blueprint $table) {
            $table->id();
            $table->string('visi_title')->nullable();
            $table->text('visi_description')->nullable();
            $table->string('misi_title')->nullable();
            $table->json('misi_points')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_visi_misis');
    }
};
