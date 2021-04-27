<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::create([
            'request' => 'info | information | menu | help',
            'response' => 'This application allows you to deposit, withdraw and exchange currencies, for more information try using one word like deposit, exchange... Available currencies: USD, EUR, GBP, JPY, AUD, CAD, CHF, CNY,', //TODO fill with info of the base
        ]);
        Message::create([
            'request' => 'bye | good bye | see you ',
            'response' => 'See you soon!',
        ]);
        Message::create([
            'request' => 'hey there | hi | hello',
            'response' => 'If you whant to se more info or the menu please type info or menu',
        ]);
        Message::create([
            'request' => 'exchange | how to exchange',
            'response' => 'You have to insert the character # followed from the word exchnge amount then the origin currency then the destiny currency. eg: #exchange 30 USD EUR',
        ]);

        Message::create([
            'request' => 'deposit | how to deposit',
            'response' => 'You have to insert the character # followed from the word deposit then amount then currency. eg: #deposit 30 USD',
        ]);

        Message::create([
            'request' => 'withdraw | how to withdraw',
            'response' => 'You have to insert the character # followed from the word withdraw then amount then currency. eg: #withdraw 30 USD',
        ]);
        Message::create([
            'request' => 'login | tutorial | how do i login | log in | how do i log in',
            'response' => 'You have to insert the character # followed from the word login then email then password. eg: #login jorge@flores.com 123456',
        ]);
        Message::create([
            'request' => 'show balance | balance | my balance',
            'response' => 'You have to insert the character # followed from the word balance to show all your accounts. eg: #balance',
        ]);
        Message::create([
            'request' => ' sign-up | signup | create account',
            'response' => 'You have to insert the character # followed from the word signup then email then password then your inicial amount then your currency. eg: #signup jorge@flores.com 123456 30 USD',
        ]);
        Message::create([
            'request' => 'logout | how do i log out | log out | how do i log out',
            'response' => 'You have to insert the character # followed from the word logout. eg: #logout',
        ]);
    }
}
