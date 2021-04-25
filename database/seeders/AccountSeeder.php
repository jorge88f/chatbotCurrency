<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account = new Account; 
        $account->amount =25.25;
        $account->user_id = 1;
        $account->currency_id = 1;
        $account->save();
    }
}
