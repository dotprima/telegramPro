<?php

namespace App\Http\Controllers;

use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Repositories\Helper;
use App\Repositories\Conversation;
class TelegramBot extends Controller
{

    private $Helper,$Conversation;

    public function __construct(Helper $Helper,Conversation $Conversation)
    {
        $this->Helper = $Helper;
        $this->Conversation = $Conversation;
    }

    public function setWebhook()
    {
        // $response = Telegram::setWebhook(['url' => env('TELEGRAM_WEBHOOK_URL')]);
        // dd($response);
        $messageModel = Message::create([
            'user_id' => 5896267480,
            'question' => 'sd',
            'answer' => 'sd',
            'request_price' => 2, // Sesuaikan dengan nilai yang sesuai
        ]);
    }



    public function commandHandlerWebHook()
    {     
        try {
            $updates = Telegram::commandsHandler(true);
            $user_id = $updates->getChat()->getId();
            $message = $updates->getMessage()->getText();

            if ($message === '/help') {
                $message = 'Hello, Selamat Datang di Bot ChatGPT';
            } elseif ($message === 'Check Quota') {
                $user = User::where('user_id', $user_id)->first();
                $message = $user ? 'Kuota Anda adalah ' . $user->quota : 'Anda belum terdaftar';
            } elseif ($message === 'Fill Quota') {
                // Lakukan tindakan yang sesuai untuk mengisi kuota
                $message = 'Kuota Anda telah diisi';
            } elseif ($message === 'Chat Admin') {
                $message = 'Silahkan Chat Admin @primjs';
            } else {
                $user = User::firstOrNew(['user_id' => $user_id]);

                if (!$user->exists) {
                    $user->fill([
                        'first_name' => $updates->getChat()->getFirstName(),
                        'username' => $updates->getChat()->getUsername(),
                        'quota' => 5,
                    ])->save();
                    $message = 'Hello, Selamat Datang di Bot ChatGPT';
                } else {
                    if ($user->quota > 0) {
                        $user->decrement('quota'); // Mengurangi nilai kuota sebanyak 1
                        $message = $this->Conversation->Chat($message,$user_id,$user['chatMode'],$message,$user);
                        
                       
                    } else {
                        $message = 'Maaf, tidak ada kuota';
                    }
                }
            }

            return Telegram::sendMessage([
                'chat_id' => $user_id,
                'text' => $message,
                'reply_markup' => $this->Helper->KeyShortcut($this->Helper->keyboard)
            ]);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();

            Telegram::sendMessage([
                'chat_id' => $user_id,
                'text' => 'Terjadi kesalahan: ' . $errorMessage,
            ]);
        }
    }
}
