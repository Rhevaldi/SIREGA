<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\Desa;
use App\Models\Warga;
use Illuminate\Http\Request;

class RtController extends Controller
{
    public function index()
    {
        $rts = Rt::with('desa')->withCount('warga')->latest()->get();
        return view('rt.index', compact('rts'));
    }

    public function create()
    {
        $desas = Desa::orderBy('nama_desa')->get();
        $wargas = Warga::orderBy('nama')->get();
        return view('rt.create', compact('desas', 'wargas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'desa_id' => 'required|exists:desa,id',
            'rt' => 'required|string|max:255',
            'ketua_warga_id' => 'nullable|exists:warga,id',
        ]);

        Rt::create($validated);

        return redirect()->route('rt.index')->with('success', 'RT berhasil ditambahkan');
    }

    public function edit(Rt $rt)
    {
        $desas = Desa::orderBy('nama_desa')->get();
        $wargas = Warga::orderBy('nama')->get();
        return view('rt.edit', compact('rt', 'desas', 'wargas'));
    }

    public function update(Request $request, Rt $rt)
    {
        $validated = $request->validate([
            'desa_id' => 'required|exists:desa,id',
            'rt' => 'required|string|max:255',
            'ketua_warga_id' => 'nullable|exists:warga,id',
        ]);

        $rt->update($validated);

        return redirect()->route('rt.index')->with('success', 'RT berhasil diperbarui');
    }

    public function destroy(Rt $rt)
    {
        if ($rt->warga()->count() > 0) {
            return redirect()->route('rt.index')
                ->with('error', 'RT tidak bisa dihapus karena masih memiliki warga');
        }

        $rt->delete();
        return redirect()->route('rt.index')->with('success', 'RT berhasil dihapus');
    }
}
