<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepository
{
    public function create(array $data): User;

    public function update(int $id, array $data): bool;

    public function delete(int $id): void;

    public function getAll(): Collection;

    public function getById(int $id): User;

    public function getByEmail(string $email): User;

    public function getByToken(string $token): ?User;
}
