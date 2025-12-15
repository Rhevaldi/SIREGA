<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;


    protected $table = 'warga';


    protected $fillable = [
        'nik',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pendidikan',
        'pekerjaan',
        'status_perkawinan',
        'status_warga',
        'alamat',
        'rt_id',
        'latitude',
        'longitude',
    ];

    // Relasi ke RT
    public function rt()
    {
        return $this->belongsTo(Rt::class);
    }
}
