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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function posts(){
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function firstStory()
    {
        return $this->hasOne(Story::class)->orderByDesc('created_at');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id', 'id');
    }

    /**
     * @return mixed
     */
    public function ifSendRequest()
    {
        return $this->hasOne(FriendRequest::class,'receive_id')->where('send_id',Auth()->user()->id);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ifReceiveRequest()
    {
        return $this->hasOne(FriendRequest::class,'send_id')->where('receive_id',Auth()->user()->id);
    }

    /**
     * @return mixed
     */
    public function  ifAuthRequestAccept()
    {
        return $this->hasOne(FriendRequest::class,'receive_id')->where('send_id',Auth()->user()->id)->where('accept',1);
    }

    /**
     * @return mixed
     */
    public function  ifFriendRequestAccept()
    {
        return $this->hasOne(FriendRequest::class,'send_id')->where('receive_id',Auth()->user()->id)->where('accept',1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function senderConverastion()
    {
        return $this->hasMany(Message::class,'user_to')->where('user_from',Auth()->user()->id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function recipientConverastion()
    {
        return $this->hasMany(Message::class,'user_from')->where('user_to',Auth()->user()->id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function readMessage()
    {
        return $this->hasMany(Message::class,'user_from')->where('user_to',Auth()->user()->id)->where('status',0);
    }

}
