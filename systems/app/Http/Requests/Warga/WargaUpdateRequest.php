<?php

namespace App\Http\Requests\Warga;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class WargaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'no_kk' => 'required|exists:kartu_keluargas,no_kk',
            'nik' => 'required|numeric|min_digits:16|max_digits:16|' . Rule::unique('warga', 'nik')->ignore($this->warga->id),
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu, Kepercayaan lainnya',
            'pendidikan' => 'required|in:Tidak/Belum Sekolah,Belum Tamat SD/Sederajat,Tamat SD/Sederajat,SLTP/Sederajat,SLTA/Sederajat,Diploma I/II,Diploma III/Sarjana Muda,Diploma IV/Strata I,Strata II,Strata III',
            'pekerjaan_id' => 'required|exists:pekerjaans,id',
            'status_perkawinan' => 'required|in:Kawin Tercatat,Kawin Tidak Tercatat,Kawin,Belum Kawin,Cerai Hidup,Cerai Mati',
            'status_hubungan' => 'required|in:Kepala Keluarga,Suami,Istri,Anak,Menantu,Cucu,Orang Tua,Mertua,Famili Lain,Lainnya',
            'status_warga' => 'required|in:Aktif,Pindah,Meninggal,Sementara,Tidak Diketahui,Keluar,Baru,Hilang,WNA',
        ];
    }
}
