<?php

namespace App\Models;

use App\Traits\HasUserRelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory, HasUserRelTrait;

    public $timestamps = false;

    public function post(){
        return $this->belongsTo(Post::class, 'id', 'post_id');
    }
}
