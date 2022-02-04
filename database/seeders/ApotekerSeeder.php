<?php

namespace Database\Seeders;

use App\Models\Apoteker;
use Illuminate\Database\Seeder;

class ApotekerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'nip' => 'superadmin',
                'nama' => 'super admin',
                'jenis_kelamin' => 'laki-laki',
            ],
        ];
        foreach ($user as $key => $value) {
            Apoteker::create($value);
        }
    }
}
