<?php

namespace App\Http\Controllers;

use App\Http\Requests\Warga\WargaStoreRequest;
use App\Http\Requests\Warga\WargaUpdateRequest;
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

    public function store(WargaStoreRequest $request)
    {
        $validated = $request->validated();

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

    public function update(WargaUpdateRequest $request, Warga $warga)
    {
        $validated = $request->validated();

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
