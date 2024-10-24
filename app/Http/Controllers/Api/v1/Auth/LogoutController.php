<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * @OA\Delete(
     *      path="/api/auth/logout",
     *      operationId="logoutUser",
     *      tags={"Authentication"},
     *      summary="Logout the authenticated user",
     *      description="Logout the currently authenticated user",
     *      security={
     *          {"bearerAuth": {}}
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="User successfully logged out",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="bool", example="true"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized - User not authenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated."),
     *          ),
     *      ),
     * )
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($request->user()->currentAccessToken()->delete());
    }
}
