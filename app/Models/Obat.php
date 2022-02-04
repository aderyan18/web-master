<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obat';
    protected $fillable = [
        'nama',
        'satuan',
        'harga',
        'stok',
    ];
    public function resep()
    {
        return $this->hasMany(Resep::class);
    }

    public function temptransaksi()
    {
        return $this->hasMany(Temptransaksi::class);
    }
    public function barangtransaksi()
    {
        return $this->hasMany(BarangTransaksi::class);
    }
}
