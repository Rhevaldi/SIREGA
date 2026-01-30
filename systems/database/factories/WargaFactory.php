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
        // $latitude  = $this->faker->randomFloat(8, -0.528000, -0.519000);
        // $longitude = $this->faker->randomFloat(8, 117.019000, 117.029000);

        // Titik pusat Desa Loa Kulu Kota
        $centerLat = -0.523632;
        $centerLng = 117.023963;
        $coord = $this->generateCoordinate($centerLat, $centerLng, 1000); // radius 2 Km


        return [
            'no_kk' => $this->generateNoKK(), // tidak lagi unique
            'nik' => $this->generateNik(),    // tetap unique
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'tempat_lahir' => 'Kutai Kartanegara',
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
                'kawin',
                'belum kawin',
                'cerai hidup',
                'cerai mati'
            ]),
            'status_hubungan' => $this->faker->randomElement([
                'kepala keluarga',
                'suami',
                'istri',
                'anak',
                'mertua',
                'cucu',
                'orang tua',
                'famili lain',
                'pembantu',
                'lainnya'
            ]),
            'status_warga' => $this->faker->randomElement([
                'aktif',
                'pindah',
                'meninggal',
                'sementara',
                'tidak diketahui',
                'keluar',
                'baru',
                'hilang',
                'wna'
            ]),
            'alamat' => $this->faker->address(),
            'rt_id' => 13,
            // 'latitude' => $latitude,
            // 'longitude' => $longitude,
            'latitude' => $coord['latitude'],
            'longitude' => $coord['longitude'],
        ];
    }

    /**
     * Generate NIK 16 digit (unik & realistis)
     */
    protected function generateNik(): string
    {
        return (string) $this->faker->unique()->numerify('64##############');
    }

    /**
     * Generate No KK 16 digit (tidak harus unik)
     */
    protected function generateNoKK(): string
    {
        return (string) $this->faker->numerify('64##############');
    }

    /**
     * Generate random coordinate within radius (in meters)
     */
    protected function generateCoordinate(float $centerLat, float $centerLng, int $radius = 1000): array
    {
        // Konversi radius ke derajat (approx)
        $radiusInDegrees = $radius / 111320.0; // 1 derajat ~ 111.32 km

        // Sudut acak
        $angle = mt_rand() / mt_getrandmax() * 2 * M_PI;
        // Jarak acak (0..radius)
        $distance = sqrt(mt_rand() / mt_getrandmax()) * $radiusInDegrees;

        // Offset lat/lng
        $latOffset = $distance * cos($angle);
        $lngOffset = $distance * sin($angle) / cos(deg2rad($centerLat));

        return [
            'latitude' => $centerLat + $latOffset,
            'longitude' => $centerLng + $lngOffset,
        ];
    }
}
