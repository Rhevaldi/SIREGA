<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Rt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WargaController extends Controller
{
    // =========================
    // LIST DATA WARGA
    // =========================
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Warga::with('rt');

        if ($keyword) {
            if (auth()->user()->role === 'admin') {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nik', 'like', "%$keyword%")
                      ->orWhere('nama', 'like', "%$keyword%");
                });
            } else {
                $query->where('nama', 'like', "%$keyword%");
            }
        }

        $warga = $query->latest()->get();

        return view('warga.index', compact('warga', 'keyword'));
    }

    // =========================
    // FORM TAMBAH WARGA
    // =========================
    public function create()
    {
        $rt = Rt::all();
        return view('warga.create', compact('rt'));
    }

    // =========================
    // SIMPAN DATA WARGA
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nik'           => 'required|unique:warga',
            'nama'          => 'required',
            'alamat'        => 'required',
            'no_kk'         => 'required',
            'no_hp'         => 'nullable',
            'rt_id'         => 'required',
            'status_warga'  => 'required',
            'latitude'      => 'nullable',
            'longitude'     => 'nullable',
            'foto_rumah'    => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_warga'    => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();

        // Upload foto rumah
        if ($request->hasFile('foto_rumah')) {
            $data['foto_rumah'] = $request->file('foto_rumah')
                ->store('foto_rumah', 'public');
        }

        // Upload foto warga
        if ($request->hasFile('foto_warga')) {
            $data['foto_warga'] = $request->file('foto_warga')
                ->store('foto_warga', 'public');
        }

        Warga::create($data);

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan');
    }

    // =========================
    // DETAIL WARGA + MAP
    // =========================
    public function show($id)
    {
        $warga = Warga::with('rt')->findOrFail($id);
        return view('warga.show', compact('warga'));
    }

    // =========================
    // FORM EDIT WARGA + MAP
    // =========================
    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        $rt = Rt::all();

        return view('warga.edit', compact('warga', 'rt'));
    }

    // =========================
    // UPDATE DATA WARGA
    // =========================
    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        $request->validate([
            'nik'          => 'required|unique:warga,nik,' . $id,
            'nama'         => 'required',
            'alamat'       => 'required',
            'rt_id'        => 'required',
            'status_warga' => 'required',
            'latitude'     => 'nullable',
            'longitude'    => 'nullable',
            'foto_rumah'   => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_warga'   => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();

        // Update foto rumah
        if ($request->hasFile('foto_rumah')) {
            if ($warga->foto_rumah) {
                Storage::disk('public')->delete($warga->foto_rumah);
            }
            $data['foto_rumah'] = $request->file('foto_rumah')
                ->store('foto_rumah', 'public');
        }

        // Update foto warga
        if ($request->hasFile('foto_warga')) {
            if ($warga->foto_warga) {
                Storage::disk('public')->delete($warga->foto_warga);
            }
            $data['foto_warga'] = $request->file('foto_warga')
                ->store('foto_warga', 'public');
        }

        $warga->update($data);

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil diperbarui');
    }

    // =========================
    // HAPUS DATA WARGA
    // =========================
    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);

        if ($warga->foto_rumah) {
            Storage::disk('public')->delete($warga->foto_rumah);
        }

        if ($warga->foto_warga) {
            Storage::disk('public')->delete($warga->foto_warga);
        }

        $warga->delete();

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus');
    }

    // =========================
    // PETA SEMUA WARGA
    // =========================
    public function map()
    {
        $warga = Warga::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('warga.map', compact('warga'));
    }
}
