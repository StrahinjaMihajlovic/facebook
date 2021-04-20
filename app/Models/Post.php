<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /** returns all the comments on the post
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(){
        return $this->hasMany(Comment::class, 'post_id', 'id')->where(['parent_id' => null]);
    }

    /** Returns all the comments the user has leaved on this post
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function isCommentedByTheUser(){
        return $this->hasOne(Comment::class, 'post_id', 'id')->where('user_id', Auth()->user()->id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pictures()
    {
        return $this->hasOne(PostPictures::class, 'post_id', 'id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id', 'id');
    }

    public function isLiked()
    {
        return $this->hasOne(Like::class)->where('user_id', Auth()->user()->id);
    }
}

