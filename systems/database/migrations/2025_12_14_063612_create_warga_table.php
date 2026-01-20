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

            // Relasi ke KK (menggunakan no_kk)
            $table->string('no_kk');
            $table->foreign('no_kk')
                ->references('no_kk')
                ->on('kartu_keluargas')
                ->onDelete('cascade');

            $table->foreignId('pekerjaan_id')
                ->nullable()
                ->constrained('pekerjaans')
                ->nullOnDelete();

            // Identitas Individu
            $table->string('nik')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');

            // Sosial
            $table->enum('agama', [
                'Islam',
                'Kristen',
                'Katolik',
                'Hindu',
                'Buddha',
                'Konghucu',
                'Kepercayaan lainnya'
            ]);
            $table->enum('pendidikan', [
                'Tidak/Belum Sekolah',
                'Belum Tamat SD/Sederajat',
                'Tamat SD/Sederajat',
                'SLTP/Sederajat',
                'SLTA/Sederajat',
                'Diploma I/II',
                'Diploma III/Sarjana Muda',
                'Diploma IV/Strata I',
                'Strata II',
                'Strata III'
            ]);

            // $table->enum('pekerjaan', [
            //     'Pelajar/Mahasiswa',
            //     'Belum/Tidak Bekerja',
            //     'Mengurus Rumah Tangga',
            //     'Karyawan Swasta',
            //     'Pegawai Negeri Sipil (PNS)',
            //     'Perangkat Desa',
            //     'Petani/Pekebun',
            //     'Nelayan/Perikanan',
            //     'Wiraswasta',
            //     'Buruh Harian Lepas',
            //     'Guru',
            //     'Tenaga Kesehatan',
            //     'TNI/Polri',
            //     'Pedagang',
            //     'Pensiunan',
            //     'Lainnya',
            // ]);

            // Status
            $table->enum('status_perkawinan', [
                'Kawin Tercatat',
                'Kawin Tidak Tercatat',
                'Kawin',
                'Belum Kawin',
                'Cerai Hidup',
                'Cerai Mati'
            ]);
            $table->enum('status_hubungan', [
                'Kepala Keluarga',
                'Suami',
                'Istri',
                'Anak',
                'Menantu',
                'Cucu',
                'Orang Tua',
                'Mertua',
                'Famili Lain',
                'Lainnya'
            ]);
            $table->enum('status_warga', [
                'Aktif',
                'Pindah',
                'Meninggal',
                'Sementara',
                'Tidak Diketahui',
                'Keluar',
                'Baru',
                'Hilang',
                'Warga Negara Asing'
            ]);

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
