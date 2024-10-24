<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetController extends Controller
{
    /**
     * @api {get} /api/user Get Authenticated User
     * @apiName GetAuthUser
     * @apiGroup User
     * @apiVersion 1.0.0
     * @apiDescription Returns user data based on the provided Bearer Token.
     *
     * @apiHeader {String} Authorization Bearer Token.
     *
     * @apiSuccess {Number} id User's ID.
     * @apiSuccess {String} name User's name.
     * @apiSuccess {String} email User's email.
     * @apiSuccess {String} email_verified_at Email verification date and time.
     * @apiSuccess {String} created_at Account creation date and time.
     * @apiSuccess {String} updated_at Account last update date and time.
     *
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {
     *   "id": 3,
     *   "name": "John",
     *   "email": "test@test.com",
     *   "email_verified_at": "2022-01-13 15:54:12",
     *   "created_at": "2022-01-13 15:54:12",
     *   "updated_at": "2022-01-13 15:54:12"
     * }
     *
     * @apiError (401 Unauthorized) {String} message Error message if authentication fails.
     *
     * @apiErrorExample {json} Unauthorized:
     * HTTP/1.1 401 Unauthorized
     * {
     *   "message": "unauthenticated"
     * }
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}
