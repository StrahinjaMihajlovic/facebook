<?php

/**
 * @OA\Get(
 *      path="/message/{id}",
 *      operationId="getMessageById",
 *      tags={"Messages"},
 *      summary="Get message information",
 *      description="Returns message data",
 *      security={{"bearerAuth": {}}},
 *      @OA\Parameter(
 *          name="id",
 *          description="Message id",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *           description="Succeseful Request"
 *       ),
 *      @OA\Response(
 *          response=400,
 *          description="Bad Request"
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *      ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */
