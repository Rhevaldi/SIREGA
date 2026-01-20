<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'kode',
        'nama',
        'tipe',
        'deskripsi'
    ];


    public function warga()
    {
        return $this->belongsToMany(
            \App\Models\Warga::class,
            'kategori_warga'
        )->withPivot('nilai')
            ->withTimestamps();
    }
}
