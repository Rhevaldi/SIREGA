<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use App\Http\Requests\Report\WargaRequest;

class ReportController extends Controller
{
    public function warga(WargaRequest $request)
    {
        /*
    |--------------------------------------------------------------------------
    | FLAG: apakah filter benar-benar dijalankan
    |--------------------------------------------------------------------------
    */
        $isFiltered = $request->hasAny([
            'jenis_kelamin',
            'status_warga',
            'status_hubungan',
        ]);

        /*
    |--------------------------------------------------------------------------
    | QUERY DASAR (untuk statistik & laporan)
    |--------------------------------------------------------------------------
    */
        $baseQuery = Warga::query();
        /*
    |--------------------------------------------------------------------------
    | APPLY FILTER JIKA ADA
    |--------------------------------------------------------------------------
    */
        if ($request->jenis_kelamin !== 'all') {
            $baseQuery->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->status_warga !== 'all') {
            $baseQuery->where('status_warga', $request->status_warga);
        }

        if ($request->status_hubungan !== 'all') {
            $baseQuery->where('status_hubungan', $request->status_hubungan);
        }

        /*
    |--------------------------------------------------------------------------
    | STATISTIK (Card Ringkasan)
    |--------------------------------------------------------------------------
    */
        if ($isFiltered) {
            // Statistik menyesuaikan filter
            $totalWarga = (clone $baseQuery)->count();

            $totalLaki = (clone $baseQuery)
                ->where('jenis_kelamin', 'L')
                ->count();

            $totalPerempuan = (clone $baseQuery)
                ->where('jenis_kelamin', 'P')
                ->count();

            $totalKK = (clone $baseQuery)
                ->where('status_hubungan', 'kepala keluarga')
                ->count();
        } else {
            // Statistik global (default)
            $totalWarga = Warga::count();

            $totalLaki = Warga::where('jenis_kelamin', 'L')->count();

            $totalPerempuan = Warga::where('jenis_kelamin', 'P')->count();

            $totalKK = Warga::where('status_hubungan', 'kepala keluarga')->count();
        }

        /*
    |--------------------------------------------------------------------------
    | DATA TABEL (HANYA JIKA FILTER DIJALANKAN)
    |--------------------------------------------------------------------------
    */
        $wargas = collect();

        if ($isFiltered) {
            $wargas = (clone $baseQuery)
                ->with(['rt', 'kategori', 'bansos'])
                ->latest()
                ->get();
        }

        /*
    |--------------------------------------------------------------------------
    | DROPDOWN FILTER (SELALU GLOBAL)
    |--------------------------------------------------------------------------
    */
        $jenisKelaminList = Warga::select('jenis_kelamin')
            ->distinct()
            ->orderBy('jenis_kelamin')
            ->pluck('jenis_kelamin');

        $statusWargaList = Warga::select('status_warga')
            ->distinct()
            ->orderBy('status_warga')
            ->pluck('status_warga');

        $statusHubunganList = Warga::select('status_hubungan')
            ->distinct()
            ->orderBy('status_hubungan')
            ->pluck('status_hubungan');

        return view('reports.warga', compact(
            'isFiltered',
            'wargas',
            'totalKK',
            'totalWarga',
            'totalLaki',
            'totalPerempuan',
            'jenisKelaminList',
            'statusWargaList',
            'statusHubunganList'
        ));
    }

    public function cetakWarga(WargaRequest $request)
    {
        $query = Warga::query();

        if ($request->jenis_kelamin !== 'all') {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->status_warga !== 'all') {
            $query->where('status_warga', $request->status_warga);
        }

        if ($request->status_hubungan !== 'all') {
            $query->where('status_hubungan', $request->status_hubungan);
        }

        $wargas = $query
            ->with(['rt', 'kategori', 'bansos'])
            ->orderBy('no_kk', 'asc')
            ->orderBy('nama', 'asc')
            ->orderBy('status_warga', 'desc')
            ->get();

        return view('reports.warga-cetak', compact('wargas'));
    }
}
