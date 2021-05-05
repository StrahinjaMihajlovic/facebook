<?php

namespace App\Models;

use App\Events\CommentDeleting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'deleting' => CommentDeleting::class,
    ];

    /** returns the owner of the comment
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /** returns the post that was commented
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post(){
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function comment(){
        return $this->belongsTo(static::class, 'parent_id', 'id');
    }

    public function subcomments(){
        return $this->hasMany(static::class, 'parent_id', 'id');
    }
}
