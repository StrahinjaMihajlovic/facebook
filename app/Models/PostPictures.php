<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPictures extends Model
{
    public $timestamps = false;
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post(){
        return $this->belongsTo(Post::class, 'id', 'post_id');
    }
}
