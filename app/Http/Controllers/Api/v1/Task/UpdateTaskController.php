<?php

namespace App\Http\Controllers\Api\v1\Task;

use App\Contracts\TaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class UpdateTaskController extends Controller
{
    /**
     * @api {put} /api/task/{id} Update a task by ID
     * @apiName UpdateTaskById
     * @apiGroup Tasks
     * @apiVersion 1.0.0
     * @apiDescription Update a task by its ID.
     *
     * @apiHeader {String} Authorization Bearer Token.
     *
     * @apiParam {Number} id ID of the task to update.
     * @apiParam {Number} [parentId] ID of the parent task (if any).
     * @apiParam {Number} [priority] Priority of the task.
     * @apiParam {String} [title] Title of the task.
     * @apiParam {String} [description] Description of the task.
     * @apiParam {String} [completedAt] Date and time when the task was completed (format: date-time).
     *
     * @apiSuccess {Number} id ID of the updated task.
     * @apiSuccess {String} title Title of the updated task.
     * @apiSuccess {String} status Status of the updated task.
     * @apiSuccess {Number} priority Priority of the updated task.
     * @apiSuccess {String} created_at Date and time when the task was created.
     * @apiSuccess {Object[]} sub_tasks Array of sub-tasks (if any).
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "id": 1,
     *       "title": "Updated Task Title",
     *       "status": "todo",
     *       "priority": 3,
     *       "created_at": "2023-08-15T07:32:04.000000Z",
     *       "sub_tasks": []
     *     }
     *
     * @apiError (401 Unauthorized) {String} message Error message when the user is not authenticated.
     * @apiError (404 Not Found) {String} message Error message when the task is not found.
     * @apiError (422 Unprocessable Entity) {String} message Error message when validation fails.
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
     *
     * @apiErrorExample {json} ValidationError:
     *     HTTP/1.1 422 Unprocessable Entity
     *     {
     *       "message": "Validation failed.",
     *       "errors": {
     *         "title": ["The title field is required."]
     *       }
     *     }
     */
    public function __invoke(UpdateTaskRequest $request, TaskRepository $taskRepository, Task $task): JsonResponse
    {
        return response()->json($taskRepository->update($task->id, $request->all()));
    }
}
