<?php

namespace App\Http\Controllers\Api\v1\Task;

use App\Contracts\TaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class UpdateTaskController extends Controller
{
    public function __invoke(UpdateTaskRequest $request, TaskRepository $taskRepository, Task $task): JsonResponse
    {
        return response()->json($taskRepository->update($task->id, $request->all()));
    }
}
