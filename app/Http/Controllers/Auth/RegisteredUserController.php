<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Laravel OpenApi Demo Documentation",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *          email="admin@admin.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )

 *
 * @OA\Tag(
 *     name="Facebook",
 *     description="API Endpoints of Projects"
 * )
 */

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Auth"},
     *     summary="Create new user",
     *     operationId="register",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             example={"name": "Marko", "email": "marko@mail.com", "password": "1234ABCDEF", "password_confirmation": "1234ABCDEF"},
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     format="email",
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     format="password",
     *                 )
     *             )
     *         )
     *    ),
     *    @OA\Response(
     *         response=422,
     *          description="Unprocessable Entity",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              example={
     *                "message": "The given data was invalid.",
     *                "errors": "All fields is required."
     *              }
     *          ),
     *          @OA\Schema(
     *              @OA\Property(
     *                  property="message"
     *              ),
     *              @OA\Property(
     *                  property="errors"
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              example={"message": "Data into fields is invalid."}
     *          ),
     *          @OA\Schema(
     *              @OA\Property(
     *                  property="message"
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="New user successfully register",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              example={"name": "Mike", "email": "Mike@mail.com", "password": "1234ABCD", "password_confirmation": "1234ABCD", "updated_at": "2020-02-12 14:59:40", "created_at": "2020-02-12 14:59:40", "id": "230",
     *                       "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC93YXJlaG91c2UubG9jYWxcL2FwaVwvbG9naW4iLCJpYXQiOjE1ODE1MTU0NjUsImV4cCI6MTU4MTUyMjY2NSwibmJmIjoxNTgxNTE1NDY1LCJqdGkiOiI1Wng0dTdYSXJ6V0JxczBtIiwic3ViIjoyMjgsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.6j2uTU6JruQ6ClMq1g-ReEbKcNV_8xSTwUpJwNuuWKw"}
     *          ),
     *          @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     format="email",
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     format="password",
     *                 ),
     *                 @OA\Property(
     *                     property="password_confirmation",
     *                     type="string",
     *                     format="password",
     *                 )
     *          )
     *     )
     * )
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]));

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
