<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Contracts\TaskRepository as TaskRepositoryContract;

final class TaskRepository implements TaskRepositoryContract
{
    protected $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Task
    {
        $this->model->fill($data);

        $this->model->save();

        return $this->model;
    }

    public function update(int $id, array $data): Task
    {
        $task = $this->model::find($id);

        if ($task) {
            $task->update($data);
        }

        return $task;
    }

    public function delete(int $id): bool
    {
        return $this->model::query()
            ->where('id', $id)
            ->where('status', 'todo')
            ->delete();
    }

    public function getAll(): Collection
    {
        return $this->model::all();
    }

    public function getById(int $id): Task
    {
        return $this->model->find($id);
    }

    public function getByIdAndUserId(int $id, int $userId): Task
    {

        return $this->model->where('id', $id)->where('user_id', $userId)->first();
    }

    public function getAllParentByUserId(int $userId, array $filters, ?int $page = 1, ?int $limit = 15): LengthAwarePaginator
    {
        $query = $this->model::query()->where('user_id', $userId)->whereNull('parent_id');

        $this->applyFiltersToQuery($query, $filters);

        return $query->paginate($limit, ['*'], 'page', $page);
    }

    public function getAllByUserId(int $userId, array $filters, int $page, int $limit): LengthAwarePaginator
    {
        $query = $this->model::query()->where('user_id', $userId);

        $this->applyFiltersToQuery($query, $filters);

        return $query->paginate($limit, ['*'], 'page', $page);
    }

    /**
     * @throws \Exception
     */
    public function updateStatus(int $id, string $status): Task
    {
        $task = $this->model::find($id);

        if (!$task) {
            throw new \Exception("Task with ID $id not found.");
        }

        $task->update(['status' => $status]);

        return $task;
    }

    private function applyFiltersToQuery(Builder $query, array $filters): void
    {
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['priority_from'])) {
            $query->where('priority', '>=', $filters['priority_from']);
        }

        if (isset($filters['priority_to'])) {
            $query->where('priority', '<=', $filters['priority_to']);
        }

        if (isset($filters['title'])) {
            $query->where('title', 'LIKE', '%' . $filters['title'] . '%');
        }

        if (isset($filters['sort_by'])) {
            $query->orderBy($filters['sort_by']);
        }

    }
}
