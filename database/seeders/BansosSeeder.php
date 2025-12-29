<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BansosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bansos')->insert([
            [
                'nama_program' => 'Program Keluarga Harapan (PKH)',
                'jenis' => 'uang',
                'penyelenggara' => 'Kementerian Sosial',
                'tahun' => 2025,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_program' => 'Bantuan Pangan Non Tunai (BPNT)',
                'jenis' => 'barang',
                'penyelenggara' => 'Kementerian Sosial',
                'tahun' => 2025,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_program' => 'BLT Dana Desa',
                'jenis' => 'uang',
                'penyelenggara' => 'Pemerintah Desa',
                'tahun' => 2025,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_program' => 'Bantuan Beras 10 Kg',
                'jenis' => 'barang',
                'penyelenggara' => 'Bulog',
                'tahun' => 2025,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
