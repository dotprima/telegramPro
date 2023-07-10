<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $fillable = ['translation', 'language_id'];

    public function translationKey()
    {
        return $this->belongsTo(TranslationKey::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
