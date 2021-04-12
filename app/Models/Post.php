<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function user() : \Illuminate\Database\Eloquent\Relations\BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
