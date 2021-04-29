<?php

/**
 * @OA\Post(
 *     path="/story",
 *     tags={"Story"},
 *     summary="Create new story",
 *     operationId="store",
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             example={"storyImage": "example.jpg"},
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="storyImage",
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
 *     @OA\Response(
 *          response=200,
 *          description="New user successfully register",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              example={"storyImage":"example.png","user_id":"13","updated_at": "2020-02-12 14:59:40", "created_at": "2020-02-12 14:59:40",
 *                       "token": "1Wd9HwTNVTccLYfvJ0gPXvghFZMIKqvBL1yEBqig"}
 *          )
 *     )
 * )
 */

/**
 * @OA\Post(
 *     path="/story/delete/{id}",
 *     tags={"Story"},
 *     summary="Delete story for a given ID",
 *     operationId="delete",
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *          name="id",
 *          in="path",
 *          description="Story ID",
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
 *              example={"message": "No results for given ID of Story."}
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
