<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    protected $fillable = [
        'no_kk',
        'pekerjaan_id',
        'nik',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pendidikan',
        // 'pekerjaan',
        'status_perkawinan',
        'status_hubungan',
        'status_warga',
    ];

    public function kartuKeluarga(): BelongsTo
    {
        return $this->belongsTo(KartuKeluarga::class, 'no_kk', 'no_kk');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }

    public function rt()
    {
        return $this->belongsTo(Rt::class, 'rt_id');
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

    public function medias(): HasManyThrough
    {
        return $this->hasManyThrough(
            MediaWarga::class,
            KartuKeluarga::class,
            'no_kk',     
            'kk_id',     
            'no_kk',     
            'id'         
        );
    }

    // Semua bansos yang pernah diterima
    public function bansosAll()
    {
        return $this->hasMany(BansosPenerima::class, 'warga_id')
            ->where('bansos_penerima.status', 'penerima')
            ->join('bansos', 'bansos.id', '=', 'bansos_penerima.bansos_id')
            ->select(
                'bansos_penerima.warga_id',
                'bansos_penerima.keterangan',
                'bansos_penerima.status',
                'bansos_penerima.tanggal_penerimaan',
                'bansos.nama_program as nama_bansos'
            );
    }

    // Bansos tahun berjalan saja
    public function bansosTahunBerjalan()
    {
        return $this->hasMany(BansosPenerima::class, 'warga_id')
            ->where('status', 'penerima')
            ->whereYear('tanggal_penerimaan', now()->year);
    }
}
