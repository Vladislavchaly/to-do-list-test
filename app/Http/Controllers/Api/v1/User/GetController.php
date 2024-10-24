<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/user/",
     *      operationId="getAuthUser",
     *      tags={"User"},
     *      summary="Get Auth user",
     *      description="Returns user by your Authorization token",
     *     @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          required=true,
     *          @OA\Schema(type="string"),
     *          description="Bearer Token",
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="User data",
     *     @OA\JsonContent(
     *                   @OA\Property(
     *                           property="id",type="id",  example="3",
     *                   ),
     *                   @OA\Property(
     *                           property="name",type="string",  example="John",
     *                   ),
     *                   @OA\Property(
     *                           property="email",type="string",  example="test@test.com",
     *                   ),
     *                   @OA\Property(
     *                           property="email_verified_at",type="string",  example="2022-01-13 15:54:1",
     *                   ),
     *                   @OA\Property(
     *                           property="created_at",type="string",  example="2022-01-13 15:54:1",
     *                   ),
     *                   @OA\Property(
     *                           property="updated_at",type="string",  example="2022-01-13 15:54:1",
     *                   ),
     *           ),
     *       ),
     *       @OA\Response(response=401,  description="Unauthorized",
     *           @OA\JsonContent(
     *               @OA\Property(property="message",type="string",  example="unauthenticated")
     *           )),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * Returns user by your Authorization token"
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}
