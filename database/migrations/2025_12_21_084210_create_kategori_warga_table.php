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
Schema::create('kategori_warga', function (Blueprint $table) {
    $table->id();

    $table->foreignId('warga_id')
        ->constrained('warga')
        ->onDelete('cascade');

    $table->foreignId('kategori_id')
        ->constrained('kategori')
        ->onDelete('cascade');


    $table->string('nilai')->nullable(); 
    // contoh: "Ya", "Tidak", "Layak", "Tidak Layak", "Aktif"

    $table->timestamps();

    $table->unique(['warga_id', 'kategori_id']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_warga');
    }
};
