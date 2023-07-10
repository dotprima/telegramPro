<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $fillable = ['language_id', 'key', 'value'];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
