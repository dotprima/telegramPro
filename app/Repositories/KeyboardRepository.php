<?php

namespace App\Repositories;

use Telegram\Bot\Keyboard\Keyboard;
use App\Models\Language;

class KeyboardRepository
{

   

    function getKeyboard()
    {
        $keyboard =  [
            [
                ['text' => 'Check Quota', 'callback_data' => 'Check Quota'],
                ['text' => 'Fill Quota', 'callback_data' => 'Fill Quota'],
                ['text' => 'Chat Admin', 'callback_data' => 'Chat Admin']
            ],
            [
                ['text' => 'Change Language', 'callback_data' => 'Change Language'],
            ],
            [
                ['text' => 'Help', 'callback_data' => 'Help']
            ]
        ];

        return $keyboard;
    }
    


    function getKeyboardLanguage()
    {
        $keyboard = [];

        $languages = Language::all();

        foreach ($languages as $language) {
            $keyboard[] = [
                ['text' => $language->name, 'callback_data' => $language->code]
            ];
        }

        $keyboard[] = [
            ['text' => 'Help', 'callback_data' => '/help']
        ];

        return $keyboard;
    }

    
}
