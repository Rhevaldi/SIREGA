<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    // Method untuk mengambil desa di Kecamatan Loa Kulu (ID: 640205)
    public static function getVillagesInLoaKulu(): Collection
    {
        // ID Kecamatan Loa Kulu = 6403050
        $response = Http::get(
            "https://www.emsifa.com/api-wilayah-indonesia/api/villages/6403050.json"
        );

        if ($response->successful()) {
            return collect($response->json())
                ->filter(fn($village) => $village['name'] === 'LOA KULU KOTA');
        }

        return collect([]);
    }

    public static function getDistrictsInKutaiKartanegara(): Collection
    {
        // ID Kutai Kartanegara = 6403
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/6403.json");

        if ($response->successful()) {
            return collect($response->json())
                ->filter(fn($district) => $district['name'] === 'LOA KULU');
        }

        return collect([]);
    }

    public static function getCitiesInKaltim(): Collection
    {
        // ID Kalimantan Timur = 64
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/64.json");

        if ($response->successful()) {
            $allCities = collect($response->json());

            // Filter hanya untuk "KABUPATEN KUTAI KARTANEGARA"
            return $allCities->filter(function ($city) {
                return $city['name'] == 'KABUPATEN KUTAI KARTANEGARA';
            });
        }

        return collect([]);
    }
    public static function getProvinces(): Collection
    {
        // Endpoint API Emsifa untuk Provinsi
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json");

        if ($response->successful()) {
            $allProvinces = collect($response->json());

            // Filter hanya untuk "KABUPATEN KUTAI KARTANEGARA"
            return $allProvinces->filter(function ($province) {
                return $province['name'] == 'KALIMANTAN TIMUR';
            });
        }

        return collect([]);
    }
}
