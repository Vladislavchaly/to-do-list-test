<?php

namespace App\Http\Controllers\Api\v1\Task;

use App\Contracts\TaskRepository;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetTaskController extends Controller
{
    public function __invoke(Request $request, TaskRepository $taskRepository, Task $task): JsonResponse
    {
        return response()->json($taskRepository->getById($task->id));
    }
}
