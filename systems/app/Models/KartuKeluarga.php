<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KartuKeluarga extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::deleting(function ($kk) {
            // Hapus semua warga terkait
            $kk->warga()->each(function ($warga) {
                $warga->delete();
            });
        });

        static::deleting(function ($kk) {
            $kk->media()->each(fn($media) => $media->delete());
        });
    }

    protected $fillable = [
        'no_kk',
        'nama_kepala_keluarga',
        'alamat',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'latitude',
        'longitude',
        'tanggal_dikeluarkan',
    ];

    /**
     * Normalisasi RT menjadi 3 digit
     */
    public function setRtAttribute($value)
    {
        $this->attributes['rt'] = str_pad((int) $value, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Normalisasi RW menjadi 3 digit
     */
    public function setRwAttribute($value)
    {
        $this->attributes['rw'] = $value !== null
            ? str_pad((int) $value, 3, '0', STR_PAD_LEFT)
            : null;
    }

    public function scopeSortedByName($query)
    {
        return $query->orderBy('no_kk');
    }

    public function warga(): HasMany
    {
        return $this->hasMany(Warga::class, 'no_kk', 'no_kk');
    }

<<<<<<< HEAD:app/Models/KartuKeluarga.php
    public function media_warga(): HasMany
=======

    public function media()
>>>>>>> dev:systems/app/Models/KartuKeluarga.php
    {
        return $this->hasMany(MediaWarga::class, 'kk_id', 'id');
    }
}
