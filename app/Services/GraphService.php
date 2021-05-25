<?php


namespace App\Services;


use App\Models\GraphedUser;
use App\Models\Interaction;
use App\Models\User;

class GraphService
{
    /** Insert user into graphDB when registered
     * @param User $user
     */
    public function insertUser(User $user)
    {
        GraphedUser::create(['id' => $user->id, 'name' => $user->name, 'email' => $user->email]);
    }
}
