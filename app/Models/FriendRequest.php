<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    public $timestamps = false;

    use HasFactory;

    public function userNotifications()
    {
        return $this->hasMany(FriendRequest::class,'receive_id')->where('receive_id', Auth()->user()->id);
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','send_id');
    }
}
