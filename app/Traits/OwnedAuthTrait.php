<?php


namespace App\Traits;

use App\Models\Comment;
use App\Models\User;

/**
 * Authorise the owner of the adequate model, override member 'foreign_id' string to apropriate names from your database
 */
trait OwnedAuthTrait
{
    protected $foreign_id = 'user_id';
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  mixed  $comment
     * @return mixed
     */

    protected function getForeignFieldName(){
        return $this->foreign_id;
    }

    public function delete(User $user,  $model)
    {
        $foreign_field = $this->foreign_id;
        return $user->id === $model->$foreign_field;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function update(User $user, $model)
    {
        $foreign_field = $this->foreign_id;
        return $user->id === $model->$foreign_field;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  mixed $model
     * @return mixed
     */
    public function forceDelete(User $user, $model)
    {
        $foreign_field = $this->foreign_id;
        return $user->id === $model->$foreign_field;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  mixed $model
     * @return mixed
     */
    public function restore(User $user, $model)
    {
        $foreign_field = $this->foreign_id;
        return $user->id === $model->$foreign_field;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return !auth()->guest();
    }

}
