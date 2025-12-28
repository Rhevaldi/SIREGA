<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\MediaWarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
            'warga_id' => $request->warga_id,
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

    public function show(MediaWarga $mediaWarga)
    {
        return response()->json([
            'medias' => $mediaWarga->warga->media()->get()
        ]);
        // return response()->download(storage_path('app/public/' . $mediaWarga->file_path), $mediaWarga->file_name);
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
