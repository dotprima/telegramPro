<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\ChatGPT;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Repositories\Helper;

class Conversation
{

    private $ChatGPT, $Helper;

    public $keyboard =  [
        [
            ['text' => '**Conversation**', 'callback_data' => '**Conversation**'],
            ['text' => '**Translate**', 'callback_data' => '**Translate**'],
            ['text' => '**Images**', 'callback_data' => '**Images**']
        ],
        [
            ['text' => '**Status**', 'callback_data' => '**Status**'],

        ]
    ];


    public function __construct(ChatGPT $ChatGPT, Helper $Helper)
    {
        $this->ChatGPT = $ChatGPT;
        $this->Helper = $Helper;
    }

    public function Chat($message, $chat_id, $chatMode, $question, $user)
    {
        if($user->status == 'trial'){
            $sejarah_percakapan = $question;
        }else{
            if (isset($user->messages)) {
                $sejarah_percakapan = "Mulai percakapan terbuka dengan asisten AI dalam bahasa Indonesia\n";
                $messages = $user->messages()->latest()->take(1)->get()->reverse();
    
                foreach ($messages as $key) {
                    $sejarah_percakapan .= "Saya: " . $key->question . "\n";
                    $sejarah_percakapan .= "AI: " . $key->answer . "\n";
                }
                $sejarah_percakapan .= "Saya: " . $message . "\n";
            } else {
                $sejarah_percakapan = "Mulai percakapan terbuka dengan asisten AI dalam bahasa Indonesia\n";
                $sejarah_percakapan .= "You: " . $message . "\n";
            }
        }

        $message = $this->ChatGPT->Chat($sejarah_percakapan);
        $user->messages()->create([
            'question' => $question,
            'answer' => $message,
            'request_price' => 1, 
        ]);

        return $message;
    }

   
}
