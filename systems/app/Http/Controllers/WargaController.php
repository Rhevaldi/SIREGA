<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\Warga;
use App\Models\Bansos;
use App\Models\Kategori;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use App\Models\KartuKeluarga;
use App\Http\Requests\Warga\WargaStoreRequest;
use App\Http\Requests\Warga\WargaUpdateRequest;

class WargaController extends Controller
{
    public function index()
    {
        $wargas = Warga::with(['rt', 'kategori', 'bansos', 'pekerjaan', 'kartuKeluarga'])->get();
        $bansosList = Bansos::orderBy('nama_program')->get();

        return view('warga.index', compact('wargas', 'bansosList'));
    }

    

    public function create()
    {
        $kartu_keluargas = KartuKeluarga::select(['no_kk'])->orderBy('no_kk', 'ASC')->get();
        $kategoris = Kategori::orderBy('tipe')->get();
        $religions = [
            'Islam' => 'Islam',
            'Kristen' => 'Kristen',
            'Katolik' => 'Katolik',
            'Hindu' => 'Hindu',
            'Buddha' => 'Buddha',
            'Konghucu' => 'Konghucu',
            'Kepercayaan lainnya' => 'Kepercayaan lainnya'
        ];
        $jenis_kelamin = [
            'L' => 'Laki-laki',
            'P' => 'Perempuan'
        ];
        $pendidikan = [
            'Tidak/Belum Sekolah' => 'Tidak/Belum Sekolah',
            'Belum Tamat SD/Sederajat' => 'Belum Tamat SD/Sederajat',
            'Tamat SD/Sederajat' => 'Tamat SD/Sederajat',
            'SLTP/Sederajat' => 'SLTP/Sederajat',
            'SLTA/Sederajat' => 'SLTA/Sederajat',
            'Diploma I/II' => 'Diploma I/II',
            'Diploma III/Sarjana Muda' => 'Diploma III/Sarjana Muda',
            'Diploma IV/Strata I' => 'Diploma IV/Strata I',
            'Strata II' => 'Strata II',
            'Strata III' => 'Strata III',
        ];
        $pekerjaans = Pekerjaan::select(['id', 'nama'])->orderBy('nama')->get();
        $status_perkawinan = [
            'Kawin Tercatat' => 'Kawin Tercatat',
            'Kawin Tidak Tercatat' => 'Kawin Tidak Tercatat',
            'Kawin' => 'Kawin',
            'Belum Kawin' => 'Belum Kawin',
            'Cerai Hidup' => 'Cerai Hidup',
            'Cerai Mati' => 'Cerai Mati'
        ];
        $status_hubungan = [
            'Kepala Keluarga' => 'Kepala Keluarga',
            'Suami' => 'Suami',
            'Istri' => 'Istri',
            'Anak' => 'Anak',
            'Menantu' => 'Menantu',
            'Cucu' => 'Cucu',
            'Orang Tua' => 'Orang Tua',
            'Mertua' => 'Mertua',
            'Famili Lain' => 'Famili Lain',
            'Lainnya' => 'Lainnya'
        ];
        $status_warga = [
            'Aktif' => 'Aktif',
            'Pindah' => 'Pindah',
            'Meninggal' => 'Meninggal',
            'Sementara' => 'Sementara',
            'Tidak Diketahui' => 'Tidak Diketahui',
            'Keluar' => 'Keluar',
            'Baru' => 'Baru',
            'Hilang' => 'Hilang',
            'WNA' => 'Warga Negara Asing'
        ];

        return view('warga.create', compact(
            'kartu_keluargas',
            'kategoris',
            'religions',
            'jenis_kelamin',
            'pendidikan',
            'pekerjaans',
            'status_perkawinan',
            'status_hubungan',
            'status_warga'
        ));
    }

    public function store(WargaStoreRequest $request)
    {
        $validated = $request->validated();

        $warga = Warga::create($validated);

        // Jika Kepala Keluarga, update nama di tabel KK
        if ($validated['status_hubungan'] === 'Kepala Keluarga') {
            KartuKeluarga::where('no_kk', $validated['no_kk'])
                ->update([
                    'nama_kepala_keluarga' => $validated['nama']
                ]);
        }

        // Attach kategori (jika ada)
        if ($request->filled('kategori')) {
            foreach ($request->kategori as $kategori_id => $nilai) {
                if ($nilai !== null && $nilai !== '') {
                    $warga->kategori()->attach($kategori_id, [
                        'nilai' => $nilai
                    ]);
                }
            }
        }

        return redirect()
            ->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function show(Warga $warga)
    {
        try {
            $warga->load('kategori', 'pekerjaan', 'kartuKeluarga', 'bansos');

            return response()->json([
                'status' => true,
                'warga' => $warga,
                'kategori' => $warga->kategori,
                'kartu_keluarga' => $warga->kartuKeluarga,
                'bansos' => $warga->bansos,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => $warga,
                'status' => false,
                'message' => 'Terjadi kesalahan saat mengambil data Warga: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Warga $warga)
    {
        $kartu_keluargas = KartuKeluarga::select(['no_kk'])->orderBy('no_kk', 'ASC')->get();
        $rts = Rt::all();
        $kategoris = Kategori::orderBy('tipe')->orderBy('kode')->get();
        $religions = [
            'Islam' => 'Islam',
            'Kristen' => 'Kristen',
            'Katolik' => 'Katolik',
            'Hindu' => 'Hindu',
            'Buddha' => 'Buddha',
            'Konghucu' => 'Konghucu',
            'Kepercayaan lainnya' => 'Kepercayaan lainnya'
        ];
        $jenis_kelamin = [
            'L' => 'Laki-laki',
            'P' => 'Perempuan'
        ];
        $pendidikan = [
            'Tidak/Belum Sekolah' => 'Tidak/Belum Sekolah',
            'Belum Tamat SD/Sederajat' => 'Belum Tamat SD/Sederajat',
            'Tamat SD/Sederajat' => 'Tamat SD/Sederajat',
            'SLTP/Sederajat' => 'SLTP/Sederajat',
            'SLTA/Sederajat' => 'SLTA/Sederajat',
            'Diploma I/II' => 'Diploma I/II',
            'Diploma III/Sarjana Muda' => 'Diploma III/Sarjana Muda',
            'Diploma IV/Strata I' => 'Diploma IV/Strata I',
            'Strata II' => 'Strata II',
            'Strata III' => 'Strata III',
        ];
        $pekerjaans = Pekerjaan::select(['id', 'nama'])->orderBy('nama')->get();
        $status_perkawinan = [
            'Kawin Tercatat' => 'Kawin Tercatat',
            'Kawin Tidak Tercatat' => 'Kawin Tidak Tercatat',
            'Kawin' => 'Kawin',
            'Belum Kawin' => 'Belum Kawin',
            'Cerai Hidup' => 'Cerai Hidup',
            'Cerai Mati' => 'Cerai Mati'
        ];
        $status_hubungan = [
            'Kepala Keluarga' => 'Kepala Keluarga',
            'Suami' => 'Suami',
            'Istri' => 'Istri',
            'Anak' => 'Anak',
            'Menantu' => 'Menantu',
            'Cucu' => 'Cucu',
            'Orang Tua' => 'Orang Tua',
            'Mertua' => 'Mertua',
            'Famili Lain' => 'Famili Lain',
            'Lainnya' => 'Lainnya'
        ];
        $status_warga = [
            'Aktif' => 'Aktif',
            'Pindah' => 'Pindah',
            'Meninggal' => 'Meninggal',
            'Sementara' => 'Sementara',
            'Tidak Diketahui' => 'Tidak Diketahui',
            'Keluar' => 'Keluar',
            'Baru' => 'Baru',
            'Hilang' => 'Hilang',
            'WNA' => 'Warga Negara Asing'
        ];

        $warga->load('kategori');

        return view('warga.edit', compact(
            'warga',
            'kartu_keluargas',
            'kategoris',
            'religions',
            'jenis_kelamin',
            'pendidikan',
            'pekerjaans',
            'status_perkawinan',
            'status_hubungan',
            'status_warga'
        ));
    }

    public function update(WargaUpdateRequest $request, Warga $warga)
    {
        $validated = $request->validated();

        $warga->kategori()->detach();

        if ($request->kategori) {
            foreach ($request->kategori as $kategori_id => $nilai) {
                if ($nilai !== null && $nilai !== '') {
                    $warga->kategori()->attach($kategori_id, [
                        'nilai' => $nilai
                    ]);
                }
            }
        }

        $warga->update($validated);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $warga = Warga::where('nik', $keyword)
            ->orWhere('no_kk', $keyword)
            ->first();

        if (!$warga) {
            return response()->json([
                'status' => false
            ]);
        }

        // Ambil seluruh keluarga
        $keluarga = Warga::where('no_kk', $warga->no_kk)
            ->select(
                'no_kk',
                'nik',
                'nama',
                'status_hubungan',
                'status_warga'
            )
            ->orderByRaw("FIELD(status_hubungan, 'kepala keluarga') DESC")
            ->get();

        return response()->json([
            'status' => true,
            'data'   => $keluarga
        ]);
    }
}
