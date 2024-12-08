<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class PermissionController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $permissions = Permission::latest()->get();
            return $this->getAll($permissions);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255|unique:permissions',
            ]);

            $permission = Permission::create($data);

            return $this->getOne($permission, 201);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $permission = Permission::findOrFail($id);
            return $this->getOne($permission);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255|unique:permissions,name,' . $id,
            ]);

            $permission = Permission::findOrFail($id);
            $permission->update($data);

            return $this->getOne($permission);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();

            return $this->successResponse(['message' => 'Permission deleted successfully'], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 404);
        }
    }
}
