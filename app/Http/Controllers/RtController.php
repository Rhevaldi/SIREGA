<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use Illuminate\Http\Request;

class RtController extends Controller
{
    public function index()
    {

        $rt = Rt::withCount('warga')->latest()->get();
        return view('rt.index', compact('rt'));
    }

    public function create()
    {
        return view('rt.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_rt' => 'required|unique:rt,nama_rt',
            'wilayah' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        Rt::create($request->all());

        return redirect()->route('rt.index')
            ->with('success', 'RT berhasil ditambahkan');
    }

    public function edit($id)
    {
        $rt = Rt::findOrFail($id);
        return view('rt.edit', compact('rt'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_rt' => 'required|unique:rt,nama_rt,' . $id,
            'wilayah' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $rt = Rt::findOrFail($id);
        $rt->update($request->all());

        return redirect()->route('rt.index')
            ->with('success', 'RT berhasil diperbarui');
    }

    public function destroy($id)
    {
        $rt = Rt::withCount('warga')->findOrFail($id);


        if ($rt->warga_count > 0) {
            return redirect()->route('rt.index')
                ->with('error', 'RT tidak bisa dihapus karena masih memiliki warga');
        }

        $rt->delete();

        return redirect()->route('rt.index')
            ->with('success', 'RT berhasil dihapus');
    }
}
