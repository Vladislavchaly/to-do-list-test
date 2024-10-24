<?php

namespace App\Http\Controllers\Api\v1\Task;

use App\Contracts\TaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\GetTasksRequest;
use Illuminate\Http\JsonResponse;

class GetTasksController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/task",
     *     summary="Get list of tasks",
     *     description="Retrieve a list of tasks with optional filters and pagination.",
     *     operationId="getTasks",
     *     tags={"Tasks"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status of the task (nullable, valid values: 'todo', 'done')",
     *         @OA\Schema(type="string", enum={"todo", "done"}, nullable=true)
     *     ),
     *     @OA\Parameter(
     *         name="priority_from",
     *         in="query",
     *         description="Minimum priority value (nullable, integer)",
     *         @OA\Schema(type="integer", nullable=true)
     *     ),
     *     @OA\Parameter(
     *         name="priority_to",
     *         in="query",
     *         description="Maximum priority value (nullable, integer, must be greater than or equal to 'priority_from')",
     *         @OA\Schema(type="integer", nullable=true)
     *     ),
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Title of the task (nullable, string)",
     *         @OA\Schema(type="string", nullable=true)
     *     ),
     *     @OA\Parameter(
     *         name="sort_by",
     *         in="query",
     *         description="Field to sort by (nullable, valid values: 'created_at', 'due_date', 'priority')",
     *         @OA\Schema(type="string", enum={"created_at", "due_date", "priority"}, nullable=true)
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number (nullable, integer)",
     *         @OA\Schema(type="integer", nullable=true)
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Number of items per page (nullable, integer)",
     *         @OA\Schema(type="integer", nullable=true)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response with list of tasks",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Task")),
     *             @OA\Property(property="links", type="object", @OA\Property(property="first", type="string"), @OA\Property(property="last", type="string"), @OA\Property(property="prev", type="string"), @OA\Property(property="next", type="string")),
     *             @OA\Property(property="meta", type="object", @OA\Property(property="current_page", type="integer"), @OA\Property(property="from", type="integer"), @OA\Property(property="last_page", type="integer"), @OA\Property(property="links", type="array", @OA\Items(type="object")), @OA\Property(property="path", type="string"), @OA\Property(property="per_page", type="integer"), @OA\Property(property="to", type="integer"), @OA\Property(property="total", type="integer"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized: Bearer token is missing or invalid",
     *     ),
     * )
     */

    public function __invoke(GetTasksRequest $request, TaskRepository $taskRepository): JsonResponse
    {
        return response()->json(
            $taskRepository->getAllParentByUserId($request->user()->id, $request->all(), $request->page, $request->limit)
        );
    }
}
