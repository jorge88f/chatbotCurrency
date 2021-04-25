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
            'request' => 'info | information | menu ',
            'response' => 'This application allows you to deposit, withdraw and exchange currencies,',
        ]);
        Message::create([
            'request' => 'bye | good bye | see you ',
            'response' => 'See you soon!',
        ]);
        Message::create([
            'request' => 'hey there | hi | hello',
            'response' => 'If you whant to se more info or the menu please type info or menu',
         ]);
    }
}
