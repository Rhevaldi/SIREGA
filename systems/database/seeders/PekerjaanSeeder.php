<?php

namespace Database\Seeders;

use App\Models\Pekerjaan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode' => '01', 'nama' => 'Pelajar/Mahasiswa'],
            ['kode' => '02', 'nama' => 'Belum/Tidak Bekerja'],
            ['kode' => '03', 'nama' => 'Mengurus Rumah Tangga'],
            ['kode' => '04', 'nama' => 'Karyawan Swasta'],
            ['kode' => '05', 'nama' => 'Nelayan/Perikanan'],
            ['kode' => '06', 'nama' => 'Petani/Pekebun'],
            ['kode' => '07', 'nama' => 'Wiraswasta'],
            ['kode' => '08', 'nama' => 'Perangkat Desa'],
            ['kode' => '09', 'nama' => 'Pegawai Negeri Sipil (PNS)'],
            ['kode' => '10', 'nama' => 'Guru Swasta'],
            ['kode' => '11', 'nama' => 'Perawat Swasta'],
            ['kode' => '12', 'nama' => 'Karyawan Honorer'],
            ['kode' => '13', 'nama' => 'Buruh Harian Lepas'],
            ['kode' => '14', 'nama' => 'Guru'],
            ['kode' => '15', 'nama' => 'Montir'],
            ['kode' => '16', 'nama' => 'Tukang Batu'],
            ['kode' => '17', 'nama' => 'Buruh Tani/Perkebunan'],
            ['kode' => '18', 'nama' => 'Kepala Desa'],
            ['kode' => '19', 'nama' => 'Tentara Nasional Indonesia (TNI)'],
            ['kode' => '20', 'nama' => 'Satpam/Security'],
            ['kode' => '21', 'nama' => 'Kepolisian RI (Polri)'],
            ['kode' => '22', 'nama' => 'Pedagang Barang Kelontong'],
            ['kode' => '23', 'nama' => 'Tukang Cukur'],
            ['kode' => '24', 'nama' => 'Tukang Las/Pandai Besi'],
            ['kode' => '25', 'nama' => 'Buruh Nelayan/Perikanan'],
            ['kode' => '26', 'nama' => 'Bidan Swasta'],
            ['kode' => '27', 'nama' => 'Imam Masjid'],
            ['kode' => '28', 'nama' => 'Gubernur'],
            ['kode' => '29', 'nama' => 'Kontraktor'],
            ['kode' => '30', 'nama' => 'Pemilik Usaha Informasi dan Komunikasi'],
            ['kode' => '31', 'nama' => 'Dokter'],
            ['kode' => '32', 'nama' => 'Perdagangan'],
            ['kode' => '33', 'nama' => 'Peternak'],
            ['kode' => '34', 'nama' => 'Karyawan BUMD'],
            ['kode' => '35', 'nama' => 'Seniman'],
            ['kode' => '36', 'nama' => 'Penyiar Radio'],
            ['kode' => '37', 'nama' => 'Pemilik Usaha Hotel dan Penginapan Lainnya'],
            ['kode' => '38', 'nama' => 'Pengusaha Kecil, Menengah dan Besar'],
            ['kode' => '39', 'nama' => 'Sopir'],
            ['kode' => '40', 'nama' => 'Buruh Usaha Hotel dan Penginapan Lainnya'],
            ['kode' => '41', 'nama' => 'Jasa Konsultasi Manajemen dan Teknis'],
            ['kode' => '42', 'nama' => 'Penata Rambut'],
            ['kode' => '43', 'nama' => 'Pendeta'],
            ['kode' => '44', 'nama' => 'Anggota BPK'],
            ['kode' => '45', 'nama' => 'Pemilik Usaha Jasa Hiburan dan Pariwisata'],
            ['kode' => '46', 'nama' => 'Usaha Jasa Pengerah Tenaga Kerja'],
            ['kode' => '47', 'nama' => 'Wakil Bupati'],
            ['kode' => '48', 'nama' => 'Buruh Usaha Jasa Transportasi dan Perhubungan'],
            ['kode' => '49', 'nama' => 'Jasa Pengobatan Alternatif'],
            ['kode' => '50', 'nama' => 'Jasa Penyewaan Peralatan Pesta'],
            ['kode' => '51', 'nama' => 'Pengrajin Industri Rumah Tangga'],
            ['kode' => '52', 'nama' => 'Industri'],
            ['kode' => '53', 'nama' => 'Karyawan BUMN'],
            ['kode' => '54', 'nama' => 'Penerjemah'],
            ['kode' => '55', 'nama' => 'Pengrajin'],
            ['kode' => '56', 'nama' => 'Penata Rias'],
            ['kode' => '57', 'nama' => 'Buruh Peternakan'],
            ['kode' => '58', 'nama' => 'Anggota DPRD Provinsi'],
            ['kode' => '59', 'nama' => 'Akuntan'],
            ['kode' => '60', 'nama' => 'Tukang Cuci'],
            ['kode' => '61', 'nama' => 'Pengacara'],
            ['kode' => '62', 'nama' => 'Buruh Usaha Jasa Hiburan dan Pariwisata'],
            ['kode' => '63', 'nama' => 'Dosen Swasta'],
            ['kode' => '64', 'nama' => 'Tukang Sumur'],
            ['kode' => '65', 'nama' => 'Wakil Gubernur'],
            ['kode' => '66', 'nama' => 'Arsitektur/Desainer'],
            ['kode' => '67', 'nama' => 'Tukang Anyaman'],
            ['kode' => '68', 'nama' => 'Anggota Kabinet/Kementrian'],
            ['kode' => '69', 'nama' => 'Bupati'],
            ['kode' => '70', 'nama' => 'Pilot'],
            ['kode' => '71', 'nama' => 'Tabib'],
            ['kode' => '72', 'nama' => 'Juru Masak'],
            ['kode' => '73', 'nama' => 'Dosen'],
            ['kode' => '74', 'nama' => 'Pemilik Usaha Jasa Transportasi dan Perhubungan'],
            ['kode' => '75', 'nama' => 'Tukang Jahit'],
            ['kode' => '76', 'nama' => 'Anggota DPR-RI'],
            ['kode' => '77', 'nama' => 'Ahli Pengobatan Alternatif'],
            ['kode' => '78', 'nama' => 'Dokter Swasta'],
            ['kode' => '79', 'nama' => 'Penata Busana'],
            ['kode' => '80', 'nama' => 'Konsultan Manajemen dan Teknis'],
            ['kode' => '81', 'nama' => 'Wakil Presiden'],
            ['kode' => '82', 'nama' => 'Wakil Walikota'],
            ['kode' => '83', 'nama' => 'Dukun Tradisional'],
            ['kode' => '84', 'nama' => 'Konstruksi'],
            ['kode' => '85', 'nama' => 'Tukang Listrik'],
            ['kode' => '86', 'nama' => 'Mekanik'],
            ['kode' => '87', 'nama' => 'Presiden'],
            ['kode' => '88', 'nama' => 'Duta Besar'],
            ['kode' => '89', 'nama' => 'Anggota Mahkamah Konstitusi'],
            ['kode' => '90', 'nama' => 'Notaris'],
            ['kode' => '91', 'nama' => 'Buruh Jasa Perdagangan Hasil Bumi'],
            ['kode' => '92', 'nama' => 'Peneliti'],
            ['kode' => '93', 'nama' => 'Pembantu Rumah Tangga'],
            ['kode' => '94', 'nama' => 'Pelaut'],
            ['kode' => '95', 'nama' => 'Tidak Mempunyai Pekerjaan Tetap'],
            ['kode' => '96', 'nama' => 'Paraji'],
            ['kode' => '97', 'nama' => 'Bidan'],
            ['kode' => '98', 'nama' => 'Biarawati'],
            ['kode' => '99', 'nama' => 'Buruh Migran'],
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
