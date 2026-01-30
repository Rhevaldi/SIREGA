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
                'nama' => 'KTP',
                'tipe' => 'administrasi',
                'deskripsi' => 'Memiliki Kartu Tanda Penduduk'
            ],
            [
                'kode' => 'ADM002',
                'nama' => 'KIA',
                'tipe' => 'administrasi',
                'deskripsi' => 'Memiliki Kartu Identitas Anak'
            ],
            [
                'kode' => 'ADM003',
                'nama' => 'IKD',
                'tipe' => 'administrasi',
                'deskripsi' => 'Identitas Kependudukan Digital'
            ],
            [
                'kode' => 'ADM004',
                'nama' => 'Akta Kelahiran',
                'tipe' => 'administrasi',
                'deskripsi' => 'Memiliki Akta Kelahiran'
            ],
            [
                'kode' => 'ADM005',
                'nama' => 'Akta Kematian',
                'tipe' => 'administrasi',
                'deskripsi' => 'Memiliki Akta Kematian'
            ],
            [
                'kode' => 'ADM006',
                'nama' => 'Akta Perkawinan',
                'tipe' => 'administrasi',
                'deskripsi' => 'Memiliki Akta Perkawinan'
            ],
            [
                'kode' => 'ADM007',
                'nama' => 'Akta Perceraian',
                'tipe' => 'administrasi',
                'deskripsi' => 'Memiliki Akta Perceraian'
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
