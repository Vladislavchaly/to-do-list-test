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
     * @apiParam {String} title Title of the task.
     * @apiParam {String} description Description of the task.
     * @apiParam {String} [cratedAt] Date and time when the task was completed (optional).
     *
     * @apiParamExample {json} Request-Example:
     * {
     *   "name": "Test Title",
     *   "description": "Test Description"
     * }
     *
     * @apiSuccess {Number} id ID of the created task.
     * @apiSuccess {String} title Title of the task.
     * @apiSuccess {String} status Status of the task (true or false).
     * @apiSuccess {String} created_at Date and time when the task was created.
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
