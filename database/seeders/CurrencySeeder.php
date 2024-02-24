<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;


class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::updateOrCreate([
            'code' => 'EGP',
        ],[
            'name' => 'Egyptian pound',
            'code' => 'EGP',
            'is_default' => 1,
            'exchange_rate' => 100,
        ]);
    }
}
