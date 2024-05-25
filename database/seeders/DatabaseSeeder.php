<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Kln\Master\Pasien::factory(10)->create();
        $this->call([
            CompanySeeder::class,
            MenuSeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            RolemenuSeeder::class,
            PendidikandanagamaSeeder::class,
            LokasiSeeder::class,
        ]);
    }
}
