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
        Schema::create('warga', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk');
            $table->string('nik')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->enum('status_perkawinan', ['kawin', 'belum kawin', 'cerai hidup', 'cerai mati']);
            $table->enum('status_hubungan', ['kepala keluarga', 'suami', 'istri', 'anak', 'mertua', 'cucu', 'orang tua', 'famili lain', 'pembantu', 'lainnya']);
            $table->enum('status_warga', ['aktif', 'pindah', 'meninggal', 'sementara', 'tidak diketahui', 'keluar', 'baru', 'hilang', 'wna']);
            $table->text('alamat');
            $table->foreignId('rt_id')->constrained('rt')->onDelete('cascade');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};
