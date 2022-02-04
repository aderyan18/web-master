<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
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
                'username' => 'admin',
                'name' => 'admin',
                'role' => 'admin',
                'password' => bcrypt('admin'),
                'password_default' => bcrypt('admin')
            ],
            [
                'username' => 'superadmin',
                'name' => 'super admin',
                'role' => 'super admin',
                'password' => bcrypt('123'),
                'password_default' => bcrypt('123')
            ],
            [
                'username' => '1202110001',
                'name' => 'ryan',
                'role' => 'user',
                'password' => bcrypt('1202110001'),
                'password_default' => bcrypt('1202110001')
            ],

        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
