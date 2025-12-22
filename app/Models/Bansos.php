<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bansos extends Model
{
    use HasFactory;

    protected $table = 'bansos';

    protected $fillable = [
        'nama_program',
        'jenis',
        'penyelenggara',
        'tahun',
    ];

    public function penerima()
    {
        return $this->hasMany(BansosPenerima::class);
    }


    public function warga()
{
    return $this->belongsToMany(Warga::class, 'bansos_penerima')
        ->withPivot(['tanggal_penerimaan', 'status', 'keterangan'])
        ->withTimestamps();
}

}
