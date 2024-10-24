<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Contracts\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
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
