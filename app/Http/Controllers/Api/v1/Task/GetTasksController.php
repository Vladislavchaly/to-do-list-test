<?php

namespace App\Http\Controllers\Api\v1\Task;

use App\Contracts\TaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\GetTasksRequest;
use Illuminate\Http\JsonResponse;

class GetTasksController extends Controller
{
    /**
     * @api {get} /api/task Get List of Tasks
     * @apiName GetTasks
     * @apiGroup Tasks
     * @apiVersion 1.0.0
     * @apiDescription Retrieve a list of tasks with optional filters and pagination.
     *
     * @apiHeader {String} Authorization Bearer Token.
     *
     * @apiParam {Boolean} [status] Status of the task (optional, `true` for completed, `false` for incomplete).
     * @apiParam {String} [title] Title of the task (optional).
     * @apiParam {String="created_at","due_date","priority"} [sort_by] Field to sort by (optional).
     * @apiParam {Number} [page] Page number (optional).
     * @apiParam {Number} [limit] Number of items per page (optional).
     *
     * @apiSuccess {Object[]} data List of tasks.
     * @apiSuccess {Number} data.id ID of the task.
     * @apiSuccess {String} data.title Title of the task.
     * @apiSuccess {Boolean} data.status Status of the task (`true` for completed, `false` for incomplete).
     * @apiSuccess {String} data.created_at Date and time when the task was created.
     * @apiSuccess {Object} links Pagination links.
     * @apiSuccess {String} links.first URL to the first page.
     * @apiSuccess {String} links.last URL to the last page.
     * @apiSuccess {String} links.prev URL to the previous page.
     * @apiSuccess {String} links.next URL to the next page.
     * @apiSuccess {Object} meta Pagination metadata.
     * @apiSuccess {Number} meta.current_page Current page number.
     * @apiSuccess {Number} meta.from Starting index of items on the current page.
     * @apiSuccess {Number} meta.last_page Last page number.
     * @apiSuccess {Number} meta.per_page Number of items per page.
     * @apiSuccess {Number} meta.to Ending index of items on the current page.
     * @apiSuccess {Number} meta.total Total number of tasks.
     *
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {
     *   "data": [
     *     {
     *       "id": 1,
     *       "title": "Test Task",
     *       "status": true,
     *       "priority": 3,
     *       "created_at": "2023-08-15T07:32:04.000000Z",
     *       "sub_tasks": []
     *     }
     *   ],
     *   "links": {
     *     "first": "http://example.com/api/task?page=1",
     *     "last": "http://example.com/api/task?page=10",
     *     "prev": null,
     *     "next": "http://example.com/api/task?page=2"
     *   },
     *   "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 10,
     *     "per_page": 10,
     *     "to": 10,
     *     "total": 100
     *   }
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
    public function __invoke(GetTasksRequest $request, TaskRepository $taskRepository): JsonResponse
    {
        return response()->json(
            $taskRepository->getAllByUserId(
                $request->user()->id,
                $request->all(),
                $request->page,
                $request->limit
            )
        );
    }
}
