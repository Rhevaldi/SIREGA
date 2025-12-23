<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            [
                'kode' => 'SOS001',
                'nama' => 'Lansia',
                'tipe' => 'sosial',
                'deskripsi' => 'Warga lanjut usia'
            ],

            [
                'kode' => 'SOS002',
                'nama' => 'Disabilitas',
                'tipe' => 'sosial',
                'deskripsi' => 'Warga penyandang disabilitas'
            ],


            [
                'kode' => 'EKO001',
                'nama' => 'UMKM',
                'tipe' => 'ekonomi',
                'deskripsi' => 'Warga memiliki usaha'
            ],

            [
                'kode' => 'HUN001',
                'nama' => 'Kondisi Rumah',
                'tipe' => 'hunian',
                'deskripsi' => 'Kondisi rumah layak huni'
            ],



            [
                'kode' => 'KES001',
                'nama' => 'BPJS Aktif',
                'tipe' => 'kesehatan',
                'deskripsi' => 'Memiliki BPJS aktif'
            ],
        ];

        foreach ($data as $item) {
            Kategori::updateOrCreate(
                ['kode' => $item['kode']],
                $item
            );
        }
    }
}
