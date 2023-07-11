<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'username',
        'quota',
        'language_id'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class,'user_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}

