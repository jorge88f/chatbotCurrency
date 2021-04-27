<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = new Currency;
        $currency->name = 'USD';
        $currency->save();
        $currency = new Currency;
        $currency->name = 'EUR';
        $currency->save();
        $currency = new Currency;
        $currency->name = 'GBP';
        $currency->save();
        $currency = new Currency;
        $currency->name = 'JPY';
        $currency->save();
        $currency = new Currency;
        $currency->name = 'AUD';
        $currency->save();
        $currency = new Currency;
        $currency->name = 'CAD';
        $currency->save();
        $currency = new Currency;
        $currency->name = 'CHF';
        $currency->save();
        $currency = new Currency;
        $currency->name = 'CNY';
        $currency->save();

    }
}
