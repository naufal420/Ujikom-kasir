<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'name' => 'adminku',
                'email' => 'adminku@gmail.com',
                'no_telepon' => '08973643',
                'role' => 'admin',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'kasirku',
                'email' => 'kasirku@gmail.com',
                'no_telepon' => '081284847',
                'role' => 'kasir',
                'password' => bcrypt('6789'),
            ],
        ];

        foreach ($userData as $key => $value) {
            user::create($value);
        }
    }
}
