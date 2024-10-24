<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use App\Contracts\UserRepository as UserRepositoryContract;

final class UserRepository implements UserRepositoryContract
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        $this->model->fill($data);

        $this->model->save();

        return $this->model;
    }

    public function update(int $id, array $data): bool
    {
        return $this->model->find($id)->update($data);
    }

    public function delete(int $id): void
    {
        $this->model->destroy($id);
    }

    public function getAll(): Collection
    {
        return $this->model->get();
    }

    public function getById(int $id): User
    {
        return $this->model->find($id)->first();
    }

    public function getByEmail(string $email): User
    {
        return $this->model->where('email', $email)->first();
    }

    public function getByToken(string $token): User
    {
        return $this->model->where('token', $token)->first();
    }
}
