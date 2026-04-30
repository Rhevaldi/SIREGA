<?php

namespace Database\Seeders;

use App\Models\Pekerjaan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PekerjaanBaruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode' => '100', 'nama' => 'Pensiunan'],
        ];

        foreach ($data as $item) {
            Pekerjaan::updateOrCreate(
                ['kode' => $item['kode']],
                [
                    'nama' => $item['nama'],
                    'keterangan' => null,
                    'is_active' => true
                ]
            );
        }
    }
}
