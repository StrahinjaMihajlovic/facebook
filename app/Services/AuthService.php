<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService extends Controller
{

    /**
     * @param $name
     * @param $email
     * @param $password
     */

    public function register($name,$email,$password)
    {
        Auth::login($user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]));

        event(new Registered($user));
    }
}
