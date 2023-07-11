<?php

namespace App\Repositories;

use App\Repositories\ChatGPTRepository;
use App\Repositories\HelperRepository;

class ConversationRepository
{

    public $keyboard = [
        [
            ['text' => '**Conversation**', 'callback_data' => '**Conversation**'],
            ['text' => '**Translate**', 'callback_data' => '**Translate**'],
            ['text' => '**Images**', 'callback_data' => '**Images**'],
        ],
        [
            ['text' => '**Status**', 'callback_data' => '**Status**'],

        ],
    ];

    private $chatGPTRepository;
    private $helperRepository;

    public function __construct(
        ChatGPTRepository $chatGPTRepository,
        HelperRepository $helperRepository,
    ) {
        $this->chatGPTRepository = $chatGPTRepository;
        $this->helperRepository = $helperRepository;
    }

    public function Chat($message, $chat_id, $chatMode, $question, $user)
    {
        if ($user->status == 'trial') {
            $sejarah_percakapan = [
                [
                    "role" => "system",
                    "content" => "Mulai percakapan terbuka dengan asisten AI dalam bahasa Indonesia",
                ],
                [
                    "role" => "user",
                    "content" => "Saya: " . $message,
                ],
            ];
        } else {
            if (isset($user->messages)) {
                $sejarah_percakapan = [
                    [
                        "role" => "system",
                        "content" => "Mulai percakapan terbuka dengan asisten AI dalam bahasa Indonesia",
                    ],
                ];
                $messages = $user->messages()->latest()->take(1)->get()->reverse();

                foreach ($messages as $key) {
                    $sejarah_percakapan[] = [
                        "role" => "user",
                        "content" => "Saya: " . $key->question,
                    ];
                    $sejarah_percakapan[] = [
                        "role" => "assistant",
                        "content" => "AI: " . $key->answer,
                    ];
                }
                $sejarah_percakapan[] = [
                    "role" => "user",
                    "content" => "Saya: " . $message,
                ];
            } else {
                $sejarah_percakapan = [
                    [
                        "role" => "system",
                        "content" => "Mulai percakapan terbuka dengan asisten AI dalam bahasa Indonesia",
                    ],
                    [
                        "role" => "user",
                        "content" => "Saya: " . $message,
                    ],
                ];
            }
        }

        $message = $this->chatGPTRepository->Chat($sejarah_percakapan);
        $user->messages()->create([
            'question' => $question,
            'answer' => $message,
            'request_price' => 1,
        ]);

        return $message;
    }

}
