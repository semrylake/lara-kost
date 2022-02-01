<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'level' => 'admin',
            'password' => bcrypt('12345678'),
            'p_user' => '12345678',
            'email_verified_at' => '2021-10-16 18:28:59',
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'yohan@example.com',
            'level' => 'admin',
            'password' => bcrypt('12345678'),
            'p_user' => '12345678',
            'email_verified_at' => '2021-10-16 18:28:59',
        ]);
    }
}
