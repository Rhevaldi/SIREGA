<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaWarga extends Model
{
    use HasFactory;

    protected $table = 'media_warga';

    protected $fillable = [
        'kk_id',
        'file_name',
        'file_type',
        'file_path',
        'keterangan',
    ];

    public function kartuKeluarga()
    {
        return $this->belongsTo(KartuKeluarga::class, 'kk_id', 'id');
    }
}
