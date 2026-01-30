<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;

    protected $table = 'rt'; // pastikan ini
    protected $fillable = ['desa_id', 'rt', 'ketua_warga_id'];


    public function wargas()
    {
        return $this->hasMany(Warga::class, 'rt_id');
    }

    public function warga()
{
    return $this->hasMany(Warga::class, 'rt_id');
}


    public function ketua()
    {
        return $this->belongsTo(Warga::class, 'ketua_warga_id');
    }


    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}
