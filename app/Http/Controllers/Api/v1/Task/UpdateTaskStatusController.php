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
     * @api {patch} /api/task/status/{id} Update the status of a task by ID
     * @apiName UpdateTaskStatusById
     * @apiGroup Tasks
     * @apiVersion 1.0.0
     * @apiDescription Update the status of a task by its ID.
     *
     * @apiHeader {String} Authorization Bearer Token.
     *
     * @apiParam {Number} id ID of the task to update.
     * @apiParam {String="todo","done"} status New status of the task.
     *
     * @apiSuccess {Number} id ID of the updated task.
     * @apiSuccess {String} title Title of the updated task.
     * @apiSuccess {String} status Status of the updated task.
     * @apiSuccess {String} created_at Date and time when the task was created.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "id": 1,
     *       "title": "Test Task",
     *       "status": false,
     *       "created_at": "2023-08-15T07:32:04.000000Z",
     *     }
     *
     * @apiError (401 Unauthorized) {String} message Error message when the user is not authenticated.
     * @apiError (404 Not Found) {String} message Error message when the task is not found.
     *
     * @apiErrorExample {json} Unauthorized:
     *     HTTP/1.1 401 Unauthorized
     *     {
     *       "message": "Unauthenticated."
     *     }
     *
     * @apiErrorExample {json} NotFound:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "message": "Task not found."
     *     }
     */
    public function __invoke(UpdateTaskStatusRequest $request, TaskRepository $taskRepository, Task $task): JsonResponse
    {
            return response()->json($taskRepository->updateStatus($task->id, $request->status));
    }
}
