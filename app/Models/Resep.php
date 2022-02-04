<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $table = 'resep';
    protected $fillable = [
        'pemeriksaan_id',
        'obat_id',
        'aturan',
        'jumlah',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class);
    }
    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
