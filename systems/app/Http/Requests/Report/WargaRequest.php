<?php

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;

class WargaRequest extends FormRequest
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
        // Jika tidak ada filter tanggal sama sekali → tidak validasi apa pun
        if (!$this->hasAny(['jenis_kelamin', 'status_hubungan', 'status_warga'])) {
            return [];
        }

        return [
            'start_date' => ['required_with:end_date', 'date'],
            'end_date'   => ['required_with:start_date', 'date', 'after_or_equal:start_date'],

            'jenis_kelamin' => ['required', 'in:all,L,P'],
            'status_warga' => ['required', 'in:all,aktif,pindah,meninggal,sementara,tidak diketahui,keluar,baru,hilang,wna'],
            'status_hubungan' => ['required', 'in:all,kepala keluarga,suami,istri,anak,mertua,cucu,orang tua,famili lain,pembantu,lainnya'],
        ];
    }
}
