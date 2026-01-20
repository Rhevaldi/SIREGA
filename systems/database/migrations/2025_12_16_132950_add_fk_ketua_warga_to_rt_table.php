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
    Schema::table('rt', function (Blueprint $table) {
        $table->foreign('ketua_warga_id')
              ->references('id')
              ->on('warga')
              ->nullOnDelete();
    });
}

public function down(): void
{
    Schema::table('rt', function (Blueprint $table) {
        $table->dropForeign(['ketua_warga_id']);
    });
}

};
