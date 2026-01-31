<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Warga;
use App\Models\Bansos;
use App\Models\KartuKeluarga;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $tahunBerjalan = now()->year;

        // ===============================
        // 1. STATISTIK JUMLAH
        // ===============================
        $totalKK = KartuKeluarga::count();
        $totalWarga = Warga::count();
        $totalLakiLaki = Warga::where('jenis_kelamin', 'L')->count();
        $totalPerempuan = Warga::where('jenis_kelamin', 'P')->count();

        // ===============================
        // LIST TAHUN BANSOS
        // ===============================
        $listTahun = DB::table('bansos_penerima')
            ->selectRaw('YEAR(tanggal_penerimaan) as tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        $tahunAktif = request('tahun', $listTahun->first());

        // ===============================
        // 2. STATISTIK BAR CHART PENERIMA BANTUAN (dengan status: calon & penerima)
        // ===============================
        $bansosStats = DB::table('bansos')
            ->leftJoin('bansos_penerima', function ($join) use ($tahunAktif) {
                $join->on('bansos.id', '=', 'bansos_penerima.bansos_id')
                    ->whereIn('bansos_penerima.status', ['calon penerima', 'penerima'])
                    ->whereRaw('YEAR(bansos_penerima.tanggal_penerimaan) = ?', [$tahunAktif]);
            })
            ->select(
                'bansos.id',
                'bansos.nama_program',
                'bansos_penerima.status',
                DB::raw('COUNT(DISTINCT bansos_penerima.warga_id) as jumlah_penerima')
            )
            ->groupBy('bansos.id', 'bansos.nama_program', 'bansos_penerima.status')
            ->orderBy('bansos.nama_program')
            ->orderBy('bansos_penerima.status')
            ->get();

        // ===============================
        // 3. STATISTIK PIE CHART BANSOS (untuk backward compatibility)
        // ===============================
        $statistik = DB::table('bansos')
            ->leftJoin('bansos_penerima', function ($join) use ($tahunAktif) {
                $join->on('bansos.id', '=', 'bansos_penerima.bansos_id')
                    ->where('bansos_penerima.status', 'penerima')
                    ->whereRaw('YEAR(bansos_penerima.tanggal_penerimaan) = ?', [$tahunAktif]);
            })
            ->select(
                'bansos.id',
                'bansos.nama_program',
                DB::raw('COUNT(DISTINCT bansos_penerima.warga_id) as jumlah_warga')
            )
            ->groupBy('bansos.id', 'bansos.nama_program')
            ->orderBy('bansos.nama_program')
            ->get();

        // ===============================
        // 4. STATISTIK PIE CHART WARGA BY JENIS KELAMIN
        // ===============================
        $wargaByJenisKelamin = Warga::selectRaw("jenis_kelamin, COUNT(*) as jumlah")
            ->groupBy('jenis_kelamin')
            ->get()
            ->mapWithKeys(function ($item) {
                $jenis = $item->jenis_kelamin === 'L' ? 'Laki-Laki' : ($item->jenis_kelamin === 'P' ? 'Perempuan' : 'Tidak Diketahui');
                return [$jenis => $item->jumlah];
            });

        // ===============================
        // 5. DATA WARGA UNTUK MAP & MODAL
        // ===============================
        // Ambil data KartuKeluarga, bungkus data `warga` di dalamnya beserta bansos dan medias.
        $wargas = KartuKeluarga::with([
            'warga.rt',
            'warga.bansosAll',
            'warga.bansosTahunBerjalan',
            'media_warga',
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
                        'bansos_all' => $warga->bansosAll
                            ->filter(function ($b) {
                                // Filter hanya data yang memiliki pivot dan tanggal_penerimaan
                                return $b->pivot && $b->pivot->tanggal_penerimaan;
                            })
                            ->map(function ($b) {
                                return [
                                    'nama'       => $b->nama_program ?? $b->nama_bansos ?? '-',
                                    'tahun'      => Carbon::parse($b->pivot->tanggal_penerimaan)->year,
                                    'keterangan' => $b->pivot->keterangan ?? '-',
                                    'status'     => $b->pivot->status ?? '-',
                                    'tanggal'    => $b->pivot->tanggal_penerimaan,
                                ];
                            })->values(),

                        'has_bansos_tahun_berjalan' =>
                        $warga->bansosTahunBerjalan->isNotEmpty(),
                    ];
                })->values(),

                // MEDIA → dari KartuKeluarga
                'medias' => $kk->media_warga->map(function ($m) {
                    return [
                        'file_path'  => $m->file_path,
                        'file_name'  => $m->file_name,
                        'file_type'  => $m->file_type,
                        'keterangan' => $m->keterangan,
                    ];
                })->values() ?? [],
            ];
        })->values();

        $bansosList = Bansos::orderBy('nama_program')->get();

        return view('dashboard', compact(
            'totalKK',
            'totalWarga',
            'totalLakiLaki',
            'totalPerempuan',
            'bansosStats',
            'statistik',
            'wargaByJenisKelamin',
            'wargas',
            'listTahun',
            'tahunAktif',
            'bansosList',
        ));
    }
}
