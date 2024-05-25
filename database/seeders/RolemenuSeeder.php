<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolemenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <=11; $i++) {
            DB::table('role_menu')->insert([
                'compId' => 1,
                'rmRoleId' => 1,
                'rmMenuId' => $i,
            ]);
        }
    }
}
