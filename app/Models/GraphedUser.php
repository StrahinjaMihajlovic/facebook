<?php


namespace App\Models;


use Vinelab\NeoEloquent\Eloquent\Model;

class GraphedUser extends Model
{
    protected $connection = 'neo4j';
    protected $label = 'User';
    protected $table = 'User';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
        'email',
        ];

    /** return all action done by the user
     * @return \Vinelab\NeoEloquent\Eloquent\Relations\HasMany
     */
    public function didInteract()
    {
        return $this->hasMany(Interaction::class, 'DID');
    }

    /** Return all interactions with this user
     * @return \Vinelab\NeoEloquent\Eloquent\Relations\BelongsToMany
     */
    public function wasInteractedTo()
    {
        return $this->belongsToMany(Interaction::class, 'DONE_TO');
    }
}
