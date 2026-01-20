<?php

namespace App\Http\Requests\KartuKeluarga;

use App\Models\KartuKeluarga;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreKartuKeluargaRequest extends FormRequest
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
            'no_kk' => 'required|numeric|min_digits:16|max_digits:16|' . Rule::unique(KartuKeluarga::class),
            'tanggal_dikeluarkan' => 'required|date',

            'provinsi' => 'required|string',
            'kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'desa' => 'required|string',
            'alamat' => 'required|string',
            'rt' => 'numeric',
            'rw' => 'numeric|nullable',
            'kode_pos' => 'numeric|nullable',

            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ];
    }
}
