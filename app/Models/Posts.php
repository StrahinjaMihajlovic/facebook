<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function user() : \Illuminate\Database\Eloquent\Relations\BelongsTo{
        return $this->belongsTo('users', 'id', 'user_id');
    }
}
