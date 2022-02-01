<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Semry Lake',
            'email' => 'jufentosemry@gmail.com',
            'level' => 'operator',
            'password' => bcrypt('12345678'),
            'p_user' => '12345678',
            'email_verified_at' => '2021-10-16 18:28:59',
        ]);

        User::create([
            'name' => 'Jufento Lake',
            'email' => 'lakejufento@gmail.com',
            'level' => 'operator',
            'password' => bcrypt('12345678'),
            'p_user' => '12345678',
            'email_verified_at' => '2021-10-16 18:28:59',
        ]);

        // for ($i = 0; $i < 20; $i++) {
        //     User::create([
        //         'name' => 'Operator ' + $i,
        //         'email' => 'oprator' . $i . '@gmail.com',
        //         'level' => 'operator',
        //         'password' => bcrypt('12345678'),
        //         'email_verified_at' => '2021-10-16 18:28:59',
        //     ]);
        // }
    }
}
