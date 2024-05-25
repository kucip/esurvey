<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Optima Multi Sinergi',
            'username' => 'optima',
            'email' => 'admin@optima.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$uBatLnuZ37l7Vbu3DOH4Ku8i1kqwvcr0VfkUV96bFJpgpvbX80hp6', // 1234
            'remember_token' => '',
            'compId' => 1,
            'role' => 1,
        ]);
    }
}
