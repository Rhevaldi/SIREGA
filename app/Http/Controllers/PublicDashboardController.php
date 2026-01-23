<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Support\Facades\DB;

class PublicDashboardController extends Controller
{
    public function index()
    {
        $tahunBerjalan = now()->year;

        // TOTAL DATA UMUM
        $totalWarga = Warga::count();
        $totalKK = Warga::distinct('no_kk')->count('no_kk');

        $statusWarga = [
            'wargaAktif'     => Warga::where('status_warga', 'aktif')->count(),
            'wargaPindah'    => Warga::where('status_warga', 'pindah')->count(),
            'wargaMeninggal' => Warga::where('status_warga', 'meninggal')->count(),
        ];

        // LIST TAHUN BANSOS
        $listTahun = DB::table('bansos')
            ->select('tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        $tahunAktif = request('tahun', $listTahun->first());

        // STATISTIK BANSOS PUBLIK (TANPA DETAIL WARGA)
        $statistik = DB::table('bansos')
            ->leftJoin('bansos_penerima', function ($join) {
                $join->on('bansos.id', '=', 'bansos_penerima.bansos_id')
                     ->where('bansos_penerima.status', 'penerima');
            })
            ->where('bansos.tahun', $tahunAktif)
            ->select(
                'bansos.nama_program',
                DB::raw('COUNT(DISTINCT bansos_penerima.warga_id) as jumlah_warga')
            )
            ->groupBy('bansos.id', 'bansos.nama_program')
            ->orderBy('bansos.nama_program')
            ->get();

        // DATA MAP PUBLIK (TANPA NIK, KK, DLL)
        $wargas = Warga::select('nama', 'alamat', 'latitude', 'longitude')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get()
            ->map(function ($warga) {
                return [
                    'nama'      => $warga->nama,
                    'alamat'    => $warga->alamat,
                    'latitude'  => $warga->latitude,
                    'longitude' => $warga->longitude,
                    'bansos'    => [] // ❌ Tidak expose data bansos per orang di publik
                ];
            });

        return view('welcome', compact(
            'totalWarga',
            'totalKK',
            'statusWarga',
            'statistik',
            'wargas',
            'listTahun',
            'tahunAktif'
        ));
    }
}
