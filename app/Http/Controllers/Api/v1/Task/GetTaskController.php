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
     * @api {get} /api/task/:id Get Task by ID
     * @apiName GetTaskById
     * @apiGroup Tasks
     * @apiVersion 1.0.0
     * @apiDescription Retrieves a task by its ID.
     *
     * @apiHeader {String} Authorization Bearer Token.
     *
     * @apiParam {Number} id The ID of the task to retrieve.
     *
     * @apiSuccess {Number} id The ID of the task.
     * @apiSuccess {String} title The title of the task.
     * @apiSuccess {String} status The status of the task.
     * @apiSuccess {Number} priority The priority of the task.
     * @apiSuccess {String} created_at The date and time when the task was created.
     * @apiSuccess {Object[]} sub_tasks The array of sub-tasks (if any).
     *
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {
     *   "id": 1,
     *   "title": "Test Task",
     *   "status": "todo",
     *   "priority": 3,
     *   "created_at": "2023-08-15T07:32:04.000000Z",
     *   "sub_tasks": []
     * }
     *
     * @apiError (401 Unauthorized) {String} message Error message when the user is not authenticated.
     *
     * @apiErrorExample {json} Unauthorized:
     * HTTP/1.1 401 Unauthorized
     * {
     *   "message": "Unauthenticated."
     * }
     *
     * @apiError (404 Not Found) {String} message Error message when the task is not found.
     *
     * @apiErrorExample {json} Not Found:
     * HTTP/1.1 404 Not Found
     * {
     *   "message": "Task not found."
     * }
     */
    public function __invoke(Request $request, TaskRepository $taskRepository, Task $task): JsonResponse
    {
        return response()->json($taskRepository->getById($task->id));
    }
}
