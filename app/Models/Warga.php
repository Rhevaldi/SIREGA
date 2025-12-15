<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rt;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';

    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'no_kk',
        'no_hp',
        'rt_id',
        'status_warga',
        'latitude',
        'longitude',
        'foto_rumah',
        'foto_warga'
    ];

 
    public function rt()
    {
        return $this->belongsTo(Rt::class);
    }


    public function kategori()
    {
        return $this->belongsToMany(
            Kategori::class,
            'warga_kategori',
            'warga_id',
            'kategori_id'
        );
    }


    public function riwayatBansos()
    {
        return $this->hasMany(RiwayatBansos::class);
    }
}
