<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\Warga;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Bansos;

class WargaController extends Controller
{
    public function index()
    {
        $wargas = Warga::with(['rt', 'kategori', 'bansos'])->get();
        $bansosList = Bansos::orderBy('nama_program')->get();

         return view('warga.index', compact('wargas', 'bansosList'));

    }

    public function create()
    {

        $rts = Rt::orderBy('rt')->get();
        $kategoris = Kategori::orderBy('tipe')->get();
        return view('warga.create', compact('rts', 'kategoris'));
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


        $warga = Warga::create($validated);

        if ($request->kategori) {
            foreach ($request->kategori as $kategori_id => $nilai) {
                if ($nilai !== null && $nilai !== '') {
                    $warga->kategori()->attach($kategori_id, [
                        'nilai' => $nilai
                    ]);
                }
            }
        }




        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function edit(Warga $warga)
    {
        $rts = Rt::all();
        $kategoris = Kategori::orderBy('tipe')->orderBy('kode')->get();

      
        $warga->load('kategori');

        return view('warga.edit', compact(
            'warga',
            'rts',
            'kategoris'
        ));
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

        $warga->kategori()->detach(); // reset dulu

        if ($request->kategori) {
            foreach ($request->kategori as $kategori_id => $nilai) {
                if ($nilai !== null && $nilai !== '') {
                    $warga->kategori()->attach($kategori_id, [
                        'nilai' => $nilai
                    ]);
                }
            }
        }


        $warga->update($validated);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
