<?php

namespace App\Http\Controllers\Api\v1\Task;

use App\Contracts\TaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UpdateTaskStatusRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class UpdateTaskStatusController extends Controller
{
    public function __invoke(UpdateTaskStatusRequest $request, TaskRepository $taskRepository, Task $task): JsonResponse
    {
            return response()->json($taskRepository->updateStatus($task->id, $request->status));
    }
}
