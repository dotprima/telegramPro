<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository
{
    public function findByUserId($userId)
    {
        return Client::where('user_id', $userId)->first();
    }

    public function firstOrNew($attributes)
    {
        return Client::firstOrNew($attributes);
    }

    public function ResetLanguage($userId)
    {
        $user = Client::where('user_id', $userId)->first();
        $user->language_id = null;
        $user->save();
    }

    public function createOrUpdate($userId, $firstName, $username, $quota)
    {
        $attributes = [
            'first_name' => $firstName,
            'username' => $username,
            'quota' => $quota,
        ];

        $client = Client::firstOrNew(['user_id' => $userId]);
        $client->fill($attributes);
        $client->save();

        return $client;
    }

    public function setLanguage($client, $languageId)
    {
        $client->language_id = $languageId;
        $client->save();
    }

}
