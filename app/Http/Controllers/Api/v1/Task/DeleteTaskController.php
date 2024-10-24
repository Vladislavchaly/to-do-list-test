<?php

namespace App\Http\Controllers\Api\v1\Task;

use App\Contracts\TaskRepository;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class DeleteTaskController extends Controller
{
    /**
     * @api {delete} /api/task/:id Delete Task by ID
     * @apiName DeleteTaskById
     * @apiGroup Tasks
     * @apiVersion 1.0.0
     * @apiDescription Deletes a task by its ID.
     *
     * @apiHeader {String} Authorization Bearer Token.
     *
     * @apiParam {Number} id The ID of the task to be deleted.
     *
     * @apiSuccess {String} message Task successfully deleted.
     *
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {
     *   "message": "Task deleted successfully."
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
    public function __invoke(TaskRepository $taskRepository, Task $task): JsonResponse
    {
        return response()->json($taskRepository->delete($task->id));
    }
}
