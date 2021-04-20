<?php

namespace App\Traits;

use App\Models\User;

trait UserTrait {

    public function usersWithoutAuth()
    {
        $users = User::get()->whereNotIn('id',Auth()->user()->id);

        return $users;
    }

}
