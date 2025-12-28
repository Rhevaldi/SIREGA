<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warga>
 */
class WargaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Koordinat sekitar Desa Loa Kulu Kota, Kutai Kartanegara
        // ± beberapa ratus meter
        $latitude  = $this->faker->randomFloat(8, -0.563500, -0.558000);
        $longitude = $this->faker->randomFloat(8, 116.605000, 116.612000);

        return [
            'nik' => $this->generateNik(),
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'tempat_lahir' => 'Loa Kulu',
            'tanggal_lahir' => $this->faker->dateTimeBetween('-70 years', '-17 years')->format('Y-m-d'),
            'agama' => $this->faker->randomElement([
                'Islam',
                'Kristen',
                'Katolik',
                'Hindu',
                'Buddha'
            ]),
            'pendidikan' => $this->faker->randomElement([
                'SD',
                'SMP',
                'SMA',
                'D3',
                'S1',
                'S2'
            ]),
            'pekerjaan' => $this->faker->randomElement([
                'Pelajar',
                'Mahasiswa',
                'Petani',
                'Wiraswasta',
                'PNS',
                'Karyawan Swasta'
            ]),
            'status_perkawinan' => $this->faker->randomElement([
                'Belum Kawin',
                'Kawin',
                'Cerai Hidup',
                'Cerai Mati'
            ]),
            'status_warga' => $this->faker->randomElement([
                'aktif',
                'pindah',
                'meninggal'
            ]),
            'alamat' => $this->faker->address(),
            'rt_id' => 13, // default sesuai permintaan
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];
    }

    /**
     * Generate NIK 16 digit (unik & realistis)
     */
    protected function generateNik(): string
    {
        return (string) $this->faker->unique()->numerify('64##############');
    }
}
