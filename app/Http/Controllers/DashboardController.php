<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Bansos;
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


        $statistik = Bansos::withCount([
            'penerima as total' => function ($q) {
                $q->where('status', 'diterima');
            }
        ])->orderBy('nama_program')->get();

        $wargas = Warga::select('nama', 'alamat', 'latitude', 'longitude')->get();

        return view('dashboard', compact(
            'totalWarga',
            'statusWarga',
            'statistik',
            'wargas'
        ));
    }
}
