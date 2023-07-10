<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['code', 'name'];

    public function translations()
    {
        return $this->hasMany(Translation::class);
    }

    public function translationKeys()
    {
        return $this->hasManyThrough(TranslationKey::class, Translation::class);
    }
}
