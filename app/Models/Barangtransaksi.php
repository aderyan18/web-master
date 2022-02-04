<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangTransaksi extends Model
{
    protected $table = 'barangtransaksi';
    protected $fillable = [
        'transaksi_id',
        'obat_id',
        'banyak',
        'sub_total',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
