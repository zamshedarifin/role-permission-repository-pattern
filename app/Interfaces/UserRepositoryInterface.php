<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;
    public function findById($id): ?User;
    public function create(array $data): User;
    public function update($id, array $data): User;
    public function delete($id): bool;
    public function assignRole($userId, $roleId): bool;
}
