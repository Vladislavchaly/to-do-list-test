<?php

namespace App\Http\Controllers\Api\v1\Task;

use App\Contracts\TaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UpdateTaskStatusRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class UpdateTaskStatusController extends Controller
{
    /**
     * @OA\Patch(
     *     path="/api/task/status/{id}",
     *     summary="Update the status of a task by ID",
     *     description="Update the status of a task by its ID.",
     *     operationId="updateTaskStatusById",
     *     tags={"Tasks"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the task",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", enum={"todo", "done"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response with updated task",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
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

    public function __invoke(UpdateTaskStatusRequest $request, TaskRepository $taskRepository, Task $task): JsonResponse
    {
            return response()->json($taskRepository->updateStatus($task->id, $request->status));
    }
}
