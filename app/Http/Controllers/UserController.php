<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // Get all users
    public function index()
    {
        $users = $this->userRepository->all();
        return response()->json(['data' => $users]);
    }

    // Show a user by ID
    public function show($id)
    {
        $user = $this->userRepository->findById($id);
        if ($user) {
            return response()->json(['data' => $user]);
        }
        return response()->json(['message' => 'User not found'], 404);
    }

    // Store a new user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
        ]);
        $user = $this->userRepository->create($validated);
        return response()->json(['data' => $user], 201);
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'string',
            'email' => 'string|email|unique:users,email,' . $id,
            'password' => 'string|min:8',
        ]);
        $user = $this->userRepository->update($id, $validated);
        return response()->json(['data' => $user]);
    }

    // Delete a user
    public function destroy($id)
    {
        $deleted = $this->userRepository->delete($id);
        if ($deleted) {
            return response()->json(['message' => 'User deleted successfully']);
        }
        return response()->json(['message' => 'User not found'], 404);
    }

    // Assign a role to a user
    public function assignAdminRole(Request $request, $userId)
    {
        $validated = $request->validate(['role_id' => 'required|exists:roles,id']);
        $assigned = $this->userRepository->assignRole($userId, $validated['role_id']);
        if ($assigned) {
            return response()->json(['message' => 'Role assigned successfully']);
        }
        return response()->json(['message' => 'Error assigning role'], 400);
    }
}
