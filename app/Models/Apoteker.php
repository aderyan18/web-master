<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apoteker extends Model
{
    protected $table = 'apoteker';
    protected $fillable = [
        'nip',
        'nama',
        'jenis_kelamin',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
