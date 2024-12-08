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
        $posts = $this->postRepository->getAll();
        return $this->getAll(PostResource::collection($posts));
    }

    public function show($id)
    {
        $post = $this->postRepository->getById($id);
        return $this->getOne(new PostResource($post));
    }

    public function store(Request $request)
    {
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
        $validated = $request->validate([
            'title' => 'string|max:255',
            'content' => 'string',
        ]);

        $post = $this->postRepository->update($id, $validated);
        return $this->getOne(new PostResource($post));
    }

    public function destroy($id)
    {
        $this->postRepository->delete($id);
        return $this->successResponse(['message' => 'Post deleted successfully'], 200);
    }
}
