<?php

namespace App\Http\Controllers\Api\v1\Task;

use App\Contracts\TaskRepository;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class DeleteTaskController extends Controller
{
    public function __invoke(TaskRepository $taskRepository, Task $task): JsonResponse
    {
        return response()->json($taskRepository->delete($task->id));
    }
}
