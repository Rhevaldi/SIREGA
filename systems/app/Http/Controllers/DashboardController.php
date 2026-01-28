<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\KartuKeluarga;
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

        // ===============================
        // LIST TAHUN BANSOS
        // ===============================
        $listTahun = DB::table('bansos')
            ->select('tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        $tahunAktif = request('tahun', $listTahun->first());

        // ===============================
        // STATISTIK PIE BANSOS
        // ===============================
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

        // ===============================
        // DATA WARGA UNTUK MAP & MODAL
        // ===============================
        // Ambil data KartuKeluarga, bungkus data `warga` di dalamnya beserta bansos dan medias.
        $wargas = KartuKeluarga::with([
            'warga.rt',
            'warga.bansosAll',
            'warga.bansosTahunBerjalan',
            'media'
        ])->get()->map(function (KartuKeluarga $kk) {
            return [
                ...$kk->only([
                    'id',
                    'no_kk',
                    'nama_kepala_keluarga',
                    'alamat',
                    'rt',
                    'rw',
                    'desa',
                    'kecamatan',
                    'kabupaten',
                    'provinsi',
                    'kode_pos',
                    'latitude',
                    'longitude',
                ]),

                'warga' => $kk->warga->map(function ($warga) {
                    return [
                        ...$warga->only([
                            'nik',
                            'nama',
                            'jenis_kelamin',
                            'tempat_lahir',
                            'tanggal_lahir',
                            'agama',
                            'pendidikan',
                            'pekerjaan',
                            'status_hubungan',
                            'status_perkawinan',
                            'status_warga',
                        ]),

                        // BANSOS (via bansos_penerima.warga_id)
                        'bansos_all' => $warga->bansosAll->map(function ($b) {
                            return [
                                'nama'       => $b->nama_program ?? $b->nama_bansos,
                                'tahun'      => \Carbon\Carbon::parse($b->pivot->tanggal_penerimaan)->year,
                                'keterangan' => $b->pivot->keterangan ?? '-',
                                'status'     => $b->pivot->status,
                                'tanggal'    => $b->pivot->tanggal_penerimaan,
                            ];
                        })->values(),

                        'has_bansos_tahun_berjalan' =>
                        $warga->bansosTahunBerjalan->isNotEmpty(),
                    ];
                })->values(),

                // MEDIA → dari KartuKeluarga
                'medias' => $kk->media->map(function ($m) {
                    return [
                        'file_path'  => $m->file_path,
                        'file_name'  => $m->file_name,
                        'file_type'  => $m->file_type,
                        'keterangan' => $m->keterangan,
                    ];
                })->values() ?? [],
            ];
        })->values();

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
