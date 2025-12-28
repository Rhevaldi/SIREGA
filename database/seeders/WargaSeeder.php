<?php

namespace Database\Seeders;

use App\Models\Warga;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Misal kita buat 10 KK
        for ($i = 0; $i < 10; $i++) {
            $noKK = (string) fake()->numerify('64##############');

            // Kepala keluarga (selalu kawin)
            $kepala = Warga::factory()->create([
                'no_kk' => $noKK,
                'status_hubungan' => 'kepala_keluarga',
                'status_perkawinan' => 'kawin',
            ]);

            // Tambahkan pasangan (istri/suami)
            $pasangan = Warga::factory()->create([
                'no_kk' => $noKK,
                'status_hubungan' => $kepala->jenis_kelamin === 'L' ? 'istri' : 'suami',
                'status_perkawinan' => 'kawin',
            ]);

            // Tambahkan anak-anak (belum kawin)
            $anakCount = rand(1, 3);
            for ($j = 0; $j < $anakCount; $j++) {
                Warga::factory()->create([
                    'no_kk' => $noKK,
                    'status_hubungan' => 'anak',
                    'status_perkawinan' => 'belum_kawin',
                ]);
            }

            // Opsional: tambahkan orang tua/mertua (biasanya kawin atau cerai mati)
            if (rand(0, 1)) {
                Warga::factory()->create([
                    'no_kk' => $noKK,
                    'status_hubungan' => 'orang_tua',
                    'status_perkawinan' => fake()->randomElement(['kawin', 'cerai_mati']),
                ]);
            }

            // Opsional: famili lain/pembantu
            if (rand(0, 1)) {
                Warga::factory()->create([
                    'no_kk' => $noKK,
                    'status_hubungan' => fake()->randomElement(['famili_lain', 'pembantu']),
                    'status_perkawinan' => fake()->randomElement(['belum_kawin', 'kawin']),
                ]);
            }
        }

        // Tambahan warga random di luar KK (misalnya kos/kontrak)
        Warga::factory()->count(10)->create([
            'status_hubungan' => 'lainnya',
            'status_perkawinan' => fake()->randomElement(['belum_kawin', 'kawin']),
        ]);
    }
}
