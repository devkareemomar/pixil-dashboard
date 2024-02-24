<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;


class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::updateOrCreate([
            'name' => 'Arabic',
            'short_name' => 'ar',
        ], [
            'name' => 'Arabic',
            'short_name' => 'ar',
            'flag' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Flag_of_Egypt.svg/800px-Flag_of_Egypt.svg.png?20221206233639',
            'is_default' => 1,
        ]);
    }
}
