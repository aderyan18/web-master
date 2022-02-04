<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'tanggal',
        'apoteker_id',
        'total',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function apoteker()
    {
        return $this->belongsTo(Apoteker::class);
    }
}
