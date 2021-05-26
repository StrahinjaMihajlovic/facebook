<?php

namespace App\Models;

use App\Traits\HasUserRelTrait;
use App\Traits\IsInteraction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    use HasUserRelTrait;
    use IsInteraction;

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->weight = 5;
    }

    public function post(){
        return $this->belongsTo(Post::class, 'id', 'post_id');
    }
}
