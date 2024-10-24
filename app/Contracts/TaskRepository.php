<?php

namespace App\Contracts;

use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface TaskRepository
{
    public function create(array $data): Task;

    public function update(int $id, array $data): Task;

    public function delete(int $id): bool;

    public function getAll(): Collection;

    public function getByIdAndUserId(int $id, int $userId): Task;

    public function getAllByUserId(int $userId, array $filters, int $page, int $limit): LengthAwarePaginator;

    public function getAllParentByUserId(int $userId, array $filters, int $page = 1, int $limit = 15): LengthAwarePaginator;

    public function getById(int $id): Task;

    public function updateStatus(int $id, string $status): Task;
}
