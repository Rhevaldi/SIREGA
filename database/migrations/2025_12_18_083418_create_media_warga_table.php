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
        Schema::create('media_warga', function (Blueprint $table) {
            $table->id();
                  $table->foreignId('warga_id')->constrained('warga')->onDelete('cascade'); // foreign key ke warga.id
            $table->string('file_name');
            $table->string('file_type');
            $table->string('file_path');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_warga');
    }
};
