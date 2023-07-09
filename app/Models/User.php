<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'username',
        'quota',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}

