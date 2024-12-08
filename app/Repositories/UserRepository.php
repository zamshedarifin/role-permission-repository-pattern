<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Role;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function all(): Collection
    {
        return User::all();
    }

    public function findById($id): ?User
    {
        return User::find($id);
    }
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update($id, array $data): User
    {
        $user = $this->findById($id);
        if ($user) {
            $user->update($data);
        }
        return $user;
    }

    public function delete($id): bool
    {
        $user = $this->findById($id);
        return $user ? $user->delete() : false;
    }
    public function assignRole($userId, $roleId): bool
    {
        $user = $this->findById($userId);
        $role = Role::find($roleId);

        if ($user && $role) {
            $user->roles()->syncWithoutDetaching($role->id);
            return true;
        }
        return false;
    }
}
