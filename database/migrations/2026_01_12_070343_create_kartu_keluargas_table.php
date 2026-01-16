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
        Schema::create('kartu_keluargas', function (Blueprint $table) {
            $table->id();

            $table->string('no_kk')->unique();
            $table->string('nama_kepala_keluarga')->nullable();

            // Alamat administratif
            $table->string('alamat');
            $table->string('rt', 5);
            $table->string('rw', 5)->nullable();
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->string('kode_pos', 10)->nullable();

            // Lokasi geografis (untuk mapping)
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            // Metadata KK
            $table->date('tanggal_dikeluarkan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_keluargas');
    }
};
