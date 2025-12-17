<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Rt;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        $wargas = Warga::with('rt')->orderBy('nama')->get();
        return view('warga.index', compact('wargas'));
    }

    public function create()
    {
        // Ambil semua RT dari tabel rt
        $rts = Rt::orderBy('rt')->get();
        return view('warga.create', compact('rts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:warga,nik',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'status_perkawinan' => 'required|in:belum menikah,menikah,cerai',
            'status_warga' => 'required|in:aktif,pindah,meninggal',
            'alamat' => 'required|string',
            'rt_id' => 'required|exists:rt,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        Warga::create($validated);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

 public function edit(Warga $warga)
{
    $rts = Rt::orderBy('rt')->get();
    return view('warga.edit', compact('warga','rts'));
}

public function update(Request $request, Warga $warga)
{
    $validated = $request->validate([
        'nik' => 'required|unique:warga,nik,' . $warga->id,
        'nama' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:L,P',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'agama' => 'required|string|max:255',
        'pendidikan' => 'nullable|string|max:255',
        'pekerjaan' => 'nullable|string|max:255',
        'status_perkawinan' => 'required|in:belum menikah,menikah,cerai',
        'status_warga' => 'required|in:aktif,pindah,meninggal',
        'alamat' => 'required|string',
        'rt_id' => 'required|exists:rt,id',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
    ]);

    $warga->update($validated);

    return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.');
}

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
