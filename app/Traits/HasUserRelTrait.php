<?php


namespace App\Traits;


use App\Models\User;

trait HasUserRelTrait
{
   /**
    * change if field name is not like underneath in your database
    * @var string $foreign_field
    * */
    protected $foreign_field = 'user_id';

    /** returns the owner of the comment
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class, $this->foreign_field, 'id');
    }
}
