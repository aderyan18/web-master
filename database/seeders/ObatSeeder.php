<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $obat = [
            [
                'nama' => 'paracetamol',
                'satuan' => 'pcs',
                'harga' => '5000',
                'stok' => '100',
            ],
        ];
        foreach ($obat as $key => $value) {
            Obat::create($value);
        }
    }
}
