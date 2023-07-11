<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question',
        'answer',
        'request_price',
    ];

    public $table = 'messages';

    public function client()
    {
        return $this->belongsTo(Client::class,'user_id');
    }
}
