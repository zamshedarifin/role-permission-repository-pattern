<?php

namespace App\Http\Controllers;

    use App\Http\Resources\RoleResource;
    use App\Interfaces\RoleRepositoryInterface;
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
        $validated = $request->validate(['permissions' => 'required|array']);
        $this->roleRepository->assignPermissions($id, $validated['permissions']);
        return response()->json(['message' => 'Permissions assigned successfully']);
    }
}
