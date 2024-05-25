<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            // Adm Utama
            ['compId' => 1, 'menuNama' => 'Dashboard', 'menuRoute' => 'dashboard', 'menuIcon' => 'icon-display4', 'menuParent' => Null, 'menuOrder' => 0],
            ['compId' => 1, 'menuNama' => 'Setup', 'menuRoute' => '', 'menuIcon' => 'icon-cog3', 'menuParent' => Null, 'menuOrder' => 2],
                ['compId' => 1, 'menuNama' => 'Company', 'menuRoute' => 'company', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 1],
                ['compId' => 1, 'menuNama' => 'Menu', 'menuRoute' => 'menu', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 2],
                ['compId' => 1, 'menuNama' => 'Role', 'menuRoute' => 'role', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 3],
                ['compId' => 1, 'menuNama' => 'Role Menu', 'menuRoute' => 'rolemenu', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 4],
                ['compId' => 1, 'menuNama' => 'User Super', 'menuRoute' => 'user', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 5],
                ['compId' => 1, 'menuNama' => 'User Company', 'menuRoute' => 'usercomp', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 6],
                ['compId' => 1, 'menuNama' => 'Ganti Password', 'menuRoute' => 'gantipass', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 7], //9
            ['compId' => 1, 'menuNama' => 'Master', 'menuRoute' => '', 'menuIcon' => 'icon-database2', 'menuParent' => Null, 'menuOrder' => 3], //10
                ['compId' => 1, 'menuNama' => 'Docs', 'menuRoute' => 'docs', 'menuIcon' => '', 'menuParent' => 10, 'menuOrder' => 1], 
            

        ];

        Menu::insert($menus);
    }
}
