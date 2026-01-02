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

   
        $totalKK = Warga::distinct('no_kk')->count('no_kk');

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

     
        $wargas = Warga::with(['bansosPenerima' => function ($query) use ($tahunBerjalan) {
            $query->whereYear('tanggal_penerimaan', $tahunBerjalan)
                ->where('status', 'penerima')
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
                'alamat'    => $warga->alamat,
                'latitude'  => $warga->latitude,
                'longitude' => $warga->longitude,
                'bansos'    => $warga->bansosPenerima->map(function ($b) {
                    return [
                        'nama'    => $b->nama_bansos,
                        'tanggal'=> $b->tanggal_penerimaan
                    ];
                })->values()
            ];
        });

        return view('dashboard', compact(
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
