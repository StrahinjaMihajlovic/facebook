<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    public  function lastMessage ()
    {
        return $this->hasOne(Message::class)->orderByDesc('created_at');
    }

    public  function messages ()
    {
        return $this->hasMany(Message::class);
    }
}
