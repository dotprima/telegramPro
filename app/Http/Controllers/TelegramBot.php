<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Language;
use App\Repositories\ClientRepository;
use App\Repositories\ConversationRepository;
use App\Repositories\Helper;
use App\Repositories\HelperRepository;
use App\Repositories\KeyboardRepository;
use App\Repositories\LanguageRepository;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBot extends Controller
{

    private $clientRepository;
    private $languageRepository;
    private $helperRepository;
    private $keyboardRepository;
    private $conversationRepository;

    public function __construct(
        ClientRepository $clientRepository,
        LanguageRepository $languageRepository,
        KeyboardRepository $keyboardRepository,
        HelperRepository $helperRepository,
        ConversationRepository $conversationRepository
    ) {
        $this->clientRepository = $clientRepository;
        $this->languageRepository = $languageRepository;
        $this->keyboardRepository = $keyboardRepository;
        $this->helperRepository = $helperRepository;
        $this->conversationRepository = $conversationRepository;
    }

    public function setWebhook()
    {
        // $response = Telegram::setWebhook(['url' => env('TELEGRAM_WEBHOOK_URL')]);
        // dd($response);

        echo $reply_markup = $this->helperRepository->KeyShortcut($this->keyboardRepository->getKeyboardLanguage());

    }

    public function commandHandlerWebHook()
    {
        $reply_markup = $this->helperRepository->KeyShortcut($this->keyboardRepository->getKeyboard());
        try {
            $updates = Telegram::commandsHandler(true);
            $user_id = $updates->getChat()->getId();
            $message = $updates->getMessage()->getText();

            switch ($message) {
                case '/help':
                    $message = 'Hello, Selamat Datang di Bot ChatGPT';
                    break;
                case 'Check Quota':
                    $user = $this->clientRepository->findByUserId($user_id);
                    $message = $user ? 'Kuota Anda adalah ' . $user->quota : 'Anda belum terdaftar';
                    break;
                case 'Change Language':
                    $user = $this->clientRepository->ResetLanguage($user_id);
                    $message = 'Silahkan Pilih Bahasa';
                    $reply_markup = $this->helperRepository->KeyShortcut($this->keyboardRepository->getKeyboardLanguage());
                    break;
                case 'Chat Admin':
                    $message = 'Silahkan Chat Admin @primjs';
                    break;
                default:
                    $user = $this->clientRepository->firstOrNew(['user_id' => $user_id]);
                    if (!$user->exists) {
                        $user = $this->clientRepository->createOrUpdate(
                            $user_id,
                            $updates->getChat()->getFirstName(),
                            $updates->getChat()->getUsername(),
                            5
                        );
                        $message = 'Hello, Selamat Datang di Bot ChatGPT';
                    } else {

                        if ($user->language_id == null) {
                            $language = $this->languageRepository->findByName($message);

                            if ($language) {
                                $this->clientRepository->setLanguage($user, $language->id);


                                $message = 'Bahasa telah dipilih dan disimpan';
                            } else {
                                $message = 'silahkan pilih bahasa';
                                $reply_markup = $this->helperRepository->KeyShortcut($this->keyboardRepository->getKeyboardLanguage());
                            }

                        } elseif ($user->quota > 0) {
                            $user->decrement('quota'); // Mengurangi nilai kuota sebanyak 1
                            // $message = $this->Conversation->Chat($message,$user_id,$user['chatMode'],$message,$user);
                            $message = 'ca';
                        } else {
                            $message = 'Maaf, tidak ada kuota';
                        }
                    }
                    break;
            }

            return Telegram::sendMessage([
                'chat_id' => $user_id,
                'text' => $message,
                'reply_markup' => $reply_markup,
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
