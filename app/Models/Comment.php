<?php

namespace App\Models;

use App\Events\CommentDeleting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUserRelTrait;
class Comment extends Model
{
    use HasFactory;
    use HasUserRelTrait;

    protected $dispatchesEvents = [
        'deleting' => CommentDeleting::class,
    ];

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
