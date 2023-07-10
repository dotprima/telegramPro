<?php

namespace App\Repositories;

use App\Models\Language;

class LanguageRepository
{
    public function findByCode($code)
    {
        return Language::where('code', $code)->first();
    }

    public function findByName($name)
    {
        return Language::where('name', $name)->first();
    }

   
}
