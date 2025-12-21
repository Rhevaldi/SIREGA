<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalWarga = Warga::count();

        $wargaAktif = Warga::where('status_warga', 'aktif')->count();

        $statistik = DB::table('kategori_warga')
            ->join('kategori', 'kategori.id', '=', 'kategori_warga.kategori_id')
            ->select(
                'kategori.nama',
                DB::raw('COUNT(kategori_warga.warga_id) as total')
            )
            ->groupBy('kategori.nama')
            ->get();

        return view('dashboard', compact(
            'totalWarga',
            'wargaAktif',
            'statistik'
        ));
    }
}
