<?php

/**
 * @OA\Post(
 *     path="/post",
 *     tags={"Post"},
 *     summary="Create new post",
 *     operationId="store",
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             example={"storyImage": "example.jpg"},
 *             @OA\Schema(
 *                  @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                  @OA\Property(
 *                     property="public",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="picture",
 *                     type="file",
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
 *    @OA\Response(
 *          response=403,
 *          description="Not allowed",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              example={"message": "You are not allowed to delete this post"}
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
 *              example={"message":"lorepm ipsum","user_id":"13","updated_at": "2020-02-12 14:59:40", "created_at": "2020-02-12 14:59:40",
 *                       "token": "1Wd9HwTNVTccLYfvJ0gPXvghFZMIKqvBL1yEBqig"}
 *          )
 *     )
 * )
 */


/**
 * @OA\Delete(
 *     path="/post/{post}",
 *     tags={"Post"},
 *     summary="Delete post for a given ID",
 *     operationId="delete",
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *          name="post",
 *          in="path",
 *          description="Post ID",
 *          required=true,
 *          example=27,
 *          @OA\Schema(
 *              type="integer"
 *          )
 *     ),
 *     @OA\Response(
 *          response=404,
 *          description="Bad Request",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              example={"message": "No results for given ID of Post."}
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
 *          description="Successfully deleted posts!",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              example={
 *                  "message": "Record successfully deleted."
 *              },
 *          ),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="message",
 *              )
 *          )
 *     )
 * )
 */

/**
 * @OA\Patch(
 *     path="/post/{post}",
 *     tags={"Post"},
 *     summary="Update post for a given ID",
 *     operationId="update",
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *          name="post",
 *          in="path",
 *          description="Post ID",
 *          required=true,
 *          example=27,
 *          @OA\Schema(
 *              type="integer"
 *          )
 *     ),
 *     @OA\Parameter(
 *          name="message",
 *          in="query",
 *          description="Description of post",
 *          required=true,
 *          example="Lorem ipsum"
 *     ),
 *     @OA\Response(
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
 *          response=404,
 *          description="Bad Request",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              example={"message": "No query results for model [App\Post]."}
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
 *              example={"message": "Data into fields is invalid."}
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
 *          description="Post successfully updated",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              example={"warehouse": {
 *                          "id": 27,
 *                          "message": "Lorem ipsum"
 *                       },
 *                      "message": "Record successfully updated!"}
 *          ),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="post",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(
 *                          property="id",
 *                          type="integer",
 *                      ),
 *                      @OA\Property(
 *                          property="message",
 *                          type="string",
 *                      )
 *                  )
 *              ),
 *              @OA\Property(
 *                  property="message"
 *              )
 *          )
 *     )
 * )
 */
