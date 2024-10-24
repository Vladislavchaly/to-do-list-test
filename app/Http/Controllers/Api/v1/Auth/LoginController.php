<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Contracts\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="User Login",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="token", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *     ),
     * )
     */
    public function __invoke(LoginRequest $request, UserRepository $userRepository): JsonResponse
    {
        if (auth()->attempt($request->all())) {
            $user = $userRepository->getByEmail($request['email']);

            return response()->json([
                'token' => 'Bearer ' . $user->createToken('api')->accessToken,
            ]);
        }

        return response()->json(__('auth.failed'), 422);
    }
}
