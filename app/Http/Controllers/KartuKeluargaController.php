<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Region;
use App\Models\KartuKeluarga;
use App\Http\Requests\KartuKeluarga\StoreKartuKeluargaRequest;
use App\Http\Requests\KartuKeluarga\UpdateKartuKeluargaRequest;

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
            'province_id'  => '64',
            'province_name' => 'KALIMANTAN TIMUR',

            'city_id'      => '6402',
            'city_name'    => 'KABUPATEN KUTAI KARTANEGARA',

            'district_id'  => '6403050',
            'district_name' => 'LOA KULU',

            'village_name' => 'LOA KULU KOTA',
            'postal_code'  => '75571',
        ];

        // Data wilayah
        $provinces  = Region::getProvinces();
        $cities     = Region::getCitiesInKaltim();
        $districts  = Region::getDistrictsInKutaiKartanegara();
        $villages   = Region::getVillagesInLoaKulu();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KartuKeluarga $kartuKeluarga)
    {
        // Default wilayah
        $default = [
            'province_id'  => '64',
            'province_name' => 'KALIMANTAN TIMUR',

            'city_id'      => '6402',
            'city_name'    => 'KABUPATEN KUTAI KARTANEGARA',

            'district_id'  => '6403050',
            'district_name' => 'LOA KULU',

            'village_name' => 'LOA KULU KOTA',
            'postal_code'  => '75571',
        ];

        // Data wilayah
        $provinces  = Region::getProvinces();
        $cities     = Region::getCitiesInKaltim();
        $districts  = Region::getDistrictsInKutaiKartanegara();
        $villages   = Region::getVillagesInLoaKulu();

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
        // Set `no_kk` to null for all related `Warga` records
        // Warga::where('kk_id', $kartuKeluarga->id)->update(['kk_id' => null]);

        $kartuKeluarga->delete();

        return redirect()->route('kk.index')->with('success', 'Data Kartu Keluarga berhasil dihapus.');
    }
}
