<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Contracts\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    /**
     * @api {post} /api/auth/login User Login
     * @apiName UserLogin
     * @apiGroup User
     * @apiDescription This endpoint logs in the user and returns a token for API authentication.
     *
     * @apiParam {String} email User email.
     * @apiParam {String} password User password.
     *
     * @apiSuccess {String} token The authentication token for the user.
     *
     * @apiError (422) {String} error Returns if authentication fails (invalid email or password).
     */

    public function __invoke(LoginRequest $request, UserRepository $userRepository): JsonResponse
    {
        if (auth()->attempt($request->all())) {
            $user = $userRepository->getByEmail($request['email']);

            return response()->json([
                'token' => 'Bearer ' . $user->createToken('api')->accessToken,
            ]);
        }

        return response()->json('auth.failed', 422);
    }
}
