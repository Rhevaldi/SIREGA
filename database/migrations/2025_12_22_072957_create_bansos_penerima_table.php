<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bansos_penerima', function (Blueprint $table) {
            $table->id();

            $table->foreignId('warga_id')
                  ->constrained('warga')
                  ->cascadeOnDelete();

            $table->foreignId('bansos_id')
                  ->constrained('bansos')
                  ->cascadeOnDelete();

            $table->date('tanggal_penerimaan')->nullable();
            $table->enum('status', ['diajukan', 'diterima', 'ditolak'])->default('diajukan');
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bansos_penerima');
    }
};
