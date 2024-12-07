<?php

namespace App\Interfaces;

interface RoleRepositoryInterface
{
    public function all();
    public function findById($id);
    public function create(array $data);
    public function assignPermissions($roleId, array $permissions);
}
