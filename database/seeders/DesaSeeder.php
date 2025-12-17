<?php

namespace Database\Seeders;

use App\Models\Rt;
use App\Models\Desa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $desa = Desa::create([
            'nama_desa' => 'Loa Kulu Kota',
            'kecamatan' => 'Loa Kulu',
            'kabupaten' => 'Kutai Kartanegara',
            'provinsi'  => 'Kalimantan Timur',
        ]);

        for ($i = 1; $i <= 23; $i++) {
            Rt::create([
                'desa_id'   => 1,
                'rt'        => 'RT ' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'ketua_warga_id'    => null,
            ]);
        }
    }
}
