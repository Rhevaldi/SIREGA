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
        $medias = MediaWarga::with('warga')->get();
        return view('media_warga.index', compact('medias'));
    }

   
    public function create()
    {
        $wargas = Warga::all();
        return view('media_warga.create', compact('wargas'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'file' => 'required|file|max:10240', 
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

        return redirect()->route('media_warga.index')->with('success', 'File berhasil diupload');
    }

    
    public function destroy(MediaWarga $mediaWarga)
    {
      
        Storage::disk('public')->delete($mediaWarga->file_path);

        
        $mediaWarga->delete();

        return redirect()->route('media_warga.index')->with('success', 'File berhasil dihapus');
    }
}
