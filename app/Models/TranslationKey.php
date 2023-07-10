<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslationKey extends Model
{
    protected $fillable = ['key'];

    public function translations()
    {
        return $this->hasMany(Translation::class);
    }
}
