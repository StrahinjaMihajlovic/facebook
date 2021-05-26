<?php

namespace App\Models;

use App\Events\CommentDeleting;
use App\Traits\IsInteraction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUserRelTrait;
class Comment extends Model
{
    use HasFactory;
    use HasUserRelTrait;
    use IsInteraction;

    protected $dispatchesEvents = [
        'deleting' => CommentDeleting::class,
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->weight = 10;
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
