<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUserRelTrait;
class Comment extends Model
{
    use HasFactory, HasUserRelTrait;
    

    /** returns the post that was commented
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post(){
        return $this->belongsTo(Post::class, 'id', 'Post_id');
    }

    public function comment(){
        return $this->belongsTo(static::class, 'id', 'parent_id');
    }

    public function subcomments(){
        return $this->hasMany(static::class, 'parent_id', 'id');
    }
}
