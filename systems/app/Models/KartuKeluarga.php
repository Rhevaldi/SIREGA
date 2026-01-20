<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KartuKeluarga extends Model
{
    use HasFactory;

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

    public function media()
    {
        return $this->hasMany(MediaWarga::class, 'kk_id', 'id');
    }
}
