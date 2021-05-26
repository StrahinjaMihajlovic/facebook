<?php


namespace App\Models;


use Vinelab\NeoEloquent\Eloquent\Model;

class Interaction extends Model
{
    protected $connection = 'neo4j';
    protected $label = 'Interaction';
    public $timestamps = true;
    protected $fillable = [
        'type',
        'weight',
    ];

    /** Returns a subject with this interaction
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|\Vinelab\NeoEloquent\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo(GraphedUser::class, "DID");
    }

    /** Return an user on which the interaction was done
     * @return \Vinelab\NeoEloquent\Eloquent\Relations\HasMany
     */
    public function objects()
    {
        return $this->hasMany(GraphedUser::class, "DONE_TO");
    }
}
