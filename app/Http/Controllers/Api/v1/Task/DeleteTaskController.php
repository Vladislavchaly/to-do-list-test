<?php

namespace App\Http\Controllers\Api\v1\Task;

use App\Contracts\TaskRepository;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class DeleteTaskController extends Controller
{
    /**
     * @OA\Delete(
     *     path="/api/task/{id}",
     *     summary="Delete a task by ID",
     *     description="Delete a task by its ID.",
     *     operationId="deleteTaskById",
     *     tags={"Tasks"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the task",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response indicating task deletion",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized: Bearer token is missing or invalid",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found",
     *     ),
     * )
     */
    public function __invoke(TaskRepository $taskRepository, Task $task): JsonResponse
    {
        return response()->json($taskRepository->delete($task->id));
    }
}
