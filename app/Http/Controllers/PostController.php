<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Interfaces\PostRepositoryInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PostController extends ApiController
{
    use ApiResponse;

    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        if (!auth()->user()->hasPermission('view-post')) {
            return $this->errorResponse('Forbidden: You do not have the required permission', 403);
        }

        $posts = $this->postRepository->getAll();
        return $this->getAll(PostResource::collection($posts));
    }

    public function show($id)
    {
        if (!auth()->user()->hasPermission('view-post')) {
            return $this->errorResponse('Forbidden: You do not have the required permission', 403);
        }

        $post = $this->postRepository->getById($id);
        return $this->getOne(new PostResource($post));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasPermission('create-post')) {
            return $this->errorResponse('Forbidden: You do not have the required permission', 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $post = $this->postRepository->create($validated);
        return $this->getOne(new PostResource($post), 201);
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasPermission('update-post')) {
            return $this->errorResponse('Forbidden: You do not have the required permission', 403);
        }

        $validated = $request->validate([
            'title' => 'string|max:255',
            'content' => 'string',
        ]);

        $post = $this->postRepository->update($id, $validated);
        return $this->getOne(new PostResource($post));
    }

    public function destroy($id)
    {
        if (!auth()->user()->hasPermission('delete-post')) {
            return $this->errorResponse('Forbidden: You do not have the required permission', 403);
        }
        $this->postRepository->delete($id);
        return $this->successResponse(['message' => 'Post deleted successfully'], 200);
    }
}
