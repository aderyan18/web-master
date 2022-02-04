<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';
    protected $fillable = [
        'id_register',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'alamat',
        'status',
        'jenis_pasien',
        'no_BPJS',
    ];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }

    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class);
    }
}
