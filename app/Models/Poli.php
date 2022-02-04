<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = 'poli';
    protected $fillable = [
        'nama',
    ];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }

    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class);
    }
    public function dokter()
    {
        return $this->hasMany(Dokter::class);
    }
}
