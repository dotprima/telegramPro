<?php

namespace App\Repositories;

use Telegram\Bot\Keyboard\Keyboard;

class Helper
{

    public $keyboard =  [
        [
            ['text' => 'Check Quota', 'callback_data' => 'Check Quota'],
            ['text' => 'Fill Quota', 'callback_data' => 'Fill Quota'],
            ['text' => 'Chat Admin', 'callback_data' => 'Chat Admin']
        ],
        [
            ['text' => 'Help', 'callback_data' => '/help']
        ]
    ];
    
    

    public function KeyShortcut($keyboard){
        $reply_markup = Keyboard::make([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);
        return $reply_markup;
    }
    
}
