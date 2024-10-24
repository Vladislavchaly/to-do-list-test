<?php

namespace App\Http\Controllers\Api\v1\Task;

use App\Contracts\TaskRepository;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetTaskController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/task/{id}",
     *     summary="Get a task by ID",
     *     description="Retrieve a task by its ID.",
     *     operationId="getTaskById",
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
     *         description="Successful response with a single task",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="priority", type="integer"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="sub_tasks", type="array", @OA\Items())
     *         )
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
    public function __invoke(Request $request, TaskRepository $taskRepository, Task $task): JsonResponse
    {
        return response()->json($taskRepository->getById($task->id));
    }
}
