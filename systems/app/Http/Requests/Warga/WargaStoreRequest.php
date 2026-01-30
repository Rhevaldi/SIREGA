<?php

namespace App\Http\Requests\Warga;

use App\Models\Warga;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class WargaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($this->status_hubungan === 'Kepala Keluarga') {
                $exists = Warga::where('no_kk', $this->no_kk)
                    ->where('status_hubungan', 'Kepala Keluarga')
                    ->exists();

                if ($exists) {
                    $validator->errors()->add(
                        'status_hubungan',
                        'Kepala Keluarga sudah ada pada Kartu Keluarga ini.'
                    );
                }
            }
        });
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
            'nik' => 'required|numeric|min_digits:16|max_digits:16|unique:warga,nik',
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

    // public function messages(): array
    // {
    //     return [
    //         'no_kk.min_digits' => 'Nomor KK harus terdiri dari 16 karakter.',
    //         'no_kk.max_digits' => 'Nomor KK harus terdiri dari 16 karakter.',
    //         'nik.min_digits' => 'NIK harus terdiri dari 16 karakter.',
    //         'nik.max_digits' => 'NIK harus terdiri dari 16 karakter.',
    //         'nik.unique' => 'NIK sudah terdaftar.',
    //     ];
    // }
}
