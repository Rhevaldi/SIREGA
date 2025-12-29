<?php

namespace App\Http\Requests\Warga;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'no_kk' => 'required|numeric|min_digits:16|max_digits:16',
            'nik' => 'required|numeric|min_digits:16|max_digits:16|unique:warga,nik',
            'nama' => 'required|string|max:255',

            'jenis_kelamin' => 'required|in:L,P',

            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',

            'agama' => 'required|string|max:50',

            'pendidikan' => 'required|string|max:100',
            'pekerjaan' => 'required|string|max:100',

            'status_perkawinan' => 'required|in:kawin,belum kawin,cerai hidup,cerai mati',

            'status_hubungan' => 'required|in:kepala keluarga,suami,istri,anak,mertua,cucu,orang tua,famili lain,pembantu,lainnya',

            'status_warga' => 'required|in:aktif,pindah,meninggal,sementara,tidak diketahui,keluar,baru,hilang,wna',

            'alamat' => 'required|string',

            'rt_id' => 'required|exists:rt,id',

            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ];
    }

    public function messages(): array
    {
        return [
            'no_kk.min_digits' => 'Nomor KK harus terdiri dari 16 karakter.',
            'no_kk.max_digits' => 'Nomor KK harus terdiri dari 16 karakter.',
            'nik.min_digits' => 'NIK harus terdiri dari 16 karakter.',
            'nik.max_digits' => 'NIK harus terdiri dari 16 karakter.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'rt_id.exists' => 'RT yang dipilih tidak valid.',
            'latitude.between' => 'Latitude harus antara -90 dan 90.',
            'longitude.between' => 'Longitude harus antara -180 dan 180.',
        ];
    }
}
