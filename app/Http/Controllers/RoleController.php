<?php

namespace App\Http\Controllers;

    use App\Http\Resources\RoleResource;
    use App\Interfaces\RoleRepositoryInterface;
    use App\Models\Permission;
    use Illuminate\Http\Request;

class RoleController extends ApiController
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $roles = $this->roleRepository->all();
        return RoleResource::collection($roles);
    }

    public function show($id)
    {
        $role = $this->roleRepository->findById($id);
        return new RoleResource($role);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|unique:roles,name']);
        $role = $this->roleRepository->create($validated);
        return new RoleResource($role);
    }

    public function assignPermissions(Request $request, $id)
    {
        $validated = $request->validate([
            'permissions' => 'required|array'
        ]);

        $role = $this->roleRepository->findById($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }
        $permissions = $validated['permissions'];
        foreach ($permissions as $permissionId) {
            $permission = Permission::find($permissionId);
            if (!$permission) {
                return response()->json(['message' => 'One or more permissions not found'], 404);
            }
        }
        $role->permissions()->sync($permissions);
        return response()->json(['message' => 'Permissions assigned successfully'], 200);
    }
}
