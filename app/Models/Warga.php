<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';

    protected $casts = [
        'tanggal_lahir' => 'date',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];


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


    public function rt()
    {
        return $this->belongsTo(Rt::class, 'rt_id');
    }

    public function media()
    {
        return $this->hasMany(MediaWarga::class);
    }


    public function kategori()
    {
        return $this->belongsToMany(
            \App\Models\Kategori::class,
            'kategori_warga'
        )->withPivot('nilai')
            ->withTimestamps();
    }


    public function bansos()
    {
        return $this->belongsToMany(
            \App\Models\Bansos::class,
            'bansos_penerima',
            'warga_id',
            'bansos_id'
        )
            ->withPivot([
                'tanggal_penerimaan',
                'status',
                'keterangan'
            ])
            ->withTimestamps();
    }

    public function bansosPenerima()
    {
        return $this->hasMany(BansosPenerima::class, 'warga_id');
    }
}
