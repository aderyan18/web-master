<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temptransaksi extends Model
{
    protected $table = 'temptransaksi';
    protected $fillable = [
        'tanggal',
        'apoteker_id',
        'obat_id',
        'banyak',
        'sub_total',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
