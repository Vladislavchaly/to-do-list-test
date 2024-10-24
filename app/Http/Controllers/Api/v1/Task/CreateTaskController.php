<?php

namespace App\Http\Controllers\Api\v1\Task;

use App\Contracts\TaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskRequest;
use Illuminate\Http\JsonResponse;

class CreateTaskController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/task/",
     *      operationId="createTask",
     *      tags={"Tasks"},
     *      summary="Create a new task",
     *      description="Create a new task",
     *      security={
     *          {"bearerAuth": {}}
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="parentId", type="integer", description="ID of the parent task (if any)", example=1),
     *              @OA\Property(property="priority", type="integer", description="Priority of the task min 1 max 5", example=2),
     *              @OA\Property(property="title", type="string", description="Title of the task", example="Test Title"),
     *              @OA\Property(property="description", type="string", description="Description of the task", example="Test Description"),
     *              @OA\Property(property="completedAt", type="string", description="Date and time of completion (optional)", example="2023-08-14 10:18:05"),
     *          ),
     *      ),
     *     @OA\Response(
     *           response=200,
     *           description="Task created successfully",
     *           @OA\JsonContent(
     *               @OA\Property(property="id", type="integer", description="ID of the created task", example=9),
     *               @OA\Property(property="title", type="string", description="Title of the task", example="Test Title"),
     *               @OA\Property(property="status", type="string", description="Status of the task", example="todo"),
     *               @OA\Property(property="priority", type="integer", description="Priority of the task", example=2),
     *               @OA\Property(property="created_at", type="string", description="Date and time of creation", example="2023-08-15T07:32:04.000000Z"),
     *               @OA\Property(property="sub_tasks", type="array", description="Array of sub-tasks", @OA\Items()),
     *           ),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized - User not authenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated."),
     *          ),
     *      ),
     * )
     */
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
