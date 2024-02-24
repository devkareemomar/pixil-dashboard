<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // make 4 menus 2 with ar locale, and 2 with en,
        Menu::create([
            'name' => 'Menu Header Ar',
            'position' => 'header',
            'locale' => 'ar'
        ]);

        Menu::create([
            'name' => 'Menu Footer Ar',
            'position' => 'footer',
            'locale' => 'ar'
        ]);
    }
}
