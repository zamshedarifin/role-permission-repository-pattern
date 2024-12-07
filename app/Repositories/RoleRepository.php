<?php

namespace App\Repositories;

use App\Models\Role;
use App\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{

    public function all()
    {
        return Role::with('permissions')->get();
    }

    public function findById($id)
    {
        return Role::with('permissions')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Role::create($data);
    }

    public function assignPermissions($roleId, array $permissions)
    {
        $role = Role::findOrFail($roleId);
        $role->permissions()->sync($permissions);
    }
}
