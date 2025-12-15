<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Warga;

class Rt extends Model
{
    use HasFactory;

    protected $table = 'rts';
    protected $fillable = ['nama_rt'];

    public function warga()
    {
        return $this->hasMany(Warga::class);
    }
}
