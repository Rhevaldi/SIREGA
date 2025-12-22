<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BansosPenerimaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required',
            'bansos_id' => 'required',
            'tanggal_penerimaan' => 'required|date',
            'status' => 'required'
        ]);

        DB::table('bansos_penerima')->insert([
            'warga_id' => $request->warga_id,
            'bansos_id' => $request->bansos_id,
            'tanggal_penerimaan' => $request->tanggal_penerimaan,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Data penerima bansos berhasil disimpan');
    }
}
