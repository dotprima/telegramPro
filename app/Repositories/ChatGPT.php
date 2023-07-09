<?php

namespace App\Repositories;

use Orhanerday\OpenAi\OpenAi;

class ChatGPT
{

    public function Chat($message){
        $client = new OpenAi(ENV('OPEN_API_KEY'));
        $result = $client->completion([
            'model' => 'text-davinci-003',
            'prompt' => $message . "AI: ",
            'temperature' => 0,
            'max_tokens' => 500,
            'frequency_penalty' => 0,
            'presence_penalty' => 0.6,
        ]);
        $result = json_decode($result, true);
        $result = $result['choices'][0]['text'];
        return $result;
    }

    public function Translate($message){
        $client = new OpenAi(ENV('OPEN_API_KEY'));
        $result = $client->completion([
            'model' => 'text-davinci-003',
            'prompt' => $message,
            'temperature' => 0,
            'max_tokens' => 500,
            'frequency_penalty' => 0,
            'presence_penalty' => 0.6,
        ]);
        $result = json_decode($result, true);
        $result = $result['choices'][0]['text'];
        return $result;
    }

    public function Image($message){
        $client = new OpenAi(ENV('OPEN_API_KEY'));

        $complete = $client->image([
            "prompt" => $message,
            "n" => 1,
            "size" => "256x256",
            "response_format" => "url",
         ]);
         $complete = json_decode($complete, true);

         return $complete['data'][0]['url'];
    }
}
