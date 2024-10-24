<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}
