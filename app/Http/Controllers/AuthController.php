<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\AuthService;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */

    private $authService;

    /**
     * AuthController constructor.
     * @param AuthService $authService
     */

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param RegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse|object
     */

    public function login(LoginRequest $request)
    {
        $userData = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($userData)) {
            return response()->json('Error! Wrong email or password!')->setStatusCode(401);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * @return \Illuminate\Http\JsonResponse|object
     */

    public function logout()
    {
        try {
            auth()->logout();
            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (JWTException $exception) {
            return response()->json([ 'error' => $exception->getMessage()])->setStatusCode(500);
        }
    }

    /**
     * @param RegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function register(RegisterRequest $request)
    {

        $this->authService->register($request->name, $request->email,$request->password);

        return redirect('/login');
    }

    /**
     * @return JsonResponse
     */

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * @return mixed
     */

    public function guard()
    {
        return Auth::guard();
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }
}
