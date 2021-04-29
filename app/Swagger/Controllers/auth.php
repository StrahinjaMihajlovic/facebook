<?php

/**
 * @OA\Post(
 *     path="/register",
 *     tags={"Auth"},
 *     summary="Create new user",
 *     operationId="register",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             example={"name": "Example", "email": "example@gmail.com", "password": "ahasadkao1", "password_confirmation": "ahasadkao1"},
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
 *                 ),
 *                @OA\Property(
 *                     property="password_confirmation",
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
 *              example={"name": "Example", "email": "example@gmail.com", "password": "ahasadkao1", "password_confirmation": "ahasadkao1", "updated_at": "2020-02-12 14:59:40", "created_at": "2020-02-12 14:59:40", "id": "230",
 *                       "token": "1Wd9HwTNVTccLYfvJ0gPXvghFZMIKqvBL1yEBqig"}
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

/**
 * @OA\Post(
 *     path="/login",
 *     tags={"Auth"},
 *     summary="Log in the user",
 *     operationId="authenticate",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="email",
 *                     type="string",
 *                     format="email"
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string",
 *                     format="password"
 *                 ),
 *                 example={"email": "example@gmail.com", "password": "ahasadkao1"}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *          response=422,
 *          description="Unprocessable Entity",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              example={
 *                "message": "The given data was invalid.",
 *                "errors": {"email": {{"The email field is required."}}}
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
 *          response=401,
 *          description="Unauthorized",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              example={"message": "Invalid credentials"}
 *          ),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="message"
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *          response=500,
 *          description="Internal Server Error",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              example={"message": "Internal Server Error"}
 *          ),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="message"
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="Success login",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              example={"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTU2MjQxMjcwOSwiZXhwIjoxNTYyNDE2MzA5LCJuYmYiOjE1NjI0MTI3MDksImp0aSI6Iks5Y1VrTXp4czhFaTZQUVAiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.PeZ-4rdDdAxWgQEcv0ypASQkq3vNOVvc75Gd3Kc4raE"}
 *          ),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="token"
 *              )
 *          )
 *     )
 * )
 */

/**
 * @OA\POST(
 *     path="/logout",
 *     tags={"Auth"},
 *     summary="Logout the user",
 *     operationId="logout",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *          response=422,
 *          description="Unprocessable Entity",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              example={
 *                "message": "The given data was invalid.",
 *                "errors": {"token": {{"The token field is required."}}}
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
 *          response=401,
 *          description="Unauthorized",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              example={"message": "User must first login."}
 *          ),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="message"
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *          response=400,
 *          description="Bad Request",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              example={"message": "Given token is invalid."}
 *          ),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="message"
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="Logout successfully",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              example={"message": "User has successfully logged out"}
 *          ),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="message"
 *              )
 *          )
 *     )
 * )
 */
