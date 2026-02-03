<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use App\Models\KartuKeluarga;
use App\Models\Warga;
use Illuminate\Support\Facades\DB;

class PublicDashboardController extends Controller
{
    public function index()
    {
        $tahunBerjalan = now()->year;

        // STATISTIK UMUM DATA WARGA
        $totalWarga = Warga::count();
        $totalKK = KartuKeluarga::count();

        // STATUS WARGA
        $statusWarga = [
            'wargaAktif'     => Warga::where('status_warga', 'aktif')->count(),
            'wargaPindah'    => Warga::where('status_warga', 'pindah')->count(),
            'wargaMeninggal' => Warga::where('status_warga', 'meninggal')->count(),
        ];

        // JENIS KELAMIN
        $jenisKelamin = [
            'laki'      => Warga::where('jenis_kelamin', 'L')->count(),
            'perempuan' => Warga::where('jenis_kelamin', 'P')->count(),
        ];

        // DAFTAR TAHUN BANSOS (UNTUK FILTER)
        $listTahun = Bansos::select('tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun')
            ->toArray();

        $tahunAktif = (int) request('tahun', $tahunBerjalan);

        // Validasi tahun yang dipilih ada dalam daftar
        if (!in_array($tahunAktif, $listTahun)) {
            $tahunAktif = !empty($listTahun) ? $listTahun[0] : $tahunBerjalan;
        }

        // STATISTIK PROGRAM BANSOS PUBLIK (TANPA DETAIL WARGA)
        $statistik = Bansos::with(['warga' => function ($query) {
            $query->wherePivot('status', 'penerima');
        }])
            ->where('tahun', $tahunAktif)
            ->get()
            ->map(function ($bansos) {
                return [
                    'id'            => $bansos->id,
                    'nama_program'  => $bansos->nama_program,
                    'jenis'         => $bansos->jenis,
                    'penyelenggara' => $bansos->penyelenggara,
                    'tahun'         => $bansos->tahun,
                    'jumlah_warga'  => $bansos->warga->count(),
                ];
            })
            ->sortBy('nama_program')
            ->values();

        // DATA LOKASI PUBLIK UNTUK MAP (TANPA INFO SENSITIF)
        $wargas = KartuKeluarga::with('warga')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get()
            ->map(function ($kk) {
                return [
                    'id'        => $kk->id,
                    'alamat'    => $kk->alamat,
                    'latitude'  => (float) $kk->latitude,
                    'longitude' => (float) $kk->longitude,
                    'jumlah_warga' => $kk->warga->count(),
                ];
            });

        return view('welcome', compact(
            'totalWarga',
            'totalKK',
            'statusWarga',
            'jenisKelamin',
            'statistik',
            'wargas',
            'listTahun',
            'tahunAktif'
        ));
    }

    public function warga()
{
    $wargas = Warga::with(['rt', 'kategori', 'bansos', 'pekerjaan'])
        ->get();

    $bansosList = Bansos::orderBy('nama_program')->get();

    return view('publik.index', compact('wargas', 'bansosList'));
}

}
