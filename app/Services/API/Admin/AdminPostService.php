<?php

namespace App\Services\API\Admin;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Admin\Post\AdminPostResource;
use App\Models\Post;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class AdminPostService
{

    public function index(): AnonymousResourceCollection
    {
        return AdminPostResource::collection(Post::paginate(10));
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        try {
            $post = Post::create([
                'title' => $request->validated('title'),
                'content' => $request->validated('content'),
                'user_id' => Auth::id(),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
            ],
        ], 201);
    }

    public function update(Post $post, UpdatePostRequest $request): JsonResponse
    {
        try {
            $post->update([
                'title' => $request->validated('title'),
                'content' => $request->validated('content'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully',
        ]);
    }

    public function delete(Post $post): JsonResponse
    {
        $post->delete();
        return response()->json([
            'success' => true,
            'message' => 'Post soft deleted successfully',
        ]);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->forceDelete();
        return response()->json([
            'success' => true,
            'message' => 'Post destroyed successfully',
        ]);
    }
}
