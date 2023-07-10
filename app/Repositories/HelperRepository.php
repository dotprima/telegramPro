<?php

namespace App\Repositories;

use Telegram\Bot\Keyboard\Keyboard;
use App\Models\Language;

class HelperRepository
{

   
    
    

    public function KeyShortcut($keyboard){
        $reply_markup = Keyboard::make([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);
        return $reply_markup;
    }


    public function Translation($code, $key)
    {
        $language = Language::where('code', $code)->first();

        if ($language) {
            $translation = $language->translations()
                ->whereHas('translationKey', function ($query) use ($key) {
                    $query->where('key', $key);
                })
                ->first();

            if ($translation) {
                return $translation->translation;
            } else {
                return $key; // Kembalikan kunci jika terjemahan tidak ditemukan
            }
        } else {
            return $key; // Kembalikan kunci jika bahasa tidak ditemukan
        }
    }

    

    
}
