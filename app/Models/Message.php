<?php

namespace App\Models;

use App\Traits\IsInteraction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    use IsInteraction;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->weight = 1;
    }

    public function save(array $options = [])
    {
        $this->logInteraction(User::where('id', $this->user_to)->get());
        return parent::save($options);
    }

    public $timestamps = false;
}
