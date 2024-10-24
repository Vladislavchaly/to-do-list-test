<?php

namespace App\Http\Controllers\Api\v1\Task;

use App\Contracts\TaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskRequest;
use Illuminate\Http\JsonResponse;

class CreateTaskController extends Controller
{
    /**
     * @api {post} /api/task Create New Task
     * @apiName CreateTask
     * @apiGroup Tasks
     * @apiVersion 1.0.0
     * @apiDescription Creates a new task.
     *
     * @apiHeader {String} Authorization Bearer Token.
     *
     * @apiParam {Number} [parentId] ID of the parent task (optional).
     * @apiParam {Number{1-5}} priority Priority of the task (minimum 1, maximum 5).
     * @apiParam {String} title Title of the task.
     * @apiParam {String} description Description of the task.
     * @apiParam {String} [completedAt] Date and time when the task was completed (optional).
     *
     * @apiParamExample {json} Request-Example:
     * {
     *   "parentId": 1,
     *   "priority": 2,
     *   "title": "Test Title",
     *   "description": "Test Description",
     *   "completedAt": "2023-08-14 10:18:05"
     * }
     *
     * @apiSuccess {Number} id ID of the created task.
     * @apiSuccess {String} title Title of the task.
     * @apiSuccess {String} status Status of the task ("todo", "in progress", etc.).
     * @apiSuccess {Number} priority Priority of the task.
     * @apiSuccess {String} created_at Date and time when the task was created.
     * @apiSuccess {Object[]} sub_tasks Array of sub-tasks (if any).
     *
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {
     *   "id": 9,
     *   "title": "Test Title",
     *   "status": "todo",
     *   "priority": 2,
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
