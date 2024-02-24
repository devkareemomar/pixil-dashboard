<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\CurrencyRate;
use Illuminate\Console\Command;

class UpdateCurrencyRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-currency-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency exchange rates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $rates = []; // TODO Fetch rates from API

        // Update the database with the new rates
        foreach ($rates as $currencyCode => $exchangeRate) {
            Currency::updateOrCreate(
                ['code' => $currencyCode],
                ['exchange_rate' => $exchangeRate]
            );
        }

        $this->info('Currency rates updated successfully.');
    }
}
