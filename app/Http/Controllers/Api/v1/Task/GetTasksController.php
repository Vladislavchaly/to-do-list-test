<?php

namespace App\Http\Controllers\Api\v1\Task;

use App\Contracts\TaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\GetTasksRequest;
use Illuminate\Http\JsonResponse;

class GetTasksController extends Controller
{
    public function __invoke(GetTasksRequest $request, TaskRepository $taskRepository): JsonResponse
    {
        return response()->json(
            $taskRepository->getAllParentByUserId($request->user()->id, $request->all(), $request->page, $request->limit)
        );
    }
}
