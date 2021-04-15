<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function posts(){
        return $this->hasMany(Post::class, 'id', 'user_id');
    }

    public function firstStory()
    {
        return $this->hasOne(Story::class)->orderByDesc('created_at');

    }


    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id', 'id');
    }
    public function ifSendRequest()
    {
        return $this->hasOne(FriendRequest::class,'receive_id')->where('send_id',Auth()->user()->id);

    }
}
