<?php

namespace App\Http\Controllers;

use App\Http\Requests\KartuKeluarga\StoreKartuKeluargaRequest;
use App\Http\Requests\KartuKeluarga\UpdateKartuKeluargaRequest;
use App\Models\KartuKeluarga;
use App\Models\Region;
use App\Models\Warga;

class KartuKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lebih fleksibel karena kamu masih bisa menambah ->paginate() atau ->get()
        $data = KartuKeluarga::sortedByName()->get();

        return view('kk.index', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Default wilayah
        $default = [
            'province_id' => '64',
            'province_name' => 'KALIMANTAN TIMUR',

            'city_id' => '6402',
            'city_name' => 'KABUPATEN KUTAI KARTANEGARA',

            'district_id' => '6403050',
            'district_name' => 'LOA KULU',

            'village_name' => 'LOA KULU KOTA',
            'postal_code' => '75571',
        ];

        // Data wilayah
        $provinces = Region::getProvinces();
        $cities = Region::getCitiesInKaltim();
        $districts = Region::getDistrictsInKutaiKartanegara();
        $villages = Region::getVillagesInLoaKulu();

        return view('kk.create', compact(
            'provinces',
            'cities',
            'districts',
            'villages',
            'default'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKartuKeluargaRequest $request)
    {
        $validated = $request->validated();

        $kartuKeluarga = KartuKeluarga::create($validated);

        return redirect()->route('kk.index')->with('success', 'Data Kartu Keluarga berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KartuKeluarga $kartuKeluarga)
    {
        try {
            $kartuKeluarga->load([
                'warga' => function ($query) {
                    $query->with('pekerjaan')->orderBy('created_at', 'asc');
                },
                'media_warga', // jika ada relasi media
            ]);

            return response()->json([
                'status' => true,
                'kartu_keluarga' => $kartuKeluarga,
                'warga' => $kartuKeluarga->warga,
                'media' => $kartuKeluarga->media_warga ?? [],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => $kartuKeluarga,
                'status' => false,
                'message' => 'Terjadi kesalahan saat mengambil data Kartu Keluarga: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KartuKeluarga $kartuKeluarga)
    {
        // Default wilayah
        $default = [
            'province_id' => '64',
            'province_name' => 'KALIMANTAN TIMUR',

            'city_id' => '6402',
            'city_name' => 'KABUPATEN KUTAI KARTANEGARA',

            'district_id' => '6403050',
            'district_name' => 'LOA KULU',

            'village_name' => 'LOA KULU KOTA',
            'postal_code' => '75571',
        ];

        // Data wilayah
        $provinces = Region::getProvinces();
        $cities = Region::getCitiesInKaltim();
        $districts = Region::getDistrictsInKutaiKartanegara();
        $villages = Region::getVillagesInLoaKulu();

        return view('kk.edit', compact(
            'kartuKeluarga',
            'provinces',
            'cities',
            'districts',
            'villages',
            'default'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKartuKeluargaRequest $request, KartuKeluarga $kartuKeluarga)
    {
        $validated = $request->validated();

        $kartuKeluarga->update($validated);

        return redirect()->route('kk.index')->with('success', 'Data Kartu Keluarga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KartuKeluarga $kartuKeluarga)
    {
        $kartuKeluarga->delete();

        return redirect()->route('kk.index')->with('success', 'Data Kartu Keluarga berhasil dihapus.');
    }
}
