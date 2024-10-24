<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Contracts\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    /**
     * @api {post} /api/auth/register Register New User
     * @apiName RegisterUser
     * @apiGroup Authentication
     * @apiVersion 1.0.0
     * @apiDescription Registers a new user with the provided credentials.
     *
     * @apiParam {String} email User's email address.
     * @apiParam {String} password User's password (minimum 8 characters).
     * @apiParam {String} password_confirmation Confirmation of the user's password.
     * @apiParam {String} name User's full name.
     *
     * @apiParamExample {json} Request-Example:
     * {
     *   "email": "test@gmail.com",
     *   "password": "Test1234",
     *   "password_confirmation": "Test1234",
     *   "name": "Test User Name"
     * }
     *
     * @apiSuccess {String} token The token for the authenticated user.
     *
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {
     *   "token": "example_token_string"
     * }
     *
     * @apiError (422 Unprocessable Entity) {String} message Error message describing why the data was invalid.
     * @apiError (422 Unprocessable Entity) {Object} errors Detailed errors for specific fields.
     *
     * @apiErrorExample {json} Validation Error:
     * HTTP/1.1 422 Unprocessable Entity
     * {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "email": ["The email has already been taken."],
     *     "password": ["The password confirmation does not match."]
     *   }
     * }
     */
    public function __invoke(
        RegistrationRequest $request,
        UserRepository $userRepository
    ): JsonResponse {
        $user = $userRepository->create($request->all());

        return response()->json([
            'token' => 'Bearer ' . $user->createToken('api')->accessToken,
        ]);
    }
}
