<?php


namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function index()
    {
        $desa = Desa::latest()->get();
        return view('desa.index', compact('desa'));
    }

    public function create()
    {
        $wargas = \App\Models\Warga::all();
        return view('desa.create', compact('wargas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_desa' => 'required|unique:desa,nama_desa',
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
        ]);

        Desa::create($request->all());

        return redirect()->route('desa.index')
            ->with('success', 'Desa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $desa = Desa::findOrFail($id);
        return view('desa.edit', compact('desa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_desa' => 'required|unique:desa,nama_desa,' . $id,
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
        ]);

        $desa = Desa::findOrFail($id);
        $desa->update($request->all());

        return redirect()->route('desa.index')
            ->with('success', 'Desa berhasil diperbarui');
    }

    public function destroy($id)
   {
    $desa = Desa::findOrFail($id);
    $desa->delete();
    return redirect()->route('desa.index')
        ->with('success', 'Desa berhasil dihapus');

   }

}
