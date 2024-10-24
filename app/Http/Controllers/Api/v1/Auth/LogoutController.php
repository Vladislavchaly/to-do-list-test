<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * @api {delete} /api/auth/logout Logout User
     * @apiName LogoutUser
     * @apiGroup Authentication
     * @apiVersion 1.0.0
     * @apiDescription Logs out the currently authenticated user.
     *
     * @apiHeader {String} Authorization Bearer Token.
     *
     * @apiSuccess {Boolean} message Indicates the user has been successfully logged out.
     *
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {
     *   "message": true
     * }
     *
     * @apiError (401 Unauthorized) {String} message Error message if the user is not authenticated.
     *
     * @apiErrorExample {json} Unauthorized:
     * HTTP/1.1 401 Unauthorized
     * {
     *   "message": "Unauthenticated."
     * }
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($request->user()->currentAccessToken()->delete());
    }
}
