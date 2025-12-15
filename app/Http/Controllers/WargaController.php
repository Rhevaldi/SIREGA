<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Rt;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wargas = Warga::with('rt')->get(); 
        return view('warga.index', compact('wargas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rts = Rt::all(); 
        return view('warga.create', compact('rts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:warga,nik',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'status_perkawinan' => 'required|string|max:255',
            'status_warga' => 'required|in:aktif,pindah,meninggal',
            'alamat' => 'required|string',
            'rt_id' => 'required|exists:rt,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Warga::create($validated);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Warga $warga)
    {
        return view('warga.show', compact('warga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warga $warga)
    {
        $rts = Rt::all();
        return view('warga.edit', compact('warga', 'rts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warga $warga)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:warga,nik,' . $warga->id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'status_perkawinan' => 'required|string|max:255',
            'status_warga' => 'required|in:aktif,pindah,meninggal',
            'alamat' => 'required|string',
            'rt_id' => 'required|exists:rt,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $warga->update($validated);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
