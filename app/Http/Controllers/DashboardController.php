<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $tahunBerjalan = now()->year;

        $totalWarga = Warga::count();

        $statusWarga = [
            'wargaAktif' => Warga::where('status_warga', 'aktif')->count(),
            'wargaPindah' => Warga::where('status_warga', 'pindah')->count(),
            'wargaMeninggal' => Warga::where('status_warga', 'meninggal')->count(),
        ];

        $statistik = DB::table('kategori_warga')
            ->join('kategori', 'kategori.id', '=', 'kategori_warga.kategori_id')
            ->select(
                'kategori.nama',
                DB::raw('COUNT(kategori_warga.warga_id) as total')
            )
            ->groupBy('kategori.nama')
            ->get();

        $wargas = Warga::with(['bansosPenerima' => function ($query) use ($tahunBerjalan) {
            $query->whereYear('tanggal_penerimaan', $tahunBerjalan)
                ->where('status', 'diterima')
                ->join('bansos', 'bansos.id', '=', 'bansos_penerima.bansos_id')
                ->select(
                    'bansos_penerima.warga_id',
                    'bansos.nama_program as nama_bansos',
                    'bansos_penerima.tanggal_penerimaan'
                );
        }])
            ->select('id', 'nama', 'alamat', 'latitude', 'longitude')
            ->get()
            ->map(function ($warga) {
                return [
                    'nama'      => $warga->nama,
                    'alamat'   => $warga->alamat,
                    'latitude' => $warga->latitude,
                    'longitude' => $warga->longitude,
                    'bansos'   => $warga->bansosPenerima->map(function ($b) {
                        return [
                            'nama' => $b->nama_bansos,
                            'tanggal' => $b->tanggal_penerimaan
                        ];
                    })->values()
                ];
            });

        return view('dashboard', compact(
            'totalWarga',
            'statusWarga',
            'statistik',
            'wargas'
        ));
    }
}
