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

    public function scopeSortedByName($query)
    {
        return $query->orderBy('no_kk');
    }

    /**
     * Get the wargas that owns the KartuKeluarga
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wargas(): HasMany
    {
        // Satu KK memiliki banyak Warga
        return $this->hasMany(Warga::class);
    }
}
