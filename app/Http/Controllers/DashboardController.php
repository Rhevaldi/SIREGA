<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $totalWarga = Warga::count();

        $statusWarga = [
            'wargaAktif'     => Warga::where('status_warga', 'aktif')->count(),
            'wargaPindah'    => Warga::where('status_warga', 'pindah')->count(),
            'wargaMeninggal' => Warga::where('status_warga', 'meninggal')->count(),
        ];


        $listTahun = DB::table('bansos')
            ->select('tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        $tahunAktif = request('tahun', $listTahun->first());

   
        $statistik = DB::table('bansos')
            ->leftJoin('bansos_penerima', function ($join) {
                $join->on('bansos.id', '=', 'bansos_penerima.bansos_id')
                     ->where('bansos_penerima.status', 'diterima');
            })
            ->where('bansos.tahun', $tahunAktif)
            ->select(
                'bansos.nama_program',
                DB::raw('COUNT(DISTINCT bansos_penerima.warga_id) as jumlah_warga')
            )
            ->groupBy('bansos.id', 'bansos.nama_program')
            ->orderBy('bansos.nama_program')
            ->get();

        /* ===============================
         * MAP WARGA
         * =============================== */
        $wargas = Warga::select('nama', 'alamat', 'latitude', 'longitude')->get();

        return view('dashboard', compact(
            'totalWarga',
            'statusWarga',
            'statistik',
            'wargas',
            'listTahun',
            'tahunAktif'
        ));
    }
}
