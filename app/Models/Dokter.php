<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';
    protected $fillable = [
        'nip',
        'nama',
        'jenis_kelamin',
        'poli_id',
    ];

    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class);
    }
    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
}
