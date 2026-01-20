<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MediaWarga extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::deleting(function ($media) {
            if ($media->file_path && Storage::disk('public')->exists($media->file_path)) {
                Storage::disk('public')->delete($media->file_path);
            }
        });
    }

    protected $table = 'media_warga';

    protected $fillable = [
        'kk_id',
        'file_name',
        'file_type',
        'file_path',
        'keterangan'
    ];

    public function kartuKeluarga()
    {
        return $this->belongsTo(KartuKeluarga::class, 'kk_id', 'id');
    }
}
