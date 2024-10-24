<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Contracts\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/auth/register",
     *      operationId="registerUser",
     *      tags={"Authentication"},
     *      summary="Register a new user",
     *      description="Register a new user with the provided credentials",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"email", "password", "password_confirmation", "name"},
     *              @OA\Property(property="email", type="string", format="email", example="tesSSt@gmail.com"),
     *              @OA\Property(property="password", type="string", format="password", example="Test1234"),
     *              @OA\Property(property="password_confirmation", type="string", format="password", example="Test1234"),
     *              @OA\Property(property="name", type="string", example="Test User Name"),
     *          ),
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="token", type="string"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity - Validation Error",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The given data was invalid."),
     *              @OA\Property(property="errors", type="object"),
     *          ),
     *      ),
     * )
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
