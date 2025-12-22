<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use Illuminate\Http\Request;

class BansosController extends Controller
{
    public function index()
    {
        $bansos = Bansos::orderBy('tahun', 'desc')->get();
        return view('bansos.index', compact('bansos'));
    }

    public function create()
    {
        return view('bansos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'jenis' => 'required|in:uang,barang,jasa',
            'penyelenggara' => 'required|string|max:255',
            'tahun' => 'required|digits:4'
        ]);

        Bansos::create($request->all());

        return redirect()
            ->route('bansos.index')
            ->with('success', 'Program bansos berhasil ditambahkan');
    }

    public function edit(Bansos $bansos)
    {
        return view('bansos.edit', compact('bansos'));
    }

    public function update(Request $request, Bansos $bansos)
    {
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'jenis' => 'required|in:uang,barang,jasa',
            'penyelenggara' => 'required|string|max:255',
            'tahun' => 'required|digits:4'
        ]);

        $bansos->update($request->all());

        return redirect()
            ->route('bansos.index')
            ->with('success', 'Program bansos berhasil diperbarui');
    }

    public function destroy(Bansos $bansos)
    {
        $bansos->delete();

        return redirect()
            ->route('bansos.index')
            ->with('success', 'Program bansos berhasil dihapus');
    }
}
