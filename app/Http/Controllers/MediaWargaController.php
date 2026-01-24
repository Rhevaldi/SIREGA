<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use App\Models\MediaWarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaWargaController extends Controller
{

    public function index()
    {
        $kartuKeluargas = KartuKeluarga::with(['medias'])
            ->withCount('medias')
            ->has('medias')
            ->get();

        return view('media_warga.index', compact('kartuKeluargas'));
    }



    public function create()
    {
        $kartu_keluargas = KartuKeluarga::all();
        return view('media_warga.create', compact('kartu_keluargas'));
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
    //         'kk_id' => 'required|exists:warga,id',
    //         'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
    //         'keterangan' => 'nullable|string'
    //     ]);

    //     $file = $request->file('file');
    //     $path = $file->store('media_warga', 'public');

    //     MediaWarga::create([
    //         'kk_id' => $request->kk_id,
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
            'kk_id' => 'required|exists:kartu_keluargas,id',
            'file' => 'required|file|mimes:jpg,jpeg,png|max:5120',
            'keterangan' => 'nullable|string'
        ]);

        $file = $request->file('file');
        // Nama asli file
        // $originalName = $file->getClientOriginalName();
        // Ambil ekstensi file
        $extension = $file->getClientOriginalExtension();
        // Unique ID acak 8 digit angka
        $uniqueId = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
        // // Enkripsi nama file
        // $encryptedName = Crypt::encryptString($originalName);
        // // Supaya bisa dipakai sebagai nama file di storage, biasanya di-hash atau diubah
        // $safeName = md5($encryptedName) . '.' . $file->getClientOriginalExtension();
        // // Simpan file ke storage
        // $path = $file->storeAs('media_warga', $safeName, 'public');
        // custom nama file sudah termasuk file_extension
        $file_name = now()->format('Ymd') . '_' . $uniqueId;
        // Simpan file ke storage
        $file_path = $file->storeAs('media_warga', $file_name . '.' . $extension, 'public');

        MediaWarga::create([
            'kk_id' => $request->kk_id,
            'file_name' => $file_name,
            'file_type' => $file->getClientOriginalExtension(),
            'file_path' => $file_path,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'File berhasil diupload'
        ]);
    }

    public function show($kk_id)
{
    $kk = KartuKeluarga::with('medias')->findOrFail($kk_id);

    return response()->json([
        'medias' => $kk->medias
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
        $kartu_keluargas = KartuKeluarga::all();
        return view('media_warga.edit', compact('mediaWarga', 'kartu_keluargas'));
    }

    public function update(Request $request, MediaWarga $mediaWarga)
    {
        $request->validate([
            'kk_id' => 'required|exists:kartu_keluargas,id',
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
            'kk_id' => $request->kk_id,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('media_warga.index')
            ->with('success', 'Media berhasil diperbarui');
    }
}
