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


            [
                'kode' => 'ADM001',
                'nama' => 'Memiliki KTP',
                'tipe' => 'administratif',
                'deskripsi' => 'Warga memiliki KTP'
            ],

            [
                'kode' => 'ADM002',
                'nama' => 'Memiliki KK',
                'tipe' => 'administratif',
                'deskripsi' => 'Warga memiliki KK'
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
