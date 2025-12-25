<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MediaWarga;
use App\Models\Warga;
use Illuminate\Support\Facades\Storage;

class MediaWargaController extends Controller
{

    public function index()
    {
        $medias = MediaWarga::with('warga')->get()->groupBy('warga_id')->map(function ($group) {
            return $group->first();
        })->values();
        return view('media_warga.index', compact('medias'));
    }


    public function create()
    {
        $wargas = Warga::all();
        return view('media_warga.create', compact('wargas'));
    }


    // public function store(Request $request)
    // {
    //     if (!$request->hasFile('file')) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Tidak ada file yang diupload'
    //         ], 422);
    //     }

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'File berhasil diupload',
    //         'file' => $request->file('file'),
    //         'request' => $request->all(),
    //     ]);

    //     $request->validate([
    //         'warga_id' => 'required|exists:warga,id',
    //         'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
    //         'keterangan' => 'nullable|string'
    //     ]);

    //     $file = $request->file('file');
    //     $path = $file->store('media_warga', 'public');

    //     MediaWarga::create([
    //         'warga_id' => $request->warga_id,
    //         'file_name' => $file->getClientOriginalName(),
    //         'file_type' => $file->getClientOriginalExtension(),
    //         'file_path' => $path,
    //         'keterangan' => $request->keterangan,
    //     ]);

    //     return redirect()->route('media_warga.index')->with('success', 'File berhasil diupload');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'file' => 'required|file|mimes:jpg,jpeg,png|max:5120',
            'keterangan' => 'nullable|string'
        ]);

        $file = $request->file('file');
        $path = $file->store('media_warga', 'public');

        MediaWarga::create([
            'warga_id' => $request->warga_id,
            'file_name' => $file->getClientOriginalName(),
            'file_type' => $file->getClientOriginalExtension(),
            'file_path' => $path,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'File berhasil diupload'
        ]);
    }



    public function destroy(MediaWarga $mediaWarga)
    {

        Storage::disk('public')->delete($mediaWarga->file_path);


        $mediaWarga->delete();

        return redirect()->route('media_warga.index')->with('success', 'File berhasil dihapus');
    }


    public function edit(MediaWarga $mediaWarga)
    {
        $wargas = Warga::all();
        return view('media_warga.edit', compact('mediaWarga', 'wargas'));
    }

    public function update(Request $request, MediaWarga $mediaWarga)
    {
        $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'keterangan' => 'nullable|string'
        ]);

        if ($request->hasFile('file')) {
            // hapus file lama
            Storage::disk('public')->delete($mediaWarga->file_path);

            $file = $request->file('file');
            $path = $file->store('media_warga', 'public');

            $mediaWarga->file_name = $file->getClientOriginalName();
            $mediaWarga->file_type = $file->getClientOriginalExtension();
            $mediaWarga->file_path = $path;
        }

        $mediaWarga->update([
            'warga_id' => $request->warga_id,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('media_warga.index')
            ->with('success', 'Media berhasil diperbarui');
    }
}
