<?php

namespace App\Http\Controllers\Api\v1\Task;

use App\Contracts\TaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskRequest;
use Illuminate\Http\JsonResponse;

class CreateTaskController extends Controller
{
    public function __invoke(CreateTaskRequest $request, TaskRepository $taskRepository): JsonResponse
    {
        return response()->json(
                $taskRepository->create(
                    array_merge(
                        ['user_id' => $request->user()->id],
                        $request->all()
                    )
                )
        );
    }
}
