<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BansosPenerima extends Model
{
    use HasFactory;

    protected $table = 'bansos_penerima';

    protected $fillable = [
        'warga_id',
        'bansos_id',
        'tanggal_penerimaan',
        'status',
        'keterangan',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function bansos()
    {
        return $this->belongsTo(Bansos::class);
    }
}
